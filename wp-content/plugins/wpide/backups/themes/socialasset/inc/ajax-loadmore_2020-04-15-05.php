<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2c6f0c8c7bfc"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/inc/ajax-loadmore.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/inc/ajax-loadmore_2020-04-15-05.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/*
 * initial posts dispaly
 */

function campaign_script_load_more($args = array()) {
  $keyword = $sorting = $hashtag = $termid = '';
  $ccat = get_queried_object();
  if( $ccat ) $termid = @$ccat->term_id;

  if( isset($_GET['search']) && !empty($_GET['search'])) $keyword = $_GET['search'];
  if( isset($_GET['sorting']) && !empty($_GET['sorting'])) $sorting = $_GET['sorting'];
  if( isset($_GET['hashtag']) && !empty($_GET['hashtag'])) $hashtag = $_GET['hashtag'];
  echo '<ul class="ulc masonry" id="ajax-content">';
      ajax_camp_script_load_more($args, $termid, $keyword, $hashtag, $sorting);
  echo '</ul>';
  echo '<div class="show-more-btn">
  <div class="ajaxloading" id="ajxaloader" style="display:none"><img src="'.THEME_URI.'/assets/images/loading.gif" alt="loader"></div>
   <a href="#" id="loadMore"  data-page="1" data-url="'.admin_url("admin-ajax.php").'" >SHOW MORE</a><span><span id="ploadCount">0</span> of <span id="putCount">0</span> Campaigns</span>';
   echo '</div>';

}
/*
 * create short code.
 */
add_shortcode('ajax_camp_posts', 'campaign_script_load_more');


/*
 * load more script call back
 */
