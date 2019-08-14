<?php get_header(); ?>

<?php if ( ! is_front_page() ) : ?>
	<div class="header-title-container" style="background-image:url(<?php echo esc_url( get_the_post_thumbnail_url( $post, 'full' ) ); ?>)">
		<div class="container">
			<h1 class="header-title"><?php the_title(); ?></h1>
		</div>
	</div>
<?php endif; ?>

<?php the_post(); the_content(); ?>

<?php get_footer(); ?>