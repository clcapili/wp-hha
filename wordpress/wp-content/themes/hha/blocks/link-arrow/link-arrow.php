<?php
/**
 * Link Arrow Block Template.
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
$class_name = 'link-arrow-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

$align = '';
if ( ! empty( $block['align'] ) ) {
    $align .= 'align' . $block['align'];
}

// Load values and assign defaults.
$link = get_field('link') ?: ['url' => '#', 'title' => 'Link Title', 'target' => ''];

?>

<?php if (!empty($block['align'])) { ?>
    <div class="<?= $align ?>">
<?php } ?>

    <?php if (!empty($link)) { ?>
        <a <?= $anchor ?> class="<?= $class_name ?> link-arrow" href="<?= $link['url'] ?? '' ?>" target="<?= $link['target'] ?>">
            <span><?= $link['title'] ?></span>
            <i class="icon icon-arrow-right"></i>
        </a>
    <?php } ?>

<?php if (!empty($block['align'])) { ?>
    </div>
<?php } ?>