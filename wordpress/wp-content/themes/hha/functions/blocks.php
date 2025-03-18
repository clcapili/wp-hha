<?php

function register_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		[
			[
				'slug' => 'custom-blocks',
				'title' => 'Custom Blocks',
            ]
        ]
	);
}
add_filter('block_categories_all', 'register_block_category', 10, 2);

// register blocks here
function register_acf_blocks() {
    register_block_type(get_template_directory() . '/blocks/accordion');
    register_block_type(get_template_directory() . '/blocks/background');
    register_block_type(get_template_directory() . '/blocks/blog-listing');
    register_block_type(get_template_directory() . '/blocks/button');
    register_block_type(get_template_directory() . '/blocks/card');
    register_block_type(get_template_directory() . '/blocks/card-benefit');
    register_block_type(get_template_directory() . '/blocks/card-icon');
    register_block_type(get_template_directory() . '/blocks/card-info');
    register_block_type(get_template_directory() . '/blocks/card-profile');
    register_block_type(get_template_directory() . '/blocks/card-stat');
    register_block_type(get_template_directory() . '/blocks/client-stories-listing');
    register_block_type(get_template_directory() . '/blocks/client-story');
    register_block_type(get_template_directory() . '/blocks/cta');
    register_block_type(get_template_directory() . '/blocks/dynamic-title');
    register_block_type(get_template_directory() . '/blocks/events-listing');
    register_block_type(get_template_directory() . '/blocks/featured-post');
    register_block_type(get_template_directory() . '/blocks/group');
    register_block_type(get_template_directory() . '/blocks/hero');
    register_block_type(get_template_directory() . '/blocks/hero-image');
    register_block_type(get_template_directory() . '/blocks/hubspot-form');
    register_block_type(get_template_directory() . '/blocks/latest-posts-automatic');
    register_block_type(get_template_directory() . '/blocks/latest-posts-manual');
    register_block_type(get_template_directory() . '/blocks/lever');
    register_block_type(get_template_directory() . '/blocks/link-arrow');
    register_block_type(get_template_directory() . '/blocks/memberships-listing');
    register_block_type(get_template_directory() . '/blocks/news-listing');
    register_block_type(get_template_directory() . '/blocks/page-header');
    register_block_type(get_template_directory() . '/blocks/partners-listing');
    register_block_type(get_template_directory() . '/blocks/press-releases-listing');
    register_block_type(get_template_directory() . '/blocks/resources-explore');
    register_block_type(get_template_directory() . '/blocks/resources-latest');
    register_block_type(get_template_directory() . '/blocks/resources-listing');
    register_block_type(get_template_directory() . '/blocks/sidebar-menu');
    register_block_type(get_template_directory() . '/blocks/slick-slide');
    register_block_type(get_template_directory() . '/blocks/slick-slider');
    register_block_type(get_template_directory() . '/blocks/solutions-listing');
    register_block_type(get_template_directory() . '/blocks/state-info-center-listing');
    register_block_type(get_template_directory() . '/blocks/tab-pane');
    register_block_type(get_template_directory() . '/blocks/tabs');
    register_block_type(get_template_directory() . '/blocks/tabs-sidebar');
    register_block_type(get_template_directory() . '/blocks/testimonial');
}
add_action('init', 'register_acf_blocks');

// add custom classes to blocks
function block_wrapper($blockContent, $block) {
    if ($block['blockName'] === 'core/heading') {
        return '<div class="wp-block-heading">' . $blockContent . '</div>';
    } else if ($block['blockName'] === 'core/table') {
        return str_replace(
            [ '<table>', '</table>' ],
            [ '<table class="table table-responsive">', '</table>' ],
            $blockContent
        );
    }

    return $blockContent;
}
add_filter('render_block', 'block_wrapper', 10, 2);

// Remove innerBlock div wrapper
function acf_remove_wrap_innerblocks($wrap, $name) {
    if (
        $name == 'custom/accordion' ||
        $name == 'custom/background' || 
        $name == 'custom/slick-slider' || 
        $name == 'custom/slick-slide' ||
        $name == 'custom/tabs' ||
        $name == 'custom/tab-pane'
    ) {
        return false;
    }
    return true;
}
add_filter('acf/blocks/wrap_frontend_innerblocks', 'acf_remove_wrap_innerblocks', 10, 2);

// Unregister all default patterns
add_action('init', function() {
	remove_theme_support('core-block-patterns');
});