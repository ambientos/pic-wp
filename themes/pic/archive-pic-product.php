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
								<ul class="product-list-item-chars list-unstyled">
									<li>Масса: 2,8 кг</li>
									<li>Марка сплава: Ак7ч</li>
								</ul>
								<div class="product-list-item-more"><a class="btn btn-primary btn-more" href="/"><?php _e( 'Get Order', 'pic' ); ?></a></div>
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