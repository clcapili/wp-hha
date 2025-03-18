<?php
/**
 * Testimonial Block Template.
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
$class_name = 'editor-grid testimonial-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$image      = get_field('image');
$video      = get_field('video');
$pretitle   = get_field('pre-title');
$quote      = get_field('quote');
$name       = get_field('name');
$position   = get_field('position');
$link       = get_field('link');

?>

<div class="<?= $class_name ?> card card-horizontal text-bg-green mb-3">
    <div class="row g-0">
        <?php if (!empty($image)) { ?>
            <div class="col-md-5">
                <?php if (!empty($video)) { ?>
                    <a href="<?= $video ?>" data-fancybox class="card-img-left btn-play" style="background-image: url(<?= $image ?>);"></a>
                <?php } else { ?>
                    <div class="card-img-left" style="background-image: url(<?= $image ?>);"></div>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="col-md-7">
            <div class="card-body">
                <?php if (!empty($pretitle)) { ?>
                    <p class="card-pretitle"><?= $pretitle ?></p>
                <?php } else { ?>
                    <p class="card-pretitle">Hear from our clients</p>
                <?php } ?>

                <?php if (!empty($quote)) { ?>
                    <h2 class="card-title"><?= $quote ?></h2>
                <?php } ?>

                <?php if (!empty($name)) { ?>
                    <p class="card-text text-dark-green"><strong><?= $name ?></strong></p>
                <?php } ?>

                <?php if (!empty($position)) { ?>
                    <p class="card-text"><?= $position ?></p>
                <?php } ?>

                <?php if (!empty($link)) { ?>
                    <?= get_link_tag($link, 'btn btn-link') ?>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="icon-cargiver"></div>
</div>