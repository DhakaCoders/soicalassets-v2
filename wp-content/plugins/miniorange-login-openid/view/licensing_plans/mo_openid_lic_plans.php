<?php

function mo_openid_licensing_plans()
{
    ?>
    <td style="vertical-align:top;width:100%;">

        <div style="float: left">
            <div class="mo_openid_table_layout" id="mo_openid_single" style="min-height: min-content; margin-top: 1%;width: 31%; float: left; display: inline-block">
                <div>
                    <table style="width: 100%" class="mo_table-bordered-license">
                        <thead>
                        <tr style="background-color:#F5F5F5;">
                            <th><br>
                                <h2>WooCommerce Integration Plugin</h2>
                                <h1><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>includes/images/dollar.png" style="width:20px;height:20px;">25</h1>
                            </th>
                        </tr>
                        <tr>
                            <th><button style="background-color: #0C1F28; width: 100%" onclick="mosocial_addonform('wp_social_login_woocommerce_plan')"
                                        class="mo-button-plan">Upgrade Now</button></th>
                        </tr>
                        </thead>
                        <tbody class="mo_align-center mo-fa-icon">
                        <tr>
                            <td><b>All Free features +</b></td>
                        </tr>
                        <tr>
                            <td>WooCommerce Display Options</td>
                        </tr>
                        <tr>
                            <td><div class="mo_openid_tooltip" >WooCommerce Integration <i class="mofa mofa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext"style="width:100%;"> First name, last name and email are pre-filled in billing details of a user and on the Woocommerce checkout page. Social Login icons are displayed on the Woocommerce checkout page.</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mo_openid_table_layout" id="mo_openid_single" style="min-height: min-content; margin-top: 1%;width: 31%; float: left; display: inline-block">
                <div>
                    <table style="width: 100%" class="mo_table-bordered-license">
                        <thead>
                        <tr style="background-color:#F5F5F5;">
                            <th><br>
                                <h2>BuddyPress Integration Plugin</h2>
                                <h1><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>includes/images/dollar.png" style="width:20px;height:20px;">25</h1>
                            </th>
                        </tr>
                        <tr>
                            <th><button style="width: 100%" onclick="mosocial_addonform('wp_social_login_buddypress_plan')"
                                        class="mo-button-plan mo_lic_color">Upgrade Now</button></th>
                        </tr>
                        </thead>
                        <tbody class="mo_align-center mo-fa-icon">
                        <tr>
                            <td><b>All Free features +</b></td>
                        </tr>
                        <tr>
                            <td>BuddyPress Display Options</td>
                        </tr>
                        <tr>
                            <td><div class="mo_openid_tooltip" >BuddyPress Integration <i class="mofa mofa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;"> Extended attributes returned from social app are mapped to Custom BuddyPress fields. Profile picture from social media is mapped to Buddypress avatar.</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mo_openid_table_layout" id="mo_openid_single" style="min-height: min-content; margin-top: 1%;width: 31%; float: left; display: inline-block">
                <div>
                    <table style="width: 100%" class="mo_table-bordered-license">
                        <thead>
                        <tr style="background-color:#F5F5F5;">
                            <th><br>
                                <h2>MailChimp Integration Plugin</h2>
                                <h1><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>includes/images/dollar.png" style="width:20px;height:20px;">10</h1>
                            </th>
                        </tr>
                        <tr>
                            <th><button style="background-color: #0C1F28; width: 100%" onclick="mosocial_addonform('wp_social_login_mailchimp_plan')"
                                        class="mo-button-plan">Upgrade Now</button></th>
                        </tr>
                        </thead>
                        <tbody class="mo_align-center mo-fa-icon">
                        <tr>
                            <td><b>All Free features +</b></td>
                        </tr>
                        <tr>
                            <td><div class="mo_openid_tooltip" >MailChimp Integration <i class="mofa mofa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;">A user is added as a subscriber to a mailing list in MailChimp when that user registers using Social Login. First name, last name and email are also captured for that user in the Mailing List. Option is available to download csv file that has list of emails of all users in WordPress.</span></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mo_openid_table_layout" id="mo_openid_single" style=" margin-top: 1%;width: 31%; float: left; display: inline-block">
                <div>
                    <table style="width: 100%" class="mo_table-bordered-license">
                        <thead>
                        <tr style="background-color:#F5F5F5;">
                            <th><br>
                                <h1>Free</h1>
                                <h2>(YOU ARE ON THIS PLAN)</h2>
                                <h2>&nbsp;</h2>
                                <h1><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>includes/images/dollar.png" style="width:20px;height:20px;">0</h1>
                                <h3>(Features and plans)</h3>
                            </th>
                        </tr>
                        <tr>
                            <th><button style="background-color: #0C1F28; width: 100%" onclick="mo_openid_support_form('')"
                                        class="mo-button-plan">Contact us for more features</button></th>
                        </tr>
                        </thead>
                        <tbody class="mo_align-center mo-fa-icon">
                        <tr>
                            <td>
                                <div class="mo_openid_tooltip" style="padding-left: 25px;">9 Pre-configured Social Login Apps <i class="mofa mofa-commenting " style="font-size:18px;color:#85929E"></i><span class="mo_openid_tooltiptext"style="width:100%;">Pre-configured apps are already configured by miniOrange. Login flow will go from plugin to miniOrange and then back to plugin. 9 pre-configured apps are<span id="mo_openid_dots">...</span><span id="mo_openid_more" style="display: none"><br>  google,vkontakte,twitter,linkedin,<br>amazon,windowslive,salesforce,<br/>yahoo and instagram.</span><button style="border:transparent;background-color: transparent;color: tomato;" onclick="myFunction('mo_openid_dots','mo_openid_more','mo_openid_myBtn')" id="mo_openid_myBtn">Read more</button</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="mo_openid_tooltip" style="padding-left: 37px;">9 Custom Social Login Apps <i class="mofa mofa-commenting " style="font-size:18px;color:#85929E"></i><span class="mo_openid_tooltiptext"style="width:100%;"> Using the custom app tab, you can set up your own app id and secret in the plugin. Login flow will not involve miniOrange in between. Login flow will go from plugin to social media application and then back to plugin.<br>10 custom apps are <span id="mo_openid_dots1">...</span><span id="mo_openid_more1" style="display:none" ><br>Facebook,Google,vkontakte,<br/>twitter,linkedin,<br>amazon,windowslive,yahoo and instagram.</span><button style="border:transparent;background-color: transparent;color: tomato;" onclick="myFunction('mo_openid_dots1','mo_openid_more1','mo_openid_myBtn1')" id="mo_openid_myBtn1">Read more</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Beautiful Icon Customisations</td>
                        </tr>
                        <tr>
                            <td>16 Social Sharing Apps</td>
                        </tr>
                        <tr>
                            <td>Facebook Social Comments</td>
                        </tr>
                        <tr>
                            <td>Disqus Social Comments</td>
                        </tr>
                        <tr>
                            <td>Login Redirect URL</td>
                        </tr>
                        <tr>
                            <td>Logout Redirect URL</td>
                        </tr>
                        <tr>
                            <td>Profile completion (username, email)</td>
                        </tr>
                        <tr>
                            <td>Profile Picture</td>
                        </tr>
                        <tr>
                            <td>Email notification to admin</td>
                        </tr>
                        <tr>
                            <td>Customizable Text For Login Icons</td>
                        </tr>
                        <tr>
                            <td>Option to enable/disable user registration</td>
                        </tr>
                        <tr>
                            <td>Basic Email Support</td>
                        </tr>
                        <tr>
                            <td>Role Mapping</td>
                        </tr>
                        <tr>
                            <td>Shortcodes to display social icons on<br/>any login page, post, popup and php pages</td>
                        </tr>

                        <tr>
                            <td><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mo_openid_table_layout" id="mo_openid_single" style=" margin-top: 1%;width: 31%; float: left; display: inline-block">
                <div>
                    <table style="width: 100%" class="mo_table-bordered-license">
                        <thead>
                        <tr style="background-color:#F5F5F5;">
                            <th><br>
                                <h1>Standard</h1>
                                <h2>&nbsp;</h2>
                                <h1>
                                    <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/dollar.png" style="width:20px;height:20px;"><strike>39</strike>
                                    <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>includes/images/dollar.png" style="width:20px;height:20px;">29 - 1 Instance</h1>
                                </h1>
                                <h1>
                                    <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>includes/images/dollar.png" style="width:20px;height:20px;">169 - 10 Instance</h1>
                                </h1>
                                <h3>(Features and plans)</h3>
                            </th>
                        </tr>
                        <tr>
                            <th><button style="width: 100%" onclick="mosocial_addonform('wp_social_login_standard_plan')"
                                        class="mo-button-plan mo_lic_color">Upgrade Now</button></th>
                        </tr>
                        </thead>
                        <tbody class="mo_align-center mo-fa-icon">
                        <tr>
                            <td><b>All Free features +</b></td>
                        </tr>
                        <tr>
                            <td><div class="mo_openid_tooltip" style="padding-left: 40px;">33 Custom Social Login Apps <i class="mofa mofa-commenting " style="font-size:18px;color:#85929E"></i><span class="mo_openid_tooltiptext"style="width:100%;"> Using the custom app tab, you can set up your own app id and secret in the plugin. Login flow will not involve miniOrange in between. Login flow will go from plugin to social media application and then back to plugin.<br>33 custom apps are <span id="mo_openid_dots2">...</span><span id="mo_openid_more2" style="display:none" ><br>Facebook,Google,Yandex,Paypal,vkontakte,<br/>Reddit,twitter,linkedin,amazon,windowslive,<br/>yahoo,apple,disqus,instagram,wordpress,pinterest,<br>
                    spotify,tumblr,twitch,vimeo,kakao,discord,<br>dirbble,flickr,line,meetup,naver,snapchat,foursquare,<br>teamsnap,stackexchange,livejournal & odnoklassniki.</span><button style="border:transparent;background-color: transparent;color: tomato;" onclick="myFunction('mo_openid_dots2','mo_openid_more2','mo_openid_myBtn2')" id="mo_openid_myBtn2">Read more</button>
                                </div></td>
                        </tr>
                        <tr>
                            <td>Advance Account Linking</td>
                        </tr>
                        <tr>
                            <td>General Data Protection Regulation (GDPR)</td>
                        </tr>
                        <tr>
                            <td>BuddyPress Display Options</td>
                        </tr>
                        <tr>
                            <td>Woocommerce Display Options</td>
                        </tr>
                        <tr>
                            <td>Account Linking & Unlinking for user</td>
                        </tr>
                        <tr>
                            <td>Email notification to multiple admins</td>
                        </tr>
                        <tr>
                            <td>Welcome Email to end users</td>
                        </tr>
                        <tr>
                            <td>Customizable Email Notification template</td>
                        </tr>
                        <tr>
                            <td>Customizable welcome Email template</td>
                        </tr>
                        <tr>
                            <td>Custom CSS for Social Login buttons</td>
                        </tr>
                        <tr>
                            <td>Social Login Opens in a New Window</td>
                        </tr>
                        <tr>
                            <td>Domain restriction</td>
                        </tr>
                        <tr>
                            <td>Force Admin To Login Using Password</td>
                        </tr>
                        <tr>
                            <td>Send username and password reset link</td>
                        </tr>
                        <tr>
                            <td>Disable admin bar</td>
                        </tr>
                        <tr>
                            <td>Google recaptcha</td>
                        </tr>
                        <tr>
                            <td><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mo_openid_table_layout" id="mo_openid_single" style=" margin-top: 1%;width: 31%; float: left; display: inline-block">
                <div>
                    <table style="width: 100%" class="mo_table-bordered-license">
                        <thead>
                        <tr style="background-color:#F5F5F5;">
                            <th><br>
                                <h1>Premium</h1>
                                <h2><font color="red">(Popular plugins integrations)</font></h2>
                                <h1>
                                    <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/dollar.png" style="width:20px;height:20px;"><strike>59</strike>
                                    <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>includes/images/dollar.png" style="width:20px;height:20px;">49 - 1 Instance</h1>
                                </h1>
                                <h1>
                                    <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>includes/images/dollar.png" style="width:20px;height:20px;">199 - 10 Instance</h1>
                                </h1>
                                <h3>(Features and plans)</h3>
                            </th>
                        </tr>
                        <tr>
                            <th><button style="background-color: #0C1F28" onclick="mosocial_addonform('wp_social_login_premium_plan')"
                                        class="mo-button-plan">Upgrade Now</button></th>
                        </tr>
                        </thead>
                        <tbody class="mo_align-center mo-fa-icon">
                        <tr>
                            <td><b>All Free features +</b></td>
                        </tr>
                        <tr>
                            <td><div class="mo_openid_tooltip" style="padding-left: 40px;">33 Custom Social Login Apps <i class="mofa mofa-commenting " style="font-size:18px;color:#85929E"></i><span class="mo_openid_tooltiptext"style="width:100%;"> Using the custom app tab, you can set up your own app id and secret in the plugin. Login flow will not involve miniOrange in between. Login flow will go from plugin to social media application and then back to plugin.<br>33 custom apps are <span id="mo_openid_dots3">...</span><span id="mo_openid_more3" style="display:none" ><br>Facebook,Google,Yandex,Paypal,vkontakte,<br/>Reddit,twitter,linkedin,amazon,windowslive,<br/>yahoo,apple,disqus,instagram,wordpress,pinterest,<br>
                    spotify,tumblr,twitch,vimeo,kakao,discord,<br>dirbble,flickr,line,meetup,naver,snapchat,foursquare,<br>teamsnap,stackexchange,livejournal & odnoklassniki.</span><button style="border:transparent;background-color: transparent;color: tomato;" onclick="myFunction('mo_openid_dots3','mo_openid_more3','mo_openid_myBtn3')" id="mo_openid_myBtn3">Read more</button>
                                </div></td>
                        </tr>
                        <tr>
                            <td><span class="mo_openid_tooltip">Custom attribute mapping <i class="mofa mofa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext"style="width:100%;">Extended attributes returned from social app are mapped to Custom attributes created by admin. These Attributes get stored in user_meta.</span></td>
                        </tr>
                        <tr>
                            <td><span class="mo_openid_tooltip">Paid Membership pro Integration <i class="mofa mofa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext"style="width:100%;">Assign default levels or let users choose to set their levels provided by Paid Membership Pro to the users login using Social Login</span></td>
                        </tr>
                        <tr>
                            <td><div class="mo_openid_tooltip" >BuddyPress Integration <i class="mofa mofa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;"> Extended attributes returned from social app are mapped to Custom BuddyPress fields. Profile picture from social media is mapped to Buddypress avatar.</span></td>
                        </tr>
                        <tr>
                            <td><div class="mo_openid_tooltip" >Woocommerce Integration <i class="mofa mofa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext"style="width:100%;"> First name, last name and email are pre-filled in billing details of a user and on the Woocommerce checkout page. Social Login icons are displayed on the Woocommerce checkout page.</span></td>
                        </tr>
                        <tr>
                            <td><div class="mo_openid_tooltip" >MailChimp Integration <i class="mofa mofa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;">A user is added as a subscriber to a mailing list in MailChimp when that user registers using Social Login. First name, last name and email are also captured for that user in the Mailing List. Option is available to download csv file that has list of emails of all users in WordPress.</span></td>
                        </tr>
                        <tr>
                            <td><div class="mo_openid_tooltip" >miniOrange OTP Integration<span style="color: red">*</span> <i class="mofa mofa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;">Verify your users via OTP on registration.</span></td>
                        </tr>
                        <tr>
                            <td><div class="mo_openid_tooltip" >Extended Profile Data <i class="mofa mofa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;">Extended profile data feature requires additional configuration. You need to have your own social media app and permissions from social media providers to collect extended user data.</span></td>
                        </tr>
                        <tr>
                            <td><div class="mo_openid_tooltip" >Custom Integration <i class="mofa mofa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;"> If you have a specific custom requirement in the Social Login Plugin, we can implement and integrate it in the Plugin fo you. This includes all those custom features that come under the scope of Social Login/ Sharing/ Comments and impart additional value to the plugin. These features are chargeable. Please send us a query through the support forum to get in touch with us about your custom requirements.</span></div></td>
                        </tr>
                        <tr>
                            <td>Ultimate Member Display Options</td>
                        </tr>
                        <tr>
                            <td>Send account activation link to the user</td>
                        </tr>
                        <tr>
                            <td>Restrict registration from specific pages</td>
                        </tr>
                        <tr>
                            <td>User Moderation</td>
                        </tr>
                        <tr>
                            <td>Advance Account Linking</td>
                        </tr>
                        <tr>
                            <td>General Data Protection Regulation (GDPR)</td>
                        </tr>
                        <tr>
                            <td>BuddyPress Display Options</td>
                        </tr>
                        <tr>
                            <td>Woocommerce Display Options</td>
                        </tr>
                        <tr>
                            <td>Account Linking & Unlinking for user</td>
                        </tr>
                        <tr>
                            <td>Email notification to multiple admins</td>
                        </tr>
                        <tr>
                            <td>Welcome Email to end users</td>
                        </tr>
                        <tr>
                            <td>Customizable Email Notification template</td>
                        </tr>
                        <tr>
                            <td>Customizable welcome Email template</td>
                        </tr>
                        <tr>
                            <td>Custom CSS for Social Login buttons</td>
                        </tr>
                        <tr>
                            <td>Social Login Opens in a New Window</td>
                        </tr>
                        <tr>
                            <td>Domain restriction</td>
                        </tr>
                        <tr>
                            <td>Force Admin To Login Using Password</td>
                        </tr>
                        <tr>
                            <td>Send username and password reset link</td>
                        </tr>
                        <tr>
                            <td>Disable admin bar</td>
                        </tr>
                        <tr>
                            <td>Google recaptcha</td>
                        </tr>
                        <tr>
                            <td><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mo_openid_table_layout" id="mo_openid_single" style="margin-left: 15%; min-height: min-content; margin-top: 1%;width: 31%; float: left; display: inline-block">
                <div>
                    <table style="width: 100%" class="mo_table-bordered-license">
                        <thead>
                        <tr style="background-color:#F5F5F5;">
                            <th><br>
                                <h2>Social Login Premium Applications</h2>
                                <h1><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>includes/images/dollar.png" style="width:20px;height:20px;">10</h1>
                            </th>
                        </tr>
                        <tr>
                            <th><button style="background-color: #0C1F28; width: 100%" onclick="mosocial_addonform('wp_social_custom_plan')"
                                        class="mo-button-plan">Upgrade Now</button></th>
                        </tr>
                        </thead>
                        <tbody class="mo_align-center mo-fa-icon">
                        <tr>
                            <td><b>All Free features +</b></td>
                        </tr>
                        <tr>
                            <td>You will get any one application of your choice integrated with the plugin with $10 each.</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mo_openid_table_layout" id="mo_openid_single" style="min-height: min-content; margin-top: 1%;width: 31%; float: left; display: inline-block">
                <div>
                    <table style="width: 100%" class="mo_table-bordered-license">
                        <thead>
                        <tr style="background-color:#F5F5F5;">
                            <th><br>
                                <h2>Custom feature / Integration</h2>
                                <h1>&nbsp;</h1>
                            </th>
                        </tr>
                        <tr>
                            <th><button style="width: 100%" onclick="mo_openid_support_form('Custom requirment for  ')"
                                        class="mo-button-plan">Contact us with requirments</button></th>
                        </tr>
                        </thead>
                        <tbody class="mo_align-center mo-fa-icon">
                        <tr>
                            <td><b>All Free features +</b></td>
                        </tr>
                        <tr>
                            <td>If you require any feature or integration of any plugin to be integrated with your Social Login plugin.</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br/>&nbsp;<br/>
        <div style="font-size: 15px; padding: 1%">
            <hr><h3>Available Add on</h3>
            <a style="text-decoration: none" target="_blank" href="<?php echo get_site_url() . "/wp-admin/admin.php?page=mo_openid_settings_addOn";?> ">Social Login Custom Registration Form Add on</a>
            <button style="margin-left: 2%; margin-top: -.5%" onclick="mosocial_addonform('wp_social_login_extra_attributes_addon')" id="mosocial_purchase_cust_addon" class="button button-primary button-large">Upgrade Now</button>
            <p style="font-size: 15px">Custom Registration Form Add-On helps you to integrate details of new as well as existing users. You can add as many fields as you want including the one which are returned by social sites at time of registration.</p>
        </div>
        <div class="clear">
            <hr>
            <h3>Refund Policy -</h3>
            <p><b>At miniOrange, we want to ensure you are 100% happy with your purchase. If the premium plugin you
                    purchased is not working as advertised and you've attempted to resolve any issues with our support
                    team, which couldn't get resolved then we will refund the whole amount within 10 days of the
                    purchase. Please email us at <a href="mailto:info@xecurify.com"><i>info@xecurify.com</i></a> for any
                    queries regarding the return policy.</b></p>
            <b>Not applicable for -</b>
            <ol>
                <li>Returns that are because of features that are not advertised.</li>
                <li>Returns beyond 10 days.</li>
            </ol>
        </div>
        <script>
            //to set heading name
            jQuery('#mo_openid_page_heading').text('<?php echo mo_sl('Licensing Plan For Social Login');?>');
            function myFunction(dots_id,read_id,btn_id) {

                var dots = document.getElementById(dots_id);
                var moreText = document.getElementById(read_id);
                var btnText = document.getElementById(btn_id);

                if (dots.style.display === "none") {
                    dots.style.display = "inline";
                    btnText.innerHTML = "Read more";
                    moreText.style.display = "none";
                } else {
                    dots.style.display = "none";
                    btnText.innerHTML = "Close";
                    moreText.style.display = "inline";
                }
            }
            function mosocial_addonform(planType) {
                jQuery.ajax({
                    url: "<?php echo admin_url("admin-ajax.php");?>", //the page containing php script
                    method: "POST", //request type,
                    dataType: 'json',
                    data: {
                        action: 'mo_register_customer_toggle_update',
                    },
                    success: function (result) {
                        if(result.status){
                            jQuery('#requestOrigin').val(planType);
                            jQuery('#mosocial_loginform').submit();
                        }
                        else
                        {
                            alert("It seems you are not registered with miniOrange. Please login or register with us to upgrade to premium plan.");
                            window.location.href="<?php echo site_url()?>".concat("/wp-admin/admin.php?page=mo_openid_general_settings&tab=profile");
                        }
                    }
                });
            }
        </script>

    </td>

    <td>
        <form style="display:none;" id="mosocial_loginform" action="<?php echo get_option( 'mo_openid_host_name' ) . '/moas/login'; ?>"
              target="_blank" method="post" >
            <input type="email" name="username" value="<?php echo esc_attr(get_option('mo_openid_admin_email')); ?>" />
            <input type="text" name="redirectUrl" value="<?php echo esc_attr(get_option( 'mo_openid_host_name')).'/moas/initializepayment'; ?>" />
            <input type="text" name="requestOrigin" id="requestOrigin"/>
        </form>
    </td>
    <?php
}

