<?php 
/*
  Template Name: About
*/
  get_camp_header();
  $thisID = get_the_ID();
 get_template_part( 'templates/page', 'banner' );
?>
<?php
  $intro = get_field('introsec', $thisID);
  $intro_src1 = $intro_src2 = $intro_src2 = '';
?>
<section class="about-story-sec">
  <div class="about-story-des">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="about-story-des-main text-center">
            <?php 
              if( !empty($intro['title']) ) printf('<h3>%s</h3>', $intro['title']); 
              if( !empty($intro['content']) ) echo wpautop( $intro['content'] ); 
            ?>
          </div>
        </div>
      </div>
    </div>     
  </div>
  <div class="about-story-bg">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="about-story-bg-main">
            <?php 
              if( !empty($intro['image_1']) ): 
              $intro_src1 = cbv_get_image_src($intro['image_1'], 'abgrid3');
            ?>
            <div class="about-story-bg-1">
              <div class="about-story-bg-1-main m-auto" style="background: url('<?php echo $intro_src1; ?>')"></div>
            </div>
            <?php endif; ?>
            <?php 
              if( !empty($intro['image_2']) ): 
              $intro_src2 = cbv_get_image_src($intro['image_2'], 'abgrid4');
            ?>
            <div class="about-story-bg-2">
              <div class="about-story-bg-2-main" style="background: url('<?php echo $intro_src2; ?>')"></div>
            </div>
            <?php endif; ?>
            
            <div class="about-story-bg-3 clearfix">
              <?php 
                if( !empty($intro['image_3']) ): 
                $intro_src3 = cbv_get_image_src($intro['image_3'], 'abgrid5');
              ?>
              <div class="about-story-bg-3-main" style="background: url('<?php echo $intro_src3; ?>')"></div>
              <?php endif; ?>
              <div class="about-story-bg-logo">
                <i><img src="<?php echo THEME_URI; ?>/assets/images/about-story-logo.png" alt=""></i>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>     
  </div>   
</section> 

<?php
  $coreValue = get_field('core_values', $thisID);
  $corevalues = $coreValue['corevalues'];
?>
<section class="core-value-sec text-center text-white">
  <span class="core-value-lft-btm-bg">
    <img src="<?php echo THEME_URI; ?>/assets/images/core-value-lft-btm-icon.png" alt="">
  </span>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="core-value-head">
          <?php if( !empty($coreValue['title']) ) printf('<h2>%s</h2>', $coreValue['title']);?>
        </div>
      </div>
      <?php if( !empty($corevalues) ): ?>
        <?php 
          $coreicon = '';
          foreach( $corevalues as $corev ): 
          if( !empty($corev['icon']) ) 
            $coreicon = cbv_get_image_tag($corev['icon']);
        ?>
        <div class="col-md-4 col-sm-12">
        <div class="core-value-col-innr">
          <i><?php echo $coreicon; ?></i>
          <?php 
          if( !empty($corev['title']) ) printf('<h6>%s</h6>', $corev['title']);
          if( !empty($corev['content']) ) echo wpautop( $corev['content'] );
          ?>
        </div>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div> 
</section>
<?php
  $sosa = get_field('socialassets', $thisID);
  $sosas = $sosa['support_type'];
?>
<section class="abt-social-asset-sec">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="abt-social-asset-innr clearfix">
          <div class="abt-social-asset-lft">
            <?php 
              if( !empty($sosa['title']) ) printf('<h4>%s</h4>', $sosa['title']);
              if( !empty($sosa['content']) ) echo wpautop( $sosa['content'] );
            ?>
          </div>
          <?php if( !empty($sosas) ): ?>
          <div class="abt-social-asset-rgt">
            <ul class="ulc">
              <?php 
                $sosicon = '';
                foreach( $sosas as $sosar ): 
                if( !empty($sosar['icon']) ) 
                  $sosicon = cbv_get_image_tag($sosar['icon']);
              ?>
              <li>
                <i>
                  <?php echo $sosicon; ?>
                </i>
                <?php 
                  if( !empty($sosar['title']) ) printf('<h6>%s</h6>', $sosar['title']);
                  if( !empty($sosar['content']) ) echo wpautop( $sosar['content'] );
                ?>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div> 
</section>
<?php get_footer(); ?>