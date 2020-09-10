<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2c6f0c8c7bfc"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/accounts/ngo/ngo-functions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/accounts/ngo/ngo-functions_2020-04-15-17.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
add_action('init', 'ngo_campaign_action_hook');

function ngo_campaign_action_hook(){
	if(is_user_logged_in()){
		ngo_campaign_create();
		ngo_campaign_update();
		ajax_my_delete_capm_init();
		ajax_my_draft_capm_init();
	}
	
}
function ngo_campaign_create(){
	global $msg, $wpdb;;
	if (isset( $_POST["add_campaign"] ) && wp_verify_nonce($_POST['ngo_add_campaign_nonce'], 'ngo-add-campaign-nonce')) {
		$user = wp_get_current_user();
		if(isset($_POST['campaign']) && $_POST['campaign'] == '-1'){
			$campaigncat = '';
		}else{
			$campaigncat = $_POST['campaign'];
		}

		if(empty($msg)){
			$post_information = array(
				'post_author' => $user->ID,
			    'post_title' => wp_strip_all_tags( $_POST['post_title'] ),
			    'post_content' => $_POST['capmaign_content'],
			    'post_type' => 'campaigns',
			    'post_status' => 'publish'
			);
			 
			$pid = wp_insert_post($post_information);
			$object_id = (int) $pid;
			if(!empty($campaigncat)){
				$cat_id = (int) $campaigncat;
				$wpdb->insert(
		            $wpdb->term_relationships,
		            array(
		                'object_id'        => $object_id,
		                'term_taxonomy_id' => $cat_id,
		            )
		        );
			}
			if(isset($_POST['campaign_tags']) && !empty($_POST['campaign_tags'])){
				$tag_exp = explode(',', $_POST['campaign_tags']);
				foreach ($tag_exp as $key => $tag_v) {
					$tag_name = ucwords(sanitize_text_field( $tag_v ));
					$tag = get_term_by('name', $tag_v, 'campaign_tag');

					if($tag && $tag->name == $tag_name){
						$camp_tag_id = (int) $tag->term_id;
						$wpdb->insert(
				            $wpdb->term_relationships,
				            array(
				                'object_id'        => $object_id,
				                'term_taxonomy_id' => $camp_tag_id,
				            )
				        );
					}else{
						$current_tag = wp_insert_term($tag_name, 'campaign_tag');
						//var_dump();
						if($current_tag && !isset($current_tag->errors['term_exists'])){
							$camp_tag_id = (int) $current_tag['term_id'];
							$wpdb->insert(
					            $wpdb->term_relationships,
					            array(
					                'object_id'        => $object_id,
					                'term_taxonomy_id' => $camp_tag_id,
					            )
					        );
						}
					}
				}
			}
			if(isset($_POST['attachment_id_array']) && !empty($_POST['attachment_id_array'])){
				$gallery_ids = array();
				foreach( $_POST['attachment_id_array'] as $attach_id ) {
					$gallery_ids[] = $attach_id;
								
				}
				//$gallary_serialized = serialize($gallery_ids);
				if ( ! add_post_meta( $pid, 'campaign_gallery', $gallery_ids, true ) ) { 
				   update_post_meta ( $pid, 'campaign_gallery', $gallery_ids );
				}
			}
			
			if(isset($_POST['_thumbnail_id'])){
				set_post_thumbnail( $pid, $_POST['_thumbnail_id'] );
			}
			if(!empty($_POST['fromt_date']) && !empty($_POST['to_date'])){
				add_post_meta( $pid, 'capmpaign_from_date', $_POST['fromt_date'], true );
				add_post_meta( $pid, 'capmpaign_to_date', $_POST['to_date'], true );
			}
			if(!empty($_POST['target_supporters']) && !empty($_POST['target_supporters'])){
				add_post_meta( $pid, 'target_supporters', $_POST['target_supporters'], true );
			}
			if(!empty($_POST['ngolocation']) && !empty($_POST['ngolocation'])){
				add_post_meta( $pid, 'ngolocation', $_POST['ngolocation'], true );
			}
			if(isset($_POST['businessids']) && !empty($_POST['businessids']) && $_POST['businessids'] !=0){
				$buss_imp = implode(',', $_POST['businessids']);
				add_post_meta( $pid, 'business_camp_attached', $buss_imp, true );
			}
			add_post_meta( $pid, '_capmpaign_status', 'draft', true );
			add_post_meta( $pid, '_supported_count', '0', true );
			add_post_meta( $pid, '_supporter_ids', '', true );
			wp_redirect( home_url('myaccount/edit-campaign/'.$pid) );
			exit();
		}else{
			$msg['error'] = 'Could not save';
		}
		return $msg;
	}
	return false;
}

