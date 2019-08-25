<?php get_header(); ?>

<?php title_header( __( 'Services', 'pics' ), carbon_get_theme_option( 'services-h-i' ) ); ?>

<div class="container">
	<?php wp_nav_menu( array(
		'theme_location' => 'services_menu',
		'item_spacing'   => 'discard',
		'menu_class'     => 'nav-sub d-md-flex align-items-md-center list-unstyled',
		'container'      => false,
	) ); ?>

	<div class="teaser">
		<div class="row">
			<figure class="teaser-thumb col-xl-5 col-lg-6"><?php the_post_thumbnail( 'service-thumb', array( 'class' => 'img-block' ) ); ?></figure>
			<div class="col-xl-7 col-lg-6">
				<div class="teaser-content">
					<div class="teaser-num"><?php printf( '%02d', $post->menu_order ); ?></div>
					<h3 class="teaser-title"><?php the_title(); ?></h3>
					<?php echo wpautop( carbon_get_the_post_meta( 's-c' ) ); ?>
					<p><span class="btn btn-primary btn-more" data-fancybox data-src="#order-service"><?php _e( 'Get Order', 'pic' ); ?></span></p>
				</div>
			</div>
		</div>
	</div>

	<?php the_post(); the_content(); ?>
</div>

<?php get_footer(); ?>