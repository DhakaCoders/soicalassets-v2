<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "76c595500ff78af9f16cf4dc19fc455e64adc83fa2"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/accounts/shortcodes/shortcode-functions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/accounts/shortcodes/shortcode-functions_2020-07-22-14.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
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


