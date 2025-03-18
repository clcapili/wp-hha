<?php

// blog
function get_blog_items() {
    $page = !empty($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $perPage = !empty($_REQUEST['per_page']) ? $_REQUEST['per_page'] : 9;

    $args = [
        'post_type'         => 'blog',
        'post_status'       => 'publish',
        'paged'             => $page,
        'posts_per_page'    => $perPage,
        'orderby'           => 'date',
        'order'             => 'DESC',
        'meta_query'        => [
            'relation'      => 'OR',
            [
                'key'       => 'featured',
                'compare'   => 'NOT EXISTS',
            ],
            [
                'key'       => 'featured',
                'value'     => true,
                'compare'   => '!=',
            ]
        ],
        'tax_query'         => ['relation' => 'AND']
    ];

    if (!empty($_GET['audience'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'audiences',
            'field' => 'slug',
            'terms' => $_GET['audience']
        ];
    }

    if (!empty($_GET['topic'])) {
        $topics = explode(',', $_GET['topic']);

        $args['tax_query'][] = [
            'taxonomy' => 'topics',
            'field' => 'slug',
            'terms' => $topics,
            'operator' => 'AND'
        ];
    }

    if (!empty($_GET['search'])) {
        $args['s'] = trim(strip_tags($_GET['search']));
    }

    $query = new WP_Query($args);
    $items = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();

            $thumbnail      = get_the_post_thumbnail_url();
            $thumbnailID    = get_post_thumbnail_id();
            $altText        = get_post_meta($thumbnailID, '_wp_attachment_image_alt', true);
            
            $items[] = [
                'id'            => $id,
                'thumbnail'     => $thumbnail,
                'alt'           => $altText,
                'title'         => get_the_title($id),
                'link'          => get_the_permalink($id)
            ];
            
        }
    }

    $numPages = $query->max_num_pages;
    echo json_encode([
        'items' => $items,
        'numPages' => $numPages
    ]);
    exit();
}
add_action('wp_ajax_get_blog_items',        'get_blog_items');
add_action('wp_ajax_nopriv_get_blog_items', 'get_blog_items');

// client stories
function get_client_stories() {
    $page = !empty($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $perPage = !empty($_REQUEST['per_page']) ? $_REQUEST['per_page'] : 9;

    $args = [
        'post_type'         => 'client-stories',
        'post_status'       => 'publish',
        'paged'             => $page,
        'posts_per_page'    => $perPage,
        'orderby'           => 'date',
        'order'             => 'DESC',
        'tax_query'         => ['relation' => 'AND']
    ];

    if (!empty($_GET['topic'])) {
        $topics = explode(',', $_GET['topic']);

        $args['tax_query'][] = [
            'taxonomy' => 'client-story-topics',
            'field' => 'slug',
            'terms' => $topics,
            'operator' => 'AND'
        ];
    }

    if (!empty($_GET['search'])) {
        $args['s'] = trim(strip_tags($_GET['search']));
    }

    $query = new WP_Query($args);
    $items = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();

            $thumbnail      = get_the_post_thumbnail_url();
            $thumbnailID    = get_post_thumbnail_id();
            $altText        = get_post_meta($thumbnailID, '_wp_attachment_image_alt', true);
            
            $items[] = [
                'id'            => $id,
                'thumbnail'     => $thumbnail,
                'alt'           => $altText,
                'title'         => get_the_title($id),
                'link'          => get_the_permalink($id)
            ];
            
        }
    }

    $numPages = $query->max_num_pages;
    echo json_encode([
        'items' => $items,
        'numPages' => $numPages
    ]);
    exit();
}
add_action('wp_ajax_get_client_stories',        'get_client_stories');
add_action('wp_ajax_nopriv_get_client_stories', 'get_client_stories');

