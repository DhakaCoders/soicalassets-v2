<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2cb986941571"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/accounts/user/user-contributions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/accounts/user/user-contributions_2020-04-03-14.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
$index = '_show_my_campaigns';
if( isset($umetas[$index]) && $umetas[$index] != 'true') return;
 
$active_camp = 0;
?>

<div id="tab-2" class="">
  <div class="tab-con-inr">
    <?php 
      if( isset($umetas['_user_account_status']) && !empty($umetas['_user_account_status']) ){
        if($umetas['_user_account_status'] == 'draft'){
    ?>
    <div class="profile-is-draft">
      <p><strong>Your profile is DRAFT</strong>.</p>
    </div>
    <?php 
      } }
    ?>
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
          'order'=> 'DESC',
          'post__in' => $array_support_ids
        ) 
      );

    if( $Query->have_posts() ): ?>
    <div class="user-profile-1-hdr clearfix">
      <strong>Contributions</strong>
      <span><?php echo $Query->found_posts; ?> Contributions</span>
    </div>
    <div class="dfp-tbl-wrap">
      <div class="table-dsc">
        <table>
          <thead>
            <tr>
              <th><span>Date </span></th>
              <th><span> Category</span></th>
              <th id="itemSort"><span>Campaign</span></th>
              <th><span>Status</span></th>
              <th><span>NGO</span></th>
            </tr>
          </thead>
          <tbody class="mixContainer">
            <?php 
            $i = 1;
            while($Query->have_posts()): $Query->the_post(); 
            $attach_id = get_post_thumbnail_id(get_the_ID());
            if( !empty($attach_id) ){
              $feaimg_tag = cbv_get_image_tag($attach_id, 'campthumb');
            }else{
              $feaimg_tag = '<img src="'.THEME_URI.'/assets/images/dfcamp.png" alt="'.get_the_title().'">';
            }

            $categories = get_the_terms( get_the_ID(), 'campaign' );
            $term_name = '';
            if ( ! empty( $categories ) ) {
                foreach( $categories as $category ) {
                   $term_name = $category->name; 
                }
            }
            $camp_data = get_edit_campaign_post_data(get_the_ID());
            $authorID = get_the_author_meta('ID');
            $sumetas = array_map( function( $a ){ return $a[0]; }, get_user_meta( $authorID ) );

          ?>
            <tr class="mix" data-price="90" data-title="B" data-place="K">
              <td>
                <div class="tbl-td">
                  <strong>Date</strong>
                  <span class="tbl-date"><?php echo get_the_date('m/d/Y'); ?></span>
                </div>
              </td>
              <td>
                <div class="tbl-td">
                  <strong>Category</strong>
                  <?php if( !empty($term_name) ): ?>
                  <span class="tbl-cat-name"><?php echo $term_name; ?></span>
                  <?php endif; ?>
                </div>
              </td>
              <td>
                <div class="tbl-td">
                  <strong>Campaign</strong>
                  <div class="tbl-campaign-des">
                    <div class="tbl-campaign-img">
                      <?php echo $feaimg_tag; ?>
                    </div>
                    <div class="tbl-campaign-des-inr">
                      <strong><?php the_title(); ?></strong>
                      <?php echo wpautop( camp_excerpt(), true ); ?>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="tbl-td">
                  <strong>Status</strong>
                  <?php
                    if( camp_expire_date(get_the_ID()) ){
                      echo '<span class="status-btn status-btn-expired">EXPIRED</span>';
                    }elseif($camp_data->post_status == 'publish'){
                      echo '<span class="status-btn status-btn-active">ACTIVE</span>';
                      $active_camp += $i;
                    }elseif($camp_data->post_status == 'pending'){
                      echo '<span class="status-btn status-btn-pending">PENDING</span>';
                    }else{
                      echo '<span class="status-btn status-btn-inactive">DRAFT</span>';
                    }
                  ?>
                </div>
              </td>
              <td>
                <div class="tbl-td">
                  <strong>NGO</strong>
                  <div class="ngo-logo">
                    <?php 
                      if( isset($sumetas['_profile_logo_id']) && !empty($sumetas['_profile_logo_id']) ){
                        echo get_user_profile_logo_tag($sumetas['_profile_logo_id']);
                     } 
                    ?> 
                  </div>
                </div>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php endif; wp_reset_postdata();?>
    <?php else: ?>
      <div class="postnot-found" style="text-align:center; padding:20px 0;">No results!</div>
    <?php endif; ?>
  </div>
</div>

