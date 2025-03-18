<?php
/**
 * Card Stat Block Template.
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
$class_name = 'custom-block block-placeholder card-stat-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$icon       = get_field('icon');
$stat       = get_field('stat');
$label      = get_field('label');

?>

<div <?= $anchor ?> class="<?= $class_name ?> card card-flush card-center mb-3">
    <?php if (!empty($icon)) { ?>
        <i class="icon <?= $icon ?> icon-lg text-green"></i>
    <?php } ?>

    <div class="card-body">
        <?php if (!empty($stat)) { ?>
            <h3 class="card-title display-1"><?= $stat ?></h3>
        <?php } ?>

        <?php if (!empty($label)) { ?>
            <p class="card-text text-dark-green lead"><?= $label ?></p>
        <?php } ?>
    </div>
</div>
