<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2c34568b2a2c"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/footer.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/footer_2020-04-19-19.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
  $spacialArry = array(".", "/", "+", " ");$replaceArray = '';
  $continfo = get_field('contactinfo', 'options');
  $adres =  $continfo['address'];
  $gmapsurl = $continfo['google_maps'];
  $e_mailadres = $continfo['emailaddress'];
  $show_telefoon = $continfo['telephone'];
  $telefoon = trim(str_replace($spacialArry, $replaceArray, $show_telefoon));
  $copyright_text = get_field('copyright_text', 'options');
  $gmaplink = !empty($gmapsurl)?$gmapsurl: 'javascript:void()';
  $smedias = get_field('socialmedia', 'options');
?>
<footer class="footer-wrp">
  <div class="ftr-main">
    <div class="container-lg">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="ftr-col-1">
            <?php _e('<h5>Get in Touch</h5>', THEME_NAME);?>
            <ul class="ulc">
              <?php if( !empty( $adres ) ) printf('<li><a href="%s">%s</a></li>', $gmaplink, $adres);  ?>
              <?php if( !empty( $show_telefoon ) ) printf('<li><a href="tel:%s">T. &nbsp; %s</a></li>', $telefoon, $show_telefoon);  ?>
              <?php if( !empty( $e_mailadres ) ) printf('<li><a href="mailto:%s">E. %s</a></li>', $e_mailadres, $e_mailadres);  ?>
            </ul> 
            <div class="ftr-social">
              <?php 
                if(!empty($smedias)): 
                foreach($smedias as $smedia): 
              ?>
                <a target="_blank" href="<?php echo $smedia['url']; ?>">
                  <?php echo $smedia['icon']; ?>
                </a>
              <?php 
                endforeach; 
                endif; 
              ?>
            </div>        
          </div>
        </div>
        <div class="col-md-6 col-sm-12 clearfix">
          <div class="ftr-col-2">
            <h5>Subscribe to our Newsletter</h5>
            <p>By subscribing here, you will receive our newsletters. You can unsubscribe at any time by following the link at the bottom of each newsletter.</p>
            <div class="nl-from-wrp">
              <form action="">
                <input type="email" placeholder="Type your email here">
                <button><i class="fas fa-long-arrow-alt-right"></i></button>
              </form>
            </div>
            <?php 
              $ftmenuOptions = array( 
                  'theme_location' => 'cbv_copyright_menu', 
                  'menu_class' => 'ulc clearfix',
                  'container' => 'copynav',
                  'container_class' => 'copynav'
                );
              wp_nav_menu( $ftmenuOptions ); 
            ?>
          </div>
        </div>
      </div>
    </div>   
  </div>
  <div class="ftr-btm">
    <div class="container-lg">
      <div class="row">
        <div class="col-6">
          <div class="ftr-btm-lft">
            <?php if( !empty( $copyright_text ) ) printf( '<span>%s</span>', $copyright_text); ?>  
          </div>
        </div>
        <div class="col-6">
          <div class="ftr-btm-rgt">
            <a href="#">
              <span class="creation-with-txt">Creation with <i class="fas fa-heart"></i> by </span>
              <img src="<?php echo THEME_URI; ?>/assets/images/wf-logo-black.png">
            </a>
          </div>
        </div>
      </div>
    </div>   
  </div>  
</footer>
<?php if( !is_user_logged_in() ): ?>

