<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "76c595500ff78af9f16cf4dc19fc455ed42ab0480b"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/sdk/google-functions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/sdk/google-functions_2020-07-30-12.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
$wrong = false;
if( isset($_GET['glogin']) && $_GET['glogin'] == 'ngo' ) {
    $role = 'ngo';
} elseif( isset($_GET['glogin']) && $_GET['glogin'] == 'user' ) {
    $role = 'subscriber';
} elseif( isset($_GET['glogin']) && $_GET['glogin'] == 'business' ) {
    $role = 'business';
}else{
    $role = 'subscriber';
}

 // init configuration
$clientID = '639085298364-bclg86lamussrl9oajin6uks321he2pi.apps.googleusercontent.com';
$clientSecret = 'Sdl8hfmTOEUCsx8Qngucf_PP';
$redirectUri = 'http://socialasset.gr/cms/account/?glogin=ngo';

  
// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

$social_ngo_login_url = $client->createAuthUrl();



$redirectUri_2 = 'http://socialasset.gr/cms/account/?glogin=user';

  
// create Client Request to access Google API
$client_2 = new Google_Client();
$client_2->setClientId($clientID);
$client_2->setClientSecret($clientSecret);
$client_2->setRedirectUri($redirectUri_2);
$client_2->addScope("email");
$client_2->addScope("profile");

$social_user_login_url = $client_2->createAuthUrl();


$redirectUri_3 = 'http://socialasset.gr/cms/business-login/?glogin=business';

  
// create Client Request to access Google API
$client_3 = new Google_Client();
$client_3->setClientId($clientID);
$client_3->setClientSecret($clientSecret);
$client_3->setRedirectUri($redirectUri_3);
$client_3->addScope("email");
$client_3->addScope("profile");

$social_business_login_url = $client_3->createAuthUrl();



function ngo_social_login(){
    global $social_ngo_login_url;
    echo '<script>window.location.href="'.$social_ngo_login_url.'"</script>';
    exit();
}
function user_social_login(){
    global $social_user_login_url;
    echo '<script>window.location.href="'.$social_user_login_url.'"</script>';
    exit();
}

function business_social_login(){
    global $social_business_login_url;
    echo '<script>window.location.href="'.$social_business_login_url.'"</script>';
    exit();
}
// authenticate code from Google OAuth Flow
if ( isset($_GET['code']) && isset($_GET['glogin']) ) {
    if( isset($_GET['glogin']) && $_GET['glogin'] == 'user' ) {
       $token = $client_2->fetchAccessTokenWithAuthCode($_GET['code']);
    } elseif( isset($_GET['glogin']) && $_GET['glogin'] == 'business' ) {
       $token = $client_3->fetchAccessTokenWithAuthCode($_GET['code']);
    }else {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    }
  
  $client->setAccessToken($token['access_token']);
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  
  $google_account_info = $google_oauth->userinfo->get();
  $your_name = $google_account_info->name;
  $user_email = $google_account_info->email;
  if(isset($user_email) && !empty($user_email) && filter_var($user_email, FILTER_VALIDATE_EMAIL)){
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
					add_user_meta( $new_user_id, '_support_camp_ids', '', true );
					
				}elseif($role == 'business'){
					add_user_meta ( $new_user_id, '_user_type', 'Business', true );
    				add_user_meta ( $new_user_id, '_show_my_profile', 'true', true );
    				add_user_meta ( $new_user_id, '_show_my_campaigns', 'true', true );
    				add_user_meta( $new_user_id, '_support_camp_ids', '', true );
    				
				}else{
				    add_user_meta ( $new_user_id, '_user_type', 'User', true );
					add_user_meta( $new_user_id, '_show_my_profile', 'true', true );
					add_user_meta( $new_user_id, '_show_my_campaigns', 'true', true );
					add_user_meta( $new_user_id, '_support_camp_ids', '', true );
					
				}
				add_user_meta( $new_user_id, '_get_newsletters', '0', true );
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