<?php
    $id             = get_the_ID();
    $footer         = get_field('footer', 'option');
    $description    = $footer['description'] ?? '';
    $social         = $footer['social'] ?? null;
    $columns        = !empty($footer['columns']) ? $footer['columns'] : [];
    $legalLinks     = $footer['legal_links'] ?? null;

    $fields = get_fields($id);
?>

<footer>
    <!-- columns -->
    <div class="container">
        <?php if (!isset($fields['hide_footer']) || !$fields['hide_footer']) { ?>
            <div class="row">
                <div class="col-auto col-lg-4">
                    <a href="/" target="_self" class="site-logo">
                        <img src="/wp-content/themes/hha/img/underwing-logo-color.svg" alt="Underwing Logo Color Version" class="img-fluid logo-color" />
                    </a>

                    <?php if (!empty($description)) { ?>
                        <p><?= $description ?></p>
                    <?php } ?>

                    <!-- social -->
                    <?php if (!empty($social)) { ?>
                        <ul class="list-inline social">
                            <?php if (!empty($social['facebook'])) { ?>
                                <li class="list-inline-item me-2">
                                    <a class="social-link" href="<?= $social['facebook'] ?>" target="_blank">
                                        <i class="icon icon-facebook" aria-hidden="true"></i>
                                        <span class="visually-hidden">Facebook</span>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if (!empty($social['twitter'])) { ?>
                                <li class="list-inline-item me-2">
                                    <a class="social-link" href="<?= $social['twitter'] ?>" target="_blank">
                                        <i class="icon icon-x" aria-hidden="true"></i>
                                        <span class="visually-hidden">Twitter</span>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if (!empty($social['linkedin'])) { ?>
                                <li class="list-inline-item me-2">
                                    <a class="social-link" href="<?= $social['linkedin'] ?>" target="_blank">
                                        <i class="icon icon-linkedin" aria-hidden="true"></i>
                                        <span class="visually-hidden">LinkedIn</span>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if (!empty($social['vimeo'])) { ?>
                                <li class="list-inline-item me-2">
                                    <a class="social-link" href="<?= $social['vimeo'] ?>" target="_blank">
                                        <i class="icon icon-vimeo" aria-hidden="true"></i>
                                        <span class="visually-hidden">Vimeo</span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>

                <div class="col-lg-8">
                    <div class="row">
                        <?php foreach($columns as $col) { ?>
                            <nav class="col-6 col-lg-3">
                                <!-- heading -->
                                <div class="footer-heading">
                                    <?php if (!empty($col['heading'])) { ?>
                                        <p><?= $col['heading'] ?></p>
                                    <?php } ?>
                                </div>

                                <!-- links -->
                                <?php if (!empty($col['links'])) { ?>
                                    <ul class="list-unstyled footer-columns">
                                        <?php foreach ($col['links'] as $link) { ?>
                                            <li>
                                                <?php if ($link['link']['url'] != '#') { ?>
                                                    <?= get_link_tag($link['link']) ?>
                                                <?php } else { ?>
                                                    <?= $link['link']['title'] ?>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </nav>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (!empty($legalLinks)) { ?>
            <ul class="list-inline copyright">
                <li class="list-inline-item">&copy; <?= Date('Y') ?> Underwing</li>

                <?php foreach($legalLinks as $link) { ?>
                    <?php if (!empty($link['link'])) { ?>
                        <li class="list-inline-item"><?= get_link_tag($link['link'], '') ?></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</footer>