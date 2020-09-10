<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "76c595500ff78af9f16cf4dc19fc455ed42ab0480b"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/sdk/fb-functions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/sdk/fb-functions_2020-07-30-12.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
session_start();
$wrong = false;

if( isset($_GET['fblogin']) && $_GET['fblogin'] == 'ngo' ) {
    $role = 'ngo';
} elseif( isset($_GET['fblogin']) && $_GET['fblogin'] == 'user' ) {
    $role = 'subscriber';
} else{
    $role = 'subscriber';
}

/*Step 1: Enter Credentials*/
$facebook  = new \Facebook\Facebook([
    'app_id' => '300545114633492',
    'app_secret' => '0ad3d95bced06503eb571cddff4e40f9',
    'default_graph_version' => 'v7.0',
    //'default_access_token' => '{access-token}', // optional
]);

$facebook_helper = $facebook->getRedirectLoginHelper();

function ngo_fbsocial_login(){
    global $facebook_helper;
    
    $facebook_permissions = ['email']; // Optional permissions
    $facebook_login_url = $facebook_helper->getLoginUrl('https://socialasset.gr/cms/account/?fblogin=ngo', $facebook_permissions);
    echo '<script>window.location.href="'.$facebook_login_url.'"</script>';
    exit();
}

function user_fbsocial_login(){
    global $facebook_helper;
    
    $facebook_permissions = ['email']; // Optional permissions
    $facebook_login_url = $facebook_helper->getLoginUrl('https://socialasset.gr/cms/account/?fblogin=user', $facebook_permissions);
    echo '<script>window.location.href="'.$facebook_login_url.'"</script>';
    exit();
}

if(isset($_GET['code'])) {
    if(isset($_SESSION['access_token']))
    {
    $access_token = $_SESSION['access_token'];
    }
    else
    {
    $access_token = $facebook_helper->getAccessToken();
    
    $_SESSION['access_token'] = $access_token;
    
    $facebook->setDefaultAccessToken($_SESSION['access_token']);
    }
    
    $graph_response = $facebook->get("/me?fields=name,email", $access_token);
    
    $facebook_user_info = $graph_response->getGraphUser();
    
    
    if(!empty($facebook_user_info['name']))
    {
        $your_name = $facebook_user_info['name'];
    }
    
    
    if(isset($facebook_user_info['email']) && !empty($facebook_user_info['email']) && filter_var($facebook_user_info['email'], FILTER_VALIDATE_EMAIL)){
        $user_email = $facebook_user_info['email'];
        $user = get_user_by( 'email', sanitize_email($user_email) );
        if ($user) {
            wp_clear_auth_cookie();
            wp_set_current_user( $user->ID, $user->user_login );
            wp_set_auth_cookie( $user->ID, true );
            do_action( 'wp_login', $user->user_login );
            if ( is_user_logged_in() ){
                $redirect_to = home_url() . '/myaccount';
                echo '<script>window.location.href="http://socialasset.gr/cms/myaccount/"</script>';
                exit();
            }
        } else{
            $exp = explode('@', $user_email);
    		$user_login = $exp[0];
    		$new_user_id = wp_insert_user(array(
    			'user_login'		=> $user_login,
    			'user_pass'	 		=> '',
    			'user_email'		=> $user_email,
    			'first_name'		=> $your_name,
    			'user_registered'	=> date('Y-m-d H:i:s'),
    			'role'				=> $role
    			)
    		);
    		if($new_user_id){
			    if(isset($user_email) && !empty($user_email)){
					update_user_meta ( $new_user_id, '_user_email', $user_email );
				}
				if($role == 'ngo'){
				    add_user_meta ( $new_user_id, '_user_type', 'Ngo', true );
					add_user_meta( $new_user_id, '_show_my_profile', 'true', true );
					add_user_meta( $new_user_id, '_show_my_campaigns', 'true', true );
					add_user_meta( $new_user_id, '_show_create_campaign', 'true', true );
					
					
				}else{
				    add_user_meta ( $new_user_id, '_user_type', 'User', true );
					add_user_meta( $new_user_id, '_show_my_profile', 'true', true );
					add_user_meta( $new_user_id, '_show_my_campaigns', 'true', true );
					
				}
				add_user_meta( $new_user_id, '_get_newsletters', '0', true );
				add_user_meta( $new_user_id, '_support_camp_ids', '', true );
				add_user_meta( $new_user_id, '_user_account_status', 'draft', true );
				if (! add_user_meta( $new_user_id, 'show_admin_bar_front', 'false', true )){ 
					update_user_meta ( $new_user_id, 'show_admin_bar_front', 'false' );
				}
    		    $user = get_user_by( 'email', sanitize_email($user_email) );
    		    if($user){
    	            wp_clear_auth_cookie();
                    wp_set_current_user( $user->ID, $user->user_login );
                    wp_set_auth_cookie( $user->ID, true );
                    do_action( 'wp_login', $user->user_login );
                    if ( is_user_logged_in() ){
                        $redirect_to = home_url() . '/myaccount';
                        //wp_redirect($redirect_to);
                        echo '<script>window.location.href = "'.$redirect_to.'";</script>';
                        exit();
                    }
    		    }
    	        
            } 
        }
    } else{
    $wrong = true;
    }
 
}

if($wrong){
    echo '<script>alert("Something was wrong! Please try again.");</script>';
}