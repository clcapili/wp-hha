<?php 

function resources_site() {
    /* CSS */
    wp_dequeue_style('global-styles');
    wp_deregister_style('wp-block-library');
    wp_dequeue_style('classic-theme-styles');

    wp_enqueue_style('styles', get_template_directory_uri() . '/css/styles.min.css', [], '1.0.2', 'all');

    /* JS */
    wp_deregister_script('jquery');

    wp_enqueue_script('hubspot', 'https://js.hsforms.net/forms/embed/v2.js', [], '1.0');

    wp_enqueue_script('libs', get_template_directory_uri() . '/js/libs.js', [], '1.0', true);
    wp_enqueue_script('site', get_template_directory_uri() . '/js/site.js', [], '2.3.4', true);
    wp_enqueue_script('load', get_template_directory_uri() . '/js/load.js', ['libs', 'site'], '1.5', true);
}
add_action('wp_enqueue_scripts', 'resources_site');


function resources_editor() {
    wp_enqueue_style('editor_css', get_stylesheet_directory_uri() . '/css/editor.css', false, '1.3.1', 'all');

    wp_enqueue_script('theme-editor', get_template_directory_uri() . '/js/editor.js', ['wp-blocks', 'wp-dom'], '1.0', true);
}
add_action('enqueue_block_editor_assets', 'resources_editor');

function add_data_attribute($tag, $handle) {
    if ( 'site' !== $handle )
     return $tag;
 
    return str_replace( 'src', ' data-cookieconsent="ignore" src', $tag );
 }
 add_filter('script_loader_tag', 'add_data_attribute', 10, 2);



/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}

/**
* Filter function used to remove the tinymce emoji plugin.
* 
* @param array $plugins 
* @return array Difference betwen the two arrays
*/
function disable_emojis_tinymce( $plugins ) {
    if (is_array($plugins)) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

/**
* Remove emoji CDN hostname from DNS prefetching hints.
*
* @param array $urls URLs to print for resource hints.
* @param string $relation_type The relation type the URLs are printed for.
* @return array Difference betwen the two arrays.
*/
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
        /** This filter is documented in wp-includes/formatting.php */
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
    
        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }

    return $urls;
}

add_action( 'init', 'disable_emojis' );
