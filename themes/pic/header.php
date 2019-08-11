<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="format-detection" content="telephone=no" />
<meta name="format-detection" content="address=no" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<?php wp_head(); ?>
</head>
<body>
	<header class="header">
		<div class="d-flex flex-wrap flex-md-nowrap">
			<div class="header-logo d-flex align-items-center justify-content-center">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img src="<?php bloginfo( 'template_directory' ); ?>/i/logo.svg" width="142" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</a>
			</div>
			<div class="header-menu-container d-flex align-items-center justify-content-end">
				<nav class="header-menu-nav d-xl-block d-none">
					<?php wp_nav_menu( array(
						'theme_location' => 'main_menu',
						'menu_class'     => 'header-menu list-unstyled',
						'item_spacing'   => 'discard',
						'container'      => false,
					) ); ?>
				</nav>
				<div class="header-menu-toggle-container d-flex d-xl-none align-items-center">
					<span class="header-menu-toggle-label"><?php _e( 'Menu', 'pic' ); ?></span>
					<button class="header-menu-toggle"></button>
				</div>
			</div>
			<div class="header-callback d-flex align-items-center justify-content-center" data-fancybox data-src="#callback"><span class="header-callback-inner">
				<span class="header-callback-l"><span class="d-none d-xl-inline"><?php _e( 'Callback', 'pic' ); ?></span>
				</span>
				<span class="header-callback-t"><?php echo esc_html( get_option('pic_tel') ); ?></span>
			</span></div>
		</div>
	</header>

	<main class="main">