<div class="modal fade vn-modal-con-wrap qquickViewModal" id="quickViewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="fl-login-form">
        <div class="fl-tabs clearfix text-center">
          <button class="tab-link current" data-tab="tab-1"><span>REGISTER</span></button>
          <button class="tab-link" data-tab="tab-2"><span>Log in</span></button>
        </div>
        <div id="tab-1" class="fl-tab-content current">
          <div class="tab-con-inr">
                  
                <form id="user-signup" onsubmit="SubmitSignupFormData(); return false">
                  <input type="hidden" name="action" value="ngo_user_create_account">
                  <div class="register-hdr-con">
                    <strong>Create your free online account</strong>
                    <span>Already have an account? <a id="goSinginTab" href="#login">Sign in here</a></span>
                  </div>
                  <div class="register-type-btn">
                    <a href="javascript:void(0)" class="register-supporter-btn">I’m Supporter</a>
                    <a href="javascript:void(0)" class="register-ngo-btn">
                      Business</span>
                    </a>
                  </div>
                  <div class="register-type-con">
                      <div class="register-type-select">
                        <div class="sa-selctpicker-ctlr">
                          <select name="usertype" class="selectpicker" id="user-type-selection">
                              <option selected="" value="User">I’m Supporter</option>
                              <option selected="" value="Ngo">Business</option>
                          </select>
                        </div>
                      </div>
                      <div class="fl-input-field-row sa-input ngo-name showCntrl" id="showNgo">
                        <label>Business Name *</label>
                        <input type="text" name="yourname" placeholder="Business Name">
                        <span class="ngo_error error-msg"></span>
                      </div>
                      <div class="fl-input-field-row sa-input user-name showCntrl" id="showUser">
                        <label>Your Name *</label>
                        <input type="text" name="your_name" placeholder="Your Name">
                        <span class="name_error error-msg"></span>
                      </div>
                      <div class="fl-input-field-row sa-input">
                        <label>Email *</label>
                        <input type="email" name="email" placeholder="Your Email">
                        <span class="email_error error-msg"></span>
                      </div>
                      <div class="fl-input-field-row-grd clearfix">
                        <div class="fl-input-field-row sa-input">
                          <label>Create a password *</label>
                          <input type="password" name="user_password" id="password" placeholder="Password">
                        </div>
                        <div class="fl-input-field-row sa-input">
                          <label>Confirm password *</label>
                          <input type="password" name="confirm_password" id="confirm_password" placeholder="Password">
                        </div>
                        <span class="pass_match_error error-msg"></span>
                      </div>
                      <div class="agree-checkmark">
                        <div class="filter-check-row clearfix">
                          <input type="checkbox" id="agree" name="agree" value="yes" required="required">
                          <span class="checkmark"></span> 
                          <label for="agree"> I have read & agree to Terms of Service</label>
                        </div>
                      </div>
                      <div class="fl-submit-btn w-full">
                        <input type="hidden" name="user_ngo_register_nonce" value="<?php echo wp_create_nonce('user-ngo-register-nonce'); ?>"/>
                        <input type="submit" id="usersignup" value="Create Account">
                      </div>
                      <div class="fl-or-text">
                        <span>Or</span>
                      </div>
                      <?php global $authUrl; if (isset($authUrl)): ?>
                      <div class="fl-sign-in-another">
                        <a class="gogle-login-btn" href="<?php echo $authUrl; ?>">
                          <i class="fab fa-google"></i>
                          Sign In with Google
                        </a>
                      </div>
                      <?php endif; ?>
                    </div>
                  </form>
          </div>
        </div>
        <div id="tab-2" class="fl-tab-content">
          <div class="tab-con-inr">
            <div class="login-form">
                
                 <span id="mloginerror" class="login-error"></span>
                <span id="msuccess-login" class="success-login"></span>
                <form id="modal-login" onsubmit="SubmitModalFormData(); return false">
                  <input type="hidden" name="action" value="user_modal_login_account">
                <div class="fl-input-field-row sa-input">
                    <label>Email *</label>
                    <input type="email" name="memail" id="mloginuser" placeholder="Your Email">
                    <span class="loginemail_error error-msg"></span>
                </div>
                <div class="fl-input-field-row sa-input">
                  <label>Password *</label>
                    <input type="password" name="mpassword" id="mloginpassword" placeholder="Password">
                    <span class="loginpass_error error-msg"></span>
                </div>
                <div class="fl-forget-row">
                  <a class="fl-forget-pass-btn" href="#">Forgot your password?</a>
                </div>
                <div class="fl-submit-btn w-full forgot-pass-field-before">
                   <input type="hidden" name="user_modal_login_nonce" value="<?php echo wp_create_nonce('user-modal-login-nonce'); ?>"/>
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
                  <a class="gogle-login-btn" href="#">
                    <i class="fab fa-google"></i>
                    Sign In with Google
                  </a>
                  <a class="facebook-login-btn" href="#">
                    <i class="fab fa-facebook-square"></i>
                    Sign In with Facebook
                  </a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade vn-modal-con-wrap" id="quickViewModall" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-content">
          <div class="modal-login-form">
            <div class="login-form">
                <span id="mloginerror" class="login-error"></span>
                <span id="msuccess-login" class="success-login"></span>
                <form id="modal-login" onsubmit="SubmitModalFormData(); return false">
                  <input type="hidden" name="action" value="user_modal_login_account">
                  <div class="fl-input-field-row sa-input">
                    <label>Email *</label>
                    <input type="email" name="memail" id="mloginuser" placeholder="Your Email">
                    <span class="loginemail_error error-msg"></span>
                  </div>
                  <div class="fl-input-field-row sa-input">
                    <label>Password *</label>
                    <input type="password" name="mpassword" id="mloginpassword" placeholder="Password">
                    <span class="loginpass_error error-msg"></span>
                  </div>
                  <div class="fl-submit-btn w-full forgot-pass-field-before">
                    <input type="hidden" name="user_modal_login_nonce" value="<?php echo wp_create_nonce('user-modal-login-nonce'); ?>"/>
                    <input type="submit" value="Sign In">
                  </div>
                </form>
                <div class="fl-or-text">
                  <span>Or</span>
                </div>
                <div class="fl-sign-in-another">
                  <a class="gogle-login-btn" href="#">
                    <i class="fab fa-google"></i>
                    Sign In with Google
                  </a>
                  <a class="facebook-login-btn" href="#">
                    <i class="fab fa-facebook-square"></i>
                    Sign In with LinkedIn
                  </a>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<?php wp_footer(); ?>
<script>
    jQuery(function(){
        var sampleTags = ["<?php echo get_campaign_tags();?>"];
        // singleFieldTags2 is an INPUT element, rather than a UL as in the other 
        // examples, so it automatically defaults to singleField.
        jQuery('#singleFieldTags2').tagit({
            availableTags: sampleTags
        });
    });
</script>
</body>
</html>
