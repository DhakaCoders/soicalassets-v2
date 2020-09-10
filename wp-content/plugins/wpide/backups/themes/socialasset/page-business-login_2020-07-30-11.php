<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "76c595500ff78af9f16cf4dc19fc455ed42ab0480b"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/page-business-login.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/page-business-login_2020-07-30-11.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
checked_loggedin();
/*
  Template Name: Business Login
*/
get_camp_header();

?>
<div class="content-center-cntlr gray-bg">
  <span class="login-form-clip"><img src="<?php echo THEME_URI; ?>/assets/images/form-clip.png"></span>
  <section class="login-businesses">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="login-businesses-form-cntlr">
              <div class="login-businesses-form-hdr">
                <p>Ad a text here in order to describe what a business  lore ipsum door sit amen.</p>
              </div>
              <div class="login-businesses-form">
                <span id="bsuccess_signup" class="success-signup"></span>
                <div id="after-bsignup-hide">
                <div class="fl-tabs clearfix text-center">
                  <button class="tab-link" data-tab="tab-1"><span>REGISTER</span></button>
                  <button class="tab-link current" data-tab="tab-2"><span>Log in</span></button>
                </div>
                <div id="tab-1" class="fl-tab-content">
                  <div class="tab-con-inr">
                    <form id="business-signup" onsubmit="BusinessSubmitSignupFormData(); return false">
                      <input type="hidden" name="action" value="business_create_account">
                        <div class="fl-input-field-row sa-input">
                          <label>Email *</label>
                          <input type="email" name="email" id="business_email" placeholder="Your Email">
                          <span class="email_error error-msg"></span>
                        </div>
                        <div class="fl-input-field-row sa-input">
                          <label>Password *</label>
                          <input type="password" name="password" id="business_password" placeholder="Password">
                          <span class="pass_error error-msg"></span>
                        </div>
                        <div class="fl-submit-btn w-full">
                          <input type="hidden" name="business_register_nonce" value="<?php echo wp_create_nonce('business-register-nonce'); ?>"/>
                          <input type="submit" value="REGISTER">
                        </div>
                        
                      </form>
                  </div>
                </div>
                <div id="tab-2" class="fl-tab-content current">
                  <div class="tab-con-inr">
                    <div class="login-form">
                      <span id="loginerror" class="login-error"></span>
                      <span id="success-login" class="success-login"></span>
                      <form id="business-login" onsubmit="BusinessSubmitLoginFormData(); return false">
                        <input type="hidden" name="action" value="business_login_account">
                        <div class="fl-input-field-row sa-input">
                          <label>Email *</label>
                          <input type="email" name="email" id="login_user" placeholder="Your Email">
                          <span class="loginemail_error error-msg"></span>
                        </div>
                        <div class="fl-input-field-row sa-input">
                          <label>Password *</label>
                          <input type="password" name="password" id="login-password" placeholder="Password">
                          <span class="loginpass_error error-msg"></span>
                        </div>
                        <div class="fl-forget-row">
                          <a class="fl-forget-pass-btn" href="#">Forgot your password?</a>
                        </div>
                        <div class="fl-submit-btn w-full forgot-pass-field-before">
                          <input type="hidden" name="business_login_nonce" value="<?php echo wp_create_nonce('business-login-nonce'); ?>"/>
                          <input type="submit" value="Sign In">
                        </div>
                        </form>
                        <form id="forgotpass" onsubmit="SubmitForgotPass(); return false">
                          <input type="hidden" name="action" value="user_forgot_password">
                        <div class="forgot-pass-field-after">
                          <div class="sa-input">
                            <span class="useremail error-msg" style="display: none;"></span>
                            <span id="generatedSuccess" class="success-login" style="display: none;"></span>
                            <input type="email" name="useremail" id="useremail" placeholder="Enter your email">
                          </div>
                          <div class="profile-submit-btn clearfix">
                            <input type="hidden" name="user_forgot_pass_nonce" value="<?php echo wp_create_nonce('user-forgot-pass-nonce'); ?>"/>
                            <input type="submit" name="forgotpass" value="Send">
                          </div>
                        </div>
                        </form>
                        <div class="fl-or-text">
                          <span>Or</span>
                        </div>
                        <div class="fl-sign-in-another">
                        <?php 
                          if(isset($_GET['glogin']) && $_GET['glogin'] == 'business'){
                              business_social_login();
                          }
                          echo "<div class='fl-sign-in-another'><a class='gogle-login-btn' href='".home_url('business-login/?glogin=business')."'><i class='fab fa-google'></i> Login with Google </a></div>";
                        ?>
<!--                          <a class="linkedin-login-btn" href="#">
                            <i class="fab fa-linkedin-in"></i>
                            Sign In with LinkedIn
                          </a>-->
                        </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>    
  </section>
</div>
<?php get_footer(); ?>