<?php

namespace AG_Pic_Site;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

class Plugin {
	/**
	 * Init
	 *
	 * @return
	 */
	public function __construct() {

		/**
		 * Actions
		 */
		add_action( 'plugins_loaded', array( __CLASS__, 'plugins_loaded' ) );
		add_action( 'init', array( __CLASS__, 'register_cpt_ct' ) );
		add_action( 'carbon_fields_register_fields', array( __CLASS__, 'carbon_fields_register_fields' ) );
		add_action('login_head', array( __CLASS__, 'login_head' ) );

		/**
		 * Shortcodes
		 */
		//add_shortcode( 'home-slider', array( $this, 'home_slider_shortcode' ) );
		//add_shortcode( 'product-slider', array( $this, 'product_slider_shortcode' ) );
	}

	/**
	 * Main load
	 *
	 * @return
	 */
	public static function plugins_loaded() {
		/**
		 * Add image sizes
		 */
		add_image_size( 'client-thumb', 140, 140, false );

		/**
		 * Load translations for this plugin
		 */
		load_textdomain( TEXT_DOMAIN, PLUGIN_FOLDER . '/languages/' . TEXT_DOMAIN . '-' . get_locale() . '.mo' );
	}

	/**
	 * Registering Custom Post Types and Custom Taxonomies
	 */
	public static function register_cpt_ct() {
		register_taxonomy( 'pic-service-category', array(), array(
			'labels'                => array(
				'name'              => __( 'Service Categories', TEXT_DOMAIN ),
				'singular_name'     => __( 'Service Category', TEXT_DOMAIN ),
				'search_items'      => __( 'Search Category', TEXT_DOMAIN ),
				'all_items'         => __( 'All Categories', TEXT_DOMAIN ),
				'view_item '        => __( 'View Category', TEXT_DOMAIN ),
				'parent_item'       => __( 'Parent Category', TEXT_DOMAIN ),
				'parent_item_colon' => __( 'Parent Category:', TEXT_DOMAIN ),
				'edit_item'         => __( 'Edit Category', TEXT_DOMAIN ),
				'update_item'       => __( 'Update Category', TEXT_DOMAIN ),
				'add_new_item'      => __( 'Add New Category', TEXT_DOMAIN ),
				'new_item_name'     => __( 'New Category Name', TEXT_DOMAIN ),
				'menu_name'         => __( 'Service Categories', TEXT_DOMAIN ),
			),
			'publicly_queryable'    => true,
			'show_in_rest'          => true,
			'hierarchical'          => true,
			'rewrite'               => array(
				'slug'              => 'service-category',
				'with_front'        => false,
				'hierarchical'      => true,
			),
			'show_admin_column'     => true,
		) );

		register_post_type( 'pic-services', array(
			'labels' => array(
				'name'               => __( 'Services', TEXT_DOMAIN ),
				'singular_name'      => __( 'Service', TEXT_DOMAIN ),
				'add_new'            => __( 'Add New Post', TEXT_DOMAIN ),
				'add_new_item'       => __( 'Add New Post item', TEXT_DOMAIN ),
				'edit_item'          => __( 'Edit Post Item', TEXT_DOMAIN ),
				'new_item'           => __( 'New Post Item', TEXT_DOMAIN ),
				'view_item'          => __( 'View Post Item', TEXT_DOMAIN ),
				'search_items'       => __( 'Search Post', TEXT_DOMAIN ),
				'not_found'          => __( 'Nothing found Services', TEXT_DOMAIN ),
				'not_found_in_trash' => __( 'Nothing found Services in Trash', TEXT_DOMAIN ),
				'menu_name'          => __( 'Services', TEXT_DOMAIN ),
			),
			'public'              => true,
			'show_in_rest'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-portfolio',
			'supports'            => array( 'title', 'editor', 'revisions' ),
			'has_archive'         => 'services',
			'taxonomies'          => array( 'pic-service-category' ),
			'rewrite'             => array(
				'slug'            => 'services',
				'with_front'      => false,
				'feeds'           => false,
			),
		) );

		register_post_type( 'pic-product', array(
			'labels' => array(
				'name'               => __( 'Products', TEXT_DOMAIN ),
				'singular_name'      => __( 'Product', TEXT_DOMAIN ),
				'add_new'            => __( 'Add New Product', TEXT_DOMAIN ),
				'add_new_item'       => __( 'Add New Product item', TEXT_DOMAIN ),
				'edit_item'          => __( 'Edit Product Item', TEXT_DOMAIN ),
				'new_item'           => __( 'New Product Item', TEXT_DOMAIN ),
				'view_item'          => __( 'View Product Item', TEXT_DOMAIN ),
				'search_items'       => __( 'Search Product', TEXT_DOMAIN ),
				'not_found'          => __( 'Nothing found Products', TEXT_DOMAIN ),
				'not_found_in_trash' => __( 'Nothing found Products in Trash', TEXT_DOMAIN ),
				'menu_name'          => __( 'Products', TEXT_DOMAIN ),
			),
			'public'              => true,
			'show_in_rest'        => false,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-cart',
			'supports'            => array( 'title', 'editor', 'revisions', 'thumbnail' ),
			'has_archive'         => 'product',
			'rewrite'             => array(
				'slug'            => 'product',
				'with_front'      => false,
				'feeds'           => false,
			),
		) );
	}

