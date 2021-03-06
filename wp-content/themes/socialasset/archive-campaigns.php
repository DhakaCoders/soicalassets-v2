<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_camp_header(); 
$thisID = get_the_ID();
$ccat = get_queried_object();

$terms = get_terms( array(
    'taxonomy' => 'campaign',
    'hide_empty' => false,
    'number' => 5
) );
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
  $order = 'desc'; $search_result = '';

$tags = get_terms( array(
    'orderby'    => 'name',
    'show_count' => true,
    'number' => 10,
    'taxonomy'   => 'campaign_tag' //i guess campaign_action  is your  taxonomy 
) );
?>
<span id="all_campaign" data-campurl="<?php echo home_url( 'campaigns' ); ?>" style="display: none;"></span>
<div class="has-shadow">
  <section class="user-campaign-list-top-con">
    <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="page-entry-hdr">
              <h1>Campaigns</h1>
              <p>View all campaigns or sort by category, date lorem ipsum</p>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="campaigns-main-category">
              <ul class="ulc clearfix">
                <?php 
                foreach ( $terms as $term ) { 
                $thumbnail_id = get_field( 'image', $term, false );
                if( !empty($thumbnail_id) ){
                    $term_image = cbv_get_image_src($thumbnail_id, 'catgrid');
                }
                else{
                   $term_image = THEME_URI .'/assets/images/catsmldf.png';
                }
                ?>
                <li>
                  <div class="campaigns-main-cat-item">
                    <div class="campaigns-main-cat-bg" style="background: url(<?php echo $term_image; ?>);">
                      <h6><?php echo $term->name; ?> <br>Campaigns</h6>
                      <a class="overlay-link" href="<?php echo esc_url( get_term_link($term) );?>"></a>
                    </div>
                  </div>
                </li>
                <?php } ?>
              </ul>
            </div>
          </div>
            <?php if( isset($_GET['search']) && !empty($_GET['search'])): ?>
            <span id="key_word" data-keyword="<?php echo $_GET['search']; ?>"></span>
            <?php $search_result = $_GET['search']; endif; ?>
            <?php if( isset($_GET['sorting']) && !empty($_GET['sorting'])): ?>
            <span id="sorting" data-sort="<?php echo $_GET['sorting']; ?>"></span>
            <?php $order = $_GET['sorting']; endif; ?>
            <?php if( isset($_GET['hashtag']) && !empty($_GET['hashtag'])): ?>
            <span id="hashtag" data-htag="<?php echo $_GET['hashtag']; ?>"></span>
            <?php endif; ?>
          <div class="col-sm-12">
            <div class="campaigns-filters-area clearfix">
              <div class="clearfix campaigns-slect-filters">
                <div class="campaigns-slect-filters-lft">
                  <div class="search-by-name">
                    <form action="" method="get">
                      <input type="search" name="search" placeholder="Search by Name" value="<?php echo $search_result; ?>">
                      <button><i class="fas fa-search"></i></button>
                    </form>
                  </div>
                </div>
                <div class="campaigns-slect-filters-rgt show-md">
                  <div class="sa-selctpicker-ctlr">
                    <label>Sort by</label>
                    <select id="campaign_sort" class="selectpicker" data-size="7">
                      <option <?php echo ($order=='asc')? 'selected="selected"': ''; ?> value="asc">ASC</option>
                      <option <?php echo ($order=='desc')? 'selected="selected"': ''; ?> value="desc">DESC</option>
                    </select>
                  </div>
                </div>

                <div class="campaigns-slect-filters-mid">
                  <?php
                    $goals = get_terms( array(
                        'taxonomy' => 'goals',
                        'hide_empty' => false,
                        'orderby' => 'ID',
                        'order'   => 'ASC',
                        'parent' => 0
                    ) );
                    $count = count($goals);
                    $totalCount = ($count > 0)? $count: '0';
                    $exgoalIDs = array();
                    if( isset($_GET['goalids']) && !empty($_GET['goalids'])){
                      $exgoalIDs = explode(',', $_GET['goalids']);
                      echo '<span style="display:none;" id="goalsIDs" data-goalids="'.$_GET['goalids'].'"></span>';
                    }
                  ?>
                  <div>
                    <strong class="csfm-btn">Choose from <?php echo $totalCount; ?> Social Development Goals</strong>
                    <?php if ( ! empty( $goals ) && ! is_wp_error( $goals ) ){ ?>
                    <div class="campaigns-slect-filters-min-toggle">
                      <div id="goalsFilter">
                      <ul class="ulc clearfix">
                        <?php $i = 1; foreach ( $goals as $goal ) { ?>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg<?php echo $i; ?>" name="goals" value="<?php echo $goal->term_id; ?>" <?php if( in_array($goal->term_id, $exgoalIDs) ): echo 'checked'; endif; ?>>
                            <span class="checkmark"></span> 
                            <label for="dg<?php echo $i; ?>"> 
                                <div class="dg-con">
                                  <i>
                                    <?php 
                                      $glogoID = get_field('logo', $goal);
                                      if( !empty($glogoID) ) echo cbv_get_image_tag($glogoID);
                                    ?>
                                  </i>
                                  <div>
                                    <span><?php echo $i; ?></span>
                                    <p><?php echo $goal->name; ?></p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <?php $i++; } ?>
                      </ul>
                      <div class="goal-submit">
                        <input type="submit" name="goal_submit" id="goal_submit" value="Submit">
                      </div>
                    </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>

                <div class="campaigns-slect-filters-rgt hide-md">
                  <div class="sa-selctpicker-ctlr">
                  <label>Sort by</label>
                  <select id="campaign_sort" class="selectpicker" data-size="7">
                    <option <?php echo ($order=='asc')? 'selected="selected"': ''; ?> value="asc">ASC</option>
                    <option <?php echo ($order=='desc')? 'selected="selected"': ''; ?> value="desc">DESC</option>
                  </select>
                </div>
                </div>
              </div>
              <?php if ( ! empty( $tags ) && ! is_wp_error( $tags ) ): ?>
              <div class="campaigns-tags">
                <label>by  Hashtag</label>
                <ul class="clearfix ulc">
                  <?php foreach( $tags as $tag ): ?>
                  <li><a href="<?php echo esc_url( home_url('campaigns').'/?hashtag='.$tag->slug );?>">#<?php echo $tag->name; ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
    </div>    
  </section>
  <section class="user-campaign-list">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="user-campaign-list-cntlr">
            <?php echo do_shortcode('[ajax_camp_posts]'); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php } ?>
<?php
get_footer(); 
?>