function ngo_campaign_update(){
	global $msg, $wpdb;;
	if ( ( isset( $_POST["update_campaign"] ) || isset( $_POST["draft_campaign"] ) ) && wp_verify_nonce($_POST['ngo_update_campaign_nonce'], 'ngo-update-campaign-nonce')) {
		$user = wp_get_current_user();
		if(isset($_POST['campaign']) && $_POST['campaign'] == '-1'){
			$campaigncat = '';
		}else{
			$campaigncat = $_POST['campaign'];
		}
		
		$poststatus = (isset($_POST["draft_campaign"]))? 'draft':'publish';

		if(empty($msg)){
			$post_information = array(
				'ID' =>  $_POST['capm_id'],
				'post_author' => $user->ID,
			    'post_title' => wp_strip_all_tags( $_POST['post_title'] ),
			    'post_content' => $_POST['capmaign_content'],
			    'post_type' => 'campaigns',
			    'post_status' => $poststatus
			);
			 
			$pid = wp_update_post($post_information);
			$object_id = (int) $pid;
			if(!empty($campaigncat)){
				$cat_id = (int) $campaigncat;
		        wp_set_object_terms( $object_id, $cat_id, 'campaign' );

			}

					

			if(isset($_POST['campaign_tags']) && !empty($_POST['campaign_tags'])){
				$tag_exp = explode(',', $_POST['campaign_tags']);

				$post_tags = wp_get_post_terms( $object_id, 'campaign_tag', array( 'fields' => 'names' ) );
					if(isset($post_tags) && !empty($post_tags) && $post_tags){
						foreach ($post_tags as $p_tag) {
							if( !in_array($p_tag, $tag_exp) ){
								$d_tag = get_term_by('name', $p_tag, 'campaign_tag');
								$dter_id = (int) $d_tag->term_id; 
								$wpdb->delete(
						        $wpdb->term_relationships,
						            array(
								        'object_id'        => $object_id,
								        'term_taxonomy_id' => $dter_id
								    ) 
						        );
							}
						}
					}

				foreach ($tag_exp as $key => $tag_v) {
					$tag_name = ucwords(sanitize_text_field($tag_v));
					if( in_array($tag_name, $post_tags) ){

					}else{

						$tag = get_term_by('name', $tag_v, 'campaign_tag');
						if($tag && $tag->name == $tag_name){
							$camp_tag_id = (int) $tag->term_id;
							$wpdb->insert(
					            $wpdb->term_relationships,
					            array(
					                'object_id'        => $object_id,
					                'term_taxonomy_id' => $camp_tag_id,
					            )
					        );
						}else{
							$current_tag = wp_insert_term($tag_name, 'campaign_tag');
							if($current_tag && !isset($current_tag->errors['term_exists'])){
								$camp_tag_id = (int) $current_tag['term_id'];
								$wpdb->insert(
						            $wpdb->term_relationships,
						            array(
						                'object_id'        => $object_id,
						                'term_taxonomy_id' => $camp_tag_id,
						            )
						        );
							}
						}
					}
				}
			}
			if(isset($_POST['attachment_id_array']) && !empty($_POST['attachment_id_array'])){
				$gallery_ids = array();
				foreach( $_POST['attachment_id_array'] as $attach_id ) {
					$gallery_ids[] = $attach_id;
								
				}
				//$gallary_serialized = serialize($gallery_ids);
				update_post_meta ( $pid, 'campaign_gallery', $gallery_ids );
			}
			
			if(isset($_POST['_thumbnail_id'])){
				set_post_thumbnail( $pid, $_POST['_thumbnail_id'] );
			}
			if(!empty($_POST['fromt_date']) && !empty($_POST['to_date'])){
				update_post_meta( $pid, 'capmpaign_from_date', $_POST['fromt_date']);
				update_post_meta( $pid, 'capmpaign_to_date', $_POST['to_date']);
			}
			if(!empty($_POST['target_supporters']) && !empty($_POST['target_supporters'])){
				update_post_meta( $pid, 'target_supporters', $_POST['target_supporters']);
			}
			if(!empty($_POST['ngolocation']) && !empty($_POST['ngolocation'])){
				update_post_meta( $pid, 'ngolocation', $_POST['ngolocation']);
			}
			if(isset($_POST['businessids']) && !empty($_POST['businessids']) && $_POST['businessids'] !=0){
				$buss_imp = implode(',', $_POST['businessids']);
				update_post_meta( $pid, 'business_camp_attached', $buss_imp );
			}
			$msg['success'] = 'Campaign updated successfully';
		}else{
			$msg['error'] = 'Could not update';
		}
		return $msg;
	}
	return false;
}

function get_edit_campaign_post_data( $id ){
	if( empty($id) ) return;

	$get_post = get_post((int)$id);
	if( $get_post ){
		return $get_post;
	}else{
		return false;
	}

}

function ajax_my_delete_capm_init(){
    wp_register_script('ajax-delete-camp-script', get_stylesheet_directory_uri(). '/assets/js/ajax-scripts.js', array('jquery') );
    wp_enqueue_script('ajax-delete-camp-script');

    wp_localize_script( 'ajax-delete-camp-script', 'ajax_delete_camp_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));
    // Enable the user with no privileges to run ajax_login() in AJAX
}
add_action('wp_ajax_my_delete_capm', 'my_delete_capm');

function my_delete_capm(){
    $permission = check_ajax_referer( 'my_delete_camp_nonce', 'nonce', false );
    if( $permission == false ) {
        echo 'error';
    }
    else {
        wp_delete_post( $_REQUEST['id'] );
        echo 'success';
    }
 
    die();
}
function ajax_my_draft_capm_init(){
    wp_register_script('ajax-draft-camp-script', get_stylesheet_directory_uri(). '/assets/js/ajax-scripts.js', array('jquery') );
    wp_enqueue_script('ajax-draft-camp-script');

    wp_localize_script( 'ajax-draft-camp-script', 'ajax_draft_camp_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));
    // Enable the user with no privileges to run ajax_login() in AJAX
}
add_action('wp_ajax_my_draft_capm', 'my_draft_capm');

function my_draft_capm(){
    $permission = check_ajax_referer( 'my_draft_camp_nonce', 'nonce', false );
    if( $_REQUEST['nonce'] == 'draft_nonce' ) {
        $post_update = array(
			'ID' => $_REQUEST['id'],
		    'post_type' => 'campaigns',
		    'post_status' => 'draft'
		);
			 
		$pid = wp_update_post($post_update);
		if( $pid )
            echo 'success';
        else
            echo 'error';
    }
 
    die();
}
