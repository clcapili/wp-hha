<?php
/**
 * Plugin Name: Bootstrap Modal
 * Description:
 * Author: MBLM
 * Author URI: http://mblm.com
 * Version: 1.0
 */

 require_once __DIR__ . '/BootstrapModal.php';

global $wpdb;

$bootstrapModal = new BootstrapModal($_REQUEST, $_SERVER, $wpdb);
$bootstrapModal->init();

if (is_admin()) {
   
}
