<?php
/**
 * Card Profile Block Template.
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
$class_name = 'custom-block card-profile-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$image      = get_field('image');
$name       = get_field('name');
$position   = get_field('position');
$link       = get_field('link');

?>

<a href="<?= $link && $link['url'] ? $link['url'] : '#' ?>" class="<?= $class_name ?> card card-profile mb-3"  <?php if ($link && $link['target']) { ?> target="<?= $link['target'] ?>" rel="noopener" <?php } ?> >
    <?php if (!empty($image)) { ?>
        <?= wp_get_attachment_image($image, 'full', false, ['class' => 'card-img-top', 'data-aos' => 'none']) ?>
    <?php } ?>
    
    <div class="card-body">
        <?php if (!empty($name)) { ?>
            <h3 class="card-title"><?= $name ?></h3>
        <?php } ?>

        <?php if (!empty($position)) { ?>
            <p class="card-text"><?= $position ?></p>
        <?php } ?>
    </div>
</a>