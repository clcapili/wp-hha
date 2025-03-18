<?php
/**
 * Card Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'custom-block card-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$color          = get_field('color') ?? 'text-bg-green';
$image          = get_field('image');
$imagePos       = get_field('image_position');
$heading        = get_field('heading');
$description    = get_field('description');
$link           = get_field('link');

?>

<div <?= $anchor ?> class="<?= $class_name ?> card <?= $color ?> mb-3">
    <?php if (!empty($image && $imagePos == 'top')) { ?>
        <?= wp_get_attachment_image($image, 'full', false, ['class' => 'card-img-top', 'data-aos' => 'none']) ?>
    <?php } ?>
    
    <div class="card-body">
        <?php if (!empty($heading)) { ?>
            <h3 class="card-title h4" data-mh="card-title"><?= $heading ?></h3>
        <?php } ?>

        <?php if (!empty($description)) { ?>
            <p class="card-text" data-mh="card-text"><?= $description ?></p>
        <?php } ?>

        <?php if (!empty($link)) { ?>
            <?= get_link_tag($link, 'btn btn-dark') ?>
        <?php } ?>
    </div>

    <?php if (!empty($image && $imagePos == 'bottom')) { ?>
        <?= wp_get_attachment_image($image, 'full', false, ['class' => 'card-img-bottom', 'data-aos' => 'none']) ?>
    <?php } ?>
</div>