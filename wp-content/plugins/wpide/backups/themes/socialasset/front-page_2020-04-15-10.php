<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2c6f0c8c7bfc"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/front-page.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/front-page_2020-04-15-10.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
  get_camp_header();
?>
<?php
  $slide = get_field('slidesec', HOMEID);
  if( $slide ): 
    $slideitems = $slide['slide'];
    if( $slideitems ): 
?>
<section class="hm-banner-slider-sec">
  <div class="hm-banner-slider">
    <?php 
      $scampbg_src = $scampleft_src = $snorm_src = '';
      foreach( $slideitems as $item ): 
        $scapm = $item['slidecampaign'];
        $snorm = $item['slidenormal'];
    ?>
    <?php 
      if($item['slide_type'] == 'campaign'): 
        if( !empty($scapm['bgimage']) ) 
          $scampbg_src = cbv_get_image_src($scapm['bgimage'], 'slidebg');
        if( !empty($scapm['image']) ) 
          $scampleft_src = cbv_get_image_src($scapm['image'], 'slidecapm');
    ?>
    <div class="hm-banner-slider-item hm-banner-design-1" style="background: url('<?php echo $scampbg_src; ?>')">
      <span class="hm-banner-slider-rb-icon">
        <img src="<?php echo THEME_URI; ?>/assets/images/hm-banner-slider-rb-icon.png" alt="">
      </span>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="hm-banner-slider-item-innr clearfix">
              <div class="hm-banner-slider-item-lft-bg hide-sm" style="background: url('<?php echo $scampleft_src; ?>')"></div>
              <div class="hm-banner-slider-item-rgt-des text-white">
              <?php 
                if( !empty($scapm['subtitle']) ) printf('<span class="actionaid-tag">%s</span>',$scapm['subtitle']);
                if( !empty($scapm['title']) ) printf('<h4>%s</h4>',$scapm['title']);
              ?>
              <?php 
                if( !empty($scapm['content']) ) echo wpautop( $scapm['content'] );

                $link = $scapm['link'];
                if( is_array( $link ) &&  !empty( $link['url'] ) ){
                  printf('<a href="%s" target="%s">%s</a>', $link['url'], $link['target'], $link['title']); 
                }
              ?>
              </div>
            </div>
          </div>
        </div>
      </div>    
    </div>
    <?php 
      else: 

      if( !empty($snorm['bgimage']) ) 
          $snorm_src = cbv_get_image_src($snorm['bgimage'], 'slidebg');
    ?>
    <div class="hm-banner-slider-item hm-banner-design-2" style="background: url('<?php echo $snorm_src; ?>')">
      <span class="hm-banner-slider-rb-icon">
        <img src="<?php echo THEME_URI; ?>/assets/images/hm-banner-slider-rb-icon.png" alt="">
      </span>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="hm-banner-slider-item-innr">
              <span class="sr-only-txt"></span>
              <?php 
                if( !empty($snorm['content']) ) printf('<h2>%s</h2>', $snorm['content']);
                $link = $snorm['link'];
                if( is_array( $link ) &&  !empty( $link['url'] ) ){
                  printf('<a href="%s" target="%s">%s</a>', $link['url'], $link['target'], $link['title']); 
                }
              ?>
            </div>
          </div>
        </div>
      </div>    
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
  </div>
  <a href="#hm-wc-social-assets-sec" class="hm-bnr-scroll"><img src="<?php echo THEME_URI; ?>/assets/images/hm-bnr-scroll.png" alt=""></a>  
</section>
<?php endif; endif; ?>
<?php
  $sassets = get_field('socialasset', HOMEID);
  $ngop_src = $bussp_src = $ngo_icon = $buss_icon = '';
  if( !empty($sassets['ngo_image']) ) 
    $ngop_src = cbv_get_image_src($sassets['ngo_image'], 'grid1');
  if( !empty($sassets['ngo_icon']) ) 
    $ngo_icon = cbv_get_image_tag($sassets['ngo_icon']);

  if( !empty($sassets['buss_image']) ) 
  $bussp_src = cbv_get_image_src($sassets['buss_image'], 'grid1');

  if( !empty($sassets['busicon']) ) 
    $buss_icon = cbv_get_image_tag($sassets['busicon']);
