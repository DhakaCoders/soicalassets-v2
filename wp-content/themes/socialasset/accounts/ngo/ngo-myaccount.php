<?php
global $msg, $wp_query;
defined( 'ABSPATH' ) || exit; 
include('header.php'); 
?>
<div class="gray-bg">
  <section class="ngo-profile-sec">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="ngo-profile-sec-iner width-1115">
              <?php 
              include('menu.php');
              $var1 = $wp_query->get( 'var1' );
              $var2 = $wp_query->get( 'var2' );
              if( isset($var1) && !empty($var1) ){
                if( $var1 == 'mycampaigns'){
                  include('ngo-campaigns.php');
                }elseif($var1 == 'add-campaign'){
                  include('ngo-new-campaign.php');
                }elseif( $var1 == 'edit-campaign' && !empty($var2)){
                  include('ngo-edit-campaign.php');
                }elseif($var1 == 'edit-campaign'){
                  include('ngo-profile.php');
                }else{
                  include('ngo-profile.php');
                }
              }else{
                include('ngo-profile.php');
              }
              ?>

            </div>
          </div>
        </div>
    </div>    
  </section>
</div>