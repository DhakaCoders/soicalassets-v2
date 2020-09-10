<?php
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
    $supportIDS = get_post_meta( $post->ID, '_supporter_ids', true );
    $exps = explode(',', $supportIDS);
    // Use nonce for verification to secure data sending
    wp_nonce_field( basename( __FILE__ ), 'wpse_our_nonce' );
    ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" >
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" >
    

    <div class="exporttable clearboth">
        <div class="exporttable-lft">
        <h2>Supporters</h2>
        <table id="supporter" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if( !empty($supportIDS && $exps) ): 
            foreach( $exps as $exp ):
                $user = $user = get_userdata( $exp );
                $user_roles = $user->roles;
                if ( in_array( 'subscriber', $user_roles, true ) ):
            ?>
            <tr>
                <td>
                <?php 
                    if( !empty($user->first_name) )
                        echo $user->first_name; 
                    else
                    echo ucfirst($user->display_name);
                ?>
                </td>
                <td><?php echo $user->user_email; ?></td>
            </tr>
            <?php endif; endforeach; endif; ?>
        </table>
        </div>
        <div class="exporttable-rgt">
        <h2>Businesses</h2>
        <table id="business" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
           <?php 
            if( !empty($supportIDS && $exps) ): 
            foreach( $exps as $exp ):
                $user = $user = get_userdata( $exp );
                $user_roles = $user->roles;
                if ( in_array( 'business', $user_roles, true ) ):
            ?>
            <tr>
                <td>
                <?php 
                    if( !empty($user->first_name) )
                        echo $user->first_name; 
                    else
                    echo ucfirst($user->display_name);
                ?>
                </td>
                <td><?php echo $user->user_email; ?></td>
            </tr>
            <?php endif; endforeach; endif; ?>
        </table>
        </div>
    </div>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <?php
}
