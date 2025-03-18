<?php
/**
 * Button Block Template.
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
$class_name = 'button-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $align = 'align' . $block['align'];
}

// Load values and assign defaults.
$link   = get_field('link') ?: [];
$style  = get_field('style') ?: 'btn-primary';
$modal  = get_field('modal') ?: false;
$modalPost = get_field('modal_content') ?: 0;
$modalSize = get_field('modal_size') ?: 'default';

?>

<?php if (!empty($block['align'])) { ?>
    <div class="<?= $align ?>">
<?php } ?>

    <?php if ($modal) { ?>
        <button class="<?= $class_name ?> btn <?= $style ?>" data-bs-toggle="modal" data-bs-target="#bootstrap-modal" data-bs-id="<?= $modalPost ?>" data-bs-size="<?= $modalSize ?>" data-bs-caller-title="<?= esc_attr( get_the_title( $post_id ) ); ?>">
            <span><?= $link['title'] ?></span>
        </button>
    <?php } else if (!empty($link['url'])) { ?>
        <a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>" class="<?= $class_name ?> btn <?= $style ?>" >
            <span><?= $link['title'] ?></span>
        </a>
    <?php } ?>

<?php if (!empty($block['align'])) { ?>
    </div>
<?php } ?>