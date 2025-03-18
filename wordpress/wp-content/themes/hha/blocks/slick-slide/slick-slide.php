<?php
/**
 * Slick Slide Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

// Load values and assign defaults.
$allowed_inner_blocks = ['core/image', 'custom/card-info'];

?>

<div>
    <InnerBlocks allowedBlocks="<?= esc_attr(wp_json_encode($allowed_inner_blocks)) ?>" />
</div>