function ajax_camp_script_load_more($args, $term_id='', $keyword = '', $htag = '', $sort = 'DESC') {
    //init ajax
    $ajax = false;
    //check ajax call or not
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $ajax = true;
    }
    //number of posts per page default
    $num = 3;
    //page number
    $paged = 1;
    if(isset($_POST['cat_id']) && !empty($_POST['cat_id'])){
      $term_id = $_POST['cat_id'];
    }
    if(isset($_POST['key_word']) && !empty($_POST['key_word'])){
        $keyword = $_POST['key_word'];
    }
    if(isset($_POST['sorting']) && !empty($_POST['sorting'])){
        $sort = $_POST['sorting'];
    }
    if(isset($_POST['htag']) && !empty($_POST['htag'])){
      $htag = $_POST['htag'];
    }
    if(isset($_POST['page']) && !empty($_POST['page'])){
        $paged = $_POST['page'] + $paged;
    }
    $totalP = ($num * $paged);
    $termQuery = $unique = array();

    if(isset($htag) && !empty($htag) && !empty($term_id)){
      $termQuery = array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'campaign',
          'field' => 'term_id',
          'terms' => $term_id
        ),
        array(
          'taxonomy' => 'campaign_tag',
          'field' => 'slug',
          'terms' => $htag
        )
      );
    }
    elseif( isset($htag) && !empty($htag)){
      $termQuery = array(
        array(
          'taxonomy' => 'campaign_tag',
          'field' => 'slug',
          'terms' => $htag
        )
      );
    }
    elseif( isset($term_id) && !empty($term_id)){
      $termQuery = array(
        array(
          'taxonomy' => 'campaign',
          'field' => 'term_id',
          'terms' => $term_id
        )
      );
    }
    if( !empty($keyword) ){
        $query = new WP_Query(array(
            'post_type'=> 'campaigns',
            'post_status' => 'publish',
            'post__in' => $unique,
            'posts_per_page' =>$num,
            'paged'=>$paged,
            'orderby' => 'date',
            'order'=> $sort,
            'tax_query' => $termQuery,
            's' => $keyword
        ));
        if( !$query->have_posts() ){
            $query = new WP_Query(array(
                'post_type'=> 'campaigns',
                'post_status' => 'publish',
                'post__in' => $unique,
                'posts_per_page' =>$num,
                'paged'=>$paged,
                'orderby' => 'date',
                'order'=> $sort,
                'tax_query' => $termQuery,
                'meta_query' => array(
                    array(
                       'key' => 'ngolocation',
                       'value' => $keyword,
                       'compare' => 'LIKE'
                    )
                 )
            ));
        }

    }else{
    $query = new WP_Query(array( 
        'post_type'=> 'campaigns',
        'post_status' => 'publish',
        'posts_per_page' =>$num,
        'paged'=>$paged,
        'orderby' => 'date',
        'order'=> $sort,
        'tax_query' => $termQuery
      ) 
    );
    }

   // printr($query);
    if($query->have_posts()){
      $i = 1;
      $count = $query->found_posts;
      if( $count <= $num){ $totalP = $count;}
    while($query->have_posts()): $query->the_post();
      $attach_id = get_post_thumbnail_id(get_the_ID());
      $feaimg_src = $ClassAdd = '';
      if( !empty($attach_id) ){
        $feaimg_src = cbv_get_image_src($attach_id, 'campgrid');
      }
      else{
        $ClassAdd = ' only-des';
      }
      $rel_terms = get_the_terms( get_the_ID(), 'campaign' );
      $rel_term_name = '';
      if ( ! empty( $rel_terms ) ) {
          foreach( $rel_terms as $rel_term ) {
             $rel_term_name = $rel_term->name; 
          }
      }
      if( !camp_expire_date(get_the_ID()) ):
    ?>
        <li class="campaigns-list-item-wrp <?php if(($i == 1)): ?>campaigns-list-item-50<?php endif; if(isset($_POST['el_li']) && !empty($_POST['el_li'])) echo $_POST['el_li']; echo $ClassAdd; ?> ">
          <div class="campaigns-list-item">
            <?php if( !empty($feaimg_src)): ?>
            <div class="campaigns-item-img" style="background: url(<?php echo $feaimg_src; ?>);"></div>
            <?php endif; ?>
            <?php if( ($i == 1) && empty($feaimg_src) && !isset($_POST['el_li']) && empty($_POST['el_li'])): ?>
              <div class="campaigns-item-img dfcimg" style="background: url(<?php echo THEME_URI.'/assets/images/dfcampgrid.png'; ?>);"></div>
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
                      <div class="campaigns-vote-percentage-number"><span><?php echo camp_progress_bar(get_the_ID()); ?>% <?php echo total_support_count(get_the_ID()); ?></span></div>
                      <div class="campaigns-vote-percentage">
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
                  <?php if( !empty($feaimg_src)): ?>
                  <?php echo wpautop( camp_excerpt(30, ''), true ); ?>
                  <?php else: ?>
                    <?php echo wpautop( camp_excerpt(14, ''), true ); ?>
                  <?php endif; ?>
                </div>
                <div class="campaigns-vote-percentage-hover-bar">
                  <div class="campaigns-vote-info">
                    <div class="campaigns-vote-percentage-bar clearfix">
                      <div class="campaigns-vote-percentage-number"><span><?php echo camp_progress_bar(get_the_ID()); ?>% <?php echo total_support_count(get_the_ID()); ?></span></div>
                      <div class="campaigns-vote-percentage">
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
        <?php
        $i++;
      endif;
    endwhile;
    if(!isset($_POST['el_li']) && empty($_POST['el_li'])){
      echo '<span id="totalPost" data-totalp="'.$count.'" data-tloadp="'.$totalP.'"></span>'; 
    }
     
    }else{
      //echo '<div class="postnot-found" style="text-align:center; padding:20px 0;">No results!</div>';
      echo '<style>.show-more-btn{display:none;}</style>';
    }  
    
    wp_reset_postdata();
    
    //check ajax call
    if($ajax) wp_die();
}

/*
 * load more script ajax hooks
 */
add_action('wp_ajax_nopriv_ajax_camp_script_load_more', 'ajax_camp_script_load_more');
add_action('wp_ajax_ajax_camp_script_load_more', 'ajax_camp_script_load_more');