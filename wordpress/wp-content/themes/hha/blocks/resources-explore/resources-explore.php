<?php
/**
 * Resources Explore Block Template.
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
$class_name = 'editor-grid resources-explore-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$topic = get_field('topic') ?? null;

$args = [
    'post_type'         => 'resources',
    'post_status'       => 'publish',
    'posts_per_page'    => 6,
    'orderby'           => 'date',
    'order'             => 'DESC',
    'exclude'	 	    => [get_the_ID()],
    'meta_query'        => [
        'relation'      => 'OR',
        [
            'key'       => 'hide_from_listing',
            'compare'   => 'NOT EXISTS',
        ],
        [
            'key'       => 'hide_from_listing',
            'value'     => '0',
        ]
    ]
];
    
if (!empty($topic)) {
    $args['tax_query'][] = [
        'taxonomy' => 'topics',
        'field' => 'slug',
        'terms' => $topic->slug ?? ''
    ];
}

$resources = get_posts($args);

?>

<?php if (!empty($resources)) { ?>
    <div <?= $anchor ?> class="<?= $class_name ?> resources-explore">
        <div class="row">
            <?php
                $i = 0;
                foreach($resources as $resource) {
            ?>
                <div class="col-lg-4">
                    <?php 
                        $resourceTypes = get_the_terms($resource, 'resource-types');
                    ?>

                    <a href="<?= get_the_permalink($resource) ?>" class="card card-flush mb-3">
                        <?= get_lazy_post_thumbnail($resource, 'card-img') ?>
                        
                        <div class="card-body">
                            <?php if (!empty($resourceTypes)) { ?>
                                <p class="card-pretitle"><?= $resourceTypes->name ?></p>
                            <?php } ?>

                            <h4 class="card-title"><?= get_the_title($resource) ?></h4>
                        </div>
                    </a>
                </div>
            <?php
                    $i++;
                    if($i == 2) {
                        break;
                    }
                }
            ?>
          

            <div class="col-lg-4">
                <?php for ($i = 2; $i <= count($resources); $i++) { ?>
                    <?php 
                        if (empty($resources[$i])) continue;
                        $id = $resources[$i];

                        $resourceTypes = get_the_terms($id, 'resource-types');
                    ?>

                    <a href="<?= get_the_permalink($id) ?>" class="card card-flush card-line mb-3">
                        <div class="card-body">
                            <?php if (!empty($resourceTypes)) { ?>
                                <p class="card-pretitle"><?= $resourceTypes[$i]->name ?></p>
                            <?php } ?>

                            <h4 class="card-title"><?= get_the_title($id) ?></h4>
                        </div>
                    </a>
                <?php } ?>

                <a href="/resources/" class="btn btn-link mt-3">See more resources</a>
            </div>
        </div>
    </div>
<?php } ?>