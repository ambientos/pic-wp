<?php

/**
 * Show title header
 */

function pic_title_header( $title = 'Title', $attachment_id = false ){
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


/**
 * Return raw phone
 */

function pic_get_phone_raw( $phone = false ){
	if ( $phone )
		return str_replace('(', '', str_replace(')', '', str_replace('-', '', str_replace(' ', '', $phone) ) ) );
}


/**
 * Check for show advertisement
 */

function pic_is_show_ad(){
	$is_show_ad = get_option( 'pic_ad_show', false );

	return $is_show_ad;
}