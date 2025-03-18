<?php
/**
 * Card Benefit Block Template.
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
$class_name = 'custom-block block-placeholder card-benefit-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$color      = get_field('color');
$icon       = get_field('icon');
$heading    = get_field('heading');

?>

<div <?= $anchor ?> class="<?= $class_name ?> card card-center <?= $color ?> mb-3">
    <div class="card-body">
        <?php if (!empty($icon)) { ?>
            <i class="icon <?= $icon ?> icon-sm card-glyph"></i>
        <?php } ?>

        <?php if (!empty($heading)) { ?>
            <p class="card-title lead" data-mh="card-benefit-title"><?= $heading ?></p>
        <?php } ?>
    </div>
</div>
