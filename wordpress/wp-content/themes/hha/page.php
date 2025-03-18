<?php 
/*
 * Template Post Type: page
 */
?>

<?php get_header(); ?>

<?php edit_link_override(get_queried_object_id()); ?>

<?php $fields = get_fields(); ?>

<main class="main" id="main-content">
	
	<?php if (have_posts()) { ?>
		<?php while (have_posts()) { the_post(); ?>
			
				<section class="page-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10">
                                <h1><?= get_the_title() ?></h1>

                            </div>
                        </div>
                    </div>   
                </section>

                <?php the_content() ?>
			
		<?php } ?>
	<?php } ?>
</main>

<?php get_footer(); ?>