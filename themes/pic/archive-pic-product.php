<?php get_header(); ?>

<?php title_header( post_type_archive_title( '', false ), carbon_get_theme_option( 'products-h-i' ) ); ?>

<div class="container">
	<?php if ( have_posts() ) : ?>
		<div class="product-list">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="product-list-item box-item">
					<div class="row">
						<div class="col-md-6 d-flex justify-content-center align-self-center">
							<figure class="product-list-item-thumb">
								<?php the_post_thumbnail('medium'); ?>
							</figure>
						</div>
						<div class="col-md-6 d-flex flex-column align-self-center">
							<div class="product-list-item-content">
								<h3 class="product-list-item-title"><?php the_title(); ?></h3>
								<?php

								$attrs = carbon_get_the_post_meta( 'pa-l' );

								if ( ! empty( $attrs ) ) : ?>
									<ul class="product-list-item-chars list-unstyled">
										<?php foreach ($attrs as $attr) : ?>
											<li><?php echo esc_html( $attr['pa-l-i'] ); ?></li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
								<div class="product-list-item-more"><span class="btn btn-primary btn-more" data-fancybox data-src="#order-product" data-title="<?php echo esc_attr( get_the_title() ); ?>"><?php _e( 'Get Order', 'pic' ); ?></span></div>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>

		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<?php get_template_part( 'parts/content', 'not-found' ); ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>