<?php
/**
 * Accordion Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or its parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'custom-block accordion-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults
$accordions = get_field('accordions');
$showFirst  = get_field('show_first');
$blockID    = 'accordionWrapper-' . uniqid();

?>

<div <?= $anchor ?> class="<?= $class_name ?>">
    <div class="accordion" id="<?= $blockID ?>">
        <?php $count = 0; foreach ($accordions as $accordion) { 
            $collapseID = $blockID . '-collapse-' . $count;
        ?>
            <div class="accordion-item">
                <h5 class="accordion-header" id="<?= $blockID . '-heading-' . $count ?>">
                    <button class="accordion-button<?= $count == 0 && $showFirst ? '' : ' collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $collapseID ?>" aria-expanded="<?= $count == 0 ? 'true' : 'false' ?>" aria-controls="<?= $collapseID ?>">
                        <?= $accordion['heading'] ?: 'Accordion heading' ?>
                    </button>
                </h5>

                <div id="<?= $collapseID ?>" class="accordion-collapse collapse<?= $count == 0 && $showFirst ? ' show' : '' ?>" data-bs-parent="#<?= $blockID ?>">
                    <div class="accordion-body">
                        <?= $accordion['description'] ?: 'Accordion description' ?>
                    </div>
                </div>
            </div>
        <?php $count++; } ?>
    </div>
</div>