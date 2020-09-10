<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2c34568b2a2c"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/taxonomy-campaign.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/taxonomy-campaign_2020-04-19-16.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_camp_header(); 
$thisID = get_the_ID();
$ccat = get_queried_object();

$terms = get_terms( array(
    'taxonomy' => 'campaign',
    'number' => 5,
    'hide_empty' => false,
) );

if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
  $order = 'desc'; $search_result = '';


$tags = get_terms( array(
    'orderby'    => 'name',
    'show_count' => true,
    'number' => 10,
    'taxonomy'   => 'campaign_tag' //i guess campaign_action  is your  taxonomy 
) );

$activeid = $inactiveid = array();
foreach( $terms as $term ){
  if( $term->term_id == $ccat->term_id ){
    $activeid[] = $term;
  }else{
    $inactiveid[] = $term;
  }
}

$reterms = array_insert($inactiveid, 2, $activeid);


?>
<span id="all_campaign" data-campurl="<?php echo esc_url(get_term_link($ccat));?>" style="display: none;"></span>
<div class="has-shadow">
  <section class="user-campaign-list-top-con">
    <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="page-entry-hdr">
              <?php 
                if( !empty($ccat->name) ) printf('<h1>%s</h1>', $ccat->name); 
                if( !empty($ccat->description) ) echo wpautop( $ccat->description, true );
              ?>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="campaigns-main-category">
              <ul class="ulc clearfix">
                <?php 
                foreach ( $reterms as $reterm ) { 
                $thumbnail_id = get_field( 'image', $reterm, false );
                if( !empty($thumbnail_id) ){
                    $term_image = cbv_get_image_src($thumbnail_id, 'catgrid');
                }
                else{
                   $term_image = THEME_URI .'/assets/images/catsmldf.png';
                }
                ?>
                <li <?php echo ($reterm->slug == $ccat->slug)? 'class="cat-active"': ''; ?>>
                  <div class="campaigns-main-cat-item">
                    <div class="campaigns-main-cat-bg" style="background: url(<?php echo $term_image; ?>);">
                      <h6><?php echo $reterm->name; ?> <br>Campaigns</h6>
                      <a class="overlay-link" href="<?php echo esc_url( get_term_link($reterm) );?>"></a>
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
                      <input type="search" name="search" value="<?php echo $search_result; ?>">
                      <button><i class="fas fa-search"></i></button>
                    </form>
                  </div>
                </div>
                <div class="campaigns-slect-filters-rgt">
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
                  <li><a href="<?php echo esc_url( get_term_link($ccat).'/?hashtag='.$tag->slug );?>">#<?php echo $tag->name; ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
    </div>    
  </section>
  <span style="display: none;" id="catID" data-termid="<?php echo $ccat->term_id; ?>"></span>
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