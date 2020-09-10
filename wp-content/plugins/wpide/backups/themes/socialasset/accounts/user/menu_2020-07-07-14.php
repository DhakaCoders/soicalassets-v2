<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "76c595500ff78af9f16cf4dc19fc455ebcdabd7cfc"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/accounts/user/menu.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/accounts/user/menu_2020-07-07-14.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
global $wp_query;
$var1 = $wp_query->get( 'var1' );
?>
<div class="user-profile-sec-tab">
	<div class="fl-tabs clearfix">
	<?php if( isset($umetas['_show_my_profile']) && !empty($umetas['_show_my_profile']) && ( $umetas['_show_my_profile'] == 'true' )){?>
	  <button onclick='window.location.href = "<?php echo home_url('myaccount'); ?>"'  
	  	class="tab-link <?php echo ($var1 == '') ? 'current' : ''; ?>"><span>My ACCONT</span></button>
	  <?php } ?>
      <?php if( isset($umetas['_show_my_campaigns']) && !empty($umetas['_show_my_campaigns']) && ( $umetas['_show_my_campaigns'] == 'true' )){?>
	  <button onclick='window.location.href = "<?php echo home_url('myaccount/contributions/'); ?>"'  class="tab-link <?php echo ($var1 == 'contributions') ? 'current' : ''; ?>"><span>Contributions</span></button>
	  <?php } ?>
	</div>
</div>