function mo_openid_licensing_plan_sharing()
{
    ?>
    <td style="vertical-align:top;width:100%;">

        <div style="float: left">
            <div class="mo_openid_table_layout" id="mo_openid_single" style="min-height: min-content; margin-top: 1%;width: 31%; float: left; display: inline-block">
                <div>
                    <table style="width: 100%" class="mo_table-bordered-license">
                        <thead>
                        <tr style="background-color:#F5F5F5;">
                            <th><br>
                                <h2>Social Sharing Premium Applications<br/>&nbsp;</h2>
                                <h1><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>includes/images/dollar.png" style="width:20px;height:20px;">10</h1>
                            </th>
                        </tr>
                        <tr>
                            <th><button style="background-color: #0C1F28; width: 100%" onclick="mosocial_addonform('wp_social_custom_plan')"
                                        class="mo-button-plan mo_lic_color">Upgrade Now</button></th>
                        </tr>
                        </thead>
                        <tbody class="mo_align-center mo-fa-icon">
                        <tr>
                            <td><b>All Free features +</b></td>
                        </tr>
                        <tr>
                            <td>You will get any one application of your choice integrated with the plugin with $10 each.</td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mo_openid_table_layout" id="mo_openid_single" style="min-height: min-content; margin-top: 1%;width: 31%; float: left; display: inline-block">
                <div>
                    <table style="width: 100%" class="mo_table-bordered-license">
                        <thead>
                        <tr style="background-color:#F5F5F5;">
                            <th><br>
                                <h2>Social Sharing Premium +<br/>Social Login Standard</h2>
                                <h1><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>includes/images/dollar.png" style="width:20px;height:20px;">45</h1>
                            </th>
                        </tr>
                        <tr>
                            <th><button style="width: 100%" onclick="mo_openid_support_form('Sharing Premium + Standard')"
                                        class="mo-button-plan">Contact us for custom plugin</button></th>
                        </tr>
                        </thead>
                        <tbody class="mo_align-center mo-fa-icon">
                        <tr>
                            <td><b>All Free features +</b></td>
                        </tr>
                        <tr>
                            <td>All Social Sharing Premium Features</td>
                        </tr>
                        <tr>
                            <td>All Social Login Standard Features</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mo_openid_table_layout" id="mo_openid_single" style="min-height: min-content; margin-top: 1%;width: 31%; float: left; display: inline-block">
                <div>
                    <table style="width: 100%" class="mo_table-bordered-license">
                        <thead>
                        <tr style="background-color:#F5F5F5;">
                            <th><br>
                                <h2>Social Sharing Premium +<br/>Social Login Premium</h2>
                                <h1><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>includes/images/dollar.png" style="width:20px;height:20px;">60</h1>
                            </th>
                        </tr>
                        <tr>
                            <th><button style="background-color: #0C1F28; width: 100%" onclick="mo_openid_support_form('Sharing Premium + Premium')"
                                        class="mo-button-plan">Contact us for custom plugin</button></th>
                        </tr>
                        </thead>
                        <tbody class="mo_align-center mo-fa-icon">
                        <tr>
                            <td><b>All Free features +</b></td>
                        </tr>
                        <tr>
                            <td>All Social Sharing Premium Features</td>
                        </tr>
                        <tr>
                            <td>All Social Login Premium Features</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mo_openid_table_layout" id="mo_openid_single" style="margin-left: 17%; margin-top: 1%;width: 31%; float: left; display: inline-block">
                <div>
                    <table style="width: 100%" class="mo_table-bordered-license">
                        <thead>
                        <tr style="background-color:#F5F5F5;">
                            <th><br>
                                <h1>Free</h1>
                                <h2>(YOU ARE ON THIS PLAN)</h2>
                                <h1><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>includes/images/dollar.png" style="width:20px;height:20px;">0</h1>
                                <h3>(Features and plans)</h3>
                            </th>
                        </tr>
                        <tr>
                            <th><button style="background-color: #0C1F28; width: 100%" onclick="mo_openid_support_form('')"
                                        class="mo-button-plan">Contact us for more features</button></th>
                        </tr>
                        </thead>
                        <tbody class="mo_align-center mo-fa-icon">
                        <tr>
                            <td>
                                <div class="mo_openid_tooltip" style="padding-left: 25px;">9 Pre-configured Social Login Apps <i class="mofa mofa-commenting " style="font-size:18px;color:#85929E"></i><span class="mo_openid_tooltiptext"style="width:100%;">Pre-configured apps are already configured by miniOrange. Login flow will go from plugin to miniOrange and then back to plugin. 9 pre-configured apps are<span id="mo_openid_dots">...</span><span id="mo_openid_more" style="display: none"><br>  google,vkontakte,twitter,linkedin,<br>amazon,windowslive,salesforce,<br/>yahoo and instagram.</span><button style="border:transparent;background-color: transparent;color: tomato;" onclick="myFunction('mo_openid_dots','mo_openid_more','mo_openid_myBtn')" id="mo_openid_myBtn">Read more</button</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="mo_openid_tooltip" style="padding-left: 37px;">9 Custom Social Login Apps <i class="mofa mofa-commenting " style="font-size:18px;color:#85929E"></i><span class="mo_openid_tooltiptext"style="width:100%;"> Using the custom app tab, you can set up your own app id and secret in the plugin. Login flow will not involve miniOrange in between. Login flow will go from plugin to social media application and then back to plugin.<br>10 custom apps are <span id="mo_openid_dots1">...</span><span id="mo_openid_more1" style="display:none" ><br>Facebook,Google,vkontakte,<br/>twitter,linkedin,<br>amazon,windowslive,yahoo and instagram.</span><button style="border:transparent;background-color: transparent;color: tomato;" onclick="myFunction('mo_openid_dots1','mo_openid_more1','mo_openid_myBtn1')" id="mo_openid_myBtn1">Read more</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Beautiful Icon Customisations</td>
                        </tr>
                        <tr>
                            <td>16 Social Sharing Apps</td>
                        </tr>
                        <tr>
                            <td>Facebook Social Comments</td>
                        </tr>
                        <tr>
                            <td>Disqus Social Comments</td>
                        </tr>
                        <tr>
                            <td>Login Redirect URL</td>
                        </tr>
                        <tr>
                            <td>Logout Redirect URL</td>
                        </tr>
                        <tr>
                            <td>Profile completion (username, email)</td>
                        </tr>
                        <tr>
                            <td>Profile Picture</td>
                        </tr>
                        <tr>
                            <td>Email notification to admin</td>
                        </tr>
                        <tr>
                            <td>Customizable Text For Login Icons</td>
                        </tr>
                        <tr>
                            <td>Option to enable/disable user registration</td>
                        </tr>
                        <tr>
                            <td>Basic Email Support</td>
                        </tr>
                        <tr>
                            <td>Role Mapping</td>
                        </tr>
                        <tr>
                            <td>Shortcodes to display social icons on<br/>any login page, post, popup and php pages</td>
                        </tr>

                        <tr>
                            <td><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mo_openid_table_layout" id="mo_openid_single" style=" margin-top: 1%;width: 31%; float: left; display: inline-block">
                <div>
                    <table style="width: 100%" class="mo_table-bordered-license">
                        <thead>
                        <tr style="background-color:#F5F5F5;">
                            <th><br>
                                <h1>Sharing Premium</h1>
                                <h2>&nbsp;</h2>
                                <h1>
                                    <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/dollar.png" style="width:20px;height:20px;"><strike>29</strike>
                                    <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>includes/images/dollar.png" style="width:20px;height:20px;">19</h1>
                                </h1>
                                <h3>(Features and plans)</h3>
                            </th>
                        </tr>
                        <tr>
                            <th><button style="width: 100%" onclick="mosocial_addonform('wp_social_login_share_plan')"
                                        class="mo-button-plan mo_lic_color">Upgrade Now</button></th>
                        </tr>
                        </thead>
                        <tbody class="mo_align-center mo-fa-icon">
                        <tr>
                            <td><b>All Free features +</b></td>
                        </tr>
                        <tr>
                            <td>45 Social Sharing Apps</td>
                        </tr>
                        <tr>
                            <td>Social Share Count</td>
                        </tr>
                        <tr>
                            <td>Display Options</td>
                        </tr>
                        <tr>
                            <td>Hover Icons</td>
                        </tr>
                        <tr>
                            <td>Floating Icons</td>
                        </tr>
                        <tr>
                            <td>WooCommerce Display option</td>
                        </tr>
                        <tr>
                            <td>E-mail subcriber</td>
                        </tr>
                        <tr>
                            <td>Facebook Like</td>
                        </tr>
                        <tr>
                            <td>Facebook Recommended</td>
                        </tr>
                        <tr>
                            <td>Pinterest Pin</td>
                        </tr>
                        <tr>
                            <td>Twitter follow</td>
                        </tr>
                        <tr>
                            <td>Vertical Icons</td>
                        </tr>
                        <tr>
                            <td>Horizontal Icons</td>
                        </tr>
                        <tr>
                            <td>Shortcodes to display social icons on<br/>any hompage page, post, popup and php pages</td>
                        </tr>
                        <tr>
                            <td><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></td>
                        </tr>
                        <tr><td</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mo_openid_table_layout" id="mo_openid_single" style="margin-left:33%; min-height: min-content; margin-top: 1%;width: 31%; float: left; display: inline-block">
                <div>
                    <table style="width: 100%" class="mo_table-bordered-license">
                        <thead>
                        <tr style="background-color:#F5F5F5;">
                            <th><br>
                                <h2>Custom feature / Integration</h2>
                                <h1>&nbsp;</h1>
                            </th>
                        </tr>
                        <tr>
                            <th><button style="width: 100%" onclick="mo_openid_support_form('Custom requirment for  ')"
                                        class="mo-button-plan">Contact us with requirments</button></th>
                        </tr>
                        </thead>
                        <tbody class="mo_align-center mo-fa-icon">
                        <tr>
                            <td><b>All Free features +</b></td>
                        </tr>
                        <tr>
                            <td>If you require any feature or integration of any plugin to be integrated with your Social Login plugin.</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br/>&nbsp;<br/>
        <div style="font-size: 15px; padding: 1%">
            <hr><h3>Available Add on</h3>
            <a style="text-decoration: none" target="_blank" href="<?php echo get_site_url() . "/wp-admin/admin.php?page=mo_openid_settings_addOn";?> ">Social Login Custom Registration Form Add on</a>
            <button style="margin-left: 2%; margin-top: -.5%" onclick="mosocial_addonform('wp_social_login_extra_attributes_addon')" id="mosocial_purchase_cust_addon" class="button button-primary button-large">Upgrade Now</button>
            <p style="font-size: 15px">Custom Registration Form Add-On helps you to integrate details of new as well as existing users. You can add as many fields as you want including the one which are returned by social sites at time of registration.</p>
        </div>
        <div class="clear">
            <hr>
            <h3>Refund Policy -</h3>
            <p><b>At miniOrange, we want to ensure you are 100% happy with your purchase. If the premium plugin you
                    purchased is not working as advertised and you've attempted to resolve any issues with our support
                    team, which couldn't get resolved then we will refund the whole amount within 10 days of the
                    purchase. Please email us at <a href="mailto:info@xecurify.com"><i>info@xecurify.com</i></a> for any
                    queries regarding the return policy.</b></p>
            <b>Not applicable for -</b>
            <ol>
                <li>Returns that are because of features that are not advertised.</li>
                <li>Returns beyond 10 days.</li>
            </ol>
        </div>
        <script>
            //to set heading name
            jQuery('#mo_openid_page_heading').text('<?php echo mo_sl('Licensing Plan For Social Sharing');?>');
            function myFunction(dots_id,read_id,btn_id) {

                var dots = document.getElementById(dots_id);
                var moreText = document.getElementById(read_id);
                var btnText = document.getElementById(btn_id);

                if (dots.style.display === "none") {
                    dots.style.display = "inline";
                    btnText.innerHTML = "Read more";
                    moreText.style.display = "none";
                } else {
                    dots.style.display = "none";
                    btnText.innerHTML = "Close";
                    moreText.style.display = "inline";
                }
            }
            function mosocial_addonform(planType) {
                jQuery.ajax({
                    url: "<?php echo admin_url("admin-ajax.php");?>", //the page containing php script
                    method: "POST", //request type,
                    dataType: 'json',
                    data: {
                        action: 'mo_register_customer_toggle_update',
                    },
                    success: function (result) {
                        if(result.status){
                            jQuery('#requestOrigin').val(planType);
                            jQuery('#mosocial_loginform').submit();
                        }
                        else
                        {
                            alert("It seems you are not registered with miniOrange. Please login or register with us to upgrade to premium plan.");
                            window.location.href="<?php echo site_url()?>".concat("/wp-admin/admin.php?page=mo_openid_general_settings&tab=profile");
                        }
                    }
                });
            }
        </script>

    </td>

    <td>
        <form style="display:none;" id="mosocial_loginform" action="<?php echo get_option( 'mo_openid_host_name' ) . '/moas/login'; ?>"
              target="_blank" method="post" >
            <input type="email" name="username" value="<?php echo esc_attr(get_option('mo_openid_admin_email')); ?>" />
            <input type="text" name="redirectUrl" value="<?php echo esc_attr(get_option( 'mo_openid_host_name')).'/moas/initializepayment'; ?>" />
            <input type="text" name="requestOrigin" id="requestOrigin"/>
        </form>
    </td>
    <?php
}

