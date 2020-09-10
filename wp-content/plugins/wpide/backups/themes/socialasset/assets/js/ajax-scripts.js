jQuery(document).ready(function($) {
    $(document).on( 'click', '.delete-capm', function() {
        var id = $(this).data('id');
        var nonce = $(this).data('nonce');
        var post = $(this).parents('#camppost_'+id);
        $.ajax({
            type: 'post',
            url: ajax_delete_camp_object.ajaxurl,
            data: {
                action: 'my_delete_capm',
                nonce: nonce,
                id: id
            },
            success: function( result ) {
                if( result == 'success' ) {
                    post.fadeOut( function(){
                        post.remove();
                    });
                }
            }
        })
        return false;
    });

});
function UserAddSupport(id){
    jQuery.ajax({
        type: 'post',
        dataType: 'JSON',
        url: ajax_support_camp_object.ajaxurl,
        data: {
            action: 'my_support_capm',
            nonce: 'nonce',
            id: id
        },
        success: function( result ) {
            console.log(result);
            if( typeof(result['success']) != "undefined" &&  result['success'].length != 0 && result['success'] == 'success' ) {
                jQuery(".btnVariations").html(' ');
                jQuery(".btnVariations").html('<a class="supportedbyUser support-btn support-capm" href="#" onclick="return false;"><i class="fas fa-heart"></i>SUPPORTED BY YOU</a>');
            }else if(typeof(result['error']) != "undefined" &&  result['error'].length != 0 && result['error'] == 'added'){
                jQuery("#supportUser").remove();
                jQuery("#supportStatus").html(
                    '<a class="supportedbyUser support-btn support-capm" href="#" onclick="return false;"><i class="fas fa-heart"></i>SUPPORTED BY YOU</a>'
                    );
            }else{
                jQuery("#campaing-progress-bar .mgsBar").html('Something went wrong please try again later.');
            }
        }
    })
    return false;
}

function UserAddSupportByHeart(id){
    jQuery.ajax({
        type: 'post',
        dataType: 'JSON',
        url: ajax_support_camp_object.ajaxurl,
        data: {
            action: 'my_support_capm',
            nonce: 'nonce',
            id: id
        },
        success: function( result ) {
            console.log(result);
            if( typeof(result['success']) != "undefined" &&  result['success'].length != 0 && result['success'] == 'success' ) {
                jQuery("#hearts"+id).html('<i class="far fa-check-circle"></i>');
                jQuery("#heartsup"+id).html('<i class="far fa-check-circle"></i>');
            }else if(typeof(result['error']) != "undefined" &&  result['error'].length != 0 && result['error'] == 'added'){
                jQuery("#hearts"+id).html('<i class="far fa-check-circle"></i>');
                jQuery("#heartsup"+id).html('<i class="far fa-check-circle"></i>');
            }else{
                jQuery("#hearts"+id).html('<i class="far fa-times-circle"></i>');
                jQuery("#heartsup"+id).html('<i class="far fa-times-circle"></i>');
            }
        }
    })
    return false;
}