	/**
	 * Carbon Fields init
	 */
	public static function carbon_fields_register_fields() {

		/**
		 * Theme Options
		 */

		Container::make( 'theme_options', __( 'Site Options', TEXT_DOMAIN ) )
			->set_icon('dashicons-hammer')

			// Products
			->add_tab( __( 'Products', TEXT_DOMAIN ), array(
				// Header background image
				Field::make( 'image', 'products-h-i', __( 'Header background image', TEXT_DOMAIN ) ),
			) )

			// Tech code
			->add_tab( __( 'Metrics / Advertising', TEXT_DOMAIN ), array(
				// Metrics code in <head>
				Field::make( 'textarea', 'site-h', __( 'Metric\'s Code in head-tag', TEXT_DOMAIN ) )
					->set_rows(10),

				// Analytic's in Body before content
				Field::make( 'textarea', 'site-b', __( 'Body before Content', TEXT_DOMAIN ) )
					->set_rows(10),

				// Metrics code
				Field::make( 'textarea', 'site-f', __( 'Analytic\'s Code (like Google Analytics, etc.)', TEXT_DOMAIN ) )
					->set_rows(10),
			) );

		/**
		 * Product
		 */

		Container::make( 'post_meta', __( 'Product attributes', TEXT_DOMAIN ) )
			->where( 'post_type', 'IN', array( 'pic-product' ) )
			->set_context( 'carbon_fields_after_title' )
			->add_fields(
				array(
					Field::make( 'complex', 'pa-l', __( 'List', TEXT_DOMAIN ) )
						->add_fields( array(
							Field::make( 'text', 'pa-l-i', __( 'Item', TEXT_DOMAIN ) ),
						) ),
				)
			);

		/**
		 * Gutenberg Blocks
		 */

		Block::make( 'Promo Carousel' )
			->add_fields( array(
				Field::make( 'complex', 'pc-l', __( 'List', TEXT_DOMAIN ) )
					->add_fields( array(
						Field::make( 'image', 'pc-l-i', __( 'Thumbnail', TEXT_DOMAIN ) ),
						Field::make( 'text', 'pc-l-t', __( 'Title', TEXT_DOMAIN ) ),
						Field::make( 'text', 'pc-l-l', __( 'More Link', TEXT_DOMAIN ) ),
						Field::make( 'rich_text', 'pc-l-c', __( 'Content', TEXT_DOMAIN ) )
							->set_rows(20),
					) )
					->set_layout( 'tabbed-horizontal' ),
			) )
			->set_icon( 'list-view' )
			->set_category( 'cb-blocks', 'Carbon Blocks' )
			->set_render_callback( function ( $block ) { ?>

			<section class="promo-container carousel-container" data-loop="1">
				<div class="promo-nav-container">
					<div class="container">
						<div class="promo-nav carousel-nav owl-nav"></div>
					</div>
				</div>
				<div class="carousel owl-carousel">
					<?php foreach ( $block['pc-l'] as $carousel_item ) : ?>
						<?php $thumb_full_arr = wp_get_attachment_image_src( $carousel_item['pc-l-i'], 'full' ); ?>
						<div class="promo-item" style="background-image:url(<?php echo esc_url( $thumb_full_arr[0] ); ?>)">
							<div class="container">
								<div class="promo-item-title"><?php echo esc_html( $carousel_item['pc-l-t'] ); ?></div>
								<div class="promo-item-info">
									<?php echo $carousel_item['pc-l-c']; ?>
								</div>
								<?php if ( ! empty($carousel_item['pc-l-l']) ) : ?>
									<div class="promo-item-more"><a class="btn btn-more" href="<?php echo esc_url( $carousel_item['pc-l-l'] ); ?>"><?php _e( 'More', TEXT_DOMAIN ) ?></a></div>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</section>

			<?php
		} );


		Block::make( 'Content Widget' )
			->add_fields( array(
				Field::make( 'text', 'cw-t', __( 'Title', TEXT_DOMAIN ) ),
				Field::make( 'rich_text', 'cw-c', __( 'Content', TEXT_DOMAIN ) )
					->set_rows(20),
			) )
			->set_icon( 'text' )
			->set_category( 'cb-blocks', 'Carbon Blocks' )
			->set_render_callback( function ( $block ) { ?>

			<section class="widget">
				<?php if ( ! empty($block['cw-t']) ) : ?>
					<div class="container">
						<h2 class="widget-title"><?php echo esc_html( $block['cw-t'] ); ?></h2>
					</div>
				<?php endif; ?>
				<?php echo $block['cw-c']; ?>
			</section>

			<?php
		} );


		Block::make( 'Grid Thumbnails' )
			->add_fields( array(
				Field::make( 'text', 'gt-t', __( 'Title', TEXT_DOMAIN ) ),
				Field::make( 'media_gallery', 'gt-l', __( 'Images', TEXT_DOMAIN ) ),
			) )
			->set_icon( 'images-alt2' )
			->set_category( 'cb-blocks', 'Carbon Blocks' )
			->set_render_callback( function ( $block ) { ?>

			<section class="widget">
				<div class="container">
					<h2 class="widget-title"><?php echo esc_html( $block['gt-t'] ); ?></h2>
					<div class="row">
						<?php foreach ( $block['gt-l'] as $thumb_id ) : ?>
							<?php $thumb_full_arr = wp_get_attachment_image_src( $thumb_id, 'full' ); ?>
							<figure class="box-item col-xl-3 col-lg-4 col-md-6 d-sm-flex">
								<a href="<?php echo esc_url( $thumb_full_arr[0] ); ?>" data-fancybox="thumbnails"><?php echo wp_get_attachment_image( $thumb_id, 'grid-thumb', false, array( 'class' => 'img-block' ) ); ?></a>
							</figure>
						<?php endforeach; ?>
					</div>
				</div>
			</section>

			<?php
		} );


		Block::make( 'Clients' )
			->add_fields( array(
				Field::make( 'text', 'cl-t', __( 'Title', TEXT_DOMAIN ) ),
				Field::make( 'image', 'cl-i', __( 'Background', TEXT_DOMAIN ) ),
				Field::make( 'complex', 'cl-l', __( 'List', TEXT_DOMAIN ) )
					->add_fields( array(
						Field::make( 'image', 'cl-l-i', __( 'Thumbnail', TEXT_DOMAIN ) ),
						Field::make( 'text', 'cl-l-t', __( 'Title', TEXT_DOMAIN ) ),
						Field::make( 'textarea', 'cl-l-c', __( 'Content', TEXT_DOMAIN ) )
							->set_rows(5),
					) )
					->set_layout( 'tabbed-horizontal' ),
			) )
			->set_icon( 'id' )
			->set_category( 'cb-blocks', 'Carbon Blocks' )
			->set_render_callback( function ( $block ) { ?>

			<section class="widget">
				<div class="container">
					<h2 class="widget-title"><?php echo esc_html( $block['cl-t'] ); ?></h2>
				</div>
				<?php $bg_full_arr = wp_get_attachment_image_src( $block['cl-i'], 'full' ); ?>
				<div class="clients" style="background-image:url(<?php echo esc_url( $bg_full_arr[0] ); ?>)">
					<div class="container">
						<div class="clients-list row">
							<?php foreach ( $block['cl-l'] as $client_item ) : ?>
								<div class="clients-list-item col-md-3">
									<figure class="clients-list-item-thumb"><?php echo wp_get_attachment_image( $client_item['cl-l-i'], 'client-thumb' ); ?></figure>
									<div class="clients-list-item-name"><?php echo esc_html( $client_item['cl-l-t'] ); ?></div>
									<div class="clients-list-item-info">
										<?php echo $client_item['cl-l-c']; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>

			<?php
		} );
	}

