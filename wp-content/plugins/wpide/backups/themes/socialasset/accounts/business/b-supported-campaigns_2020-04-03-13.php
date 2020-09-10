<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2cb986941571"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/accounts/business/b-supported-campaigns.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/accounts/business/b-supported-campaigns_2020-04-03-13.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
$index = '_show_my_campaigns';
if( isset($umetas[$index]) && $umetas[$index] != 'true') return;

$order = 'asc';
if( isset($_GET['sorting']) && !empty($_GET['sorting'])){
  $order = $_GET['sorting'];
}
?>
<div id="tab-2" class="">
  <div class="tab-con-inr ">
    <?php 
      if( isset($umetas['_user_account_status']) && !empty($umetas['_user_account_status']) ){
        if($umetas['_user_account_status'] == 'draft'){
    ?>
    <div class="profile-is-draft">
      <p><strong>Your profile is DRAFT</strong></p>
    </div>
    <?php 
      } }
    ?>

    <div class="supported-campaigns-tab-hdr clearfix">
      <strong>Your Campaigns</strong>
      <div class="sort-by clearfix">
        <label>Sort by</label>
        <div class="sa-selctpicker-ctlr">
            <select id="campaign_sort" class="selectpicker">
              <option <?php echo ($order=='asc')? 'selected="selected"': ''; ?> value="asc">Old Campaigns</option>
              <option <?php echo ($order=='desc')? 'selected="selected"': ''; ?> value="desc">New Campaigns</option>
            </select>
        </div>
      </div>
    </div>
    <span id="all_campaign" data-campurl="<?php echo esc_url(home_url('myaccount/supported-campaigns/'));?>" style="display: none;"></span>
    <?php 
    if(isset($umetas['_support_camp_ids']) && !empty($umetas['_support_camp_ids'])):
    $support_ids = $umetas['_support_camp_ids'];
    $array_support_ids = explode(',', $support_ids);
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $Query = new WP_Query(array( 
        'post_type'=> 'campaigns',
        'post_status' => array('publish', 'draft', 'pending'),
        'posts_per_page' => 10,
        'paged' => $paged,
        'order'=> $order,
        'post__in' => $array_support_ids
      ) 
    );

    ?>
    <?php if( $Query->have_posts() ): ?>
    <div class="supported-campaigns-tab-items">
      <ul class="clearfix ulc">
        <?php 
            while($Query->have_posts()): $Query->the_post(); 
            $attach_id = get_post_thumbnail_id(get_the_ID());
            if( !empty($attach_id) ){
              $feaimg_src = cbv_get_image_src($attach_id, 'medium');
            }else{
              $feaimg_src = THEME_URI.'/assets/images/dfcamp.png';
            }

            $categories = get_the_terms( get_the_ID(), 'campaign' );
            $term_name = '';
            if ( ! empty( $categories ) ) {
                foreach( $categories as $category ) {
                   $term_name = $category->name; 
                }
            }
          ?>
        <li class="campaigns-list-item-wrp">
          <div class="campaigns-list-item">
            <div class="campaigns-item-img" style="background: url(<?php echo $feaimg_src; ?>);"></div>
            <div class="campaigns-item-des">
              <div class="campaigns-item-des-inr">
                <div class="campaigns-item-cat-name">
                  <?php if( !empty($term_name) ): ?>
                  <strong><?php echo $term_name; ?></strong>
                  <?php endif; ?>
                </div>
                <div class="campaigns-item-des-btm">
                  <div>
                    <h6><?php the_title(); ?></h6>
                    <?php echo wpautop( camp_excerpt(), true ); ?>
                  </div>
                  <div class="campaigns-vote-percentage-bar clearfix">
                      <div class="campaigns-vote-percentage-number"><span><?php echo camp_progress_bar(get_the_ID()); ?>%</span></div>
                      <div class="campaigns-vote-percentage">
                        <div>
                          <span style="width: <?php echo camp_progress_bar(get_the_ID()); ?>%"></span>
                        </div>
                      </div>
                    </div>
                    <div class="months-left">
                      <?php if(date_remaining(get_the_ID())): ?>
                      <i class="far fa-clock"></i>
                      <span><?php echo date_remaining(get_the_ID());?></span>
                      <?php endif;?>
                    </div>
                  </div>
              </div>
            </div>

          </div>
        </li>
        <?php endwhile; ?>
      </ul>
    </div>
    <?php endif; wp_reset_postdata();?>
    <?php else: ?>
      <div class="postnot-found" style="text-align:center; padding:20px 0;">No results!</div>
    <?php endif; ?>
  </div>
</div>