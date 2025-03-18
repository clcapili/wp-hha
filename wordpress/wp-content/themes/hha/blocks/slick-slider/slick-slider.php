<?php
/**
 * Slick Slider Block Template.
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
    $sliderId = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'slick-slider-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$isAutoplay         = get_field('autoplay');
$continuousSlide    = get_field('continuous_slide');
$slidesToShow       = get_field('slidestoshow') ?: '';
$slidesToShowTablet = get_field('slidestoshow_tablet') ?: '';
$slidesToShowMobile = get_field('slidestoshow_mobile') ?: '';
$isBleeding         = get_field('is_bleeding');

$allowed_inner_blocks   = ['custom/slick-slide'];

if ($isBleeding) { 
    $class_name .= ' is-bleeding';
}
?>

<div <?= $anchor ?> class="<?= $class_name ?>">
    <div class="slick-slider-wrapper">
        <?php if ($isBleeding) { ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12"><?php } ?>
                        <div class="<?= $isBleeding ? 'slick-bleed' : ' mb-4' ?>">
                            <div class="slick" 
                                data-slick='{ "slidesToShow": <?= $slidesToShow ?> }' 
                                data-slick-responsive-992='{ "slidesToShow": <?= $slidesToShowTablet ?> }' 
                                data-slick-responsive-768='{ "slidesToShow": <?= $slidesToShowTablet ?> }' 
                                data-slick-responsive-576='{ "slidesToShow": <?= $slidesToShowMobile ?> }'
                                data-autoplay='{ "autoplay": <?= $isAutoplay ? 'true' : 'false' ?> }'
                                data-continuous='{ "autoplaySpeed": <?= $continuousSlide ? 0 : 5000 ?><?= $continuousSlide ? ', "cssEase": "linear"' : '' ?><?= $continuousSlide ? ', "speed": 7000' : '' ?><?= $continuousSlide ? ', "centerMode": true' : '' ?> }'
                                data-infinite='{ "infinite": <?= $isBleeding && !$continuousSlide ? 'false' : 'true' ?> }' 
                            >
                                <InnerBlocks allowedBlocks="<?= esc_attr(wp_json_encode($allowed_inner_blocks)) ?>" />
                            </div>
                        </div>
        <?php if ($isBleeding) { ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($isBleeding) { ?>
            <div class="container">
        <?php } ?>
            <div class="slick-nav">
                <div class="slick-buttons">
                    <button class="slick-prev btn btn-primary" aria-hidden aria-label="Slider previous">
                        <i class="icon icon-arrow-left" aria-hidden="true"></i>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="slick-next btn btn-primary" aria-hidden aria-label="Slider next">
                        <i class="icon icon-arrow-right" aria-hidden="true"></i>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="1" aria-valuenow="0" aria-valuemax="0" style="width: 0%;"></div>
                </div>
            </div>
        <?php if ($isBleeding) { ?>
            </div>
        <?php } ?>
    </div>
</div>