<?php 
get_camp_header(); 
while( have_posts() ): the_post();
$thisID = get_the_ID();

$authorID = get_the_author_meta('ID');
$sumetas = array_map( function( $a ){ return $a[0]; }, get_user_meta( $authorID ) );
$bcontent = !empty(get_field('profile_content', $thisID))? get_field('profile_content', $thisID): '';
?>

<section class="s2-page-bnr-cntlr inline-bg" style="background: url(<?php echo THEME_URI;?>/assets/images/page-bnr-NGO-profile.jpg);">
	<div class="s2-page-bnr-con">
		<h1 class="s2-page-bnr-title"><?php the_title(); ?></h1>
	</div>

	<div class="bnr-circle">
	<?php 
		if( isset($sumetas['_profile_logo_id']) && !empty($sumetas['_profile_logo_id']) ){
			echo get_user_profile_logo_tag($sumetas['_profile_logo_id'], 'full');
		}
	?>
	</div>

</section>

<?php 
$m_title = !empty(get_field('mission_title', $ngo_data->ID))? get_field('mission_title', $thisID): '';
$mcontent = !empty(get_field('mission_content', $ngo_data->ID))? get_field('mission_content', $thisID): '';
$mposterID = !empty(get_field('vposter', $ngo_data->ID))? get_field('vposter', $thisID): '';
$mvideo_url = !empty(get_field('video_url', $ngo_data->ID))? get_field('video_url', $thisID): '';
$mbcontent = !empty(get_field('btm_content', $ngo_data->ID))? get_field('btm_content', $thisID): '';
?>

<section class="s2-ngo-profile-page-cntlr">
	<div class="container">
		<div class="row"> 
			<div class="col-sm-12">
				<div class="s2-ngo-profile-block">
					<div class="s2-ngo-profile-entry-hdr">
						<?php if( !empty($m_title) ) printf('<h2 class="s2npeh-title">%s</h2>', $m_title) ?>
						<?php echo wpautop($mcontent); ?>
					</div>
					<div class="our-follow-impact">
						<ul class="ulc">
							<li>
								<div class="our-follow-impact-grd">
									<div>
										<strong>
											<?php 
											$impstr = '';
											$squery = new WP_Query(array( 
											    'post_type'=> 'campaigns',
											    'post_status' => 'publish',
											    'posts_per_page' => -1,
											    'author' => $authorID
											  ) 
											);
											$exsupIDs = $arrayMarge = $unicarr = array();
											if($squery->have_posts()):
												while($squery->have_posts()): $squery->the_post(); 
													$supporterIDs = get_post_meta(get_the_ID(), '_supporter_ids', true);
													if( !empty($supporterIDs) ):
													$exsupIDs[] = $supporterIDs;
													endif;
													
												endwhile;
												$impstr = implode(',', $exsupIDs);
												$unicarr = array_unique(explode(',', $impstr));
												if($unicarr){
													echo count($unicarr);
												}else{
													echo '0';
												}
											else:
												echo '0';
											endif; wp_reset_postdata();
											?>
										</strong>
										<span>total<br>
										supporters</span>
									</div>
								</div>
							</li>
							<li>
								<div class="our-follow-impact-grd">
									<div>
										<strong>
											<?php 
												if( get_count_posts_by_author('campaigns', $authorID) ):
													echo get_count_posts_by_author('campaigns', $authorID); 
												else:  
												 	echo '0';
												endif; 
										   ?>
										</strong>
										<span>active<br> 
										campaigns</span>
									</div>
								</div>
							</li>
							<li>
								<div class="our-follow-impact-grd">
									<div>
										<strong>
											<?php  
											if( get_count_previous_posts_by_author('campaigns', $authorID) ):
												echo get_count_previous_posts_by_author('campaigns', $authorID); 
											else:  
											 	echo '0';
											endif; 
											?>
										</strong>
										<span>previous<br> 
										Campaigns</span>
									</div>
								</div>
							</li>
						</ul>
						<div class="ofi-btn">
							<a href="#"><i class="far fa-heart"></i><span>Follow OUR Impact</span></a>
						</div>
					</div>
					<?php 
						$cam_galleries = !empty(get_field('ngo_galleries', $thisID))? get_field('ngo_galleries', $thisID): '';
	                  	if($cam_galleries){
					?>
					<div class="gallery-wrap">
						<div class="gallery">
							<?php 
			                    foreach( $cam_galleries as $gallery_id ):
			                      if(isset($gallery_id['id']) && !empty($gallery_id['id'])){
			                        $g_id = $gallery_id['id'];
			                      }elseif(isset($gallery_id) && !empty($gallery_id)){
			                        $g_id = $gallery_id;
			                      }
			                    if( !empty($g_id) ){
			                      $gallery_image = cbv_get_image_tag($g_id, 'galleryngo');
			                    }
			                ?>
							<div class="gallery-item">
								<?php echo $gallery_image; ?>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					<?php } ?>
					<?php 
          				if( !empty( $mvideo_url ) ){
                          $atag = "data-fancybox href='{$mvideo_url}'";
                        }else{
                          $atag = "class='no-video'";
                        }
                        $posterimg = '';
		                if( !empty($mposterID) ){
		                  $posterimg = cbv_get_image_tag($mposterID, 'ngovideoposter');
		                }
					?>
					<?php if( !empty( $mvideo_url ) ){ ?>
					<div class="video-play">
		                <a <?php echo $atag; ?>>
		                  <?php echo $posterimg; ?>
		                </a>
	              	</div>
	                <?php }else{ ?>
	              		<?php echo $posterimg; ?>
	                <?php } ?>
	              	<div class="social-development-goals-sec">
	              		<h3 class="sdgs-title">Our Social Development Goals</h3>
	              		<div class="sdgs-grds">
	              			<ul class="ulc">
	              				<li>
	              					<div>
	              						<img src="<?php echo THEME_URI;?>/assets/images/social-development-goal-img-01.jpg">
	              					</div>
	              				</li>
	              				<li>
	              					<div>
	              						<img src="<?php echo THEME_URI;?>/assets/images/social-development-goal-img-02.jpg">
	              					</div>
	              				</li>
	              				<li>
	              					<div>
	              						<img src="<?php echo THEME_URI;?>/assets/images/social-development-goal-img-03.jpg">
	              					</div>
	              				</li>
	              				<li>
	              					<div>
	              						<img src="<?php echo THEME_URI;?>/assets/images/social-development-goal-img-04.jpg">
	              					</div>
	              				</li>
	              			</ul>
	              		</div>
	              		<?php if( !empty($mbcontent) ): ?>
	              		<div class="text-center">
	              			<?php echo wpautop($mbcontent); ?>
	              		</div>
	              		<?php endif; ?>
	              		<div class="ofi-btn">
							<a href="#"><i class="far fa-heart"></i><span>Follow OUR Impact</span></a>
						</div>
	              	</div>
				</div>
			</div>
		</div>
	</div>
