<?php 
    $fields     = get_fields(); 
    $id         = get_the_ID();
    $audiences  = get_the_terms($id, 'audiences');
    $topics     = get_the_terms($id, 'topics');

    $authorID   = get_post_field('post_author', $id);
    $authorName = get_the_author_meta('display_name', $authorID);
    $authorPosition = get_the_author_meta('position', $authorID);
?>

<?php get_header(); ?>

<?php edit_link_override(get_queried_object_id()); ?>

<main class="main" id="main-content">
    
    <section class="page-header">
        <div class="container">
            <h1><?= get_the_title($id) ?></h1>
            <p class="single-post-meta">
                <span class="post-meta">By <?= $authorName ?>, <?= $authorPosition ?></span> <?= get_the_date('M j, Y') ?>
            </p>

            <?php
                $audiences = is_array($audiences) ? $audiences : [];
                $topics = is_array($topics) ? $topics : [];
                
                $combinedTerms = array_merge($audiences, $topics);

                if (!empty($combinedTerms)) {
                    $taxonomyCache = [];
                    foreach ($combinedTerms as $i => $term) {
                        if (!isset($taxonomyCache[$term->taxonomy])) {
                            $taxonomyCache[$term->taxonomy] = get_taxonomy($term->taxonomy);
                        }
                        $taxonomy = $taxonomyCache[$term->taxonomy] ?? null;
                        ?>
                            <a href="/blog/?<?= strtolower($taxonomy->labels->singular_name) ?>=<?= $term->slug ?>" class="post-meta"><?= $term->name ?></a><?= ($i < count($combinedTerms) - 1) ? ', ' : '' ?>
                        <?php 
                    }
                }
            ?>
        </div>
    </section>

    <div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>

    <section class="container">
        <!-- content -->
        <div class="row">
            <div class="offset-md-2 col-md-8">
                <div class="content">
                    <?php if (!empty(get_lazy_post_thumbnail($id))) { ?>
                        <?= get_lazy_post_thumbnail($id, 'img-fluid mb-6') ?>
                    <?php } ?>

                    <?php the_content() ?>
                </div>

                <div style="height:100px" aria-hidden="true" class="wp-block-spacer is-style-medium"></div>

                <!-- social -->
                <ul class="list-inline single-social">
                    <p class="social-label">SHARE</p>

                    <li class="list-inline-item me-2">
                        <a class="social-link" href="http://www.twitter.com/share?url=<?= get_the_permalink($id) ?>" aria-label="Share on Twitter" data-share-type="Twitter">
                            <i class="icon icon-x"></i>
                        </a>
                    </li>

                    <li class="list-inline-item me-2">
                        <a class="social-link" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= get_the_permalink($id) ?>" target="_blank" aria-label="Share on LinkedIn">
                            <i class="icon icon-linkedin"></i>
                        </a>
                    </li>

                    <li class="list-inline-item me-2">
                        <a class="social-link" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(get_the_permalink($id)) ?>&amp;src=sdkpreparse" target="_blank" aria-label="Share on Facebook" data-share-type="Facebook">
                            <i class="icon icon-facebook"></i>
                        </a>
                    </li>

                    <li class="list-inline-item me-2">
                        <a class="social-link copy-link" onclick="copyURI(this, '<?= get_the_permalink($id) ?>')" data-share-type="link" title="Copy link">
                            <i class="icon icon-link-chain"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <div style="height:100px" aria-hidden="true" class="wp-block-spacer is-style-large"></div>

    <!-- resources explore -->
    <div class="wp-block-heading">
        <h2 class="wp-block-heading has-dark-green-color has-text-color">More resources from Underwing</h2>
    </div>

    <div style="height:10px" aria-hidden="true" class="wp-block-spacer"></div>

    <div class="container">
        <?php include 'blocks/resources-explore/resources-explore.php' ?>
    </div>

    <div style="height:100px" aria-hidden="true" class="wp-block-spacer is-style-medium"></div>

    <!-- cta -->
    <?php include 'blocks/cta/cta.php' ?>
</main>

<?php get_footer(); ?>