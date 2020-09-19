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

		if(isset($_POST['postid']) && !empty($_POST['postid'])){
			$post_information = array(
				'ID' =>  $_POST['postid'],
				'post_author' => $user->ID,
			    'post_title' => wp_strip_all_tags( $_POST['first_name'] ),
			    'post_type' => 'business'
			);
			 
			$post_id = wp_update_post($post_information);
		}else{
			$post_information = array(
				'post_author' => $user->ID,
			    'post_title' => wp_strip_all_tags( $_POST['first_name'] ),
			    'post_type' => 'business',
			    'post_status' => 'publish'
			);
			 
			$post_id = wp_insert_post($post_information);
		}


		if($post_id){
			if (! add_post_meta( $post_id, 'bannerimage', $_POST['bannerimage'], true )) 
			{ 
				update_post_meta( $post_id, 'bannerimage', $_POST['bannerimage'] );
			}
			if (! add_post_meta( $post_id, 'profile_content', $_POST['business_profile_content'], true )) 
			{ 
				update_post_meta( $post_id, 'profile_content', $_POST['business_profile_content'] );
			}
			$msg['success'] = 'Updated successfully.';
			wp_redirect( home_url('myaccount/update-profile/'.$post_id) );
			exit();
		}else{
			$msg['error'] = 'Could not update';
		}
		return $msg;
	}
	return false;
}
