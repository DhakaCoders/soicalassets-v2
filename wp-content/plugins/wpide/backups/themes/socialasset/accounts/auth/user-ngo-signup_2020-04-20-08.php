<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "76c595500ff78af9f16cf4dc19fc455e789234ddeb"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/accounts/auth/user-ngo-signup.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/accounts/auth/user-ngo-signup_2020-04-20-08.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
add_action('wp_enqueue_scripts', 'user_signup_action_hooks');

function user_signup_action_hooks(){
		ajax_user_ngo_signup_init();
}

function ajax_user_ngo_signup_init(){
    wp_register_script('ajax-user-ngo-script', get_stylesheet_directory_uri(). '/assets/js/ajax-scripts.js', array('jquery') );
    wp_enqueue_script('ajax-user-ngo-script');

    wp_localize_script( 'ajax-user-ngo-script', 'ajax_user_ngo_signup_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));
    // Enable the user with no privileges to run ajax_login() in AJAX
}
add_action('wp_ajax_nopriv_ngo_user_create_account', 'ngo_user_create_account');
	//add_action('wp_ajax_ngo_user_create_account', 'ngo_user_create_account');
function ngo_user_create_account(){
	$data = array();
	if (isset( $_POST["email"] ) && wp_verify_nonce($_POST['user_ngo_register_nonce'], 'user-ngo-register-nonce')) {
		$user_email   	= sanitize_email($_POST["email"]);
  		$usertype	    = sanitize_text_field($_POST["usertype"]);
  		
  		$agree	    = sanitize_text_field($_POST["agree"]);
  		$user_password	= esc_attr($_POST["user_password"]);
  		$conf_password	= esc_attr($_POST["confirm_password"]);
  		$success = true;
  		if($usertype == 'Ngo'){
  			$ngo_name = sanitize_text_field($_POST["ngo_name"]);
  			if(empty($ngo_name)) {
				//invalid email
				$data['ngo_name'] = 'NGO name is required.';
				$success = false;
			}elseif(!preg_match("/^[a-zA-Z0-9 .-]+$/", $ngo_name)) {
			    $data['ngo_name'] = 'Only latter, number, space, dot and dash are supported.';
			    $success = false;
			}
			$username = '';
			$userrole = 'ngo';
  		}elseif($usertype == 'Business'){
  			$your_name = sanitize_text_field($_POST["yourname"]);
  			if(empty($your_name)) {
				//invalid email
				$data['ngo_name'] = 'Business name is required.';
				$success = false;
			}elseif(!preg_match("/^[a-zA-Z0-9 .-]+$/", $your_name)) {
			    $data['ngo_name'] = 'Only latter, number, space, dot and dash are supported.';
			    $success = false;
			}
			$username = '';
			$userrole = 'business';
  		}else{
  			$your_name = sanitize_text_field($_POST["your_name"]);
  			if(empty($your_name)) {
				//invalid email
				$data['ur_name'] = 'Name is required.';
				$success = false;
			}elseif(!preg_match("/^[a-zA-Z .-]+$/", $your_name)) {
			    $data['ur_name'] = 'Only latter, space, dot and dash are supported.';
			    $success = false;
			}
			$userrole = 'subscriber';
  		}

  		if(!is_email($user_email)) {
			//invalid email
			$data['email'] = 'Invalid email address.';
			$success = false;
		}elseif(email_exists($user_email)) {
			//Email address already registered
			$data['email'] = 'Email already registered.';
			$success = false;
		}elseif(empty($user_email)) {
			//Email address already registered
			$data['email'] = 'Email is required.';
			$success = false;
		}

		if(empty($user_password)) {
			$data['pass'] = 'Password is required.';
			$success = false;
		}
		if(empty($conf_password)) {
			$data['con_password'] = 'Confirm password is required.';
			$success = false;
		}
		if(!empty($user_password) && !empty($conf_password) ) {
			if($user_password !== $conf_password){
				$data['match_pass'] = "Password do not match!";
				$success = false;
			}
			
		}
		if(isset($user_email) && !empty($user_email)){
			$exp = explode('@', $user_email);
			$user_login = $exp[0];
			if(empty($user_login)) {
				// Username already registered
				$data['username'] = 'Something went wrong. Please try again latter.';
				$success = false;
			}
		}
		if($success){
			$new_user_id = wp_insert_user(array(
				'user_login'		=> $user_login,
				'user_pass'	 		=> $user_password,
				'user_email'		=> $user_email,
				'first_name'		=> $your_name,
				'user_registered'	=> date('Y-m-d H:i:s'),
				'role'				=> $userrole
				)
			);
			if($new_user_id) {
				if(isset($user_email) && !empty($user_email)){
					update_user_meta ( $new_user_id, '_user_email', $user_email );
				}
				if(isset($ngo_name) && !empty($ngo_name)){
					update_user_meta ( $new_user_id, '_ngo_name', $ngo_name );
				}
				if(isset($usertype) && !empty($usertype)){
					update_user_meta ( $new_user_id, '_user_type', $usertype );
				}
				if(isset($agree) && !empty($agree)){
					update_user_meta( $new_user_id, '_user_agree', $agree );
				}
				if($usertype == 'Ngo'){
					add_user_meta( $new_user_id, '_show_my_profile', 'true', true );
					add_user_meta( $new_user_id, '_show_my_campaigns', 'true', true );
					add_user_meta( $new_user_id, '_show_create_campaign', 'true', true );
				}elseif($usertype == 'Business'){
					add_user_meta( $new_user_id, '_show_my_profile', 'true', true );
					add_user_meta( $new_user_id, '_show_my_campaigns', 'true', true );
				}else{
					add_user_meta( $new_user_id, '_show_my_profile', 'true', true );
					add_user_meta( $new_user_id, '_show_my_campaigns', 'true', true );
				}
				add_user_meta( $new_user_id, '_get_newsletters', '0', true );
				add_user_meta( $new_user_id, '_support_camp_ids', '', true );
				add_user_meta( $new_user_id, '_user_account_status', 'draft', true );
				if (! add_user_meta( $new_user_id, 'show_admin_bar_front', 'false', true )){ 
					update_user_meta ( $new_user_id, 'show_admin_bar_front', 'false' );
				}
				if( isset( $_POST['popupaction'] ) && !empty($_POST['popupaction']) && $_POST['popupaction'] == 'popupsignup' ){
				    $data['popup_success'] = 'You have successfully registerd';
				} else{
	                $data['signup_success'] = 'We have received your registration request. We review your request and contact with you within 72 hours.';
				}
				$data['user_status'] = 'success';
			}else{
				$data['user_status'] = 'error';
			}
		}else{
			$data['user_status'] = 'error';
		}
		echo json_encode($data);
		wp_die();
	}
}
