<?php
/**
 * Card Info Block Template.
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
$class_name = 'custom-block card-info-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$color          = get_field('color') ?? 'text-bg-green';
$icon           = get_field('icon');
$heading        = get_field('heading');
$description    = get_field('description');
$link           = get_field('link');

?>

<div <?= $anchor ?> class="<?= $class_name ?> card <?= $color ?> mb-3">
    <div class="card-body">
        <?php if (!empty($icon)) { ?>
            <i class="icon <?= $icon ?> icon-md card-glyph"></i>
        <?php } ?>

        <?php if (!empty($heading)) { ?>
            <h3 class="card-title" data-mh="card-info-title"><?= $heading ?></h3>
        <?php } ?>

        <?php if (!empty($description)) { ?>
            <p class="card-text" data-mh="card-info-text"><?= $description ?></p>
        <?php } ?>

        <?php if (!empty($link)) { ?>
            <?= get_link_tag($link, 'btn btn-link') ?>
        <?php } ?>
    </div>
</div>
