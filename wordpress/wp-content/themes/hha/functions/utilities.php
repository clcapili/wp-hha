<?php 

// Images
function get_lazy_post_thumbnail($postId, $classes = '') {
    $thumbnailId = get_post_thumbnail_id($postId);
    return wp_get_attachment_image($thumbnailId, 'full', false, ['class' => $classes, 'data-aos' => 'fade-up']);
}

// Links
function get_link_tag($link, $classes = '', $attr = '') {
    if ($link && !empty(array_filter($link))) {
        return '<a href="' . $link['url'] . '" target="' . $link['target'] . '" class="' . $classes . '" '. $attr .'>' . $link['title'] . '</a>';
    }
    return '';
}

// Admin Edit button
function edit_link_override($id = null) {
    if (!is_user_logged_in()) {
        return;
    }
    
    $editLinks = [];

    if (is_archive()) {
        $postTypeName = get_queried_object()->name;
        $postType = get_post_type_object($postTypeName);

        $editLinks[] = ['label' => 'Edit ' . $postType->labels->name, 'link' => '/wp-admin/edit.php?post_type=' . $postTypeName];
        
    } else if (isset($id)) {
        $postTypeName = get_post_type($id);
        $postType = get_post_type_object($postTypeName);

        $editLinks[] = ['label' => 'Edit ' . $postType->labels->singular_name, 'link' => '/wp-admin/post.php?post='.$id.'&action=edit'];
        
    }

    $menu = '';
    $menu .= '<div class="dropup edit-link">';
        $menu .= '<button aria-label="Edit Page" title="Edit Page" class="dropdown-toggle" data-bs-toggle="dropdown"></button>';
        $menu .= '<ul class="dropdown-menu">';
            if (!empty($editLinks)) {
                foreach ($editLinks as $editLink) {
                    $menu .= '<li><a class="dropdown-item" href="'.$editLink['link'].'">'.$editLink['label'].'</a></li>';
                }
                $menu .= '<li><hr class="dropdown-divider"></li>';    
            }
            $menu .= '<li><a class="dropdown-item" href="/wp-admin/admin.php?page=theme-options">Theme Options</a></li>';
            $menu .= '<li><a class="dropdown-item" href="/wp-admin/">Dashboard</a></li>';
        $menu .= '</ul>';
    $menu .= '</div>';

    echo $menu; 
}