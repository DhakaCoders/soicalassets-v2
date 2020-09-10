<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2cb700d26e25"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/single-campaigns.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/single-campaigns_2020-04-19-22.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
get_camp_header(); 
while( have_posts() ): the_post();
$thisID = get_the_ID();

$categories = get_the_terms( $thisID, 'campaign' );
$term_name = $term_slug = $termlink = '';
if ( ! empty( $categories ) ) {
    foreach( $categories as $category ) {
       $term_name = $category->name; 
       $term_slug = $category->slug;
    }
}
$authorID = get_the_author_meta('ID');
$sumetas = array_map( function( $a ){ return $a[0]; }, get_user_meta( $authorID ) );
?>


<div id="customSidebar" class="hide-lg">
  <div class="miracle-plan-des-wrp">
    <div class="miracle-plan-des-innr">
    <?php if( !empty($term_name) ): ?>
      <span class="human-tag"><?php echo $term_name; ?></span>
  	  <?php endif; ?>
      <h3><?php the_title(); ?></h3>
      <?php echo wpautop( camp_excerpt(30, ''), true ); ?>
      <div class="miracle-plan-progress-camp">
        <ul class="ulc clearfix">
          <li>
            <?php 
                if( isset($sumetas['_profile_logo_id']) && !empty($sumetas['_profile_logo_id']) ){
              ?>
              <i><?php echo get_user_profile_logo_tag($sumetas['_profile_logo_id']);?></i> 
            <?php 
            } else{ 
                if( isset($sumetas['_ngo_name']) && !empty($sumetas['_ngo_name']) ) printf('<span class="ngoname">%s</span>', $sumetas['_ngo_name']);
            }
            ?>   
          </li>
          <?php if( get_count_posts_by_author('campaigns', $authorID) ): ?>
          <li>
            <span><?php echo get_count_posts_by_author('campaigns', $authorID); ?> Active Campaigns</span>
          </li>
          <?php else: ?>
          	<li>
            <span>0 Active Campaigns</span>
          </li>
          <?php endif; ?>
          
        </ul> 

            <?php 
              $location = get_field('ngolocation', $thisID);
                if( isset($location) && !empty($location) ){
             ?>
          <div class="ngolocation">
              <span><strong>Location: </strong><?php echo $location;?></span>          
          </div>
          <?php } ?> 
        <hr>
        <div id="campaing-progress-bar" class="miracle-plan-progress-bar-con">
          <div class="miracle-plan-progress-top-des clearfix">
            <span>Support</span>
            <span class="percentbar"><strong class="progress-par barcount"><?php echo camp_progress_bar($thisID); ?></strong>% <strong class="supporterno"><?php echo total_support_count(get_the_ID()); ?></strong></span>
          </div>
          <div class="miracle-plan-progress-main percentwidth">
            <span style="width: <?php echo camp_progress_bar($thisID); ?>%"></span>
          </div>
          <div class="miracle-plan-progress-btm-des">
            <?php 
              if(date_remaining($thisID)):
            ?>
            <span><?php echo date_remaining($thisID);?></span>
            <?php endif; ?>
          </div>
          <div class="miracle-plan-progress-link-wrp">
        	<div class="btnVariations">
          <?php if( camp_expire_date($thisID) ){ ?>
            <span class="support-btn status-btn-expired"><i class="far fa-clock"></i>Fulfilled</span>
        	<?php 
          }
          else{ 
          ?>
      		<?php 
            $scamIDs = array();
            $user = wp_get_current_user();
            $scamIDs = get_camp_support_ids();

            if ( (in_array( 'subscriber', (array) $user->roles ) ) || ( in_array( 'business', (array) $user->roles ) ) && is_user_logged_in() ) {
      		?>
          <?php 
            if( !empty($scamIDs) && in_array( $thisID, (array)$scamIDs ) ): 
          ?>
        		<a class="supportedbyUser support-btn support-capm" href="#" onclick="return false;"><i class="fas fa-heart"></i>SUPPORTED BY YOU</a>
          <?php else: ?>
            <a class="support-btn support-capm" id="supportUser" href="#" onclick="UserAddSupport(<?php echo $thisID; ?>); return false;"><i class="far fa-heart"></i>SUPPORT THIS CAMPAIGN</a><span id="supportStatus"></span>
          <?php endif; ?>
      		<?php 
          }
          elseif( (in_array( 'administrator', (array) $user->roles ) || in_array( 'ngo', (array) $user->roles ) ) && is_user_logged_in()){ 
          
          }
          else{ 
          ?>
        	  <a class="support-btn" id="quickViewOpener" data-toggle="modal" data-target="#quickViewModal" href="javascript:void(0)"><i class="far fa-heart"></i>SUPPORT THIS CAMPAIGN</a>
        	<?php } ?>
            
        	<?php } ?>
        </div>
            <div class="share-btn" >SHARE 
              <span class="share-btn-dot"></span>
              <div class="share-icons">
                <a href="#">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
                <a href="#">
                  <i class="fas fa-envelope"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="mgsBar">
          <?php 
            if( !empty($scamIDs) && in_array( $thisID, (array)$scamIDs ) ){
              echo '<p class="text-supportedbyUser">Hey, you have followed this campaign!</p>';
            }
          ?>
          </div>
        </div>
      </div>               
    </div>   
  </div>  