function SubmitForgotPass(){
    var serialized = jQuery( '#forgotpass' ).serialize();
    jQuery.ajax({
        type: 'post',
        dataType: 'JSON',
        url: ajax_forgotpass_object.ajaxurl,
        data: serialized,
        beforeSend: function() {    
            jQuery('.useremail').show();
            jQuery('#generatedSuccess').show();
        },
        success: function( result ) {
            if( typeof(result['success']) != "undefined" &&  result['success'].length != 0) {
                jQuery('#useremail').val('');
                jQuery('.useremail').text('');
                jQuery('#generatedSuccess').text(result['success']);
            }if(typeof(result['email']) != "undefined" &&  result['email'].length != 0){
                jQuery('#generatedSuccess').text('');
                jQuery('.useremail').text(result['email']);
            }if(typeof(result['error']) != "undefined" &&  result['error'].length != 0){
                jQuery('#generatedSuccess').text('');
                jQuery('.useremail').text(result['error']);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status == 500) {
              console.log('Internal error: ' + jqXHR.responseText);
            } else {
              console.log('Unexpected error.');
            }
        }
    })
    return false;
}
function SubmitSignupFormData(){
    var error = false;
    var serialized = jQuery( '#user-signup' ).serialize();
    //console.log(serialized);
    jQuery.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: ajax_user_ngo_signup_object.ajaxurl,
        data: serialized,
        success: function(data){
            console.log(data);
            if(typeof(data['user_status']) != "undefined" &&  data['user_status'].length != 0 && data['user_status'] == 'success'){
                
                if(typeof(data['signup_success']) != "undefined" &&  data['signup_success'].length != 0){
                  jQuery("#after-signup-hide").remove();
                  jQuery('.success-signup').text(data['signup_success']);
                  /*function redirect_page(){
                    window.location.href = ajax_user_ngo_signup_object.redirecturl+data.user_name;
                  }
                  setTimeout(redirect_page,5000);*/
                }
                
            }else{
                if(typeof(data['email']) != "undefined" &&  data['email'].length != 0){
                    jQuery('.email_error').text(data['email']);
                    error = true;
                }
                if(typeof(data['ngo_name']) != "undefined" &&  data['ngo_name'].length != 0){
                    jQuery('.ngo_error').text(data['ngo_name']);
                    error = true;
                }
                if(typeof(data['ur_name']) != "undefined" &&  data['ur_name'].length != 0){
                    jQuery('.name_error').text(data['ur_name']);
                    error = true;
                }
                if(typeof(data['pass']) != "undefined" &&  data['pass'].length != 0){
                    jQuery('.pass_error').text(data['pass']);
                    error = true;
                }
                if(typeof(data['con_password']) != "undefined" &&  data['con_password'].length != 0){
                    jQuery('.conpass_error').text(data['con_password']);
                    error = true;
                }
                if(typeof(data['match_pass']) != "undefined" &&  data['match_pass'].length != 0){
                    jQuery('.pass_match_error').text(data['match_pass']);
                    jQuery('.pass_error').text('');
                    jQuery('.conpass_error').text('');
                    error = true;
                }
                if(error == true){
                    jQuery('#password').val('');
                    jQuery('#confirm_password').val('');
                }
            }
            // $('#login p.status').text(data.message);
            // if (data.loggedin == true){
            //     document.location.href = ajax_login_object.redirecturl;
            // }
        }
    });

    return false
}

function BusinessSubmitSignupFormData(){
    var error = false;
    var serialized = jQuery( '#business-signup' ).serialize();
    //console.log(serialized);
    jQuery.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: ajax_business_signup_object.ajaxurl,
        data: serialized,
        success: function(data){
            console.log(data);
            if(typeof(data['buser_status']) != "undefined" &&  data['buser_status'].length != 0 && data['buser_status'] == 'success'){
                
                if(typeof(data['bsignup_success']) != "undefined" &&  data['bsignup_success'].length != 0){
                  jQuery("#after-bsignup-hide").remove();
                  jQuery('#bsuccess_signup').text(data['bsignup_success']);
                }
                
            }else{
                if(typeof(data['email']) != "undefined" &&  data['email'].length != 0){
                    jQuery('.email_error').text(data['email']);
                    error = true;
                }
                if(typeof(data['pass']) != "undefined" &&  data['pass'].length != 0){
                    jQuery('.pass_error').text(data['pass']);
                    error = true;
                }
                if(error == true){
                    jQuery('#business_password').val('');
                }
            }
        }
    });

    return false
}

