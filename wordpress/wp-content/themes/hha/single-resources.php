<?php 
    $id = get_the_ID();
    $fields = get_fields();
?>

<?php get_header(); ?>

<?php edit_link_override(get_queried_object_id()); ?>

<main class="main" id="main-content">
    <section class="page-header">
        <div class="container">
            <h1><?= get_the_title($id) ?></h1>
        </div>
    </section>

	<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>

	<section class="container">
        <!-- content -->
        <div class="row">
            <div class="offset-md-2 col-md-8">
                <div class="content">
                    <?php if (!empty(get_lazy_post_thumbnail($id)) && !$fields['hide_featured_image']) { ?>
                        <?= get_lazy_post_thumbnail($id, 'img-fluid mb-6') ?>
                    <?php } ?>

                    <?php the_content() ?>
                </div>
            </div>
        </div>
    </section>

    <div style="height:100px" aria-hidden="true" class="wp-block-spacer is-style-large"></div>

    <!-- resources explore -->
    <div class="wp-block-heading">
        <h2 class="wp-block-heading has-dark-green-color has-text-color">Resources</h2>
    </div>

    <div style="height:10px" aria-hidden="true" class="wp-block-spacer"></div>

    <div class="container">
        <?php include 'blocks/resources-latest/resources-latest.php' ?>
    </div>

    <div style="height:100px" aria-hidden="true" class="wp-block-spacer is-style-medium"></div>

    <!-- cta -->
    <?php include 'blocks/cta/cta.php' ?>

</main>

<?php get_footer(); ?>
