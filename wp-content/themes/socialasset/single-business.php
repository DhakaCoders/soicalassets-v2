<?php 
get_camp_header(); 
while( have_posts() ): the_post();
$thisID = get_the_ID();

$authorID = get_the_author_meta('ID');
$sumetas = array_map( function( $a ){ return $a[0]; }, get_user_meta( $authorID ) );
$bcontent = !empty(get_field('profile_content', $thisID))? get_field('profile_content', $thisID): '';

$bannerID = !empty(get_post_meta($thisID, 'bannerimage', true))? get_post_meta($thisID, 'bannerimage', true): '';
if( empty($bannerID) ) {
  $standaardbanner = THEME_URI.'/assets/images/page-bnr-company-profile.jpg';
}else{
  $standaardbanner = cbv_get_image_src($bannerID);
}

?>

<section class="s2-page-bnr-cntlr inline-bg" style="background: url(<?php echo $standaardbanner; ?>);">
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

<section class="company-profile-page-con-top">
	<div class="container">
		<div class="row"> 
			<div class="col-sm-12">
				<div class="cppct-des-cntrl">
					<div class="cppct-des">
						<div class="cppct-des-inr">
							<?php echo wpautop($bcontent); ?>
						</div>
					</div>
					<?php 
					if(isset($sumetas['_support_camp_ids']) && !empty($sumetas['_support_camp_ids'])):
					$support_ids = $sumetas['_support_camp_ids'];
					$array_support_ids = explode(',', $support_ids);
					$array_support_ids = array_unique($array_support_ids);
					$Query = new WP_Query(array( 
					    'post_type'=> 'campaigns',
					    'post_status' => array('publish', 'draft', 'pending'),
					    'posts_per_page' => -1,
					    'order'=> $order,
					    'post__in' => $array_support_ids
					  ) 
					);
					?>
					<?php if( $Query->have_posts() ): ?>
					<div class="supported-ngos-area">
						<h3 class="supported-ngos-area-title">Supported NGOs</h3>
						<ul class="reset-list ulc">
				            <?php 
					            while($Query->have_posts()): $Query->the_post(); 
				            	$ngoID = get_the_author_meta('ID');
								$ngometas = array_map( function( $a ){ return $a[0]; }, get_user_meta( $ngoID ) );

				            ?>
							<li>
								<div class="supported-ngo-item">
									<div class="mHc">
									<?php 
										if( isset($ngometas['_profile_logo_id']) && !empty($ngometas['_profile_logo_id']) ){
											echo get_user_profile_logo_tag($ngometas['_profile_logo_id'], 'full');
										}
									?>
									</div>
									<?php if( isset($ngometas['_ngo_name']) && !empty($ngometas['_ngo_name']) ) printf('<strong>%s</strong>', $ngometas['_ngo_name']);?>
								</div>
							</li>
							<?php endwhile; ?>
						</ul>
					</div>
					<?php endif; wp_reset_postdata(); endif;?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
if(isset($sumetas['_support_camp_ids']) && !empty($sumetas['_support_camp_ids'])):
$support_ids = $sumetas['_support_camp_ids'];
$array_support_ids = explode(',', $support_ids);
$array_support_ids = array_unique($array_support_ids);
$query = new WP_Query(array( 
    'post_type'=> 'campaigns',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order'=> 'DESC',
	'post__in' => $array_support_ids
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
            <h4>Supported Campaigns</h4>
          </div>
          <div class="upcoming-campaigns-main">
            <div class="user-campaign-list-cntlr">
              <ul class="ulc clearfix" id="bus-supported-camp">
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
              <div class="show-more-btn business-btn">
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
endif;  
wp_reset_postdata();
endif;
?>
<?php endwhile; ?>
<?php get_footer(); ?>