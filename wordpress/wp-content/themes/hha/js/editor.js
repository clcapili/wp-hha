wp.domReady(() => {
    // Unregister blocks
	wp.blocks.unregisterBlockType('core/archives');
	wp.blocks.unregisterBlockType('core/avatar');
	wp.blocks.unregisterBlockType('core/audio');
	// wp.blocks.unregisterBlockType('core/block'); // always enable for the create pattern option
    wp.blocks.unregisterBlockType('core/button');
    wp.blocks.unregisterBlockType('core/buttons');
    wp.blocks.unregisterBlockType('core/calendar');
    wp.blocks.unregisterBlockType('core/categories');
    wp.blocks.unregisterBlockType('core/code');
    wp.blocks.unregisterBlockType('core/column');
    wp.blocks.unregisterBlockType('core/columns');
    wp.blocks.unregisterBlockType('core/comments');
	wp.blocks.unregisterBlockType('core/cover');
	wp.blocks.unregisterBlockType('core/details');
	wp.blocks.unregisterBlockType('core/embed');
	wp.blocks.unregisterBlockType('core/file');
	wp.blocks.unregisterBlockType('core/freeform');
	wp.blocks.unregisterBlockType('core/gallery');
	wp.blocks.unregisterBlockType('core/group');
	// wp.blocks.unregisterBlockType('core/html');
	wp.blocks.unregisterBlockType('core/latest-comments');
	wp.blocks.unregisterBlockType('core/latest-posts');
	wp.blocks.unregisterBlockType('core/legacy-widget');
	wp.blocks.unregisterBlockType('core/loginout');
	wp.blocks.unregisterBlockType('core/media-text');
	wp.blocks.unregisterBlockType('core/more');
	wp.blocks.unregisterBlockType('core/navigation-link');
	wp.blocks.unregisterBlockType('core/navigation');
	wp.blocks.unregisterBlockType('core/nextpage');
	wp.blocks.unregisterBlockType('core/page-list');
	wp.blocks.unregisterBlockType('core/post-author');
	wp.blocks.unregisterBlockType('core/post-author-biography');
	wp.blocks.unregisterBlockType('core/post-author-name');
	wp.blocks.unregisterBlockType('core/post-comments-form');
	wp.blocks.unregisterBlockType('core/post-content');
	wp.blocks.unregisterBlockType('core/post-date');
	wp.blocks.unregisterBlockType('core/post-excerpt');
	wp.blocks.unregisterBlockType('core/post-featured-image');
	wp.blocks.unregisterBlockType('core/post-navigation-link');
	wp.blocks.unregisterBlockType('core/post-terms');
	wp.blocks.unregisterBlockType('core/post-title');
	wp.blocks.unregisterBlockType('core/preformatted');
	wp.blocks.unregisterBlockType('core/pullquote');
	wp.blocks.unregisterBlockType('core/query-pagination-next');
	wp.blocks.unregisterBlockType('core/query-pagination-numbers');
	wp.blocks.unregisterBlockType('core/query-pagination-previous');
	wp.blocks.unregisterBlockType('core/query-pagination');
	wp.blocks.unregisterBlockType('core/query-title');
	wp.blocks.unregisterBlockType('core/query');
	// wp.blocks.unregisterBlockType('core/quote');
	wp.blocks.unregisterBlockType('core/read-more');
	wp.blocks.unregisterBlockType('core/rss');
	wp.blocks.unregisterBlockType('core/search');
	// wp.blocks.unregisterBlockType('core/separator');
	wp.blocks.unregisterBlockType('core/site-logo');
	wp.blocks.unregisterBlockType('core/site-tagline');
	wp.blocks.unregisterBlockType('core/site-title');
	wp.blocks.unregisterBlockType('core/social-link');
	wp.blocks.unregisterBlockType('core/social-links');
	// wp.blocks.unregisterBlockType('core/table');
	wp.blocks.unregisterBlockType('core/tag-cloud');
	wp.blocks.unregisterBlockType('core/template-part');
	wp.blocks.unregisterBlockType('core/term-description');
	wp.blocks.unregisterBlockType('core/text-columns');
	wp.blocks.unregisterBlockType('core/verse');
	// wp.blocks.unregisterBlockType('core/video');
    wp.blocks.unregisterBlockType('wp-bootstrap-blocks/button');

	// Register blocks style
	wp.blocks.registerBlockStyle('core/spacer', [
		{
			name: 'default',
			label: 'Default',
			isDefault: true,
		},
		{
			name: 'small',
			label: 'S',
		},
		{
			name: 'medium',
			label: 'M',
		},
		{
			name: 'large',
			label: 'L',
		},
		{
			name: 'x-large',
			label: 'XL',
		}
	]);

});