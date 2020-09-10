<?php
add_action('wp_enqueue_scripts', 'business_signup_action_hooks');

function business_signup_action_hooks(){
		ajax_business_signup_init();
}

function ajax_business_signup_init(){
    wp_register_script('ajax-business-script', get_stylesheet_directory_uri(). '/assets/js/ajax-scripts.js', array('jquery') );
    wp_enqueue_script('ajax-business-script');

    wp_localize_script( 'ajax-business-script', 'ajax_business_signup_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));
    // Enable the user with no privileges to run ajax_login() in AJAX
}
add_action('wp_ajax_nopriv_business_create_account', 'business_create_account');
	//add_action('wp_ajax_ngo_user_create_account', 'ngo_user_create_account');
function business_create_account(){
	$data = array();
	if (isset( $_POST["email"] ) && wp_verify_nonce($_POST['business_register_nonce'], 'business-register-nonce')) {
		$user_email   	= sanitize_email($_POST["email"]);
  		$user_password	= esc_attr($_POST["password"]);
  		$success = true;
  		$data['email'] = ' ';
  		if(!is_email($user_email)) {
			//invalid email
			$data['email'] = 'Invalid email';
			$success = false;
		}elseif(email_exists($user_email)) {
			//Email address already registered
			$data['email'] = 'Email already registered';
			$success = false;
		}elseif(empty($user_email)) {
			//Email address already registered
			$data['email'] = 'Email is required';
			$success = false;
		}
		$data['pass'] = ' ';
		if(empty($user_password)) {
			$data['pass'] = 'Password is required';
			$success = false;
		}
		if(isset($user_email) && !empty($user_email)){
			$exp = explode('@', $user_email);
			$user_login = $exp[0];
			if(empty($user_login)) {
				// Username already registered
				$data['username'] = 'Something was wrong please try again';
				$success = false;
			}
		}
		if($success){
			$new_user_id = wp_insert_user(array(
				'user_login'		=> $user_login,
				'user_pass'	 		=> $user_password,
				'user_email'		=> $user_email,
				'first_name'		=> '',
				'user_registered'	=> date('Y-m-d H:i:s'),
				'role'				=> 'business'
				)
			);
			if($new_user_id) {
				if(isset($user_email) && !empty($user_email)){
					update_user_meta ( $new_user_id, '_user_email', $user_email );
				}
				add_user_meta ( $new_user_id, '_user_type', 'Business', true );
				add_user_meta ( $new_user_id, '_show_my_profile', 'true', true );
				add_user_meta ( $new_user_id, '_show_my_campaigns', 'true', true );
				add_user_meta( $new_user_id, '_get_newsletters', '0', true );
				add_user_meta( $new_user_id, '_support_camp_ids', '', true );
				add_user_meta( $new_user_id, '_user_account_status', 'draft', true );
				if (! add_user_meta( $new_user_id, 'show_admin_bar_front', 'false', true )){ 
					update_user_meta ( $new_user_id, 'show_admin_bar_front', 'false' );
				}
	            $data['bsignup_success'] = 'We have received your registration request. We review your request and contact with you within 72 hours.';
            	$data['buser_status'] = 'success';
			}else{
				$data['buser_status'] = 'error';
			}
		}else{
			$data['buser_status'] = 'error';
		}
		echo json_encode($data);
		wp_die();
	}
}
