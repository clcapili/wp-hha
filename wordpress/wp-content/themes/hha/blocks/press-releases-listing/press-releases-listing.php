<?php

/**
 * Press Releases Listing Block Template.
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
$class_name = 'custom-block block-placeholder listing-block press-releases-listing-block';
if (!empty($block['className'])) {
	$class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
	$class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$page = !empty($_REQUEST['pager']) ? (int) $_REQUEST['pager'] : 1;
$url = get_permalink();

//query for noscript fallback
$args = [
	'post_type' => 'press-releases',
	'paged' => $page,
	'posts_per_page' => (isset($_GET['view']) && $_GET['view'] === 'all') ? -1 : 9
];

$loop = new WP_Query($args);

?>

<div <?= $anchor ?> class="<?= $class_name ?>">
	<noscript>
		<?php if ($loop->have_posts()) { ?>
			<div class="row press-releases-archive-list">
				<?php
					while($loop->have_posts()) {
					$loop->the_post();
				?>
					<div class="col-md-6 col-lg-4">
						<a href="<?= get_the_permalink(get_the_ID()); ?>" target="_self" class="card card-flush mb-3">
							<?= get_the_post_thumbnail(get_the_ID(), 'medium', ['class' => 'card-img', 'loading' => 'lazy']) ?>

							<div class="card-body">
								<h3 class="card-title"><?= get_the_title(get_the_ID()); ?></h3>
							</div>
						</a>
					</div>
				<?php } ?>
			</div>

			<?php
				$total_pages = $loop->max_num_pages;

				if ($total_pages > 1) {
			?>
				<nav aria-label="Press Releases Pagination">
					<ul class="pagination mb-0">
						<li class="page-item page-prev<?= ($page == 1 ? ' disabled' : '') ?>">
							<a data-page="1" class="page-link" href="<?= ($page == 1 ? 'javascript:void(0)' : esc_url($url . '?pager=1')) ?>">
								<span class="text">First</span>
							</a>
						</li>

						<?php for ($i = 1; $i <= $total_pages; $i++) { ?>
							<?php if ($i == $page) { ?>
								<li class="page-item page-numbers active" aria-current="page">
									<span class="page-link"><?= $i ?></span>
								</li>
							<?php } else { ?>
								<?php if ($i == 1 || $i == $total_pages || abs($i - $page) <= 2) { ?>
									<li class="page-item">
										<a data-page="<?= $i ?>" class="page-link" href="<?= esc_url($url . '?pager=' . $i) ?>"><?= $i ?></a>
									</li>
								<?php } else if ($i == $page - 3 && $i != 1) { ?>
									<li class="page-item disabled">
										<div class="page-link">...</div>
									</li>
								<?php } else if ($i == $page + 3 && $i != $total_pages) { ?>
									<li class="page-item disabled">
										<div class="page-link">...</div>
									</li>
								<?php } ?>
							<?php } ?>
						<?php } ?>

						<li class="page-item page-next<?= ($page == $total_pages ? ' disabled' : '') ?>">
							<a data-page="<?= $total_pages ?>" class="page-link" href="<?= ($page == $total_pages ? 'javascript:void(0)' : esc_url($url . '?pager=' . $total_pages)) ?>">
							<span class="text">Last</span>
							</a>
						</li>

						<li class="page-item">
							<a class="page-link" href="<?= esc_url($url . '?view=all') ?>">
								<span class="text">View all</span>
							</a>
						</li>
					</ul>
				</nav>
			<?php } ?>

			<?php wp_reset_postdata(); ?>
		<? } ?>
	</noscript>
</div>