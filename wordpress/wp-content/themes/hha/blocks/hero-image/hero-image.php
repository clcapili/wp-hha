<?php
/**
 * Hero Image Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'hero-image-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$theme          = get_field('theme');
$desktopImage   = get_field('desktop_image');
$mobileImage    = get_field('mobile_image');
$label          = get_field('label');
$heading        = get_field('heading') ?: 'Hero Heading';
$description    = get_field('description');
$link           = get_field('link');

?>

<section class="<?= $class_name ?> hero hero-image <?= $theme == 'light' ? 'text-bg-off-white' : 'text-bg-dark-green' ?>">
    <?php if (!empty($mobileImage)) { ?>
        <?= wp_get_attachment_image($mobileImage, 'full', false, ['class' => 'mobile-image img-fluid', 'data-aos' => 'none']) ?>
    <?php } ?>

    <?php if (!empty($desktopImage)) { ?>
        <div class="desktop-image" style="background: url(<?= $desktopImage ?>);"></div>
    <?php } ?>

    <div class="hero-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <?php if (!empty($label)) { ?>
                        <p class="hero-pretitle"><?= $label ?></p>
                    <?php } ?>

                    <?php if (!empty($heading)) { ?>
                        <h1 class="display-1"><?= $heading ?></h1>
                    <?php } ?>

                    <?php if (!empty($description)) { ?>
                        <p><?= $description ?></p>
                    <?php } ?>

                    <?php if (!empty($link)) { ?>
                        <?= get_link_tag($link, 'btn btn-primary') ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>