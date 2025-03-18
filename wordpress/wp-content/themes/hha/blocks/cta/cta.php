<?php
/**
 * CTA Block Template.
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
$class_name = 'editor-grid cta-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$ctaObject  = get_field('cta');
$type = '';

if (isset($ctaObject) && is_object($ctaObject)) {
    $ctaFields  = get_fields($ctaObject->ID);

    if (!empty($ctaFields)) {
        $type = isset($ctaFields['type']) ? $ctaFields['type'] : '';
        
        $general = isset($ctaFields['general']) ? $ctaFields['general'] : [];
        $subscribe = isset($ctaFields['subscribe']) ? $ctaFields['subscribe'] : [];
    }
}

?>

<?php if (isset($ctaObject)) { ?>
    <div <?= $anchor ?> class="<?= $class_name ?> cta">
        <?php if ($type == 'general') { ?>
            <!-- general -->
            <section class="cta-general text-bg-<?= $general['background_color'] ?>">
                <div class="cta-inner">
                    <?php if (!empty($general['desktop_image'])) { ?>
                        <div class="desktop-image" style="<?= $general['desktop_image'] ? 'background-image: url('. $general['desktop_image'] .'); ' : '' ?>"></div>
                    <?php } ?>

                    <?php if (!empty($general['mobile_image'])) { ?>
                        <div class="mobile-image" style="<?= $general['mobile_image'] ? 'background-image: url('. $general['mobile_image'] .'); ' : '' ?>"></div>
                    <?php } ?>

                    <div class="cta-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php if (!empty($general['heading'])) { ?>
                                        <span class="h2"><?= $general['heading'] ?></span>
                                    <?php } ?>

                                    <?php if (!empty($general['description'])) { ?>
                                        <p><?= $general['description'] ?></p>
                                    <?php } ?>

                                    <?php if (!empty($general['link'] && $general['background_color'] == 'green')) { ?>
                                        <?= get_link_tag($general['link'], 'btn btn-dark') ?>
                                    <?php } else { ?>
                                        <?= get_link_tag($general['link'], 'btn btn-primary') ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } else if ($type == 'subscribe') { ?>
            <!-- subscribe -->
            <section class="cta cta-subscribe text-bg-dark-green">
                <div class="cta-inner">
                    <div class="cta-body">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <?php if (!empty($subscribe['heading'])) { ?>
                                        <span class="h2"><?= $subscribe['heading'] ?></span>
                                    <?php } ?>
                                </div>

                                <div class="col-lg-3">
                                    <?php if (!empty($subscribe['image'])) { ?>
                                        <?= wp_get_attachment_image($subscribe['image'], 'full', false, ['class' => 'img-fluid', 'data-aos' => 'none']) ?>
                                    <?php } ?>
                                </div>

                                <?php if ($subscribe['modal']) { ?>
                                    <div class="col-lg-3">
                                        <button class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#bootstrap-modal"
                                            data-bs-id="<?= $subscribe['modal_content'] ?>"
                                            data-bs-size="<?= $subscribe['modal_size'] ?>"
                                            
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

                                            <span><?= $subscribe['link']['title'] ?></span>
                                        </button>
                                    </div>
                                <?php } else if (!empty($subscribe['link'])) { ?>
                                    <div class="col-lg-3">
                                        <?= get_link_tag($subscribe['link'], 'btn btn-primary') ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
    </div>
<?php } ?>