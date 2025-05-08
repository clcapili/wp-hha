<?php
	$externalLink = get_field('external_link');
	
    if (!empty($externalLink)) {
        wp_redirect($externalLink);
    } else {
		get_header();
	
		edit_link_override(get_queried_object_id());
?>

<main class="main" id="main-content">

	<?php if (have_posts()) { ?>
		<?php while (have_posts()) { the_post(); ?>
			<?php the_content() ?>	
		<?php } ?>
	<?php } ?>

</main>

<?php
		get_footer();
	}
?>