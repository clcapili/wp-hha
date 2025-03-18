<?php
    $header     = get_field('header', 'option');
    $topLinks   = $header['top_links'] ?? [];
    $headerMenu = !empty($header['menu']) ? $header['menu'] : [];
    $ctaBtn     = $header['cta_button'] ?? [];

    $headerTheme = get_field('header_theme');

    if (is_404()) {
        $headerTheme = 'light';
    }

    $fields = get_fields($id);
?>

<header class="header header-<?= $headerTheme ?> show">
    <?php include(locate_template('parts/alert.php')) ?>

    <!-- header desktop -->
    <div class="header-desktop">
        <div class="visually-hidden-focusable">
			<div class="container">
				<a class="skip-link" href="#main-content">Skip to main content</a>
			</div>
		</div>

        <?php if (!empty($topLinks) && (!isset($fields['hide_header']) || !$fields['hide_header'])) { ?>
            <!-- top links -->
            <nav class="top-menu">
                <div class="container">
                    <div class="row text-end">
                        <div class="col">
                            <ul class="list-inline top-menu-items">
                                <?php foreach($topLinks as $link) { ?>
                                    <?php if (!empty($link['link'])) { ?>
                                        <li class="list-inline-item">
                                            <?= get_link_tag($link['link'], 'label-small') ?>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        <?php } ?>
        
        <nav class="main-menu">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-3">
                        <!-- site logo -->
                        <a href="/" target="_self" class="navbar-brand site-logo">
                            <img src="/wp-content/themes/hha/img/underwing-logo-white.svg" alt="Underwing Logo White Version" class="img-fluid logo-white" />
                            <img src="/wp-content/themes/hha/img/underwing-logo-color.svg" alt="Underwing Logo Color Version" class="img-fluid logo-color" />
                        </a>
                    </div>
                    
                    <?php if (!isset($fields['hide_header']) || !$fields['hide_header']) { ?>
                        <div class="col-auto">
                            <!-- main nav -->
                            <div class="main-menu-items">
                                <div class="navbar-expand">
                                    <ul class="navbar-nav">
                                        <?php if (isset($headerMenu)) { ?>
                                            <?php foreach ($headerMenu as $menu) { ?>
                                                <?php 
                                                    $columns = $menu['columns'] ?: [];
                                                    $banner = $menu['banner'];
                                                ?>

                                                <li class="nav-item<?= !empty($columns) ? ' with-submenu' : '' ?>">
                                                    <?php if (!empty($menu['label'])) { ?>
                                                        <span class="submenu-toggle nav-link" tabindex="0">
                                                            <?= $menu['label'] ?>
                                                        </span>
                                                    <?php } ?>

                                                    <?php if (!empty($columns)) { ?>
                                                        <div class="submenu">
                                                            <div class="container">
                                                                <div class="submenu-inner">
                                                                    <div class="row gx-0">
                                                                        <div class="col-lg-9 d-flex flex-column justify-content-between">
                                                                            <div class="row">
                                                                                <?php foreach ($columns as $layout) {
                                                                                        // utilities.php
                                                                                        switch ($layout['acf_fc_layout']) {
                                                                                            case 'descriptive_links':
                                                                                                echo columnDescriptiveLinksDesktop($layout);
                                                                                                break;
                                                                                            case 'link_list':
                                                                                                echo columnLinkListDesktop($layout);
                                                                                                break;
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                            </div>

                                                                            <?php if (!empty($menu['cta'])) { ?>
                                                                                <div class="header-cta">
                                                                                    <a href="<?= $menu['cta']['url'] ?>">
                                                                                        <?= $menu['cta']['title'] ?>
                                                                                        <i class="icon icon-arrow-right"></i>
                                                                                    </a>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </div>

                                                                        <div class="col-lg-3">
                                                                            <div class="menu-banner" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.60) 18.6%, rgba(0, 0, 0, 0.00) 43.97%), <?= $banner['background_image'] ? 'url('. $banner['background_image'] .'); ' : '' ?>;">
                                                                                <?php if (!empty($banner['description'])) { ?>
                                                                                    <p><?= $banner['description'] ?></p>
                                                                                <?php } ?>

                                                                                <?php if (!empty($banner['link'])) { ?>
                                                                                    <a href="<?= $banner['link']['url'] ?>">
                                                                                        <?= $banner['link']['title'] ?>
                                                                                        <i class="icon icon-arrow-right"></i>
                                                                                    </a>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-auto ms-auto">
                            <div class="nav-item-button">
                                <?php if ($header['modal']) { ?>
                                    <button class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#bootstrap-modal"
                                        data-bs-id="<?= $header['modal_content'] ?>"
                                        data-bs-size="<?= $header['modal_size'] ?>"
                                    >

                                        <span><?= $ctaBtn['title'] ?></span>
                                    </button>
                                <?php } else if (!empty($ctaBtn)) { ?>
                                    <?= get_link_tag($ctaBtn, 'btn btn-primary') ?>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </div>

    <!-- header mobile -->
    <div class="header-mobile">
        <div class="visually-hidden-focusable">
			<div class="container">
				<a class="skip-link" href="#main-content">Skip to main content</a>
			</div>
		</div>

        <div class="header-mobile-nav">
            <div class="container">
                <div class="row">
                    <div class="col-10 col-xs-auto">
                        <!-- site logo -->
                        <a href="/" target="_self" class="navbar-brand site-logo">
                            <img src="/wp-content/themes/hha/img/underwing-logo-white.svg" alt="Underwing Logo White Version" class="img-fluid logo-white" />
                            <img src="/wp-content/themes/hha/img/underwing-logo-color.svg" alt="Underwing Logo Color Version" class="img-fluid logo-color" />
                        </a>
                    </div>
                    
                    <div class="col d-flex align-items-center justify-content-end">
                        <a href="javascript:;" aria-label="Mobile menu" id="hamburger" class="menu-close">
                            <div class="mobile-button__bar"></div>
                            <div class="mobile-button__bar"></div>
                            <div class="mobile-button__bar"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- mobile menu -->
        <nav class="header-mobile-menu">
                <?php if (!empty($headerMenu)) { ?>
                    <ul class="list-unstyled main-menu">
                        <?php foreach($headerMenu as $menu) { ?>
                            <?php $columns = $menu['columns'] ?: [] ?>
                            
                            <li class="mobile-nav-item<?= !empty($columns) ? ' with-submenu' : '' ?>">
                                <?php if (!empty($menu['label'])) { ?>
                                    <div class="container">
                                        <div class="nav-link mobile-submenu-toggle" tabindex="0">
                                            <p id="<?= $menu['label'] ?>" class="menu-item-link"><?= $menu['label'] ?></p>
                                            <span class="toggle-icon icon icon-keyboard_arrow_down"></span>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if (!empty($columns)) { ?>
                                    <!-- submenu -->
                                    <div class="mobile-submenu">
                                        <div class="container">
                                            <div class="row">
                                                <?php foreach ($columns as $layout) {
                                                    // utilities.php
                                                    switch ($layout['acf_fc_layout']) {
                                                            case 'descriptive_links':
                                                                echo columnDescriptiveLinksMobile($layout);
                                                                break;
                                                            case 'link_list':
                                                                echo columnLinkListMobile($layout);
                                                                break;
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        
                                        <?php if (!empty($menu['cta'])) { ?>
                                            <div class="header-cta">
                                                <div class="container">
                                                    <?= get_link_tag($menu['cta']) ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>

            <div class="container">
                <?php if (!empty($ctaBtn)) { ?>
                    <!-- CTA button -->
                    <?= get_link_tag($ctaBtn, 'btn btn-primary') ?>
                <?php } ?>
            </div>
                
            <?php if (!empty($topLinks)) { ?>
                <!-- bottom menu -->
                <div class="bottom-menu">
                    <ul class="list-unstyled mb-0">
                        <?php foreach($topLinks as $link) { ?>
                            <?php if (!empty($link['link'])) { ?>
                                <li>
                                    <div class="container">
                                        <a href="<?= $link['link']['url'] ?>" target="<?= $link['link']['target'] ?>">
                                            <?= $link['link']['title'] ?? 'Link' ?>
                                        </a>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </nav>
    </div>
</header>

