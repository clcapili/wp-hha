<?php
/**
 * Featured Post Block Template.
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
$class_name = 'custom-block editor-grid featured-post-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$featured = get_posts([
    'post_type'         => 'blog',
    'post_status'       => 'publish',
    'posts_per_page'    => 1,
    'meta_query'        => [
        'relation'      => 'AND',
        [
            'key'       => 'featured',
            'value'     => true,
            'compare'   => '==',
        ]
    ]
]);

?>

<?php if (!empty($featured)) { ?>
    <?php $image  = get_lazy_post_thumbnail($featured[0], 'img-fluid'); ?>

    <a <?= $anchor ?> href="<?= get_the_permalink($featured[0]) ?>" class="<?= $class_name ?> card card-featured">
        <div class="row flex-lg-row-reverse">
            <?php if (!empty($image)) { ?>
                <div class="col-lg-6">
                    <?= $image ?>
                </div>
            <?php } ?>

            <div class="col-lg-6 d-flex align-items-center">
                <div class="row">
                    <div class="col-lg offset-lg-1">
                        <div class="card-body">
                            <p class="card-pretitle">FEATURED POST</p>
                            <h2 class="card-title"><?= get_the_title($featured[0]) ?></h2>
                            <span class="btn btn-link">Read more</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
<?php } ?>