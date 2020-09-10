<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2c263846cc68"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/accounts/ngo/ngo-campaigns.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/accounts/ngo/ngo-campaigns_2020-04-04-12.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
$index = '_show_my_campaigns';
if( isset($umetas[$index]) && $umetas[$index] != 'true') return;


$date_arg = $keyword = '';
$per_page = 3;
if(isset($_GET['search']) && !empty($_GET['search'])){
  $keyword = $_GET['search'];
}elseif(isset($_GET['archive']) && !empty($_GET['archive'])){
  $exp_date = explode('-', $_GET['archive']);
  $date_arg = array(
       'year'  => $exp_date[2],
       'month' => $exp_date[0],
       'day'   => $exp_date[1],
      );

}



if(isset($_COOKIE['per_page']) && !empty($_COOKIE['per_page'])) {
  $per_page = $_COOKIE['per_page'];
}
$var2 = $wp_query->get( 'var2' );
if( isset($var2) && !empty($var2) )
  $var2_int = (int) filter_var($var2, FILTER_SANITIZE_NUMBER_INT);
else
  $var2_int = '';

$paged = (!empty($var2_int)) ? $var2_int : 1;
$Query = new WP_Query(array( 
    'post_type'=> 'campaigns',
    'post_status' => array('publish', 'draft', 'pending'),
    'posts_per_page' => $per_page,
    'paged' => $paged,
    'order'=> 'DESC',
    'author' => $user->ID, 
    's' => $keyword,
    'date_query' => array($date_arg),
  ) 
);
?>
<span id="all_campaign" data-campurl="<?php echo esc_url(home_url('myaccount/mycampaigns/'));?>" style="display: none;"></span>
<div id="tab-2" class="">

  <div class="tab-con-inr">
  <?php 
    $draft = true;
    if( isset($umetas['_user_account_status']) && !empty($umetas['_user_account_status']) ){
      if($umetas['_user_account_status'] == 'draft'){
        $draft = false;
  ?>
  <div class="profile-is-draft">
    <p><strong>Your profile is DRAFT</strong>   Lorem ipsum donor sit met.</p>
    <i class="fas fa-times"></i>
  </div>
  <?php } }?>

    <div class="ngo-campaigns-tab-hdr clearfix">
      <?php if( $Query->have_posts() ): ?>
      <strong><span id="total_active_camp"><?php echo get_count_posts_by_author('campaigns', $user->ID); ?></span> Active Campaigns</strong>
      <?php endif; ?>
      <div class="ngo-campaigns-tab-hdr-rgt">
        <form id="archive_form">
          <div class="ngo-archive">
            <label>Archive</label>
            <div class="ngo-archive-date">
                  <input type="text" name="to_date" id="datepicker3" autocomplete="off">
              <input type="text" class="archive_date" id="datepicker" >
              <img src="<?php echo THEME_URI; ?>/assets/images/calender.png">
            </div>
          </div>
        </form>
          <form action="" method="get">
          <div class="search-by-name">
            <input type="search" name="search" value="<?php echo $keyword; ?>">
            <button><i class="fas fa-search"></i></button>
          </div>
        </form>
      </div>
    </div>
    <?php if( $Query->have_posts() ): ?>
    <div class="dfp-tbl-wrap">
      <div class="table-dsc">
        <table>
          <thead>
            <tr>
              <th><span>Date </span></th>
              <th><span> Category</span></th>
              <th><span>Campaign</span></th>
              <th><span>Status</span></th>
              <th><span>Progress</span></th>
            </tr>
          </thead>
          <tbody>
          <?php 
            $post_count = 0;
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
            $post_count += 1;
          ?>
            <tr class="edit-action" id="camppost_<?php echo get_the_ID(); ?>">
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
                      <div class="campaign-action">
                        <?php if( $draft ): ?>
                        <a href="<?php echo home_url('myaccount/edit-campaign/'.get_the_ID())?>">Edit</a> |
                        <?php endif; ?>

                        <?php if( !camp_expire_date(get_the_ID()) && $draft ){ ?>
                         <a href="<?php echo esc_url(home_url('myaccount/mycampaigns/'.get_the_ID()));?>" onclick="return confirm('Are you sure you want to delete at this campaign: <?php echo get_the_title() ?>?')" style="color: red;" data-id="<?php the_ID() ?>" data-nonce="<?php echo wp_create_nonce('my_delete_camp_nonce') ?>" class="delete-capm">Delete</a> |
                        <?php } ?>
                        <a href="<?php the_permalink(); ?>" target="_blank">View</a> 
                        | <a href="#" onclick="campaignDraft(<?php echo get_the_ID(); ?>, 'draft_nonce'); return false;">Draft</a>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="tbl-td">
                  <strong>Status</strong>
                  <?php
                    if( camp_expire_date(get_the_ID()) ){
                      echo '<span class="status-btn status-btn-expired">Fulfilled</span>';
                    }elseif($camp_data->post_status == 'publish'){
                      echo '<span class="status-btn status-btn-active">ACTIVE</span>';
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
                  <strong>Progress</strong>
                  <div class="ngo-td-progress">
                    <span><?php echo camp_progress_bar(get_the_ID()); ?>% <?php echo total_support_count(get_the_ID()); ?></span>
                  </div>
                </div>
              </td>
            </tr>
            <?php endwhile; ?>
            

            
          </tbody>
        </table>
      </div>
    </div>
    <div class="pagi-select-area clearfix">
      <div class="fl-pagi-pagi-ctlr">
          <?php 
            if( $Query->max_num_pages > 1 ):
            $big = 999999999; // need an unlikely integer
            echo paginate_links( array(
              'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
              'format' => '?paged=%#%',
              'current' => max( 1, $var2_int ),
              'total' => $Query->max_num_pages,
              'type'  => 'list',
              'show_all' => true,
              'prev_next' => false
            ) );
            endif; 
            $total_camp = $Query->found_posts;
          ?>
      </div>
      <div class="showing-page-select">
        <div class="sa-selctpicker-ctlr">
          <select class="selectpicker" id="perpage_set">
            <?php
              
              $x = 1; for( $x; $x < 11; $x++  ){ 
                if( $x <= $total_camp ){
            ?>
            <option <?php echo ($per_page == $x)? 'selected="selected"': ''; ?>><?php echo $x; ?></option>
            <?php 
                }
              } 
            ?>
          </select>
        </div>

        <?php 
        $showCount    = true;
        // Calculate the total number of pages
        $numPages = ceil($total_camp / $per_page);
        // Is there only one page? will not need to continue
        if ($numPages == 1){
            if ($showCount){
                $info = 'Showing : ' . $total_camp;
                return $info;
            }else{
                return '';
            }
        }
        
        if (!is_numeric($paged) || $paged == 0){
            $paged = 1;
        }
        
        // Links content string variable
        $output = '';
        
        // Showing links notification
        if ($showCount){
           $currentOffset = ($paged > 1)?($paged - 1)*$per_page:$paged;
            if($paged == 1)
              $info = 'Showing ' . ($currentOffset) . '-' ;
            else
              $info = 'Showing ' . ($currentOffset+1) . '-' ;
        
           if( ($currentOffset + $per_page) <= $total_camp )
              $info .= $paged * $per_page;
           else
              $info .= $total_camp;
           
           $info .= ' of ' . $total_camp;
        
           $output .= $info;
        }
        
        echo '<span>'.$output.'</span>';
        // Ca
        ?>
      </div>

    </div>
    <?php else: ?>
      <div class="postnot-found" style="text-align:center; padding:20px 0;">No results!</div>
    <?php endif; wp_reset_postdata();?>
  </div>
</div>