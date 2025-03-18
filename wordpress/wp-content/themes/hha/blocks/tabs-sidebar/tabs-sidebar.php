<?php
/**
 * Tabs Sidebar Block Template.
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
$class_name = 'editor-grid tabs-sidebar-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty( $block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$allowed_inner_blocks = ['custom/tab-pane'];
$tabs = get_field('tabs') ?? [];

?>

<div class="<?= $class_name ?> tabs-sidebar">
    <div class="row">
        <div class="col-lg-4">
            <div class="sticky-element">
                <p class="text-label">TABLE OF CONTENTS</p>
                
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <?php $first = true; ?>
                    <?php foreach ($tabs as $tab) { ?>
                        <li class="nav-item" role="presentation">
                            <?php if (!empty($tab['tab_anchor']) && !empty($tab['tab_name'])) { ?>
                                <button class="nav-link <?= $first ? 'active' : '' ?>" id="<?= $tab['tab_anchor'] ?>-tab" data-bs-toggle="pill" data-bs-target="#<?= $tab['tab_anchor'] ?>" type="button" role="tab" aria-controls="<?= $tab['tab_anchor'] ?>" aria-selected="<?= $first ? 'true' : 'false' ?>"><?= $tab['tab_name'] ?></button>
                            <?php } ?>
                        </li>
                    <?php $first = false; ?>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="tab-content" id="pills-tabContent">
                <InnerBlocks allowedBlocks="<?= esc_attr(wp_json_encode($allowed_inner_blocks)) ?>" />
            </div>
        </div>
    </div>
</div>