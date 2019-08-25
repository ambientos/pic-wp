<?php get_header(); ?>

<?php if ( ! is_front_page() ) : ?>
	<?php title_header( get_the_title() ); ?>
<?php endif; ?>

<?php the_post(); the_content(); ?>

<?php get_footer(); ?>