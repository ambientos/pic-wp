<?php

/**
 * Theme Setup
 */

function pic_setup() {
	load_theme_textdomain( 'pic', get_template_directory() . '/languages' );

	register_nav_menus( array(
		'main_menu' => __( 'Header Menu', 'pic' ),
		'sub_menu'  => __( 'Footer Main Menu', 'pic' ),
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
	//add_image_size( 'home-news-featured', 384, 256, false );

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
			'before_widget' => '',
			'after_widget'  => '',
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
 * Add options to customizer
 */

add_action('customize_register', function($wp_customize){

	/**
	 * Init customize data
	 */

	$customize_data = array(
		'transport' => 'refresh',
		'sections' => array(
			'pic_settings' => array(
				'panel' => '',
				'title' => __( 'Extra Site Settings', 'pic' ),
				'priority' => 50,
				'settings' => array(
					// Mail
					'pic_mail' => array(
						'label' => __( 'E-mail', 'pic' ),
						'setting_type' => 'option',
						'control_type' => 'text',
					),

					// Phone
					'pic_tel' => array(
						'label' => __( 'Phone', 'pic' ),
						'setting_type' => 'option',
						'control_type' => 'text',
					),

					// Address
					'pic_addr' => array(
						'label' => __( 'Address', 'pic' ),
						'setting_type' => 'option',
						'control_type' => 'text',
					),

					// Copyrights
					'pic_cr' => array(
						'label' => __( 'Copyrights', 'pic' ),
						'setting_type' => 'option',
						'control_type' => 'text',
					),

					// Years
					'pic_y' => array(
						'label' => __( 'Years', 'pic' ),
						'setting_type' => 'option',
						'control_type' => 'text',
					),

					// Checkbox ad
					'pic_ad_show' => array(
						'label' => __( 'Enable Advertisement and Analytics Code?', 'pic' ),
						'setting_type' => 'option',
						'control_type' => 'checkbox',
					),
				),
			),
		),
	);


	/**
	 * Create customize options
	 */

	foreach ($customize_data['sections'] as $section_name => $section) {

		/**
		 * Add settings and controls
		 */

		foreach ($section['settings'] as $setting_name => $setting) {
			$wp_customize->add_setting(
				$setting_name,
				array(
					'type'      => $setting['setting_type'],
					'default'   => $setting['default_content'],
					'transport' => $customize_data['transport'],
				)
			);

			$wp_customize->add_control(
				$setting_name,
				array(
					'section' => $section_name,
					'label' => $setting['label'],
					'type' => $setting['control_type'],
				)
			);
		}

		/**
		 * Add sections
		 */

		$wp_customize->add_section(
			$section_name,
			array(
				'panel' => $section['panel'],
				'title' => $section['title'],
				'priority' => $section['priority'],
			)
		);
	}
});


/**
 * Return raw phone
 */

function pic_get_phone_raw( $phone = false ){
	if ( $phone )
		return str_replace('(', '', str_replace(')', '', str_replace('-', '', str_replace(' ', '', $phone) ) ) );
}


/**
 * Function files includes
 */

require 'functions/is_show_ad.php';