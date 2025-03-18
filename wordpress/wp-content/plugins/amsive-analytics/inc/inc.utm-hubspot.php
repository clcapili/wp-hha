<?php if (!defined('ABSPATH')) exit;
/**
 * Hubspot plugin integration
 * v0.0.3
 */

// get 'amsive_preserve_utm_hubspot' from options
$amsive_preserve_utm_options = get_option('amsive_preserve_utm_options', array());

// if amsive_preserve_utm_hubspot is set to true, add the script for injecting UTM parameters into Hubspot forms hidden fields
if (isset($amsive_preserve_utm_options['amsive_preserve_utm_checkbox']) && $amsive_preserve_utm_options['amsive_preserve_utm_checkbox']) {
    // add the script for injecting UTM parameters into Hubspot forms hidden fields
    add_action('wp_enqueue_scripts', function () {
        wp_enqueue_script('amsive-utm-hubspot', plugin_dir_url(__FILE__) . 'amsive-utm-hubspot.js', '', filemtime(plugin_dir_path(__FILE__) . 'amsive-utm-hubspot.js'), true);
    });
}

/**---------------------- backend stuff below ----------------------*/

// Register settings, section, and fields
add_action('admin_init', function () {
    // Register a new setting for "amsive_preserve_utm_options" page.
    register_setting('amsive-analytics', 'amsive_preserve_utm_options');

    // Register a new section in the "amsive-analytics" page.
    add_settings_section(
        'amsive-analytics-section-utm', // Section ID
        'UTM Settings', // Section title
        null, // Callback (we don't want to render anything here)
        'amsive-analytics' // Page to add this section to
    );

    // Register a new field in the "amsive-analytics-section-utm" section, inside the "amsive-analytics" page.
    add_settings_field(
        'amsive_preserve_utm_hubspot', // Field ID
        'Hubspot forms', // Field title
        'amsive_preserve_utm_hubspot_callback', // Callback for rendering the field
        'amsive-analytics', // Page on which to add this field
        'amsive-analytics-section-utm', // Section in which to add this field
        [
            'label_for' => 'amsive_preserve_utm_checkbox',
            'class' => 'amsive_utm_class',
        ]
    );
});

function amsive_preserve_utm_hubspot_callback($args)
{
    $options = get_option('amsive_preserve_utm_options');
    $checkbox = isset($options[$args['label_for']]) ? $options[$args['label_for']] : '';
?>
    <input type="checkbox" id="<?php echo esc_attr($args['label_for']); ?>" name="amsive_preserve_utm_options[<?php echo esc_attr($args['label_for']); ?>]" value="1" <?php checked(1, $checkbox); ?> />
    <label for="<?php echo esc_attr($args['label_for']); ?>">Enable</label>
<?php
}
