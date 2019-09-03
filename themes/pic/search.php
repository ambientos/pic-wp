<?php get_header(); ?>

<?php pic_title_header( __( 'Search', 'pic' ) ); ?>

<section class="widget container">
	<h2 class="widget-title"><?php printf( __( 'Search Results by &laquo;%s&raquo;', 'pic' ), get_search_query() ); ?></h2>

	<?php get_search_form(); ?>

	<?php if ( have_posts() ) : ?>
		<div class="list-featured-container">
			<ul class="list-featured list-unstyled">
				<?php while ( have_posts() ) : the_post(); ?>
					<li>
						<b><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></b>
						<p><?php echo wp_trim_words( get_the_content(), 55, '&hellip;' ); ?></p>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>

		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p><?php _e( 'Sorry, but nothing found. Try another search.', 'pic' ); ?></p>
	<?php endif; ?>
</section>

<?php get_footer(); ?>