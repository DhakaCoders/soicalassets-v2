<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2c179aeaff32"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/accounts/admin/export-data.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/accounts/admin/export-data_2020-04-16-16.php") )  ) ){
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" >
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" >
    

    <div class="exporttable clearboth">
        <div class="exporttable-lft">
        <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
            </tr>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table>
        </div>
        <div class="exporttable-rgt"></div>
    </div>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <?php
}