// events
function get_events() {
    $page = !empty($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $perPage = !empty($_REQUEST['per_page']) ? $_REQUEST['per_page'] : 9;

    $args = [
        'post_type'         => 'events',
        'post_status'       => 'publish',
        'paged'             => $page,
        'posts_per_page'    => $perPage,
        'order'             => 'ASC',
        'meta_query'        => [
            'relation' => 'AND',
            [
                'key'       => 'date_end',
                'value'     => date('Y-m-d'),
                'compare'   => '>=',
                'type'      => 'DATE',
            ],
        ],
        'orderby'           => 'meta_value',
        'meta_key'          => 'date_start',
    ];    
    

    if (!empty($_GET['type'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'event-types',
            'field' => 'slug',
            'terms' => $_GET['type']
        ];
    }

    if (!empty($_GET['search'])) {
        $args['s'] = trim(strip_tags($_GET['search']));
    }

    $query = new WP_Query($args);
    $items = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();

            $thumbnail      = get_the_post_thumbnail_url();
            $thumbnailID    = get_post_thumbnail_id();
            $altText        = get_post_meta($thumbnailID, '_wp_attachment_image_alt', true);

            $link = get_field('link', $id);
            
            $items[] = [
                'id'            => $id,
                'thumbnail'     => $thumbnail,
                'alt'           => $altText,
                'title'         => get_the_title($id),
                'link'          => !empty($link) ? $link : '#'
            ];
            
        }
    }

    $numPages = $query->max_num_pages;
    echo json_encode([
        'items' => $items,
        'numPages' => $numPages
    ]);
    exit();
}
add_action('wp_ajax_get_events',        'get_events');
add_action('wp_ajax_nopriv_get_events', 'get_events');

// memberships
function get_memberships() {
    $page = !empty($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $perPage = !empty($_REQUEST['per_page']) ? $_REQUEST['per_page'] : 9;

    $args = [
        'post_type'         => 'memberships',
        'post_status'       => 'publish',
        'paged'             => $page,
        'posts_per_page'    => $perPage,
        'orderby'           => 'date',
        'order'             => 'DESC',
        'tax_query'         => ['relation' => 'AND']
    ];

    if (!empty($_GET['state'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'states',
            'field' => 'slug',
            'terms' => $_GET['state']
        ];
    }

    if (!empty($_GET['tag'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'membership-tags',
            'field' => 'slug',
            'terms' => $_GET['tag']
        ];
    }

    if (!empty($_GET['search'])) {
        $args['s'] = trim(strip_tags($_GET['search']));
    }

    $query = new WP_Query($args);
    $items = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();

            $thumbnail      = get_the_post_thumbnail_url();
            $thumbnailID    = get_post_thumbnail_id();
            $altText        = get_post_meta($thumbnailID, '_wp_attachment_image_alt', true);

            $externalLink   = get_field('url', $id);
            
            $items[] = [
                'id'        => $id,
                'thumbnail' => $thumbnail,
                'alt'       => $altText,
                'title'     => get_the_title($id),
                'link'      => !empty($externalLink) ? $externalLink : '#'
            ];
            
        }
    }

    $numPages = $query->max_num_pages;
    echo json_encode([
        'items' => $items,
        'numPages' => $numPages
    ]);
    exit();
}
add_action('wp_ajax_get_memberships',        'get_memberships');
add_action('wp_ajax_nopriv_get_memberships', 'get_memberships');

// partners
function get_partners() {
    $page = !empty($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $perPage = !empty($_REQUEST['per_page']) ? $_REQUEST['per_page'] : 9;

    $args = [
        'post_type'         => 'partners',
        'post_status'       => 'publish',
        'paged'             => $page,
        'posts_per_page'    => $perPage,
        'orderby'           => 'menu_order',
        'order'             => 'ASC',
        'tax_query'         => ['relation' => 'AND']
    ];

    if (!empty($_GET['tag'])) {
        $tags = explode(',', $_GET['tag']);

        $args['tax_query'][] = [
            'taxonomy' => 'partner-tags',
            'field' => 'slug',
            'terms' => $tags,
            'operator' => 'AND'
        ];
    }

    if (!empty($_GET['search'])) {
        $args['s'] = trim(strip_tags($_GET['search']));
    }

    $query = new WP_Query($args);
    $items = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();

            $thumbnail      = get_the_post_thumbnail_url();
            $thumbnailID    = get_post_thumbnail_id();
            $altText        = get_post_meta($thumbnailID, '_wp_attachment_image_alt', true);
            
            $items[] = [
                'id'            => $id,
                'thumbnail'     => $thumbnail,
                'alt'           => $altText,
                'title'         => get_the_title($id),
                'link'          => get_the_permalink($id)
            ];
            
        }
    }

    $numPages = $query->max_num_pages;
    echo json_encode([
        'items' => $items,
        'numPages' => $numPages
    ]);
    exit();
}
add_action('wp_ajax_get_partners',        'get_partners');
add_action('wp_ajax_nopriv_get_partners', 'get_partners');