?>
<section class="hm-wc-social-assets-sec" id="hm-wc-social-assets-sec">
  <div class="hm-wc-social-assets-top">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="hm-wc-social-assets-top-innr text-center">
            <?php if( !empty($sassets['title']) ) printf('<h1>%s</h1>', $sassets['title']); ?>
            <?php 
            if( !empty($sassets['content']) ) echo wpautop( $sassets['content'] ); 
            $link3 = $sassets['link'];
            if( is_array( $link3 ) &&  !empty( $link3['url'] ) ){
              printf('<a href="%s" target="%s">%s</a>', $link3['url'], $link3['target'], $link3['title']); 
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <span class="hm-wc-social-assets-top-shape"></span>      
  </div>  
</section>


<section class="join-journey-section hm-join-journey-sec">
  <div class="container-xlg">
    <div class="row">
      <div class="col-sm-12">
        <div class="join-journey-section-inner">
          <div class="join-journey-sct-grid">
            <ul class="ulc clearfix">
              <li>
                <div class="join-journey-sct-grid-inner clearfix">
                  <div class="join-journey-sct-grid-img-top-wrap">
                    <div class="join-journey-sct-grid-img-top" style="background: url('<?php echo $ngop_src; ?>');">
                      <div class="jjsg-media-icon">
                        <?php echo $ngo_icon; ?>
                      </div>
                    </div>
                  </div>
                  <div class="jjsg-des-top-wrap">
                    <div class="jjsg-des-top">
                      <div class="jjsg-des">
                        <?php if( !empty($sassets['ngo_title']) ) printf('<h3>%s</h3>', $sassets['ngo_title']); ?>
                        <?php 
                        if( !empty($sassets['ngo_content']) ) echo wpautop( $sassets['ngo_content'] ); 
                        $link4 = $sassets['ngo_link'];
                        if( is_array( $link4 ) &&  !empty( $link4['url'] ) ){
                          printf('<a href="%s" target="%s">%s</a>', $link4['url'], $link4['target'], $link4['title']); 
                        }
                        ?>
                      </div>
                      <span><img src="<?php echo THEME_URI; ?>/assets/images/hm-join-journey-1.png" alt=""></span>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div class="join-journey-sct-grid-inner clearfix">
                  <div class="join-journey-sct-grid-img-bottom-wrap">
                    <div class="join-journey-sct-grid-img-bottom" style="background: url('<?php echo $bussp_src; ?>');">
                      <div class="jjsg-media-icon">
                        <?php echo $buss_icon; ?>
                      </div>
                    </div>
                  </div>
                  <div class="jjsg-des-bottom-wrap">
                    <div class="jjsg-des-bottom">
                      <div class="jjsg-des">
                        <?php if( !empty($sassets['buss_title']) ) printf('<h3>%s</h3>', $sassets['buss_title']); ?>
                        <?php 
                        if( !empty($sassets['buss_content']) ) echo wpautop( $sassets['buss_content'] ); 
                        $link5 = $sassets['busslink'];
                        if( is_array( $link5 ) &&  !empty( $link5['url'] ) ){
                          printf('<a href="%s" target="%s">%s</a>', $link5['url'], $link5['target'], $link5['title']); 
                        }
                        ?>
                      </div>
                      <span><img src="<?php echo THEME_URI; ?>/assets/images/hm-join-journey-2.png" alt=""></span>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php 
  if( !empty($sassets['user_image']) ) 
  $userp_src = cbv_get_image_src($sassets['user_image'], 'grid2');
?>
<section class="hm-user-support-sec">
  <div class="container-xlg">
    <div class="row">
      <div class="col-sm-12">
        <div class="hm-user-support-inner" style="background: url('<?php echo $userp_src; ?>');">
          <div class="hm-user-support-rgt-des hide-md">
            <?php if( !empty($sassets['user_title']) ) printf('<h3>%s</h3>', $sassets['user_title']); ?>
            <?php if( !empty($sassets['user_content']) ) echo wpautop( $sassets['user_content'] );

              $link6 = $sassets['userlink'];
              if( is_array( $link6 ) &&  !empty( $link6['url'] ) ){
                printf('<a href="%s" target="%s">%s</a>', $link6['url'], $link6['target'], $link6['title']); 
              }
            ?>
          </div>
        </div>
        <div class="hm-user-support-rgt-des show-md">
          <?php if( !empty($sassets['user_title']) ) printf('<h3>%s</h3>', $sassets['user_title']); ?>
          <?php if( !empty($sassets['user_content']) ) echo wpautop( $sassets['user_content'] );

            $link6 = $sassets['userlink'];
            if( is_array( $link6 ) &&  !empty( $link6['url'] ) ){
              printf('<a href="%s" target="%s">%s</a>', $link6['url'], $link6['target'], $link6['title']); 
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php 
  $upcamp = get_field('upcampaigns', HOMEID);
  $scamps = $upcamp['scamp'];
?>
<section class="upcoming-campaigns-sec">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="upcoming-campaigns-head text-center">
          <?php 
            if( !empty($upcamp['title']) ) printf('<h4>%s</h4>', $upcamp['title']); 
            if( !empty($upcamp['content']) ) echo wpautop( $upcamp['content'] );
          ?>
        </div>
        <?php if( $scamps ): ?>
        <div class="upcoming-campaigns-main">
          <div class="user-campaign-list-cntlr">
            <ul class=" ulc masonry">
              <?php $i = 1;
                $rel_term_name = $ClassAdd = '';  
                foreach( $scamps  as $scamp ): 
                  $attach_id = get_post_thumbnail_id( $scamp->ID );
                  if( !empty($attach_id) ){
                    $feaimg_src = cbv_get_image_src($attach_id, 'campgrid');
                  }else{
                    $feaimg_src = '';
                    $ClassAdd = ' only-des';
                  }
                  $rel_terms = get_the_terms( $scamp->ID, 'campaign' );
                  
                  if ( ! empty( $rel_terms ) ) {
                      foreach( $rel_terms as $rel_term ) {
                         $rel_term_name = $rel_term->name; 
                      }
                  }
              ?>
              <li class="campaigns-list-item-wrp <?php if( $i == 1 ) echo 'campaigns-list-item-50'; echo $ClassAdd; ?>">
                <div class="campaigns-list-item">
                  <?php if( !empty($feaimg_src)): ?>
                  <div class="campaigns-item-img" style="background: url(<?php echo $feaimg_src; ?>);"></div>
                  <?php endif; ?>
                  <?php if( ($i == 1) && empty($feaimg_src)): ?>
                  <div class="campaigns-item-img" style="background: url(<?php echo THEME_URI.'/assets/images/dfcampgrid.png'; ?>);"></div>
                  <?php endif; ?>
                  <div class="campaigns-item-des">
                    <div class="campaigns-item-des-inr">
                      <div class="campaigns-item-cat-name">
                        <?php if( !empty($rel_term_name) ) printf('<strong>%s</strong>', $rel_term_name); 
                        $scamIDs = array();
                        $scamIDs = get_camp_support_ids();
                        $user = wp_get_current_user();
                        if ( (in_array( 'subscriber', (array) $user->roles ) ) || ( in_array( 'business', (array) $user->roles ) ) && is_user_logged_in() ) {
                        ?>
                          <span id="hearts<?php echo $scamp->ID; ?>">
                        <?php if( !empty($scamIDs) && in_array( $scamp->ID, (array)$scamIDs ) ): ?>
                            <i class="far fa-check-circle"></i>
                        <?php else: ?>
                          <i class="far fa-heart"></i>
                        <?php endif; ?>
                          </span>
                        <?php }else {?>
                          <span><i class="far fa-heart"></i></span>
                        <?php } ?>
                      </div>
                      <div class="campaigns-item-des-btm">
                        <div>
                          <h6><?php echo $scamp->post_title; ?></h6>
                      <?php 
                        echo wpautop(get_custom_excerpt($scamp->post_content, 14)); 
                      ?>
                        </div>
                        <div class="campaigns-vote-info">
                          <div class="campaigns-vote-percentage-bar clearfix">
                            <div class="campaigns-vote-percentage-number"><span class="percentbar"><strong class="barcount"><?php echo camp_progress_bar($scamp->ID); ?></strong>% <strong class="supporterno"><?php echo total_support_count($scamp->ID); ?></strong></span></div>
                            <div class="campaigns-vote-percentage percentwidth">
                              <div>
                                <span style="width: <?php echo camp_progress_bar($scamp->ID); ?>%"></span>
                              </div>
                            </div>
                          </div>
                          <div class="months-left">
                          <?php if(date_remaining($scamp->ID)): ?>
                            <i class="far fa-clock"></i>
                            <span><?php echo date_remaining($scamp->ID); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="campaigns-list-item-des-hover">
                    <div class="campaigns-list-item-des-hover-inr">
                      <a class="overlay-link" href="<?php echo get_the_permalink($scamp->ID); ?>"></a>
                      <div class="campaigns-item-cat-name">
                        <?php if( !empty($rel_term_name) ) printf('<strong>%s</strong>', $rel_term_name); 
                        if ( (in_array( 'subscriber', (array) $user->roles ) ) || ( in_array( 'business', (array) $user->roles ) ) && is_user_logged_in() ) { 
                        ?>
                        <?php if( !empty($scamIDs) && in_array( $scamp->ID, (array)$scamIDs ) ): ?>
                        <span><i class="far fa-check-circle"></i></span>
                        <?php else: ?>
                          <span id="heartsup<?php echo $scamp->ID; ?>" onclick="UserAddSupportByHeart(<?php echo $scamp->ID; ?>); return false;"><i class="far fa-heart"></i></span>
                        <?php endif; ?>
                        <?php }else{ ?>
                          <span id="quickViewOpener" data-toggle="modal" data-target="#quickViewModal"><i class="far fa-heart"></i></span>
                        <?php } ?>
                      </div>
                      <div class="campaigns-list-item-des-hover-des">
                        <h6><?php echo $scamp->post_title; ?></h6>
                      <?php
                        if( !empty($feaimg_src)):  
                          echo wpautop(get_custom_excerpt($scamp->post_content, 30));
                        else:
                          echo wpautop(get_custom_excerpt($scamp->post_content, 14));
                        endif;
                      ?>
                      </div>
                      <div class="campaigns-vote-percentage-hover-bar">
                        <div class="campaigns-vote-info">
                          <div class="campaigns-vote-percentage-bar clearfix">
                            <div class="campaigns-vote-percentage-number"><span class="percentbar"><strong class="barcount"><?php echo camp_progress_bar($scamp->ID); ?></strong>% <strong class="supporterno"><?php echo total_support_count($scamp->ID); ?></strong></span></div>
                            <div class="campaigns-vote-percentage percentwidth">
                              <div>
                                <span style="width: <?php echo camp_progress_bar($scamp->ID); ?>%"></span>
                              </div>
                            </div>
                          </div>
                          <div class="months-left">
                          <?php if(date_remaining($scamp->ID)): ?>
                            <i class="far fa-clock"></i>
                            <span><?php echo date_remaining($scamp->ID); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </li>
              <?php $i++; endforeach; ?>
            </ul>
            <div class="show-more-btn">
              <a href="<?php echo home_url( 'campaigns' ); ?>">EXPLORE ALL CAMPAIGNS</a>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div> 
  <span class="hm-wc-social-assets-top-shape"></span> 
</section>

<?php 
$htermsg = get_field('ccategory', HOMEID);
$hterms = $htermsg['cselect'];
if ( ! empty( $hterms ) && ! is_wp_error( $hterms ) ):
?>
<section class="hm-explore-campaigns-sec">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="hm-explore-campaigns-innr text-center">
          <ul class="ulc clearfix">
            <?php 
                $i = 1;
                foreach ( $hterms as $hterm ) { 
                $thumbnail_id = get_field( 'image', $hterm, false );
                if( !empty($thumbnail_id) ){
                    $term_image = cbv_get_image_src($thumbnail_id);
                }
                else{
                   $term_image = THEME_URI .'/assets/images/campcat.png';
                }
                if( $i > 3 ){
                  $hmexcls = 'w-50';
                }else{
                  $hmexcls = '';
                }
            ?>
            <li class="<?php echo $hmexcls; ?>">
              <div class="hm-explore-campaigns-con">
                <div class="hm-explore-campaigns-con-bg" style="background: url(<?php echo $term_image; ?>)"></div>
                <div class="hm-explore-campaigns-des-wrp">
                  <div class="hm-explore-campaigns-des">
                    <strong><?php echo $hterm->name; ?> <br>Campaigns</strong>
                    <?php if( get_count_posts_by_cat('campaigns', $hterm->term_id) ): ?>
                    <span><?php echo get_count_posts_by_cat('campaigns', $hterm->term_id); ?> opened</span>
                    <?php else: echo '<span>0 opened</span>';endif; ?>
                  </div>                  
                </div>
                <a class="overlay-link" href="<?php echo esc_url( get_term_link($hterm) );?>"></a>
              </div>
            </li>
            <?php $i++; } ?>
          </ul>
          <div class="hm-explore-campaigns-link">
            <a class="hm-explore-btn" href="<?php echo home_url( 'campaigns' ); ?>">EXPLORE ALL CAMPAIGNS</a>
            <br>
            <a class="hm-campaign-btn" href="<?php echo home_url('account/?login=ngo'); ?>">START A CAMPAIGN</a>  
          </div>
        </div>
      </div>
    </div>
  </div>    
</section>
<?php endif; ?>
<?php 
  $testmls = get_field('testimonials', HOMEID);
  $quotes = $testmls['quote'];
?>

<section class="hm-testimonials-sec">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="hm-testimonials-innr">
          <div class="hm-testimonials-head text-center text-white">
          <?php 
            if( !empty($testmls['title']) ) printf('<h4>%s</h4>',$testmls['title']); 
            if( !empty($testmls['content']) ) echo wpautop( $testmls['content'] );
          ?>
          </div>
          <?php if( !empty($quotes) ): ?>
          <div class="hm-testimonials-slider dft-slider-dot-con">
            <?php 
              foreach( $quotes as $quote ): 
                $quote_tag = '';
                if( !empty($quote['image']) ) 
                  $quote_tag = cbv_get_image_tag($quote['image']);
            ?>
            <div class="hm-testimonials-slider-item">
              <i><?php echo $quote_tag; ?></i>              
              <?php if( !empty($quote['content']) ) echo wpautop( $quote['content'] ); ?>
              <div class="hm-testimonials-ftr">
                <?php 
                  if( !empty($quote['name']) ) printf('<span>%s</span>',$quote['name']);
                  if( !empty($quote['designation']) ) printf('<strong>%s</strong>',$quote['designation']);
                ?>              
              </div>
              <span class="top-q-icon"><img src="<?php echo THEME_URI; ?>/assets/images/testimonials-top-q-icon.png" alt=""></span>
              <span class="btm-q-icon"><img src="<?php echo THEME_URI; ?>/assets/images/testimonials-btm-q-icon.png" alt=""></span>
            </div>
            <?php endforeach; ?>
          </div>
          <span class="hm-testimonials-icon"><img src="<?php echo THEME_URI; ?>/assets/images/hm-testimonials-icon.png" alt=""></span>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>    
</section>

<?php 
  $csassets = get_field('csocialassets', HOMEID);
  $clogos = $csassets['clogo'];
?>
<section class="hm-partner-sec">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="hm-partner-innr">
          <div class="hm-partner-head text-center">
            <?php if( !empty($csassets['title']) ) printf('<h4>%s</h4>',$csassets['title']); ?>
          </div>
          <?php if( $clogos ): ?>
          <div class="hm-partner-slider clearfix dft-slider-dot-con">
            <?php 
              $clogo_tag = '';
              foreach( $clogos as $clogo ): 
                if( !empty($clogo['logo']) ) 
                  $clogo_tag = cbv_get_image_tag($clogo['logo']);
            ?>
            <div class="hm-partner-slider-item">
              <i><?php echo $clogo_tag; ?></i>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>    
</section>

<?php 
$blog = get_field('blog', HOMEID);

$blg_query = new WP_Query(array( 
    'post_type'=> 'post',
    'post_status' => 'publish',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order'=> 'desc'
  ) 
);
?>   
<section class="hm-blog-sec">
  <div class="container-md">
    <div class="row">
      <div class="col-12">
        <div class="hm-blog-innr">
          <div class="hm-blog-head text-center">
            <?php 
              if( !empty($blog['title']) ) printf('<h4>%s</h4>', $blog['title']); 
              if( !empty($blog['content']) ) echo wpautop( $blog['content'] );
            ?>
          </div>
          <?php if($blg_query->have_posts()): ?>
          <div class="hm-blog-grid-wrp clearfix">
            <?php 
              $blog_src = '';
              while($blg_query->have_posts()): $blg_query->the_post();
                
                $attach_id = get_post_thumbnail_id(get_the_ID());
                if( !empty($attach_id) )
                  $blog_src = cbv_get_image_src($attach_id,'bloggrid');
                else
                  $blog_src = THEME_URI .'/assets/images/blogdef.png';
            ?>
            <div class="hm-blog-grid-item">
              <div class="hm-blog-grid-item-innr">
                <div class="hm-blog-grid-bg">
                  <div class="hm-blog-grid-bg-main" style="background: url('<?php echo $blog_src; ?>');"></div>
                </div>
                <div class="hm-blog-grid-des mHc">
                  <h6><?php the_title();?></h6>
                  <?php the_excerpt();?>
                </div>
                <a href="<?php the_permalink();?>" class="overlay-link"></a>              
              </div>  
            </div>
            <?php endwhile; ?>
          </div>
          <div class="hm-blog-load-more text-center">
            <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">VIEW ALL ARTICLES</a>
          </div>
          <?php 
            endif;  
            wp_reset_postdata();
          ?>
        </div>
      </div>
    </div>
  </div>    
</section>
<?php get_footer(); ?>