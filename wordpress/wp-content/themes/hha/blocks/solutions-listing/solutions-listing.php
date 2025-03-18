<?php
/**
 * Solutions Listing Block Template.
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
$class_name = 'editor-grid solutions-listing-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$posts = get_field('solutions');

?>

<?php if (!empty($posts)) { ?>
    <div class="<?= $class_name ?>">
        <div class="row">
            <?php foreach ($posts as $post) { ?>
                <?php
                    $icon = get_field('icon', $post);
                ?>

                <div class="col-md-4">
                    <div class="card card-solution mb-4" data-mh="card-solution">
                        <div class="card-body">
                            <?php if (!empty($icon)) { ?>
                                <i class="icon <?= $icon ?> icon-md card-glyph"></i>
                            <?php } ?>
                        
                            <h3 class="card-title" data-mh="card-title"><?= get_the_title($post) ?></h3>
                            <p class="card-text" data-mh="card-text"><?= get_the_excerpt($post) ?></p>

                            <a href="<?= get_the_permalink($post) ?>" class="link-arrow stretched-link">
                                <span>Learn more</span><i class="icon icon-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>