	/**
	 * Custom Login Brand
	 */
	public static function login_head() {
		?>
		
		<style>
			h1 a {
				width: 220px!important;
				height: 61px!important;
				background: url(<?php echo PLUGIN_URI; ?>/assets/admin/i/logo.svg) 50% 50% no-repeat !important;
				background-size: contain!important;
			}
		</style>

		<?php
	}

	/**
	 * Home slider shortcode
	 */
	public function home_slider_shortcode( $atts = false ) {
		extract( shortcode_atts( array(
		), $atts ) );

		ob_start();

		self::home_slider();

		return ob_get_clean();
	}

	/**
	 * Home slider static function
	 */
	public static function home_slider() {
		$slider_items = carbon_get_theme_option('home-slider');

		if ( ! empty($slider_items) ) :
			?>

			<div class="slider owl-carousel">
				<?php foreach ($slider_items as $slider_item) : ?>
					<?php
						$slider_item_image_src = wp_get_attachment_image_src( $slider_item['site-home-banner-thumb'], 'home-slider' );
					?>
					<div class="slider__item">
						<a href="<?php echo esc_url( $slider_item['site-home-banner-link'] ); ?>" style="background-image:url(<?php echo $slider_item_image_src[0]; ?>)">
						</a>
					</div>
				<?php endforeach; ?>
			</div>

			<?php

		endif;
	}

	/**
	 * Product slider shortcode
	 */
	public function product_slider_shortcode( $atts = false ) {
		$limit_init = 8;

		extract( shortcode_atts( array(
			'title' => __( 'Product slider', TEXT_DOMAIN ),
			'limit' => $limit_init,
		), $atts ) );

		$limit = intval( $limit ) ? intval( $limit ) : 8;


		$products_args = array(
			'post_type' => 'product',
			'posts_per_page' => $limit,
		);

		$products_query = new \WP_Query( $products_args );


		ob_start();

		if ( $products_query->have_posts() ) :
			?>

			<div class="none-m">
                <h4><?php echo esc_html( $title ); ?></h4>

                <div class="product-carousel owl-carousel">
					<?php

					while ( $products_query->have_posts() ) :
						$products_query->the_post();

						wc_get_template_part( 'content', 'product' );
					endwhile;

					?>
				</div>
			</div>

			<?php

		endif;

		wp_reset_postdata();

		return ob_get_clean();
	}
}
