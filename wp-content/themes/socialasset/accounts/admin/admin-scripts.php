<?php 
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
        {
            extend: 'excelHtml5',
            text: 'Export Supporters',
            filename: 'Supporters',
            title: 'Supporters' 
        }
        ],
        //"bPaginate": false,
        "bFilter": false,
        "bInfo": false
    } );
    $('#business').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        {
            extend: 'excelHtml5',
            text: 'Export Businesses',
            filename: 'Businesses',
            title: 'Businesses' 
        }
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
    wp_enqueue_style('cbv-devices-style', get_template_directory_uri() . '/accounts/admin/camp-style.css', array(), array(0, 99));
}