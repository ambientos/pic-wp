<?php

/**
 * Show title header
 */

function title_header( $title = 'Title', $attachment_id = false ){
	global $post;

	$background_url = '';

	if ( $attachment_id ) {
		$background_url = wp_get_attachment_url( $attachment_id );
	}

	else if ( isset( $post ) ) {
		$background_url = get_the_post_thumbnail_url( $post, 'full' );
	}

	?>

	<div class="header-title-container" style="background-image:url(<?php echo esc_url( $background_url ); ?>)">
		<div class="container">
			<h1 class="header-title"><?php echo esc_html( $title ); ?></h1>
		</div>
	</div>

	<?php
}