</section>


<?php
$query = new WP_Query(array( 
    'post_type'=> 'campaigns',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order'=> 'DESC',
    'author' => $authorID
  ) 
);
if($query->have_posts()):
?>
<section class="user-rel-camp-sec">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="user-rel-camp-innr">
          <div class="user-rel-camp-head user-rel-camp-head-2 text-center">
            <a class="active" href="">Active Campaigns</a>
            <a href="">Previous Campaigns</a>
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

                  if( camp_expire_date(get_the_ID()) ){
                  	$expClass = ' previous-campaign';
                  }else{
                  	$expClass = '';
                  }
                ?>
                <li class="campaigns-list-item-wrp<?php echo $ClassAdd; echo $expClass; ?>">
                  <div class="campaigns-list-item">
                    <?php if( !empty($feaimg_src) ): ?>
                    <div class="campaigns-item-img" style="background: url(<?php echo $feaimg_src; ?>);"></div>
                     <?php endif; ?>
                    <div class="campaigns-item-des">
                      <div class="campaigns-item-des-inr">
                        <div class="campaigns-item-cat-name">
                          <?php if( !empty($rel_term_name) ) printf('<strong>%s</strong>', $rel_term_name);?>
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
                          <?php if( !empty($rel_term_name) ) printf('<strong>%s</strong>', $rel_term_name); ?>
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
                <a href="">SHOW MORE</a>
              </div>
            </div>
          </div>          
        </div>  
      </div>
    </div>
  </div>     
</section>
<?php 
endif; wp_reset_postdata();
?>

<?php endwhile; ?>
<?php get_footer(); ?>