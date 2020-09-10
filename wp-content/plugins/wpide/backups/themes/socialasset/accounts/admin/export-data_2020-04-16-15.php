<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2c179aeaff32"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/accounts/admin/export-data.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/accounts/admin/export-data_2020-04-16-15.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
//making the meta box (Note: meta box != custom meta field)
function wpse_add_custom_meta_box_exportdata() {
   add_meta_box(
       'custom_meta_exportdata',       // $id
       'Export Table',                  // $title
       'show_custom_meta_box_exportdata',  // $callback
       'campaigns',                 // $page
       'normal',                  // $context
       'low'                     // $priority
   );
}
add_action('add_meta_boxes', 'wpse_add_custom_meta_box_exportdata');

//showing custom form fields
function show_custom_meta_box_exportdata() {
    global $post;
    $video_urls = get_post_meta( $post->ID, 'video_urls', true );
    
    // Use nonce for verification to secure data sending
    wp_nonce_field( basename( __FILE__ ), 'wpse_our_nonce' );

    ?>


    <?php
}
