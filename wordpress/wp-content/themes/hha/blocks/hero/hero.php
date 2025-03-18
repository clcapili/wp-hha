<?php
/**
 * Hero Block Template.
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
$class_name = 'editor-grid hero-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$bgColor        = get_field('background_color');
$image          = get_field('image');
$label          = get_field('label');
$heading        = get_field('heading') ?: 'Page Title';
$description    = get_field('description');
$link           = get_field('link');

$modal          = get_field('modal') ?: false;
$modalPost      = get_field('modal_content') ?: 0;
$modalSize      = get_field('modal_size') ?: 'default';
$dynamicData    = get_field('dynamic_data');

?>

<section <?= $anchor ?> class="<?= $class_name ?> hero hero-icon bg-<?= $bgColor ?><?= $bgColor == 'blue' ? ' text-black' : '' ?>">
    <div class="container">
        <div class="row align-items-center flex-lg-row-reverse">
            <div class="col-lg-6">
                <?php if (!empty($image)) { ?>
                    <?= wp_get_attachment_image($image, 'full', false, ['class' => 'img-fluid', 'data-aos' => 'none']) ?>
                <?php } ?>
            </div>

            <div class="col-lg-6">
                <?php if (!empty($label)) { ?>
                    <p class="hero-pretitle"><?= $label ?></p>
                <?php } ?>

                <?php if (!empty($heading)) { ?>
                    <h1 class="hero-title"><?= $heading ?></h1>
                <?php } ?>

                <?php if (!empty($description)) { ?>
                    <p class="hero-text"><?= $description ?></p>
                <?php } ?>

                <?php if ($modal) { ?>
                    <button class="btn btn-dark"
                        data-bs-toggle="modal"
                        data-bs-target="#bootstrap-modal"
                        data-bs-id="<?= $modalPost ?>"
                        data-bs-size="<?= $modalSize ?>"
                        
                        <?php
                            if (!empty($dynamicData)) {
                                foreach ($dynamicData as $row) {
                                    $data_name  = $row['data_name'];
                                    $data_value = $row['data_value'];

                                    $data_name_slug = sanitize_title($data_name); 

                                    if (!empty($data_name_slug) && !empty($data_value)) {
                                        printf(
                                            ' data-bs-caller-%s="%s"',
                                            esc_attr($data_name_slug),
                                            esc_attr($data_value)
                                        );
                                    }
                                }
                            }
                        ?>
                    >

                        <span><?= $link['title'] ?></span>
                    </button>
                <?php } else if (!empty($link)) { ?>
                    <?= get_link_tag($link, 'btn btn-dark') ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>