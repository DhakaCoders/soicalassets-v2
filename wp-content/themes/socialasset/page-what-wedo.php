<?php 
/*
  Template Name: What Wedo
*/
  get_camp_header();
  $thisID = get_the_ID();
  get_template_part( 'templates/page', 'banner' );
?>
<?php
  $intro = get_field('introsec', $thisID);

  $vposter_tag = '';
  if( !empty($intro['poster']) ) $vposter_tag = cbv_get_image_tag($intro['poster'], 'vposter');

  if( !empty($intro['video_url']) ):
    $video_url = $intro['video_url'];
    $poster_tag = '<a data-fancybox href="{$video_url}">';
    $poster_tag .= $vposter_tag;
    $poster_tag .= '</a>';
  else:
    $poster_tag = $vposter_tag;
  endif;
?>
<section class="wwd-des-section">
  <div class="wwd-des-grey-bg"></div>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="wwd-desc-sct-inner">
          <?php if( !empty($intro['content']) ) echo wpautop( $intro['content'] ); ?>
          <div class="video-play">
            <?php echo $poster_tag; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php 
  $ideam = get_field('ideamarket', $thisID);
  $ngop_src = $bussp_src = $ngo_icon = $buss_icon = '';
  if( !empty($ideam['ngo_image']) ) 
    $ngop_src = cbv_get_image_src($ideam['ngo_image'], 'grid1');
  if( !empty($ideam['ngo_icon']) ) 
    $ngo_icon = cbv_get_image_tag($ideam['ngo_icon']);

  if( !empty($ideam['buss_image']) ) 
  $bussp_src = cbv_get_image_src($ideam['buss_image'], 'grid1');

  if( !empty($ideam['busicon']) ) 
    $buss_icon = cbv_get_image_tag($ideam['busicon']);
?>
<section class="join-journey-section">
  <div class="container-xlg">
    <div class="row">
      <div class="col-sm-12">
        <div class="join-journey-section-inner">
          <div class="join-journey-sct-title">
            <?php if( !empty($ideam['title']) ) printf('<h3>%s</h3>', $ideam['title']); ?>
          </div>
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
                        <?php if( !empty($ideam['ngo_title']) ) printf('<h3>%s</h3>', $ideam['ngo_title']); ?>
                        <?php if( !empty($ideam['ngo_content']) ) echo wpautop( $ideam['ngo_content'] ); ?>
                      </div>
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
                        <?php if( !empty($ideam['buss_title']) ) printf('<h3>%s</h3>', $ideam['buss_title']); ?>
                        <?php if( !empty($ideam['buss_content']) ) echo wpautop( $ideam['buss_content'] ); ?>
                      </div>
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
  if( !empty($ideam['users_image']) ) 
  $userp_src = cbv_get_image_src($ideam['users_image'], 'grid2');
?>
<section class="wwd-user-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="wwd-user-sec-wrap">
          <div class="wwd-user-sec-inner">
            <div class="wwd-user-sec-img" style="background: url('<?php echo $userp_src; ?>');">
              
            </div>
            <div class="wwd-user-sec-rgt">
              <div class="wwd-user-sec-rgt-inner">
                <div class="wwd-user-sec-rgt-des">
                  <?php if( !empty($ideam['users_title']) ) printf('<h3>%s</h3>', $ideam['users_title']); ?>
                  <?php if( !empty($ideam['users_content']) ) echo wpautop( $ideam['users_content'] );

                    $link = $ideam['link'];
                    if( is_array( $link ) &&  !empty( $link['url'] ) ){
                      printf('<a href="%s" target="%s">%s<i><img src="'.THEME_URI.'/assets/images/wwd-right.png"></i></a>', $link['url'], $link['target'], $link['title']); 
                    }

                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php 
  $mcampaigns = get_field('make_campaigns', $thisID);
  $mtypes = $mcampaigns['user_type'];
  $ngop_src = $bussp_src = '';
  if( !empty($ideam['ngo_image']) ) 
    $ngop_src = cbv_get_image_src($ideam['ngo_image'], 'grid1');
?>
<section class="wwd-campaigns-sec">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="wwd-campaigns-sec-inner">
          <div class="wwd-campaigns-title">
            <h3>Ready to make Campaigns <br> work for you?</h3>
            <?php if( !empty($mcampaigns['users_title']) ) printf('<h3>%s</h3>', $mcampaigns['users_title']); ?>
          </div>
          <?php if( !empty($mtypes) ): ?>
          <div class="wwd-campaigns-grid-item">
            <ul class="ulc clearfix">
              <?php 
              $utypeicon = '';
              foreach( $mtypes as $mtype ): 
                if( !empty($mtype['icon']) ) 
                  $utypeicon = cbv_get_image_tag($mtype['icon']);
              ?>
              <li>
                <div class="wwd-campaigns-grid-item-wrap">
                  <div class="wwd-campaigns-grid-item-icon">
                    <?php echo $utypeicon; ?>
                  </div>
                  <div class="wwd-campaigns-grid-item-des">
                  <?php 
                  if( !empty($mtype['title']) ) printf('<h6>%s</h6>', $mtype['title']); 
                  if( !empty($mtype['content']) ) echo wpautop( $mtype['content'] );
                  ?>
                  </div>
                </div>
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