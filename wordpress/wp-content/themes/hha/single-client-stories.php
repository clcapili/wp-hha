<?php 
    $fields     = get_fields(); 
    $id         = get_the_ID();
?>

<?php get_header(); ?>

<?php edit_link_override(get_queried_object_id()); ?>

<main class="main" id="main-content">
    
    <section class="page-header">
        <div class="container">
            <h1><?= get_the_title($id) ?></h1>
        </div>
    </section>

    <section class="container">
        <!-- content -->
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="content">

                    <div style="height:16px" aria-hidden="true" class="wp-block-spacer"></div>

                    <?php the_content() ?>

                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>