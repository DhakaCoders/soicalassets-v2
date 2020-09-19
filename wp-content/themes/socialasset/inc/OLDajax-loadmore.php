<?php
/*
 * initial posts dispaly
 */

function campaign_script_load_more($args = array()) {
  $keyword = $sorting = $hashtag = $termid = $goals = '';
  $ccat = get_queried_object();
  if( $ccat ) $termid = @$ccat->term_id;

  if( isset($_GET['search']) && !empty($_GET['search'])) $keyword = $_GET['search'];
  if( isset($_GET['sorting']) && !empty($_GET['sorting'])) $sorting = $_GET['sorting'];
  if( isset($_GET['hashtag']) && !empty($_GET['hashtag'])) $hashtag = $_GET['hashtag'];
  if( isset($_GET['goalids']) && !empty($_GET['goalids'])) $goals = $_GET['goalids'];
  echo '<ul class="ulc masonry" id="ajax-content">';
      ajax_camp_script_load_more($args, $termid, $keyword, $hashtag, $goals, $sorting);
  echo '</ul>';
  if( empty($keyword) ):
  echo '<div class="show-more-btn">
  <div class="ajaxloading" id="ajxaloader" style="display:none"><img src="'.THEME_URI.'/assets/images/loading.gif" alt="loader"></div>
   <a href="#" id="loadMore"  data-page="1" data-url="'.admin_url("admin-ajax.php").'" >SHOW MORE</a><span><span id="ploadCount">0</span> of <span id="putCount">0</span> Campaigns</span>';
   echo '</div>';
   endif;

}
/*
 * create short code.
 */
add_shortcode('ajax_camp_posts', 'campaign_script_load_more');


/*
 * load more script call back
 */
function ajax_camp_script_load_more($args, $term_id='', $keyword = '', $htag = '', $goals = '', $sort = 'DESC') {
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
    if(isset($_POST['goalids']) && !empty($_POST['goalids'])){
      $goals = $_POST['goalids'];
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
    }elseif(isset($goals) && !empty($goals) && !empty($term_id)){
      $exgols = explode(',', $goals);

      $termQuery = array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'campaign',
          'field' => 'term_id',
          'terms' => $term_id
        ),
        array(
          'taxonomy' => 'goals',
          'field' => 'term_id',
          'terms' => $exgols,
          'operator' => 'AND',
        )
      );
    }
    elseif( isset($goals) && !empty($goals)){
      $exgols = explode(',', $goals);
      $termQuery = array(
        array(
          'taxonomy' => 'goals',
          'field' => 'term_id',
          'terms' => $exgols,
          'operator' => 'AND',
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
        $q1 = get_posts(array(
            'post_type'=> 'campaigns',
            'post_status' => 'publish',
            'posts_per_page' =>-1,
            'orderby' => 'date',
            'order'=> $sort,
            'tax_query' => $termQuery,
            's' => $keyword,
        ));
        $qids1 = array();
        if(isset($q1) && $q1){
            foreach( $q1 as $q ){
                $qids1[]= $q->ID; 
            }
        }

        $q2 = get_posts(array(
            'post_type'=> 'campaigns',
            'post_status' => 'publish',
            'posts_per_page' =>-1,
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
        $qids2 = array();
        if(isset($q2) && $q2){
            foreach( $q2 as $qq ){
                $qids2[]= $qq->ID; 
            }
        }


$unique = array_unique( array_merge( $qids1, $qids2 ) );
if( $unique ){
    $query = new WP_Query(array(
            'post_type'=> 'campaigns',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order'=> $sort,
            'tax_query' => $termQuery,
            'post__in' => $unique,
        ));
}else{
    $query = new WP_Query();
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
    $expquery = new WP_Query(array( 
        'post_type'=> 'campaigns',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order'=> $sort,
        'tax_query' => $termQuery
      ) 
    );
    }

   // printr($query);
    if($query->have_posts()){
      $i = 1;
      $expcount = 0;
      $count = $query->found_posts;
      
    while($query->have_posts()): $query->the_post();
      $authorID = get_the_author_meta('ID');
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
      if( !camp_expire_date(get_the_ID()) ){ 
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
                    <span title="Click here to support" id="heartsup<?php echo get_the_ID(); ?>" onclick="UserAddSupportByHeart(<?php echo get_the_ID(); ?>); return false;"><i class="far fa-heart"></i></span>
                  <?php endif; ?>
                  <?php }else{ ?>
                    <span title="Click here to support" id="quickViewOpener" data-toggle="modal" data-target="#quickViewModal"><i class="far fa-heart"></i></span>
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
      <?php 
      $i++;
      }
    endwhile;
    
      
    while($expquery->have_posts()): $expquery->the_post();
      if( camp_expire_date(get_the_ID()) ){ 
          echo '<span class="countexp" style="display:none"></span>';
      }
    endwhile;
    
    echo '<span id="totalPost" data-tloadp="'.$count.'"></span>'; 

     
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