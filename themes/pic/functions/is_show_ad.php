<?php

/**
 * Check for show advertisement
 */

function is_show_ad(){
	$is_show_ad = get_option( 'pic_ad_show', false );

	return $is_show_ad;
}