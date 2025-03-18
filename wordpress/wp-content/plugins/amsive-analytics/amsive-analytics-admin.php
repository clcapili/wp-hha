<?php



/********************** backend stuff ***********************/


// create the menu page content
function amsive_analytics_page()
{
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <h2>Analytics</h2>
        <p>Amsive Analytics plugin provides functionalities such as preserving UTM parameters in the cookie when a user navigates between pages on a website and attempt to fill out the UTM hidden fields in the selected forms and etc.</p>
        <p>For more information, please visit <a href="https://www.amsive.com">Amsive</a>.</p>

        <form action="options.php" method="post">
            <?php
            settings_fields('amsive-analytics');
            do_settings_sections('amsive-analytics');
            submit_button('Save Settings');
            ?>
        </form>
    </div>
<?php
}

// add settings link on plugin page
add_filter('plugin_action_links_' . plugin_basename(PLUGIN_BASENAME), function ($links) {
    $settings_link = '<a href="' . admin_url('tools.php?page=amsive-analytics') . '">Settings</a>';
    array_unshift($links, $settings_link); // This will add your link at the beginning of the list
    return $links;
});

// admin init hook
add_action('admin_init', function () {
    if (!current_user_can('manage_options')) {
        return;
    }
    // register settings
    register_setting('amsive_analytics-settings', 'amsive-utm-settings', 'amsive_utm_settings_sanitize');
});
// add the menu page
add_action('admin_menu', function () {
    if (!current_user_can('manage_options')) {
        return;
    }
    add_management_page(
        'Amsive Analytics Settings', // Page title
        'Amsive Analytics', // Menu title
        'manage_options',
        'amsive-analytics',      // Menu slug
        'amsive_analytics_page'  // Function that outputs the page content
    );
});


// add amsive_analytics function to the WordPress init hook
add_action('admin_init', function () {

    // Register a new setting for "amsive-analytics" page
    register_setting(
        'amsive-analytics', // Option group, should match the page
        'amsive_analytics_options' // Option name
    );

    // Add a new section to the "amsive_analytics-utm" page
    add_settings_section(
        'amsive-analytics-section-utm', // Section ID
        'UTM Preservation Settings', // Section title
        'amsive_analytics_section_callback', // Callback for rendering the description of the section
        'amsive-analytics' // Page on which to add this section
    );
    
});

function amsive_analytics_section_callback()
{
    echo '<p>Injecting UTM data enabled for following forms:</p>';
}


// adding integer field to the "amsive_analytics-utm" page - cookie expiration time
add_action('admin_init', function () {
    add_settings_field(
        'amsive_analytics_cookie_expiration',
        'Cookie Expiration Time<br>(in seconds)',
        'amsive_analytics_cookie_expiration_callback',
        'amsive-analytics',
        'amsive-analytics-section-utm'
    );
});

// adding integer field as html to the "amsive_analytics-utm" page
function amsive_analytics_cookie_expiration_callback()
{
    global $cookie_expiration_default;

    $options = get_option('amsive_analytics_options');
    $cookie_expiration = isset($options['cookie_expiration']) ? $options['cookie_expiration'] : $cookie_expiration_default;

    echo '<input type="number" name="amsive_analytics_options[cookie_expiration]" value="' . esc_attr($cookie_expiration) . '" />';
}

// sanitize the input
function amsive_utm_settings_sanitize($input)
{
    $sanitized_input = array();

    if (isset($input['cookie_expiration'])) {
        $sanitized_input['cookie_expiration'] = absint($input['cookie_expiration']);
    }

    return $sanitized_input;
}


