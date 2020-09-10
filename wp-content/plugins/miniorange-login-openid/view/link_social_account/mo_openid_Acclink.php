<?php

function mo_openid_linkSocialAcc(){
    if(mo_openid_restrict_user())
        $disable="disabled";
    else
        $disable="";

    ?><br/>
    <div class="mo_openid_table_layout">
        <form id="account_linking" name="premium_feature" method="post" action="" xmlns="http://www.w3.org/1999/html">
            <input type="hidden" name="option" value="mo_openid_account_linking" />
            <input type="hidden" name="mo_openid_enable_account_linking_nonce"
               value="<?php echo wp_create_nonce( 'mo-openid-enable-account-linking-nonce' ); ?>"/>
            <table>
                <tr>
                    <td colspan="2">
                        <div>
                            <label class="mo_openid_note_style"> <?php echo mo_sl('Enable account linking to let your users link their Social accounts with existing WordPress account. Users will be prompted with the option to either link to any existing account using WordPress login page or register as a new user.');?></label><br/>
                            <label style="cursor: auto" class="mo_openid_checkbox_container"><?php echo mo_sl('Enable linking of Social Accounts');?>
                                <input type="checkbox" id="account_linking_enable" name="mo_openid_account_linking_enable" value="1"
                                    <?php checked( get_option('mo_openid_account_linking_enable') == 1 );?> onclick="customize_account_linking()" />
                                <?php if($disable){ ?>
                                    <span class="mo_openid_checkbox_checkmark_disable"></span>
                                <?php } else { ?>
                                    <span class="mo_openid_checkbox_checkmark"></span>
                                <?php } ?>
                            </label>
                        </div>
                    </td>
                </tr>
                <tr><td colspan="2"></td></tr>
                    <tr id="account_link_customized_text"><td colspan="2"><h3 style="float: left"><?php echo mo_sl('Customize Text for Account Linking');?></h3><a style="float: right;margin-right: 325px;margin-top: 20px" onclick="customize_account_linking_img()"><?php echo mo_sl('Preview Account Linking form');?></a></td></tr>
                    <tr id="acc_link_img"><td colspan="2"></td></tr>
                    <tr id="account_link_customized_text"><td class="mo_openid_fix_fontsize" style="width: 40%">1. <?php echo mo_sl('Enter title of Account linking form');?>:</td><td><input <?php echo $disable ?> class="mo_openid_textfield_css" style="border: 1px solid ;border-color: #0867b2" type="text" name="mo_account_linking_title" value="<?php echo esc_attr(get_option('mo_account_linking_title')); ?>" /></td></tr>
                    <tr id="account_link_customized_text"><td class="mo_openid_fix_fontsize" style="width: 40%">2.<?php echo mo_sl(' Enter button text for create new user');?>:</td><td><input <?php echo $disable ?> class="mo_openid_textfield_css" style="border: 1px solid ;border-color: #0867b2" type="text" name="mo_account_linking_new_user_button" value="<?php echo esc_attr(get_option('mo_account_linking_new_user_button')); ?>"/></td></tr>
                    <tr id="account_link_customized_text">
                        <td class="mo_openid_fix_fontsize" style="width: 40%">
                            3.<?php echo mo_sl( 'Enter button text for Link to existing user:');?></td><td><input <?php echo $disable ?> class="mo_openid_textfield_css" style="border: 1px solid ;border-color: #0867b2" type="text" name="mo_account_linking_existing_user_button" value="<?php echo esc_attr(get_option('mo_account_linking_existing_user_button')); ?>"/></td></tr>
                <tr><td></td></tr>
                    <tr id="account_link_customized_text"><td class="mo_openid_fix_fontsize" colspan="2">4. <?php echo mo_sl('Enter instruction to Create New Account :');?><br/><input <?php echo $disable ?> class="mo_openid_textfield_css" style="border: 1px solid ;border-color: #0867b2;width: 98%" type="text" name="mo_account_linking_new_user_instruction" value="<?php echo esc_attr(get_option('mo_account_linking_new_user_instruction')); ?>"/>
                        </td>
                    </tr>
                <tr><td></td></tr>
                    <tr id="account_link_customized_text">
                        <td class="mo_openid_fix_fontsize" colspan="2">
                            5.<?php echo mo_sl(' Enter instructions to link to an existing account :');?><br/><input <?php echo $disable ?> class="mo_openid_textfield_css" style="border: 1px solid ;border-color: #0867b2;width: 98%" type="text" name="mo_account_linking_existing_user_instruction" value="<?php echo esc_attr(get_option('mo_account_linking_existing_user_instruction')); ?>"/>
                        </td>
                    </tr>
                <tr><td></td></tr>
                    <tr id="account_link_customized_text"><td disabled class="mo_openid_fix_fontsize" colspan="2"><?php echo mo_sl('Enter extra instructions for account linking ');?>:<br/><input <?php echo $disable ?> class="mo_openid_textfield_css" style="border: 1px solid ;border-color: #0867b2;width: 98%" style="width:98%;margin-left: 0px;" type="text" name="mo_account_linking_extra_instruction" value="<?php echo esc_attr(get_option('mo_account_linking_extra_instruction')); ?>"/>
                        </td>
                    </tr>
                        <tr id="disp_logo"><td colspan="2"> <br/>
                                <label class="mo_openid_checkbox_container"><?php echo mo_sl('Display miniOrange logo with social login icons on account completion forms');?>
                                    <input  type="checkbox" id="moopenid_logo_check_account" name="moopenid_logo_check_account" value="1"
                                        <?php checked( get_option('moopenid_logo_check_account') == 1 );?>  />
                                    <?php if($disable){ ?>
                                        <span class="mo_openid_checkbox_checkmark_disable"></span>
                                    <?php } else { ?>
                                        <span class="mo_openid_checkbox_checkmark"></span>
                                    <?php } ?>
                                </label>
                                <br/></td></tr>
                                  <tr id="save_btn"><td><br/><input <?php echo $disable?> type="submit" name="submit" value="<?php echo mo_sl('Save');?>" style="width:150px;text-shadow: none;background-color:#0867b2;color:white;box-shadow:none;"  class="button button-primary button-large" /></td></tr>
                    <tr id="acc_link"><td> </td></tr>
            </table>
        </form>
    </div>
    <script>
        //to set heading name
        jQuery('#mo_openid_page_heading').text('<?php echo mo_sl('Link Social Account');?>');
        var win_height = jQuery('#mo_openid_menu_height').height();
        //win_height=win_height+18;
        jQuery(".mo_container").css({height:win_height});
        jQuery.ajax({
            url: "<?php echo admin_url("admin-ajax.php");?>", //the page containing php script
            method: "POST", //request type,
            dataType: 'json',
            data: {
                action: 'mo_check_restrict_user',
            },
            success: function (result) {
                if (result.status=='true') {
                    var temp = jQuery("<a style=\"left: 1%; padding:4px; position: relative; text-decoration: none\" class=\"mo-openid-premium\" href=\"<?php echo add_query_arg(array('tab' => 'licensing_plans'), $_SERVER['REQUEST_URI']); ?>\">PRO</a>");
                    jQuery("#mo_openid_page_heading").append(temp);
                }
                else {
                    var temp = jQuery("");
                    jQuery("#mo_openid_page_heading").append(temp);
                }
            }
        });
        var custom_link;
        var custom_link_img;
        var custom_profile_img;
        id=document.getElementById('account_linking_enable');
        var checkbox1 = document.getElementById('account_linking_enable');
        jQuery(document).ready(function(){
                custom_link= 1;
                custom_link_img=1;
            }
        );

        function customize_account_linking_img(){
            if(custom_link_img==1){
                jQuery("<tr id=\"account_linking_img\"><td colspan=\"2\"><img style=\"margin-top: 15px;margin-left: 15px;\" src=\"<?php echo plugin_dir_url(dirname(__DIR__));?>includes/images/account_linking.png\"></td></tr>").insertBefore(jQuery("#acc_link_img"));
                custom_link_img=2;
            }else{
                jQuery("#account_linking_img").remove();
                custom_link_img=1;
            }
        }
    </script>
    <?php
}
?>