// resources
function get_resources_items() {
    $page = !empty($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $perPage = !empty($_REQUEST['per_page']) ? $_REQUEST['per_page'] : 9;

    $args = [
        'post_type'         => 'resources',
        'post_status'       => 'publish',
        'paged'             => $page,
        'posts_per_page'    => $perPage,
        'orderby'           => 'date',
        'order'             => 'DESC',
        'meta_query'        => [
            'relation'      => 'OR',
            [
                'key'       => 'hide_from_listing',
                'compare'   => 'NOT EXISTS',
            ],
            [
                'key'       => 'hide_from_listing',
                'value'     => true,
                'compare'   => '!=',
            ]
        ],
        'tax_query'         => ['relation' => 'AND']
    ];

    if (!empty($_GET['audience'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'audiences',
            'field' => 'slug',
            'terms' => $_GET['audience']
        ];
    }

    if (!empty($_GET['type'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'resource-types',
            'field' => 'slug',
            'terms' => $_GET['type']
        ];
    }

    if (!empty($_GET['topic'])) {
        $topics = explode(',', $_GET['topic']);

        $args['tax_query'][] = [
            'taxonomy' => 'topics',
            'field' => 'slug',
            'terms' => $topics,
            'operator' => 'AND'
        ];
    }

    if (!empty($_GET['search'])) {
        $args['s'] = trim(strip_tags($_GET['search']));
    }

    $query = new WP_Query($args);
    $items = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();
            $thumbnail      = get_the_post_thumbnail_url();
            $thumbnailID    = get_post_thumbnail_id();
            $altText        = get_post_meta($thumbnailID, '_wp_attachment_image_alt', true);

            $resourceTypes = get_the_terms($id, 'resource-types');
            
            $items[] = [
                'id'            => $id,
                'thumbnail'     => $thumbnail,
                'alt'           => $altText,
                'type'          => !empty($resourceTypes) ? $resourceTypes[0]->name : '',
                'title'         => get_the_title($id),
                'link'          => get_the_permalink($id)
            ];
            
        }
    }

    $numPages = $query->max_num_pages;
    echo json_encode([
        'items' => $items,
        'numPages' => $numPages
    ]);
    exit();
}
add_action('wp_ajax_get_resources_items',        'get_resources_items');
add_action('wp_ajax_nopriv_get_resources_items', 'get_resources_items');

// state info center
function get_state_info_center() {
    $page = !empty($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $perPage = !empty($_REQUEST['per_page']) ? $_REQUEST['per_page'] : 9;

    $args = [
        'post_type'         => 'state-info-center',
        'post_status'       => 'publish',
        'paged'             => $page,
        'posts_per_page'    => $perPage,
        'orderby'           => 'menu_order',
        'order'             => 'ASC',
        'tax_query'         => ['relation' => 'AND']
    ];

    if (!empty($_GET['state'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'states',
            'field' => 'slug',
            'terms' => $_GET['state']
        ];
    }

    if (!empty($_GET['search'])) {
        $args['s'] = trim(strip_tags($_GET['search']));
    }

    $query = new WP_Query($args);
    $items = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();

            $thumbnail      = get_the_post_thumbnail_url();
            $thumbnailID    = get_post_thumbnail_id();
            $altText        = get_post_meta($thumbnailID, '_wp_attachment_image_alt', true);
            
            $items[] = [
                'id'            => $id,
                'thumbnail'     => $thumbnail,
                'alt'           => $altText,
                'title'         => get_the_title($id),
                'link'          => get_the_permalink($id)
            ];
            
        }
    }

    $numPages = $query->max_num_pages;
    echo json_encode([
        'items' => $items,
        'numPages' => $numPages
    ]);
    exit();
}
add_action('wp_ajax_get_state_info_center',        'get_state_info_center');
add_action('wp_ajax_nopriv_get_state_info_center', 'get_state_info_center');