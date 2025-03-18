<?php 
/*
 * Template Name: Gated
 * Template Post Type: resources
 */
?>

<?php
	$fields = get_fields();
    $id	= get_the_ID();
?>

<?php get_header(); ?>

<?php edit_link_override(get_queried_object_id()); ?>

<main class="main" id="main-content">
	<?php if (have_posts()) { ?>
		<?php while (have_posts()) { the_post(); ?>

			<section class="page-header">
				<div class="container">
					<h1><?= get_the_title($id) ?></h1>
				</div>
			</section>
			
			<section class="container">
				 <div class="row">
					<div class="col-lg-7">
						<div class="content">
							<?php if (!empty(get_lazy_post_thumbnail($id)) && !$fields['hide_featured_image']) { ?>
								<?= get_lazy_post_thumbnail($id, 'img-fluid mb-6') ?>
							<?php } ?>

							<?php the_content() ?>
						</div>
					</div>

					<div class="col-lg-1 d-none d-xl-flex"></div>

					<div class="col-lg-4">
						<?php include 'blocks/hubspot-form/hubspot-form.php' ?>
					</div>
				</div>
			</section>
		<?php } ?>
	<?php } ?>

</main>

<?php get_footer(); ?>