<?php 
global $wp_query;
$var1 = $wp_query->get( 'var1' );
?>
<div class="user-profile-sec-tab">
  <div class="fl-tabs clearfix">
    <?php if( isset($umetas['_show_my_profile']) && !empty($umetas['_show_my_profile']) && ( $umetas['_show_my_profile'] == 'true' )){?>
    <button onclick='window.location.href = "<?php echo home_url('myaccount'); ?>"'  
        class="tab-link <?php echo ($var1 == '') ? 'current' : ''; ?>"><span>MY NGO’S PROFILE</span></button>
    <?php } ?>
    <?php if( isset($umetas['_show_my_campaigns']) && !empty($umetas['_show_my_campaigns']) && ( $umetas['_show_my_campaigns'] == 'true' )){?>
    <button onclick='window.location.href = "<?php echo home_url('myaccount/mycampaigns/'); ?>"'  
        class="tab-link <?php echo ($var1 == 'mycampaigns') ? 'current' : ''; ?>"><span>MY CAMPAIGNS</span></button>
    <?php } ?>
    <?php if( isset($umetas['_show_create_campaign']) && !empty($umetas['_show_create_campaign']) && ( $umetas['_show_create_campaign'] == 'true' )){?>
    <button onclick='window.location.href = "<?php echo home_url('myaccount/add-campaign/'); ?>"'  
        class="tab-link <?php echo ($var1 == 'add-campaign') ? 'current' : ''; ?>"><span>CREATE A CAMPAIGN</span></button>
    <?php } ?>
  </div>
</div>