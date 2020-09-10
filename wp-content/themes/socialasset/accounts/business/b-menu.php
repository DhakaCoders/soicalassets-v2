<?php 
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
  <button onclick='window.location.href = "<?php echo home_url('myaccount/supported-campaigns/'); ?>"'  class="tab-link <?php echo ($var1 == 'supported-campaigns') ? 'current' : ''; ?>"><span>Supported campaigns</span></button>
  <?php } ?>
</div>
</div>