<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2c22c446ff3d"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/accounts/auth/global-functions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/accounts/auth/global-functions_2020-04-14-06.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
add_action('init', 'global_action_hook');

function global_action_hook(){
	if(is_user_logged_in()){
		user_profile_image_update();
		user_change_password_customly();
		user_notification_settings_update();
		ajax_my_support_capm_init();
	}
	forgot_password_init();
}


function user_profile_image_update(){
	global $msg;
	if (isset( $_POST["save_profile_logo"] ) && wp_verify_nonce($_POST['user_change_profile_image_nonce'], 'user-change-profile-image-nonce')) {
		$user = wp_get_current_user();
		if( $user ){
			if(isset( $_POST["_profile_logo_id"] ) && !empty($_POST["_profile_logo_id"])){
				if(! add_user_meta( $user->ID, '_profile_logo_id', $_POST['_profile_logo_id'], true )){ 
					update_user_meta( $user->ID, '_profile_logo_id', $_POST['_profile_logo_id'] );
				}
			}

			/* NGO */
			if(isset( $_POST["_ngo_name"] ) && !empty($_POST["_ngo_name"])){
				update_user_meta( $user->ID, '_ngo_name', sanitize_text_field($_POST["_ngo_name"]) );
			}
			
			if(isset( $_POST["_about_ngo"] ) && !empty($_POST["_about_ngo"])){
				update_user_meta( $user->ID, '_about_ngo', sanitize_text_field( $_POST['_about_ngo'] ) );

			}
			/* NGO */
			/* User */
			if(isset( $_POST["yourname"] ) && !empty($_POST["yourname"])){
				$userdata = array(
		            'ID'        =>  $user->ID,
		            'first_name' => sanitize_text_field($_POST["yourname"])
		        );  
	    		wp_update_user($userdata);
			}
			/* User */

			$msg['success'] = 'Updated successfully.';
			stop_fom_resubmittion();
		}else{
  			$msg['error'] = 'Something was wrong please try again.';
  		}
	}
}

function user_change_password_customly(){
	global $msg;
	if (isset( $_POST["change_pass"] ) && wp_verify_nonce($_POST['user_change_password_nonce'], 'user-change-password-nonce')) {
		$user = wp_get_current_user();
		$currnt_pass	= esc_attr($_POST["currnt_pass"]);
  		$new_pass	= esc_attr($_POST["new_pass"]);
  		if($user){
  			if( !wp_check_password($currnt_pass, $user->user_pass, $user->ID) ) {
				// if the user name doesn't exist
				$msg['error'] = 'Current password not matching';
			}else{
				$userdata = array(
		            'ID'        =>  $user->ID,
		            'user_pass' =>  $new_pass,
		        );  
	    		$user_id = wp_update_user($userdata);
	    		if($user_id){
	    			$msg['success'] = 'Password updated successfully.';
	    			stop_fom_resubmittion();
	    		}else{
	    			$msg['error'] = 'Could not update';
	    		}
			}
  		}else{
  			$msg['error'] = 'Something was wrong please try again.';
  		}
	}
	return false;
}

function user_notification_settings_update(){
	global $msg;
	if (isset( $_POST["notification_settings"] ) && wp_verify_nonce($_POST['user_notification_settings_nonce'], 'user-notification-settings-nonce')) {
		$user = wp_get_current_user();
		if( $user ){
			if(isset( $_POST["_get_newsletters"] ) && !empty($_POST["_get_newsletters"])){
				update_user_meta( $user->ID, '_get_newsletters', $_POST["_get_newsletters"]);
				$msg['success'] = 'Settings updated successfully.';
				stop_fom_resubmittion();
			}
			elseif(!isset( $_POST["_get_newsletters"] ) && empty($_POST["_get_newsletters"])){
				update_user_meta( $user->ID, '_get_newsletters', 0);
				$msg['success'] = 'Settings updated successfully.';
				stop_fom_resubmittion();
			}
			else{
				$msg['error'] = 'Settings could not update.';
			}

		}else{
  			$msg['error'] = 'Settings could not update.';
  		}
	}
}

