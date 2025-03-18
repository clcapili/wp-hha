<?php
    $activate = get_field('activate', 'option');
    $all_website = get_field('all_website', 'option');
    $showHere = get_field('posts', 'option');
    $text = get_field('text', 'option');

    $bannerTimestamp = get_option('bannerLastUpdate');

    if (!$bannerTimestamp) {
        $bannerTimestamp = time();
        update_option('bannerLastUpdate', $bannerTimestamp);
    }

    $bannerHash = md5($text . '_' . $bannerTimestamp);
    $cookieName = 'bannerClosed' . $bannerHash;

    $banner = '';

    if ($activate && !isset($_COOKIE[$cookieName])) {
        ob_start();
?>
    <div class="alert alert-primary alert-dismissible my-custom-alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <?php echo $text; ?>
    </div>


<?php
        $banner = ob_get_clean();
    }

    if ($all_website) {
        echo $banner;
    }
    
    else {
        if (is_array($showHere) && !empty($showHere)) {
            foreach ($showHere as $in_post) {
                if (get_the_ID() == $in_post) {
                    echo $banner;
                    break;
                }
            }
        }
    }
?>
