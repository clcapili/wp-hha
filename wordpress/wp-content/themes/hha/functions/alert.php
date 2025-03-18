<?php
add_action('acf/save_post', 'bannerupdateTimestamp');
function bannerupdateTimestamp( $post_id ) {
    if ($post_id !== 'options') {
        return;
    }

    $bannerText = get_field('text', 'option');
    
    if (!empty($bannerText)) {
        update_option('bannerLastUpdate', time());
    }
}
?>