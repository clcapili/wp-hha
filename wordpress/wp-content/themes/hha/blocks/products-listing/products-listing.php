<?php
$class_name = 'editor-grid solutions-listing-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

$posts = get_field('products');
?>

<?php if (!empty($posts)) { ?>
    <div class="<?= esc_attr($class_name) ?>">
        <div class="row">
            <?php foreach ($posts as $post_id) { ?>
                <?php
                    $icon = get_field('icon', $post_id);
                ?>
                <div class="col-md-4">
                    <div class="card card-solution mb-4" data-mh="card-solution">
                        <div class="card-body">
                            <?php if (!empty($icon)) { ?>
                                <i class="icon <?= esc_attr($icon) ?> icon-md card-glyph"></i>
                            <?php } ?>
                            <h3 class="card-title" data-mh="card-title"><?= get_the_title($post_id) ?></h3>
                            <p class="card-text" data-mh="card-text"><?= get_the_excerpt($post_id) ?></p>
                            <a href="<?= get_the_permalink($post_id) ?>" class="link-arrow stretched-link">
                                <span>Learn more</span><i class="icon icon-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
