<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2cf10c7f2b3d"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/accounts/admin/admin-scripts.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/accounts/admin/admin-scripts_2020-04-17-11.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
add_action('admin_footer', 'custom_js_css_input_admin_footer');
function custom_js_css_input_admin_footer(){
?>
<script>
(function($) {
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.videourl-inner'); //Input field wrapper
    var fieldHTML = '<div class="videourl-row"><input type="text" name="video_url[]" value=""/><a href="javascript:void(0);" class="remove_button"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    
    $('#supporter').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
        ],
        //"bPaginate": false,
        "bFilter": false,
        "bInfo": false
    } );
    $('#business').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
        ],
        //"bPaginate": false,
        "bFilter": false,
        "bInfo": false
    } );
})(jQuery);
</script>
<?php
}
add_action( 'admin_enqueue_scripts', 'camp_admin_scripts');
function camp_admin_scripts(){
    wp_enqueue_style('cbv-devices-style', get_template_directory_uri() . '/camp-style.css', array(), array(0, 99));
}