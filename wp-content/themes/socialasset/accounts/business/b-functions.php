<?php
add_action('init', 'business_profile_action_hook');

function business_profile_action_hook(){
	if(is_user_logged_in()){
		business_profile_update();
	}
	
}
function business_profile_update(){
	global $msg, $wpdb;;
	if (isset( $_POST["add_business_profile"] ) && wp_verify_nonce($_POST['add_business_profile_nonce'], 'add-business-profile-nonce')) {
		$user = wp_get_current_user();
		if (! add_user_meta( $user->ID, 'profile_content', $_POST['business_profile_content'], true )) 
		{ 
			update_user_meta( $user->ID, 'profile_content', $_POST['business_profile_content'] );
			$save = true;
		}
			/* User */
			if(isset( $_POST["first_name"] ) && !empty($_POST["first_name"])){
				$userdata = array(
		            'ID'        =>  $user->ID,
		            'first_name' => sanitize_text_field($_POST["first_name"])
		        );  
	    		wp_update_user($userdata);
	    		if( $userdata ){
	    			$save = true;
	    		}else{
	    			$save = false;
	    		}
			}

		if($save){
			$msg['success'] = 'Updated successfully.';
			stop_fom_resubmittion();
		}else{
			$msg['error'] = 'Could not update';
		}
		return $msg;
	}
	return false;
}
