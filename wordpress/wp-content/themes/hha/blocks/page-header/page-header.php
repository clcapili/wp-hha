<?php
/**
 * Page Header Block Template.
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
$class_name = 'custom-block page-header-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$heading        = get_field('heading') ?: 'Page Header';
$description    = get_field('description');

?>

<div class="<?= $class_name ?> page-header">
    <?php if (!empty($heading)) { ?>
        <h1><?= $heading ?></h1>
    <?php } ?>

    <?php if (!empty($description)) { ?>
        <p class="lead"><?= $description ?></p>
    <?php } ?>
</div>