function ajax_my_support_capm_init(){
    wp_register_script('ajax-support-camp-script', get_stylesheet_directory_uri(). '/assets/js/ajax-scripts.js', array('jquery') );
    wp_enqueue_script('ajax-support-camp-script');

    wp_localize_script( 'ajax-support-camp-script', 'ajax_support_camp_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));
    // Enable the user with no privileges to run ajax_login() in AJAX
}
add_action('wp_ajax_my_support_capm', 'my_support_capm');

function my_support_capm(){
    if( isset($_POST['nonce']) && $_POST['nonce'] == 'nonce' ) {

	$user = wp_get_current_user();
	$camp_ids = array();
	$suppport_ids = array();
	if($user){
		if(isset($_POST['id']) && !empty($_POST['id']) && !empty($user->ID)){
			$post_id = $_POST['id'];
			$userid = "$user->ID";
			$getPost_ids = get_user_meta( $user->ID, '_support_camp_ids', true );
			$getUser_ids = get_post_meta( $post_id, '_supporter_ids', true );
			$get_counts = get_post_meta( $post_id, '_supported_count', true );



			if(isset($getUser_ids) && !empty($getUser_ids) && isset($getPost_ids) && !empty($getPost_ids)){
				$expCamp_ids = explode(',', $getPost_ids);
				$expSup_ids = explode(',', $getUser_ids);
				$sup_ids = array();
				foreach ($expSup_ids as $key => $sid) {
					$sup_ids[] = $sid;
				}
			if(in_array( $user->ID, $sup_ids) && in_array( $post_id, $expCamp_ids)){
				$data['error'] = 'added';
			}else{
				$expCamp_ids[] = $post_id;
		    	$impCamp_ids = implode(',', $expCamp_ids);

			    $expSup_ids[] = $user->ID;
			    $impSup_ids = implode(',', $expSup_ids);
			    update_user_meta( $user->ID, '_support_camp_ids', $impCamp_ids );
				update_post_meta( $post_id, '_supporter_ids', $impSup_ids );
				if(in_array( 'subscriber', (array) $user->roles )){
					$total_count = $get_counts + 1;
					update_post_meta( $post_id, '_supported_count', $total_count );
				}
				$data['success'] = 'success';

			}
				
			}else{ 
				if($getPost_ids && !empty($getPost_ids)){
					$expCamp_ids = explode(',', $getPost_ids);
					$expCamp_ids[] = $post_id;
		    		$impCamp_ids = implode(',', $expCamp_ids);
					update_user_meta( $user->ID, '_support_camp_ids', $impCamp_ids );
				}else{
					update_user_meta( $user->ID, '_support_camp_ids', $post_id );
				}


				if($getUser_ids && !empty($getUser_ids)){
					$expUser_ids = explode(',', $getUser_ids);
					$expUser_ids[] = $user->ID;
		    		$impCamp_ids = implode(',', $expUser_ids);
					update_post_meta( $post_id, '_supporter_ids', $impCamp_ids );
					if(in_array( 'subscriber', (array) $user->roles )){
						$total_count = $get_counts + 1;
						update_post_meta( $post_id, '_supported_count', $total_count );
					}
				}else{
					update_post_meta( $post_id, '_supporter_ids', $user->ID );
					if(in_array( 'subscriber', (array) $user->roles )){
						update_post_meta( $post_id, '_supported_count', 1 );
					}
					
				}
				
				$data['success'] = 'success';
			}
		}else{
			$data['error'] = 'error';
		}
	}else{
		$data['error'] = 'error';
	} 
    }
 
    echo json_encode($data);
	die();
 
}

function forgot_password_init(){
    wp_register_script('ajax-forgotpass-script', get_stylesheet_directory_uri(). '/assets/js/ajax-scripts.js', array('jquery') );
    wp_enqueue_script('ajax-forgotpass-script');

    wp_localize_script( 'ajax-forgotpass-script', 'ajax_forgotpass_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));
    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_user_forgot_password', 'user_forgot_password');
	add_action('wp_ajax_user_forgot_password', 'user_forgot_password');
}

function user_forgot_password(){
	global $msg;
	if (isset( $_POST["action"] ) && wp_verify_nonce($_POST['user_forgot_pass_nonce'], 'user-forgot-pass-nonce')) {
		$user_email   	= sanitize_email($_POST["useremail"]);
		if(!is_email($user_email)) {
			//invalid email
			$msg['email'] = 'Invalid email address.';
			$success = false;
		}elseif(email_exists($user_email)) {
			$user = get_user_by( 'email', $user_email );
			$generatePass = cam_generate_password(8);
			$userdata = array(
	            'ID'        =>  $user->ID,
	            'user_pass' => esc_attr($generatePass)
	        );  
	    	$userid = wp_update_user($userdata);
	    	if($userid){
	    		if( !empty($user->first_name) )
					$name = $user->first_name;
				else
					$name = ucfirst($user->display_name);

				if ( in_array( 'ngo', (array) $user->roles ) || in_array( 'subscriber', (array) $user->roles ))
					$redirect_to = site_url() . '/account';
				elseif(in_array( 'business', (array) $user->roles ))
					$redirect_to = site_url() . '/business-login';
				else
					$redirect_to = site_url();
	    	$body  = '<p>Hi '.$name.'!</p>';
	    	$body  .= '<p>Your generated new password below.</p>';
	    	$body  .= '<p>New Password: '.$generatePass.'</p>';
		    $body .= '<p>Please <a href="'.$redirect_to.'">Click Here for Login</a></p>';
		    $send = wp_mail( $user_email, 'New Password', $body );
		    if($send){
				$msg['success'] = 'New password has been set and sent the password to your mail.';
			}else{
				$msg['error'] = 'Something went wrong! Please try again.';
			}
	    	}
		}else{
			$msg['email'] = 'Email address does not match';
		}
		echo json_encode($msg);
		wp_die();
	}
}

function camp_progress_bar($post_id){
	$limit = get_post_meta( $post_id , 'target_supporters', true );
	$vote_count = get_post_meta( $post_id , '_supported_count', true );
	if( 
		isset($limit) &&
		isset($vote_count) &&
		!empty($limit) && 
		!empty($vote_count)
	)
	{
		$divided = ($vote_count / $limit);
		$percentange = ($divided * 100);
		return round($percentange, 2);
	}
	else{
		return 0;
	}
}

function total_support_count($id){
    if( empty($id) ) return;
    $vote_count = get_post_meta( $id , '_supported_count', true );
    return " ($vote_count)";
}

if(!function_exists('get_user_profile_logo_tag')){
	function get_user_profile_logo_tag($media_id, $size = 'thumbnail', $title = false){

		if( isset( $media_id ) && !empty($media_id)){
			$output = '';
			$image_title = get_the_title($media_id);
			$image_alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true);
		    if( empty( $image_alt ) ){
		      $image_alt = $image_title;
		    }
			$image_src = wp_get_attachment_image_src( $media_id, $size, false );

			if( $title ){
				$output = '<img src="'.$image_src[0].'" alt="'.$image_alt.'" title="'.$image_title.'">';
			}else{
				$output = '<img src="'.$image_src[0].'" alt="'.$image_alt.'">';
			}

			return $output;
		}
		return false;
	}
}

function camp_user_role($role = ''){
	$user = wp_get_current_user();
	
	if($user && !empty($role) && $user->cap_key !=NULL ):
		if ( in_array( $role, (array) $user->roles ) && is_user_logged_in() )
			return true;
		elseif(in_array( $role, (array) $user->roles ) && is_user_logged_in())
		    return true;
		elseif(in_array( $role, (array) $user->roles ) && is_user_logged_in())
			return true;
		else
			return false;
	else:
		return false;
	endif;
}

function checked_loggedin(){
	$user = wp_get_current_user();
	
	if($user && $user->cap_key !=NULL ):
		if ( in_array( 'ngo', (array) $user->roles ) && is_user_logged_in() ){
			echo '<script>window.location.href="'.site_url().'/myaccount"</script>'; exit();
		}
		elseif(in_array( 'subscriber', (array) $user->roles ) && is_user_logged_in()){
		    echo '<script>window.location.href="'.site_url().'/myaccount"</script>'; exit();
		}
		elseif(in_array( 'business', (array) $user->roles ) && is_user_logged_in()){
			echo '<script>window.location.href="'.site_url().'/myaccount"</script>'; exit();
		}
		elseif(in_array( 'administrator', (array) $user->roles ) && is_user_logged_in()){
			echo '<script>window.location.href="'.site_url().'"</script>'; exit();
		}
		else{
			return false;
		}
	else:
		return false;
	endif;
}

function get_current_user_name(){
	$user = wp_get_current_user();
	//printr($user);
	if($user)
		if( !empty($user->first_name) )
			return $user->first_name;
		else
			return ucfirst($user->display_name);
	else
		return false;
}

function get_author_avatar(){
	$user = wp_get_current_user();
	if( $user ){
		$umetas = array_map( function( $a ){ return $a[0]; }, get_user_meta( $user->ID ) ); 
		if( isset($umetas['_profile_logo_id']) && !empty($umetas['_profile_logo_id']) ){
	      echo get_user_profile_logo_tag($umetas['_profile_logo_id']); 
	    }else{
	    	echo '<img src="'.THEME_URI.'/assets/images/user.png" alt="user avatar">';
	    }
	}else{
		echo '<img src="'.THEME_URI.'/assets/images/user.png" alt="user avatar">';
	}

}