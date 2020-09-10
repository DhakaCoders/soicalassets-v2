<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
add_action( 'init', 'shortcode_hook_action' );
function shortcode_hook_action() {
	add_shortcode('my_account', 'shortcode_user_myaccount');
}

function shortcode_user_myaccount(){
	global $get_userid;

	$user = wp_get_current_user();
	$get_userid = $user->ID;
	if ( in_array( 'ngo', (array) $user->roles ) && is_user_logged_in() ) { 
		include_once(ACCOUNT_DIR .'/ngo/ngo-myaccount.php');
	}elseif(in_array( 'subscriber', (array) $user->roles ) && is_user_logged_in()){
		include_once(ACCOUNT_DIR .'/user/user-myaccount.php');
	}elseif(in_array( 'business', (array) $user->roles ) && is_user_logged_in()){
		include_once(ACCOUNT_DIR .'/business/business-myaccount.php');
	}else{
		echo '<script>window.location.href="'.home_url('account').'"</script>';
		exit();
	}
	return false;	
}

function shortcode_user_myaccount2(){
	global $get_userid;

	$user = wp_get_current_user();
	$get_userid = $user->ID;
	if ( in_array( 'ngo', (array) $user->roles ) && is_user_logged_in() ) { 
		include_once(ACCOUNT_DIR .'/ngo/ngo-myaccount.php');
	}elseif(in_array( 'subscriber', (array) $user->roles ) && is_user_logged_in()){
		include_once(ACCOUNT_DIR .'/user/user-myaccount.php');
	}elseif(in_array( 'business', (array) $user->roles ) && is_user_logged_in()){
		include_once(ACCOUNT_DIR .'/business/business-myaccount.php');
	}else{
		echo '<script>window.location.href="'.home_url('account').'"</script>';
		exit();
	}
	return false;	
}


