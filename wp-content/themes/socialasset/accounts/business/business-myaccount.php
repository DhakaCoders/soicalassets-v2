<?php
global $msg, $wp_query;
defined( 'ABSPATH' ) || exit; 
include('b-header.php'); 
?>
<div class="gray-bg">
  <section class="business-profile-sec">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="business-profile-sec-iner width-1115">
             <?php 
              include('b-menu.php');
              $var1 = $wp_query->get( 'var1' );
              $var2 = $wp_query->get( 'var2' );
              if( isset($var1) && !empty($var1) ){
                if( $var1 == 'supported-campaigns'){
                  include('b-supported-campaigns.php');
                }else{
                  include('b-profile.php');
                }
              }else{
                include('b-profile.php');
              }
              ?>
            </div>
          </div>
        </div>
    </div>    
  </section>
</div>