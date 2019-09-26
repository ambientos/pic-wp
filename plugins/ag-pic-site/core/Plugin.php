<?php

namespace AG_Pic_Site;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

class Plugin {
	/**
	 * Post Types
	 */
	const PRODUCT_POST_TYPE = 'pic-product';
	const SERVICE_POST_TYPE = 'pic-services';

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

		/**
		 * Register CPT and CT
		 */
		add_action( 'init', array( __CLASS__, 'register_cpt_ct' ) );

		/**
		 * Carbon Fields
		 */
		add_action( 'carbon_fields_register_fields', array( __CLASS__, 'carbon_fields_register_fields' ) );

		/**
		 * Login customize
		 */
		add_action('login_head', array( __CLASS__, 'login_head' ) );

		/**
		 * Redirect Product posts to their Archive page
		 */
		add_filter( 'pre_get_posts', array( __CLASS__, 'redirect_post_product_to_archive_page' ) );
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
		register_post_type( Plugin::SERVICE_POST_TYPE, array(
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
			'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes', ),
			'has_archive'         => false,
			'rewrite'             => array(
				'slug'            => 'service',
				'with_front'      => false,
				'feeds'           => false,
			),
		) );

		register_post_type( Plugin::PRODUCT_POST_TYPE, array(
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
			'public'              => false,
			'show_ui'             => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'show_in_nav_menus'   => true,
			'show_in_rest'        => false,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-cart',
			'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', ),
			'has_archive'         => 'products',
			'rewrite'             => array(
				'slug'            => 'services',
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

			// Services
			->add_tab( __( 'Services', TEXT_DOMAIN ), array(
				// Header background image
				Field::make( 'image', 'services-h-i', __( 'Header background image', TEXT_DOMAIN ) ),
			) )

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
			->where( 'post_type', '=', 'pic-product' )
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
		 * Service
		 */

		Container::make( 'post_meta', __( 'Services', TEXT_DOMAIN ) )
			->where( 'post_type', '=', 'pic-services' )
			->add_fields( array(
				// Thumbnail video
				Field::make( 'file', 's-i', __( 'Main Video', TEXT_DOMAIN ) ),

				// Custom title
				Field::make( 'text', 's-t', __( 'Title', TEXT_DOMAIN ) ),

				// Short Description
				Field::make( 'textarea', 's-d', __( 'Short Description', TEXT_DOMAIN ) ),

				// Full Description
				Field::make( 'textarea', 's-c', __( 'Full Description', TEXT_DOMAIN ) ),
			) );

		/**
		 * Promo Carousel Block
		 */

		Block::make( 'Promo Carousel' )
			->add_fields( array(
				Field::make( 'complex', 'pc-l', __( 'List', TEXT_DOMAIN ) )
					->add_fields( array(
						Field::make( 'image', 'pc-l-i', __( 'Thumbnail', TEXT_DOMAIN ) ),
						Field::make( 'association', 'pc-l-l', __( 'Service', TEXT_DOMAIN ) )
							->set_types( array(
								array(
									'type'      => 'post',
									'post_type' => 'pic-services',
								)
							) )
							->set_max( 1 ),
						Field::make( 'rich_text', 'pc-l-c', __( 'Description', TEXT_DOMAIN ) )
							->set_rows(20),
					) )
					->set_layout( 'tabbed-horizontal' ),
			) )
			->set_icon( 'list-view' )
			->set_category( 'cb-blocks', 'Carbon Blocks' )
			->set_render_callback( function ( $block ) { ?>

			<section class="promo-container carousel-container" data-loop="1" data-autoheight="1">
				<div class="promo-nav-container">
					<div class="container">
						<div class="promo-nav carousel-nav owl-nav"></div>
					</div>
				</div>
				<div class="carousel owl-carousel">
					<?php foreach ( $block['pc-l'] as $carousel_item ) : ?>
						<?php
							$thumb_full = wp_get_attachment_url( $carousel_item['pc-l-i'] );
							$service_post = get_post( $carousel_item['pc-l-l'][0]['id'] );
						?>
						<div class="promo-item" style="background-image:url(<?php echo esc_url( $thumb_full ); ?>)">
							<div class="container">
								<div class="promo-item-title"><?php echo esc_html( $service_post->post_title ); ?></div>
								<div class="promo-item-info">
									<?php echo $carousel_item['pc-l-c']; ?>
								</div>
								<div class="promo-item-more"><a class="btn btn-more" href="<?php the_permalink( $service_post ); ?>"><?php _e( 'More', TEXT_DOMAIN ) ?></a></div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</section>

			<?php
		} );


		/**
		 * Content Widget Block
		 */

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


		/**
		 * Grid Thumbnails with desctiption Block
		 */

		Block::make( 'Grid Thumbnails' )
			->add_fields( array(
				Field::make( 'text', 'gt-t', __( 'Title', TEXT_DOMAIN ) ),
				Field::make( 'complex', 'gt-l', __( 'List', TEXT_DOMAIN ) )
					->add_fields( array(
						Field::make( 'image', 'gt-l-i', __( 'Thumbnail', TEXT_DOMAIN ) ),
						Field::make( 'text', 'gt-l-l', __( 'Link', TEXT_DOMAIN ) ),
						Field::make( 'text', 'gt-l-d', __( 'Description', TEXT_DOMAIN ) ),
					) )
					->set_layout( 'tabbed-horizontal' ),
			) )
			->set_icon( 'images-alt2' )
			->set_category( 'cb-blocks', 'Carbon Blocks' )
			->set_render_callback( function ( $block ) { ?>

			<section class="widget">
				<div class="container">
					<h2 class="widget-title"><?php echo esc_html( $block['gt-t'] ); ?></h2>
					<div class="row">
						<?php foreach ( $block['gt-l'] as $thumb_item ) : ?>
							<?php

							$thumb_full = ! empty( $thumb_item['gt-l-l'] ) ? esc_attr( $thumb_item['gt-l-l'] ) : wp_get_attachment_url( $thumb_item['gt-l-i'] );

							?>
							<a href="<?php echo esc_url( $thumb_full ); ?>" data-fancybox="thumbnails" class="box-item col-xl-3 col-lg-4 col-md-6 d-sm-flex">
								<figure>
									<?php echo wp_get_attachment_image( $thumb_item['gt-l-i'], 'grid-thumb', false, array( 'class' => 'img-block' ) ); ?>
									<?php if ( ! empty( $thumb_item['gt-l-d'] ) ) : ?>
										<figcaption><?php echo esc_html( $thumb_item['gt-l-d'] ); ?></figcaption>
									<?php endif; ?>
								</figure>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			</section>

			<?php
		} );


		/**
		 * Clients Block
		 */

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
				<?php $bg_full = wp_get_attachment_url( $block['cl-i'] ); ?>
				<div class="clients" style="background-image:url(<?php echo esc_url( $bg_full ); ?>)">
					<div class="container">
						<div class="clients-list carousel-container" data-autowidth="1" data-nav="1" data-dots-hide="1">
							<div class="carousel owl-carousel">
								<?php foreach ( $block['cl-l'] as $client_item ) : ?>
									<div class="clients-list-item">
										<figure class="clients-list-item-thumb d-flex justify-content-center align-items-center"><?php echo wp_get_attachment_image( $client_item['cl-l-i'], 'client-thumb' ); ?></figure>
										<div class="clients-list-item-name"><?php echo esc_html( $client_item['cl-l-t'] ); ?></div>
										<div class="clients-list-item-info">
											<?php echo $client_item['cl-l-c']; ?>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</section>

			<?php
		} );


		/**
		 * Services Block
		 */

		Block::make( 'Services' )
			->add_fields( array(
				Field::make( 'association', 'sv-l', __( 'Services', TEXT_DOMAIN ) )
					->set_types( array(
						array(
							'type'      => 'post',
							'post_type' => 'pic-services',
						)
					) ),
			) )
			->set_icon( 'portfolio' )
			->set_category( 'cb-blocks', 'Carbon Blocks' )
			->set_render_callback( function ( $block ) { ?>

			<section class="widget">
				<div class="container">
					<h2 class="widget-title"><?php _e( 'Services', TEXT_DOMAIN ); ?></h2>
					<div class="service-list row">
						<?php foreach ( $block['sv-l'] as $service_assoc ) : ?>
							<?php
								$service_post = get_post( $service_assoc['id'] );
								$thumb_full = get_the_post_thumbnail_url( $service_post, 'full' );;
							?>
							<div class="col-xl-3 col-lg-4 col-md-6 d-sm-flex">
								<a class="service-list-item box-item" href="<?php the_permalink( $service_post ); ?>">
									<div class="service-list-item-thumb" style="background-image:url(<?php echo esc_url( $thumb_full ); ?>)"></div>
									<h3 class="service-list-item-title"><?php echo esc_html( $service_post->post_title ); ?></h3>
									<div class="service-list-item-text"><?php echo wpautop( carbon_get_post_meta( $service_assoc['id'], 's-d' ) ); ?></div>
								</a>
							</div>
						<?php endforeach; ?>
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
	 * Redirect Product post to their Archive page
	 */

	public static function redirect_post_product_to_archive_page( $query ) {
		if (
			! is_admin() &&
			$query->is_main_query() &&
			isset( $query->query_vars[ Plugin::PRODUCT_POST_TYPE ] )
		) {
			wp_redirect( site_url( '/products/' ), 301 );

			exit;
		}

		return $query;
	}
}
