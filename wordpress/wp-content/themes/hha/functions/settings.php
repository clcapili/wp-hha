<?php 

function theme_setup() {
    add_post_type_support('page', 'excerpt');
    add_theme_support('post-thumbnails');
    add_theme_support('editor-styles');
    add_theme_support('disable-custom-colors');
    add_theme_support(
        'editor-color-palette',
        [
            [
                'name'  => esc_html__('White', 'hha'),
                'slug'  => 'white',
                'color' => '#FFFFFF',
            ],
            [
                'name'  => esc_html__('Off White', 'hha'),
                'slug'  => 'off-white',
                'color' => '#FDFFF2',
            ],
            [
                'name'  => esc_html__('Black', 'hha'),
                'slug'  => 'black',
                'color' => '#000000',
            ],
            [
                'name'  => esc_html__('Dark Green', 'hha'),
                'slug'  => 'dark-green',
                'color' => '#004152',
            ],
            [
                'name'  => esc_html__('Green', 'hha'),
                'slug'  => 'green',
                'color' => '#BCEB44',
            ],
            [
                'name'  => esc_html__('Yellow', 'hha'),
                'slug'  => 'yellow',
                'color' => '#F1FF75',
            ],
            [
                'name'  => esc_html__('Aqua', 'hha'),
                'slug'  => 'aqua',
                'color' => '#D1FFF0',
            ],
            [
                'name'  => esc_html__('Purple', 'hha'),
                'slug'  => 'purple',
                'color' => '#A6ABFF',
            ],
            [
                'name'  => esc_html__('Blue', 'hha'),
                'slug'  => 'blue',
                'color' => '#77A4FF',
            ]
        ]
    );
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => esc_attr__('Small', 'hha'),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => esc_attr__('Medium', 'hha'),
            'size' => 16,
            'slug' => 'regular'
        ),
        array(
            'name' => esc_attr__('Large', 'hha'),
            'size' => 20,
            'slug' => 'medium'
        )
    ));
}
add_action('after_setup_theme', 'theme_setup');

function custom_menu() {
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'custom_menu');

function add_upload_mimes($types) { 
	$types['json'] = 'text/plain';
    $types['svg'] = 'image/svg+xml';
    // add svg
	return $types;
}
add_filter('upload_mimes', 'add_upload_mimes');

add_filter('wpcf7_form_elements', function ($content) {
    $content = preg_replace('/<label><input type="(checkbox|radio)" name="(.*?)" value="(.*?)" \/><span class="wpcf7-list-item-label">/i', '<label class="form-check form-check-inline form-check-\1"><input type="\1" name="\2" value="\3" class="form-check-input"><span class="wpcf7-list-item-label form-check-label">', $content);
    return $content;
});

// add body class - header
function add_body_classes($classes) {

    return $classes;
}
add_filter('body_class','add_body_classes');

function add_admin_body_classes($classes) { 
   
    return $classes;
}
add_filter('admin_body_class', 'add_admin_body_classes'); 

//Add extra admin settings option
function add_admin_settings() {
    add_settings_field('analytics', 'Analytics', 'analytics_callback', 'general');
    register_setting('general', 'ga-code');    
}

function analytics_callback($args) {
    $option = get_option('ga-code');
    echo '<input type="text" id="ga-code" name="ga-code" class="regular-text ltr" value="' . $option . '" />';
}

add_action('admin_init', 'add_admin_settings');

// yoast columns
function yoast_seo_admin_remove_columns($columns) {
    unset($columns['wpseo-score']);
    unset($columns['wpseo-score-readability']);
    unset($columns['wpseo-title']);
    unset($columns['wpseo-metadesc']);
    unset($columns['wpseo-focuskw']);
    unset($columns['wpseo-links']);
    unset($columns['wpseo-linked']);
    return $columns;
}

add_filter('manage_edit-post_columns', 'yoast_seo_admin_remove_columns', 10, 1);
add_filter('manage_edit-page_columns', 'yoast_seo_admin_remove_columns', 10, 1);

//hide acf admin panel
function my_acf_show_admin($show) {
	// provide a list of usernames who can edit custom field definitions here
	$admins = [
		'ccapili@mblm.com', 'dmihalakakos@mblm.com', 'atran@mblm.com', 'richard@elovia.it'
    ];

	// get the current user
	$current_user = wp_get_current_user();

	return (in_array($current_user->user_email, $admins));
}
add_filter('acf/settings/show_admin', 'my_acf_show_admin');