<?php /* Template Name: Default Page */ ?>

<?php get_header(); ?>

<?php title_header( get_the_title() ); ?>

<section class="widget container">
	<?php the_post(); the_content(); ?>
</section>

<?php get_footer(); ?>