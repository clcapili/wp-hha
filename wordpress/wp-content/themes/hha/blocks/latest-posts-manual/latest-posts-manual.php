<?php
/**
 * Latest Posts (Manual) Block Template.
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
$class_name = 'editor-grid latest-posts-manual-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$id     = get_the_ID();
$posts  = get_field('posts');

?>

<?php if (!empty($posts)) { ?>
    <div <?= $anchor ?> class="<?= $class_name ?>">
        <div class="row">
            <?php foreach($posts as $post_id) { ?>
                <?php 
                    $topics = get_the_terms($post_id, 'topics');
                    $resourceTypes = get_the_terms($post_id, 'resource-types');
                ?>

                <div class="col-lg-4">
                    <a href="<?= get_the_permalink($post_id) ?>" class="card card-flush mb-3">
                        <?= get_lazy_post_thumbnail($post_id, 'card-img') ?>
                        
                        <div class="card-body">
                            <?php if (is_array($topics)) { ?>
                                <p class="card-pretitle"><?= $topics[0]->name ?></p>
                            <?php } ?>

                            <?php if (is_array($resourceTypes)) { ?>
                                <p class="card-pretitle"><?= $resourceTypes[0]->name ?></p>
                            <?php } ?>
                            
                            <h4 class="card-title"><?= get_the_title($post_id) ?></h4>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>