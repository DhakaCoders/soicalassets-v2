<?php
include_once(ACCOUNT_DIR .'/core/core-functions.php');
include_once(ACCOUNT_DIR .'/admin/admin-scripts.php');
include_once(ACCOUNT_DIR .'/admin/export-data.php');
include_once(ACCOUNT_DIR .'/admin/user-meta-functions.php');
include_once(ACCOUNT_DIR .'/shortcodes/shortcode-functions.php');
include_once(ACCOUNT_DIR .'/auth/global-functions.php');
include_once(ACCOUNT_DIR .'/ngo/ngo-functions.php');
include_once(ACCOUNT_DIR .'/business/b-functions.php');
include_once(ACCOUNT_DIR .'/auth/user-ngo-signup.php');
include_once(ACCOUNT_DIR .'/auth/business-signup.php');
include_once(ACCOUNT_DIR .'/auth/login.php');

add_action( 'wp_enqueue_scripts', 'get_enqueue_media' );
function get_enqueue_media() {
	if(is_user_logged_in() && is_page('myaccount')){
		wp_enqueue_media();
    	wp_enqueue_script('wpmedia-js',  THEME_URI.'/assets/js/wpmedia.js', array('jquery'), '1.0.0', true);
	}
}
add_filter( 'ajax_query_attachments_args', 'filter_media' );

function filter_media( $query ) {
	// admins get to see everything
	if ( ! current_user_can( 'manage_options' ) )
		$query['author'] = get_current_user_id();

	return $query;
}