function mo_openid_licensing_plans_addon()
{
    ?>
    <td style="vertical-align:top;width:100%;">
        <div class="mo_openid_table_layout" style="min-height:625px; margin-left: 6%">
            <div class="grid">
                <div style="width: 25%;"></div>
                <div class="col100 red">
                    <table class="table mo_table-bordered-license mo_table-striped-license" style="width: 150%;">
                        <thead>
                        <tr style="background-color:#F5F5F5;">
                            <th width="400px;"><br>
                                <h1>Custom Registration Form</h1>
                                <h1>Add-On</h1>
                                <h1>
                                    <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/dollar.png" style="width:20px;height:20px;"><strike>19</strike>
                                    <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>includes/images/dollar.png" style="width:20px;height:20px;">15</h1>
                                <h3>Features/ Plan</h3></th>
                        </tr>
                        <tr>
                            <th><button onclick="mosocial_addonform('wp_social_login_extra_attributes_addon')"
                                        id="mosocial_purchase_cust_addon"
                                        class="mo-button-plan">Upgrade Now</button></th>
                        </tr>
                        </thead>
                        <tbody class="mo_align-center mo-fa-icon">
                        <tr>
                            <td>Map users data which is returned from social apps</td>
                        </tr>
                        <tr>
                            <td>Create a pre-registration form</td>
                        </tr>
                        <tr>
                            <td>Allow user to select Role while registration</td>
                        </tr>
                        <tr>
                            <td>The form can support any theme</td>
                        </tr>
                        <tr>
                            <td>Ability to add custom fields in the registration form</td>
                        </tr>
                        <tr>
                            <td>Edit Profile option using shortcode</td>
                        </tr>
                        <tr>
                            <td>Support input field types: text, date, checkbox or dropdown</td>
                        </tr>
                        <tr>
                            <td>Optional mandatory fields</td>
                        </tr>
                        <tr>
                            <td>Synchronization existing meta field</td>
                        </tr>
                        <tr>
                            <td><a target="_blank"
                                   href="<?php echo get_site_url() . "/wp-admin/admin.php?page=mo_openid_settings&tab=login"; ?> ">Contact
                                    Us using Support Form</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="clear">
            <hr>
            <h3>Refund Policy -</h3>
            <p><b>At miniOrange, we want to ensure you are 100% happy with your purchase. If the premium plugin you
                    purchased is not working as advertised and you've attempted to resolve any issues with our support
                    team, which couldn't get resolved then we will refund the whole amount within 10 days of the
                    purchase. Please email us at <a href="mailto:info@xecurify.com"><i>info@xecurify.com</i></a> for any
                    queries regarding the return policy.</b></p>
            <b>Not applicable for -</b>
            <ol>
                <li>Returns that are because of features that are not advertised.</li>
                <li>Returns beyond 10 days.</li>
            </ol>
        </div>
        <style>
            div.grid {
                width: 850px;
            }

            div.grid div {
                float: left;
                height: 10px;
            }

            div.col100 {
                width: 250px;
            }
        </style>
        <script>
            //to set heading name
            jQuery('#mo_openid_page_heading').text('<?php echo mo_sl('Licensing Plan For Social Login');?>');
            function mosocial_addonform(planType) {
                jQuery.ajax({
                    url: "<?php echo admin_url("admin-ajax.php");?>", //the page containing php script
                    method: "POST", //request type,
                    dataType: 'json',
                    data: {
                        action: 'mo_register_customer_toggle_update',
                    },
                    success: function (result) {
                        if(result.status){
                            jQuery('#requestOrigin').val(planType);
                            jQuery('#mosocial_loginform').submit();
                        }
                        else
                        {
                            alert("It seems you are not registered with miniOrange. Please login or register with us to upgrade to premium plan.");
                            window.location.href="<?php echo site_url()?>".concat("/wp-admin/admin.php?page=mo_openid_general_settings&tab=profile");
                        }
                    }
                });
            }
        </script>



    <td>
        <form style="display:none;" id="mosocial_loginform" action="<?php echo get_option( 'mo_openid_host_name' ) . '/moas/login'; ?>"
              target="_blank" method="post" >
            <input type="email" name="username" value="<?php echo esc_attr(get_option('mo_openid_admin_email')); ?>" />
            <input type="text" name="redirectUrl" value="<?php echo esc_attr(get_option( 'mo_openid_host_name')).'/moas/initializepayment'; ?>" />
            <input type="text" name="requestOrigin" id="requestOrigin"/>
        </form>
    </td>
    <?php
}