</div>

<section class="miracle-plan-sec">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php 
          if(
            isset($_GET['preview_id']) && 
            isset($_GET['preview']) && 
            ($_GET['preview'] = 'true') && 
            ( !empty($_GET['preview']) ) &&
            ( !empty($_GET['preview_id']) ) 
          ): 
        ?>
        <div class="previewBack"><a class="backto-panel" href="<?php echo esc_url(home_url('myaccount/edit-campaign/'.$thisID));?>">BACK TO YOUR PANEL</a></div>
        <?php endif; ?>
        <div class="miracle-plan-innr clearfix">
          <div class="miracle-plan-slider-wrp">
            <div class="miraclePlanBigSlider">
      			<?php 
      			  $cam_galleries = get_field('campaign_gallery', $thisID);
      			  $gallery_src = '';
      			  if($cam_galleries && !empty($cam_galleries)){
      			    //var_dump($cam_galleries);
      			    foreach( $cam_galleries as $gallery_id ):

      			      if(isset($gallery_id['id']) && !empty($gallery_id['id'])){
      			        $g_id = $gallery_id['id'];
      			      }elseif(isset($gallery_id) && !empty($gallery_id)){
      			        $g_id = $gallery_id;
      			      }
      			    if( !empty($g_id) ){
      			      $gallery_src = cbv_get_image_src($g_id, 'full');
      			    }
      			?>
              <div class="miraclePlanBigSlider-item">
                <?php 
                if(is_capm_video($g_id)): 
                    if( !empty( get_camp_video_url( $g_id ) ) ){
                      $vtag = "class='img-zoom' data-fancybox='Miracle Plan' href='{get_camp_video_url( $g_id )}'";
                    }else{
                      $vtag = "class='no-video'";
                    }
                ?>
                  <!--<video width="750" height="480" controls>
                    <source src="" type="video/mp4">
                  </video>-->
                    <div class="fancybox-video">
                        <a <?php echo $vtag; ?>>
                            <span>
                            <i><img src="<?php echo THEME_URI; ?>/assets/images/plan-play.png" alt=""></i>     
                            </span>  
                          <div class="miracle-plan-video-bg" style="background-image: url();">
                            <!--<span class="playbutton"><i class="fa fa-play-circle"></i></span>-->
                          </div>
                        </a>
                    </div>
                <?php else: ?>
                <div class="miraclePlanBigSlider-item-bg" style="background: url('<?php echo $gallery_src; ?>')">
                </div>
                <?php endif; ?>
              </div>
              <?php endforeach; ?>
          	<?php 
          		}else{ 
          		  $attach_id = get_post_thumbnail_id( $thisID );
		          $featured_src = '';
		          if( !empty($attach_id) ){
		            $featured_src = cbv_get_image_src($attach_id, 'full');
		          }
          	?>
          	<div class="miraclePlanBigSlider-item">
                <div class="miraclePlanBigSlider-item-bg" style="background: url('<?php echo $featured_src; ?>')">
                </div>
             </div>
          	<?php } ?>
          	
          	   <?php 
                    $video_urls = get_post_meta( $thisID, 'video_urls', true ); 
                    if( $video_urls ): 
                    foreach( $video_urls as $video_url ):
                        if( !empty( $video_url ) ){
                          $atag = "class='img-zoom' data-fancybox='Miracle Plan' href='{$video_url}'";
                        }else{
                          $atag = "class='no-video'";
                        }
                ?>
                <div class="miraclePlanBigSlider-item">
                    <div class="fancybox-video">
                        <a <?php echo $atag; ?>>
                            <span>
                            <i><img src="<?php echo THEME_URI; ?>/assets/images/plan-play.png" alt=""></i>     
                            </span>  
                          <div class="miracle-plan-video-bg" style="background-image: url(<?php echo get_video_fullsize($video_url); ?>);">
                            <!--<span class="playbutton"><i class="fa fa-play-circle"></i></span>-->
                          </div>
                        </a>
                     </div>
                </div>
                <?php endforeach; endif;?>
            </div>
            
            <div class="miraclePlanthumbSlider clearfix">
              <?php if($cam_galleries){ ?>
              <?php
                $gallery_src = ''; 
        				foreach( $cam_galleries as $gallery_id ):

        				if(isset($gallery_id['id']) && !empty($gallery_id['id'])){
        				$g_id = $gallery_id['id'];
        				}elseif(isset($gallery_id) && !empty($gallery_id)){
        				$g_id = $gallery_id;
        				}
      			    if( !empty($g_id) ){
      			      $gallery_src = cbv_get_image_src($g_id, 'thumbnail');
      			    }
              ?>
              <span class="miraclePlanthumbSlider-item">
                 <?php if(is_capm_video($g_id)): ?>
                  <video width="60" height="60" controls>
                    <source src="<?php echo get_camp_video_url( $g_id ); ?>" type="video/mp4">
                  </video>
                <?php else: ?>
                <?php echo $gallery_tag; ?>
                <div class="thumb-item-bg" style="background: url('<?php echo $gallery_src; ?>')">
                </div>
                <?php endif; ?>
              </span>
              <?php endforeach; ?>
              <?php } ?>
            <?php 
            if( $video_urls ): 
            foreach( $video_urls as $video_url ):
                if( !empty($video_url) ):
            ?>
            <span class="miraclePlanthumbSlider-item">
               <div class="thumb-item-bg" style="background: url('<?php echo get_video_thumbnail($video_url); ?>')"></div>
            </span>
            <?php endif; endforeach; endif;?>
            </div>
        	

          </div>
          <div class="miracle-plan-des-wrp show-lg">
            <div class="miracle-plan-des-innr">
              <?php if( !empty($term_name) ): ?>
              <span class="human-tag"><?php echo $term_name; ?></span>
          	  <?php endif; ?>
              <h3><?php the_title(); ?></h3>
              <?php echo wpautop( camp_excerpt(30, ''), true ); ?>
              <div class="miracle-plan-progress-camp">
                <ul class="ulc clearfix">
                  <li>
                    <?php 
  	                  if( isset($sumetas['_profile_logo_id']) && !empty($sumetas['_profile_logo_id']) ){
  	                ?>
	                  <i><?php echo get_user_profile_logo_tag($sumetas['_profile_logo_id']);?></i> 
	                <?php 
	                } else{ 
	                    if( isset($sumetas['_ngo_name']) && !empty($sumetas['_ngo_name']) ) printf('<span class="ngoname">%s</span>', $sumetas['_ngo_name']);
	                }
	                ?>   
                  </li>
                  <?php if( get_count_posts_by_author('campaigns', $authorID) ): ?>
                  <li>
                    <span><?php echo get_count_posts_by_author('campaigns', $authorID); ?> Active Campaigns</span>
                  </li>
                  <?php else: ?>
                  	<li>
                    <span>0 Active Campaigns</span>
                  </li>
                  <?php endif; ?>
                  
                </ul> 

                    <?php 
                      $location = get_field('ngolocation', $thisID);
  	                  if( isset($location) && !empty($location) ){
  	               ?>
                  <div class="ngolocation">
	                  <span><strong>Location: </strong><?php echo $location;?></span>          
                  </div>
                  <?php } ?> 
                <hr>
                <div id="campaing-progress-bar" class="miracle-plan-progress-bar-con">
                  <div class="miracle-plan-progress-top-des clearfix">
                    <span>Support</span>
                    <span class="percentbar"><strong class="progress-par barcount"><?php echo camp_progress_bar($thisID); ?></strong>% <strong class="supporterno"><?php echo total_support_count(get_the_ID()); ?></strong></span>
                  </div>
                  <div class="miracle-plan-progress-main percentwidth">
                    <span style="width: <?php echo camp_progress_bar($thisID); ?>%"></span>
                  </div>
                  <div class="miracle-plan-progress-btm-des">
                    <?php 
                      if(date_remaining($thisID)):
                    ?>
                    <span><?php echo date_remaining($thisID);?></span>
                    <?php endif; ?>
                  </div>
                  <div class="miracle-plan-progress-link-wrp">
                	<div class="btnVariations">
                  <?php if( camp_expire_date($thisID) ){ ?>
                    <span class="support-btn status-btn-expired"><i class="far fa-clock"></i>Fulfilled</span>
                	<?php 
                  }
                  else{ 
                  ?>
              		<?php 
                    $scamIDs = array();
                    $user = wp_get_current_user();
                    $scamIDs = get_camp_support_ids();

                    if ( (in_array( 'subscriber', (array) $user->roles ) ) || ( in_array( 'business', (array) $user->roles ) ) && is_user_logged_in() ) {
              		?>
                  <?php 
                    if( !empty($scamIDs) && in_array( $thisID, (array)$scamIDs ) ): 
                  ?>
                		<a class="supportedbyUser support-btn support-capm" href="#" onclick="return false;"><i class="fas fa-heart"></i>SUPPORTED BY YOU</a>
                  <?php else: ?>
                    <a class="support-btn support-capm" id="supportUser" href="#" onclick="UserAddSupport(<?php echo $thisID; ?>); return false;"><i class="far fa-heart"></i>SUPPORT THIS CAMPAIGN</a><span id="supportStatus"></span>
                  <?php endif; ?>
              		<?php 
                  }
                  elseif( (in_array( 'administrator', (array) $user->roles ) || in_array( 'ngo', (array) $user->roles ) ) && is_user_logged_in()){ 
                  
                  }
                  else{ 
                  ?>
                	  <a class="support-btn" id="quickViewOpener" data-toggle="modal" data-target="#quickViewModal" href="javascript:void(0)"><i class="far fa-heart"></i>SUPPORT THIS CAMPAIGN</a>
                	<?php } ?>
                    
                	<?php } ?>
                </div>
                    <div class="share-btn" >SHARE 
                      <span class="share-btn-dot"></span>
                      <div class="share-icons">
                        <a href="#">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#">
                          <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#">
                          <i class="fas fa-envelope"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="mgsBar">
                  <?php 
                    if( !empty($scamIDs) && in_array( $thisID, (array)$scamIDs ) ){
                      echo '<p class="text-supportedbyUser">Hey, you have followed this campaign!</p>';
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
  </div>     
</section>


<section class="user-story-cmpaign-sec">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="user-story-cmpaign-con">
          <h3>Story Campaign</h3>
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div>    
</section>
<?php
if( !empty($term_slug) ):
$query = new WP_Query(array( 
    'post_type'=> 'campaigns',
    'post_status' => 'publish',
    'posts_per_page' => 4,
    'orderby' => 'date',
    'order'=> 'DESC',
    'post__not_in'   => array( $thisID ),
    'tax_query' => array(
      array(
        'taxonomy' => 'campaign',
        'field' => 'slug',
        'terms' => $term_slug
      )
    )
  ) 
);
if($query->have_posts()):
?>
<section class="user-rel-camp-sec">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="user-rel-camp-innr">
          <div class="user-rel-camp-head text-center">
            <h4>Relevant Campaigns</h4>
            <p>You may also be interested in</p>
          </div>
          <div class="upcoming-campaigns-main">
            <div class="user-campaign-list-cntlr">
              <ul class=" ulc clearfix">
                <?php 
                  $ClassAdd = '';
                  while($query->have_posts()): $query->the_post(); 
                  $attach_id = get_post_thumbnail_id(get_the_ID());
                  if( !empty($attach_id) ){
                    $feaimg_src = cbv_get_image_src($attach_id, 'campgrid');
                  }else{
                    $feaimg_src = '';
                    $ClassAdd = ' only-des';
                  }
                  $rel_terms = get_the_terms( get_the_ID(), 'campaign' );
                  $rel_term_name = '';
                  if ( ! empty( $rel_terms ) ) {
                      foreach( $rel_terms as $rel_term ) {
                         $rel_term_name = $rel_term->name; 
                      }
                  }
                ?>
                <li class="campaigns-list-item-wrp<?php echo $ClassAdd; ?>">
                  <div class="campaigns-list-item">
                    <?php if( !empty($feaimg_src) ): ?>
                    <div class="campaigns-item-img" style="background: url(<?php echo $feaimg_src; ?>);"></div>
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
                            <span id="hearts<?php echo get_the_ID(); ?>">
                          <?php if( !empty($scamIDs) && in_array( get_the_ID(), (array)$scamIDs ) ): ?>
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
                            <h6><?php the_title(); ?></h6>
                            <?php echo wpautop( camp_excerpt(14, ''), true ); ?>
                          </div>
                          <div class="campaigns-vote-info">
                            <div class="campaigns-vote-percentage-bar clearfix">
                              <div class="campaigns-vote-percentage-number"><span class="percentbar"><strong class="barcount"><?php echo camp_progress_bar(get_the_ID()); ?></strong>% <strong class="supporterno"><?php echo total_support_count(get_the_ID()); ?></strong></span></div>
                              <div class="campaigns-vote-percentage percentwidth">
                                <div>
                                  <span style="width: <?php echo camp_progress_bar(get_the_ID()); ?>%"></span>
                                </div>
                              </div>
                            </div>
                            <div class="months-left">
                            <?php if(date_remaining(get_the_ID())): ?>
                              <i class="far fa-clock"></i>
                              <span><?php echo date_remaining(get_the_ID()); ?></span>
                            <?php endif; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="campaigns-list-item-des-hover">
                      <div class="campaigns-list-item-des-hover-inr">
                        <a class="overlay-link" href="<?php the_permalink(); ?>"></a>
                        <div class="campaigns-item-cat-name">
                          <?php if( !empty($rel_term_name) ) printf('<strong>%s</strong>', $rel_term_name); 
                          if ( (in_array( 'subscriber', (array) $user->roles ) ) || ( in_array( 'business', (array) $user->roles ) ) && is_user_logged_in() ) { 
                          ?>
                          <?php if( !empty($scamIDs) && in_array( get_the_ID(), (array)$scamIDs ) ): ?>
                          <span><i class="far fa-check-circle"></i></span>
                          <?php else: ?>
                            <span id="heartsup<?php echo get_the_ID(); ?>" onclick="UserAddSupportByHeart(<?php echo get_the_ID(); ?>); return false;"><i class="far fa-heart"></i></span>
                          <?php endif; ?>
                          <?php }else{ ?>
                            <span id="quickViewOpener" data-toggle="modal" data-target="#quickViewModal"><i class="far fa-heart"></i></span>
                          <?php } ?>
                        </div>
                        <div class="campaigns-list-item-des-hover-des">
                          <h6><?php the_title(); ?></h6>
                          <?php if( !empty($feaimg_src) ): ?>
                          <?php echo wpautop( camp_excerpt(30, ''), true ); ?>
                          <?php else: ?>
                            <?php echo wpautop( camp_excerpt(14, ''), true ); ?>
                          <?php endif; ?>
                        </div>
                        <div class="campaigns-vote-percentage-hover-bar">
                          <div class="campaigns-vote-info">
                            <div class="campaigns-vote-percentage-bar clearfix">
                              <div class="campaigns-vote-percentage-number"><span class="percentbar"><strong class="barcount"><?php echo camp_progress_bar(get_the_ID()); ?></strong>% <strong class="supporterno"><?php echo total_support_count(get_the_ID()); ?></strong></span></div>
                              <div class="campaigns-vote-percentage percentwidth">
                                <div>
                                  <span style="width: <?php echo camp_progress_bar(get_the_ID()); ?>%"></span>
                                </div>
                              </div>
                            </div>
                            <div class="months-left">
                            <?php if(date_remaining(get_the_ID())): ?>
                              <i class="far fa-clock"></i>
                              <span><?php echo date_remaining(get_the_ID()); ?></span>
                            <?php endif; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <?php endwhile; ?>
              </ul>
              <div class="show-more-btn">
                <a href="<?php echo esc_url( get_term_link($term_slug, 'campaign') );?>">SHOW MORE</a>
              </div>
            </div>
          </div>          
        </div>  
      </div>
    </div>
  </div>     
</section>
<?php 
endif;  
wp_reset_postdata();
endif;
?>
<?php endwhile; ?>
<?php get_footer(); ?>