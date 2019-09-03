<div class="footer-search">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<span class="screen-reader-text"><?php _e( 'Search:', 'pic' ) ?></span>
		<input class="footer-search-control form-control-sm form-control" type="search" placeholder="Поиск по сайту" value="<?php echo get_search_query(); ?>" name="s">
	</form>
</div>