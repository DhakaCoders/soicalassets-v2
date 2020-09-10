<?php
global $msg, $wp_query;
defined( 'ABSPATH' ) || exit; 
include('user-header.php'); 
?>
<div class="gray-bg">
  <section class="user-profile-sec">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="user-profile-sec-iner width-1115">
              <?php 
              include('menu.php');
              $var1 = $wp_query->get( 'var1' );
              $var2 = $wp_query->get( 'var2' );
              if( isset($var1) && !empty($var1) ){
                if( $var1 == 'contributions'){
                  include('user-contributions.php');
                }else{
                  include('user-profile.php');
                }
              }else{
                include('user-profile.php');
              }
              ?>

            </div>
          </div>
        </div>
    </div>    
  </section>
</div>