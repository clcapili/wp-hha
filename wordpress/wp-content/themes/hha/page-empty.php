<?php 
/*
 * Template Name: Empty
 * Template Post Type: page, solutions
 */
?>

<?php get_header(); ?>

<?php edit_link_override(get_queried_object_id()); ?>

<?php $fields = get_fields(); ?>

<main class="main" id="main-content">

	<?php if (have_posts()) { ?>
		<?php while (have_posts()) { the_post(); ?>
			<?php the_content() ?>	
		<?php } ?>
	<?php } ?>

</main>

<?php get_footer(); ?>