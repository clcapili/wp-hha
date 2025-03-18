<?php if (!defined('ABSPATH')) exit;
/**
 * Plugin Name: Amsive Analytics
 * Plugin URI: https://www.amsive.com
 * Description: Amsive Analytics plugin provides functionalities such as preserving UTM parameters in the cookie when a user navigates between pages on a website and attempt to fill out the UTM hidden fields in the selected forms and etc.
 * Author: Amsive (Bojan)
 * Version: 0.4.4
 */

define('PLUGIN_NAME', 'Amsive Analytics');
define('PLUGIN_BASENAME', plugin_basename(__FILE__));


// include the update check
include_once 'amsive-analytics-update-check.php';

// default cookie expiration time in seconds
$cookie_expiration_default = 1296000; // 15 days (15 days * 24 hours * 60 minutes * 60 seconds)

// search for UTM parameters in the URL and store them in the cookie
// also if hidden fields are present in the form it fill them with UTM parameters, if option is enabled
$check_for_utm = array(
    'utm_source',
    'utm_medium',
    'utm_campaign',
    'utm_content',
    'utm_term',
    'utm_keyword'
);

// get cookie expiration time from the settings
$options = get_option('amsive_analytics_options', array());
$cookie_expiration = isset($options['cookie_expiration']) ? $options['cookie_expiration'] : $cookie_expiration_default;

// scripts hook
add_action('wp_enqueue_scripts', function () use ($check_for_utm, $cookie_expiration){
    
    // enqueue main script
    wp_enqueue_script('amsive-analytics', plugin_dir_url(__FILE__) . 'amsive-analytics.js', '', filemtime(plugin_dir_path(__FILE__) . 'amsive_analytics-utm.js'), true);
    
    // make vars accessible in javascript
    wp_localize_script('amsive-analytics', 'amsive_analytics_vars', array(
        'check_for_utm'     => $check_for_utm,
        'cookie_expiration' => $cookie_expiration
    ));
});

// include all files from the inc subfolder starting with inc.*.php
foreach (glob(__DIR__ . '/inc/*.php') as $file) {
    require_once $file;
}

// include admin page
include_once 'amsive-analytics-admin.php';


