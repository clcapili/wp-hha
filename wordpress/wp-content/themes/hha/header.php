<!doctype html>
<html lang="en">
	<head>
		<?php include(locate_template('/parts/analytics.php')); ?>

		<meta charset="utf-8">
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

		<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
		<link rel="icon" type="image/svg+xml" href="/favicon.svg" />
		<link rel="icon" type="image/x-icon" href="/favicon.ico" sizes="32x32" />
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
		<meta name="apple-mobile-web-app-title" content="Underwing" />
		<link rel="manifest" href="/site.webmanifest" />
		
		<meta name="ajaxurl" content="<?= admin_url('admin-ajax.php') ?>">
		
		<?php wp_head(); ?>
	</head>
	<body <?= body_class() ?> data-partner-id="<?= get_field('partner_id') ?: '' ?>">
		<?php if ($googleAnalyticsCode != false && $googleAnalyticsCode != '') { ?>
			<!-- Google Tag Manager (noscript) -->
			<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= $googleAnalyticsCode ?>"
			height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<!-- End Google Tag Manager (noscript) -->
		<?php } ?>

		<?php include(locate_template('parts/header-nav.php')) ?>