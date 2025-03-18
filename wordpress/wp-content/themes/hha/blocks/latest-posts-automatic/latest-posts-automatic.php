<?php
/**
 * Latest Posts (Automatic) Block Template.
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
$class_name = 'editor-grid latest-posts-automatic-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$id         = get_the_ID();

$postType   = get_field('post_type');
$audience   = get_field('audience');
$type       = get_field('type');
$topic      = get_field('topic');

$args = [
    'post_type'		 => !empty($postType) ? $postType : ['blog', 'resources'] ,
    'post_status'	 => 'publish',
    'posts_per_page' => 3,
    'orderby'           => 'date',
    'order'             => 'DESC',
    'exclude'	 	 => [$id],
    'tax_query'         => ['relation' => 'AND']
];
    
if (!empty($audience)) {
    $args['tax_query'][] = [
        'taxonomy' => 'audiences',
        'field' => 'slug',
        'terms' => $audience->slug ?? ''
    ];
}
    
if (!empty($type && $postType == 'resources')) {
    $args['tax_query'][] = [
        'taxonomy' => 'resource-types',
        'field' => 'slug',
        'terms' => $type->slug ?? ''
    ];
}
    
if (!empty($topic)) {
    $args['tax_query'][] = [
        'taxonomy' => 'topics',
        'field' => 'slug',
        'terms' => $topic->slug ?? ''
    ];
}

$posts = get_posts($args);

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
                            <?php if ($postType != 'resources' && is_array($topics)) { ?>
                                <p class="card-pretitle"><?= $topics[0]->name ?></p>
                            <?php } ?>

                            <?php if ($postType != 'blog' && is_array($resourceTypes)) { ?>
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