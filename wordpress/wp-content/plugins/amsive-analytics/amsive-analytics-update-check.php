<?php



add_filter('site_transient_update_plugins', 'check_plugin_update_from_github');

function check_plugin_update_from_github($transient)
{
    if (empty($transient->checked)) {
        return $transient;
    }


    $current_version = $transient->checked[PLUGIN_BASENAME] ?? '';
    $release = get_latest_github_release();
    if (!$release || version_compare($current_version, ltrim($release->tag_name, 'v'), '>=')) {
        return $transient;
    }

    // Update the transient to include our update
    $transient->response[PLUGIN_BASENAME] = (object) [
        'url' => $release->html_url,
        'slug' => PLUGIN_BASENAME,
        'package' => $release->browser_download_url,
        'new_version' => ltrim($release->tag_name, 'v')
    ];

    echo "1";

    return $transient;
}

function get_latest_github_release()
{

    // get access token from settings
    $options = get_option('amsive_analytics_options');
    if (!isset($options['access_token'])) {
        // show admin notice if access token is not set, update will not work

        $options['access_token_set'] = '';

        // save variable to settings with empty value
        update_option('amsive_analytics_options', $options);

        add_action('admin_notices', 'amsive_analytics_admin_notice_missing_access_token');
        return false;
    }

    $response = wp_remote_get("https://api.github.com/repos/Amsive-Digital/amsive-analytics/releases/latest", [
        'headers' => [
            'Authorization' => 'Bearer ' . $options['access_token'],
            'User-Agent' => 'WordPress/' . $GLOBALS['wp_version'] . '; ' . home_url()
        ]
    ]);

    if (is_wp_error($response)) {
        return false;
    }

    $release_data = json_decode(wp_remote_retrieve_body($response), true);
    error_log(print_r($release_data, true));
    if (isset($release_data['message']) && $release_data['message'] == 'Bad credentials') {

        $options['access_token_set'] = 'bad';

        // save variable to settings with value 'bad'
        update_option('amsive_analytics_options', $options);

        // bad credentials, show admin notice
        add_action('admin_notices', 'amsive_analytics_admin_notice_bad_credentials');
        return false;
    }
    if (empty($release_data) || !isset($release_data['tag_name'])) {
        return false;
    }


    $options['access_token_set'] = 'good';

    // save variable to settings with value 'good'
    update_option('amsive_analytics_options', $options);

    $release_data['browser_download_url'] = $release_data['assets'][0]['browser_download_url'];
    return (object) $release_data;
}




// Add admin_init action hook
add_action('admin_init', function () {

    // Add a new section to the "amsive_analytics-utm" page
    add_settings_section(
        'amsive-analytics-section-general', // Section ID
        'Settings', // Section title
        'amsive_analytics_general_section_callback', // Callback for rendering the description of the section
        'amsive-analytics' // Page on which to add this section
    );


    // Add new field for the Access Token
    add_settings_field(
        'amsive_analytics_access_token', // Field ID
        'Access Token', // Field title
        'amsive_analytics_access_token_callback', // Callback for rendering the field input
        'amsive-analytics', // Page
        'amsive-analytics-section-general' // Section ID
    );
}, 99);


function amsive_analytics_general_section_callback()
{
    echo '<p>Geleral plugin settings</p>';
}

// Sanitize the options input
function amsive_analytics_options_sanitize($options)
{
    if (!empty($options['access_token'])) {
        $options['access_token'] = sanitize_text_field($options['access_token']);
    }
    return $options;
}

/*
// Callback function for access token field
function amsive_analytics_access_token_callback() {
    $options = get_option('amsive_analytics_options');
    $access_token = $options['access_token'] ?? '';
    echo '<input type="password" id="amsive_analytics_access_token" name="amsive_analytics_options[access_token]" value="' . esc_attr($access_token) . '" />';

    echo '<p class="description">Enter your access token for the plugin.</p>';
    echo '<p class="description">Enter your access token for the plugin.</p>';
}
*/

function check_github_token_validity()
{
    $options = get_option('amsive_analytics_options');
    $token = $options['access_token'] ?? '';

    // GitHub API endpoint to fetch user information
    $response = wp_remote_get('https://api.github.com/Amsive-Digital', [
        'headers' => [
            'Authorization' => 'Bearer ' . $token,
            'User-Agent' => 'WordPress/' . $GLOBALS['wp_version'] . '; ' . home_url()  // GitHub requires a user-agent
        ]
    ]);

    if (is_wp_error($response)) {
        return false; // Network error or other problem
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);
    $status_code = wp_remote_retrieve_response_code($response);

    // Check if the API call was successful
    return $status_code === 200 && isset($body['login']); // 'login' is part of the user profile
}

function amsive_analytics_admin_notice_missing_access_token()
{
    // only on plugin page
    if (!isset($_GET['page']) || $_GET['page'] !== 'amsive-analytics') {
        return;
    }
?>
    <div class="notice notice-error settings-error is-dismissible">
        <p><strong>Error:</strong> The GitHub token is missing. Please update the token settings in <a href="<?php echo admin_url('tools.php?page=amsive-analytics'); ?>">Amsive Analytics Settings</a>.</p>
    </div>
<?php
}
function amsive_analytics_admin_notice_bad_credentials()
{
    // only on plugin page
    if (!isset($_GET['page']) || $_GET['page'] !== 'amsive-analytics') {
        return;
    }
?>
    <div class="notice notice-error settings-error is-dismissible">
        <p><strong>Error:</strong> The GitHub token is invalid or has expired. Please update the token settings in <a href="<?php echo admin_url('tools.php?page=amsive-analytics'); ?>">Amsive Analytics Settings</a>.</p>
    </div>
<?php
}


function amsive_analytics_access_token_callback()
{
    $options = get_option('amsive_analytics_options');
    $access_token = $options['access_token'] ?: '';
    echo '<input type="password" id="amsive_analytics_access_token" name="amsive_analytics_options[access_token]" value="' . esc_attr($access_token) . '" />';


}


function amsive_analytics_update_token_message($access_token_set = '') {

    if (empty($access_token_set)) {
        return 'The GitHub token is missing. Please update the token settings in <a href="' . admin_url('tools.php?page=amsive-analytics') . '">Amsive Analytics Settings</a>.';
    } else if ($access_token_set === 'bad') {
        return 'The GitHub token is invalid or has expired. Please update the token settings in <a href="' . admin_url('tools.php?page=amsive-analytics') . '">Amsive Analytics Settings</a>.';
    }
}


add_action('after_plugin_row_amsive-analytics/amsive-analytics.php', 'amsive_analytics_plugin_row', 10, 3);
function amsive_analytics_plugin_row($plugin_file, $plugin_data, $status)
{

    $options = get_option('amsive_analytics_options');
    $access_token_set = $options['access_token_set'] ?? '';

    if ($access_token_set === '') {

        echo $access_token_set;
        
        //$message = amsive_analytics_update_token_message($access_token);
        
        // if access token is not set, show admin notice
        if (empty($access_token_set)) {
            $wp_list_table = _get_list_table('WP_Plugins_List_Table');
            echo '<tr class="plugin-update-tr plugin-update-tr--message active">
            <td colspan="4" class="plugin-update colspanchange">
            <div class="update-message notice inline notice-warning notice-alt">
            <p>GitHub access token is not set. Updates will not work until the token is provided.
            <a href="' . esc_url(admin_url('tools.php?page=amsive-analytics')) . '">Set the token now</a>.
            </p>
            </div>
            </td>
            </tr>';
        }
    }

}


