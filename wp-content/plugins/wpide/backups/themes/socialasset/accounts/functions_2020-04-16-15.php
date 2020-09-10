<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2c179aeaff32"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/accounts/functions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/accounts/functions_2020-04-16-15.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
include_once(ACCOUNT_DIR .'/core/core-functions.php');
include_once(ACCOUNT_DIR .'/admin/admin-scripts.php');
include_once(ACCOUNT_DIR .'/admin/export-data.php');
include_once(ACCOUNT_DIR .'/admin/user-meta-functions.php');
include_once(ACCOUNT_DIR .'/shortcodes/shortcode-functions.php');
include_once(ACCOUNT_DIR .'/auth/global-functions.php');
include_once(ACCOUNT_DIR .'/ngo/ngo-functions.php');
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




