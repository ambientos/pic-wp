<?php

/**
 * Theme Setup
 */

function pic_setup() {
	load_theme_textdomain( 'pic', get_template_directory() . '/languages' );

	register_nav_menus( array(
		'main_menu'     => __( 'Header Menu', 'pic' ),
		'sub_menu'      => __( 'Footer Main Menu', 'pic' ),
		'services_menu' => __( 'Services Menu', 'pic' ),
	) );

	/**
	 * Theme supports
	 */
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'search-form', 'caption', ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );

	/**
	 * Theme image sizes
	 */
	add_image_size( 'service-thumb', 445, 345, false );

	/**
	 * Theme filters
	 */
	add_filter( 'widget_text', 'do_shortcode' );
}

add_action( 'after_setup_theme', 'pic_setup' );


/**
 * Add styles and scripts
 */

function pic_scripts_styles() {

	/**
	 * Styles
	 */

	wp_enqueue_style( 'pic-bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '20190809' );
	wp_enqueue_style( 'pic-owl-carousel', get_template_directory_uri() . '/css/owl-carousel.css', array(), '20190809' );
	wp_enqueue_style( 'pic-fancybox', get_template_directory_uri() . '/css/fancybox.css', array(), '20190809' );
	wp_enqueue_style( 'pic-site', get_template_directory_uri() . '/css/site.css', array(), '20190809' );


	/**
	 * Scripts
	 */

	wp_enqueue_script( 'pic-owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '2.3.4', true );
	wp_enqueue_script( 'pic-fancybox-js', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array('jquery'), '3.5.7', true );
	wp_enqueue_script( 'pic-site-js', get_template_directory_uri() .'/js/site.js', array('jquery'), '20190809', true );
}

add_action( 'wp_enqueue_scripts', 'pic_scripts_styles' );


/**
 * Register sidebars
 */

function pic_register_sidebars(){
	register_sidebar(
		array(
			'name'          => __( 'After Content', 'pic' ),
			'id'            => 'after-content',
			'description'   => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Form', 'pic' ),
			'id'            => 'footer-form',
			'description'   => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Menu List', 'pic' ),
			'id'            => 'footer-menu-list',
			'description'   => '',
			'before_widget' => '<div class="col-md-3">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Hidden', 'pic' ),
			'id'            => 'sidebar-hidden',
			'description'   => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
}

add_action( 'widgets_init', 'pic_register_sidebars' );


/**
 * Template functions
 */

require 'inc/template-functions.php';


/**
 * Customizer
 */

require 'inc/customizer.php';
