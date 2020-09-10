<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2c74d772e907"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/accounts/admin/user-meta-functions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/accounts/admin/user-meta-functions_2020-03-29-17.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php

add_action( 'show_user_profile', 'my_custom_user_profile_field' );
add_action( 'edit_user_profile', 'my_custom_user_profile_field' );
function my_custom_user_profile_field( $user ) { 
	$status = get_the_author_meta( '_user_account_status', $user->ID );
	$myprofile = get_the_author_meta( '_show_my_profile', $user->ID );
    $mycamp = get_the_author_meta( '_show_my_campaigns', $user->ID );
	$createcamp = get_the_author_meta( '_show_create_campaign', $user->ID );
?>
    <h3>User Status: </h3>
    <table class="form-table">
        <tr>
            <th><label for="my-custom-user-profile-field">Account Status:</label></th>
            <td>
                <input type="checkbox" <?php echo (!empty($status) && $status == 'active')? 'checked': ''; ?> name="_user_account_status" id="_user_account_status" value="active"> Active
            </td>
        </tr>
        <tr>
            <th><label for="my-custom-user-profile-field">My Profile Tab:</label></th>
            <td>
                <input type="checkbox" <?php echo (!empty($myprofile) && $myprofile == 'true')? 'checked': ''; ?> name="_show_my_profile" id="_show_my_profile" value="true"> Yes
            </td>
        </tr>
        <tr>
            <th><label for="my-custom-user-profile-field">My Campaigns Tab:</label></th>
            <td>
                <input type="checkbox" <?php echo (!empty($mycamp) && $mycamp == 'true')? 'checked': ''; ?> name="_show_my_campaigns" id="_show_my_campaigns" value="true"> Yes
            </td>
        </tr>
        <?php if ( in_array( 'ngo', (array) $user->roles ) && is_user_logged_in() ): ?>
        <tr>
            <th><label for="my-custom-user-profile-field">Create Campaign Tab:</label></th>
            <td>
                <input type="checkbox" <?php echo ( isset($createcamp) && !empty($createcamp) && $createcamp == 'true')? 'checked': ''; ?> name="_show_create_campaign" id="_show_create_campaign" value="true"> Yes
            </td>
        </tr>
        <?php endif; ?>
    </table>
<?php }

add_action( 'personal_options_update', 'save_my_custom_user_profile_field' );
add_action( 'edit_user_profile_update', 'save_my_custom_user_profile_field' );
function save_my_custom_user_profile_field( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    if( isset($_POST['_user_account_status']) && !empty($_POST['_user_account_status']))
    	update_user_meta( absint( $user_id ), '_user_account_status', wp_kses_post( $_POST['_user_account_status'] ) );
	else
		update_user_meta( absint( $user_id ), '_user_account_status', wp_kses_post( 'draft' ) );

    if( isset($_POST['_show_my_profile']) && !empty($_POST['_show_my_profile']))
    	update_user_meta( absint( $user_id ), '_show_my_profile', wp_kses_post( $_POST['_show_my_profile'] ) );
	else
		update_user_meta( absint( $user_id ), '_show_my_profile', wp_kses_post( 'false' ) );
	
	if( isset($_POST['_show_my_campaigns']) && !empty($_POST['_show_my_campaigns']))
    	update_user_meta( absint( $user_id ), '_show_my_campaigns', wp_kses_post( $_POST['_show_my_campaigns'] ) );
	else
		update_user_meta( absint( $user_id ), '_show_my_campaigns', wp_kses_post( 'false' ) );

    if( isset($_POST['_show_create_campaign']) && !empty($_POST['_show_create_campaign']))
        update_user_meta( absint( $user_id ), '_show_create_campaign', wp_kses_post( $_POST['_show_create_campaign'] ) );
    else
        update_user_meta( absint( $user_id ), '_show_create_campaign', wp_kses_post( 'false' ) );
}


//add columns to User panel list page
function add_user_columns($column) {
    $column['_user_account_status'] = 'Account Status';
    return $column;
}
add_filter( 'manage_users_columns', 'add_user_columns' );

//add the data
function add_user_column_data( $val, $column_name, $user_id ) {
    $user = get_userdata($user_id);

    switch ($column_name) {
        case '_user_account_status' :
            return $user->_user_account_status;
            break;
        default:
    }
    return;
}
add_filter( 'manage_users_custom_column', 'add_user_column_data', 10, 3 );



// Add the custom columns to the book post type:
add_filter( 'manage_campaigns_posts_columns', 'set_custom_edit_book_columns' );
function set_custom_edit_book_columns($columns) {
    unset( $columns['date'] );
    $columns['_supported_count'] = __( 'Supporters', 'your_text_domain' );
    $columns['capmpaign_from_date'] = __( 'Start/End Date', 'your_text_domain' );
    $columns['post_status'] = __( 'Status', 'your_text_domain' );
    $columns['date'] = __( 'Date', 'your_text_domain' );
    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_campaigns_posts_custom_column' , 'custom_book_column', 10, 3 );
function custom_book_column( $column, $post_id ) {
    
    switch ( $column ) {
        
        case '_supported_count' :
            echo '<div>'.get_post_meta( $post_id , '_supported_count' , true ).'</div>'; 
        break;
        case 'capmpaign_from_date' :
            $startd = get_post_meta( $post_id , 'capmpaign_from_date' , true ); 
            $endd = get_post_meta( $post_id , 'capmpaign_to_date' , true );
            $format_startd = date('Y/m/d', strtotime($startd));
            $format_endtd = date('Y/m/d', strtotime($endd));
            echo '<div>Start: '.$format_startd.'</div>';
            echo '<div>End: '.$format_endtd.'</div>';
        break;
        case 'post_status' :
            if( camp_expire_date($post_id) ){
                      echo '<span class="status-btn status-btn-expired">EXPIRED</span>';
            } elseif ( get_post_status ( $post_id ) == 'draft' ) {
                echo '<span class="status-btn status-btn-draft">DRAFT</span>';
            } elseif ( get_post_status ( $post_id ) == 'pending' ) {
                echo '<span class="status-btn status-btn-pending">PENDING</span>';
            }else {
                echo '<span class="status-btn status-btn-active">ACTIVE</span>';
            }
        break;

    }
}