function BusinessSubmitLoginFormData(){
    var error = false;
    var serialized = jQuery( '#business-login' ).serialize();
    //console.log(serialized);
    jQuery.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: ajax_business_login_object.ajaxurl,
        data: serialized,
        success: function(data){
            console.log(data);
            if(typeof(data['login_status']) != "undefined" &&  data['login_status'].length != 0 && data['login_status'] == 'success'){
                
                if(typeof(data['login_success']) != "undefined" &&  data['login_success'].length != 0){
                  jQuery('#loginerror').text('');
                  jQuery('.loginpass_error').text(' ');
                  jQuery('#login_user').val('');
                  jQuery('#login-password').val('');
                  jQuery('#success-login').text(data['login_success']);
                  function redirect_page(){
                    window.location.href = ajax_business_login_object.redirecturl;
                  }
                  setTimeout(redirect_page,3000);
                }
                
            }else{
                if(typeof(data['email']) != "undefined" &&  data['email'].length != 0){
                    jQuery('.loginemail_error').text(data['email']);
                    error = true;
                }
                if(typeof(data['pass']) != "undefined" &&  data['pass'].length != 0){
                    jQuery('.loginpass_error').text(data['pass']);
                    error = true;
                }
                if(typeof(data['loging_error']) != "undefined" &&  data['loging_error'].length != 0){
                    jQuery('#loginerror').text(data['loging_error']);
                    error = true;
                }

                if(error == true){
                    jQuery('#login-password').val('');
                }
            }
        }
    });

    return false
}

function SubmitLoginFormData(){
    var error = false;
    var serialized = jQuery( '#user-login' ).serialize();
    //console.log(serialized);
    jQuery.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: ajax_user_ngo_login_object.ajaxurl,
        data: serialized,
        success: function(data){
            console.log(data);
            if(typeof(data['login_status']) != "undefined" &&  data['login_status'].length != 0 && data['login_status'] == 'success'){
                
                if(typeof(data['login_success']) != "undefined" &&  data['login_success'].length != 0){
                  jQuery('#loginerror').text('');
                  jQuery('#login_user').val('');
                  jQuery('#login-password').val('');
                  jQuery('#success-login').text(data['login_success']);
                  function redirect_page(){
                    window.location.href = ajax_user_ngo_login_object.redirecturl;
                  }
                  setTimeout(redirect_page,3000);
                }
                
            }else{
                if(typeof(data['email']) != "undefined" &&  data['email'].length != 0){
                    jQuery('.loginemail_error').text(data['email']);
                    error = true;
                }
                if(typeof(data['pass']) != "undefined" &&  data['pass'].length != 0){
                    jQuery('.loginpass_error').text(data['pass']);
                    error = true;
                }
                if(typeof(data['loging_error']) != "undefined" &&  data['loging_error'].length != 0){
                    jQuery('#loginerror').text(data['loging_error']);
                    error = true;
                }

                if(error == true){
                    jQuery('#login-password').val('');
                }
            }
        }
    });

    return false
}

function SubmitModalFormData(){
    var error = false;
    var serialized = jQuery( '#modal-login' ).serialize();
    //console.log(serialized);
    jQuery.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: ajax_user_modal_login_object.ajaxurl,
        data: serialized,
        success: function(data){
            console.log(data);
            if(typeof(data['login_status']) != "undefined" &&  data['login_status'].length != 0 && data['login_status'] == 'success'){
                
                if(typeof(data['login_success']) != "undefined" &&  data['login_success'].length != 0){
                  jQuery('#mloginerror').text('');
                  jQuery('#mloginuser').val('');
                  jQuery('#mloginpassword').val('');
                  jQuery('#msuccess-login').text(data['login_success']);
                  function redirect_page(){
                    window.location.href = '';
                  }
                  setTimeout(redirect_page,3000);
                }
                
            }else{
                if(typeof(data['email']) != "undefined" &&  data['email'].length != 0){
                    jQuery('.loginemail_error').text(data['email']);
                    error = true;
                }
                if(typeof(data['pass']) != "undefined" &&  data['pass'].length != 0){
                    jQuery('.loginpass_error').text(data['pass']);
                    error = true;
                }
                if(typeof(data['loging_error']) != "undefined" &&  data['loging_error'].length != 0){
                    jQuery('#mloginerror').text(data['loging_error']);
                    error = true;
                }

                if(error == true){
                    jQuery('#mloginpassword').val('');
                }
            }
        }
    });

    return false
}