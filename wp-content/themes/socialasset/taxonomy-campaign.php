<?php
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
                      <input type="search" name="search" placeholder="Search by Name" value="<?php echo $search_result; ?>">
                      <button><i class="fas fa-search"></i></button>
                    </form>
                  </div>
                </div>
                <div class="campaigns-slect-filters-mid">
                  <div>
                    <strong class="csfm-btn">Choose from 17 Social Development Goals</strong>
                    <div class="campaigns-slect-filters-min-toggle">
                      <ul class="ulc clearfix">
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg1" name="dg1" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg1"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-01.jpg"></i>
                                  <div>
                                    <span>1</span>
                                    <p>No poverty</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg2" name="dg2" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg2"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-02.jpg"></i>
                                  <div>
                                    <span>2</span>
                                    <p>zero hunger</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg3" name="dg3" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg3"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-03.jpg"></i>
                                  <div>
                                    <span>3</span>
                                    <p>good health and well-being</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg4" name="dg4" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg4"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-04.jpg"></i>
                                  <div>
                                    <span>4</span>
                                    <p>quality education</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg5" name="dg5" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg5"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-05.jpg"></i>
                                  <div>
                                    <span>5</span>
                                    <p>gender 
                                      equality</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg6" name="dg6" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg6"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-06.jpg"></i>
                                  <div>
                                    <span>6</span>
                                    <p>clean water 
                                      and sanitation</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg7" name="dg7" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg7"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-07.jpg"></i>
                                  <div>
                                    <span>7</span>
                                    <p>affordable 
                                      and clean
                                      energy</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg8" name="dg8" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg8"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-08.jpg"></i>
                                  <div>
                                    <span>8</span>
                                    <p>decent work
                                    and economy
                                    growth</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg9" name="dg9" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg9"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-09.jpg"></i>
                                  <div>
                                    <span>9</span>
                                    <p>industry,
                                      innovation and
                                      infrastructure</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg10" name="dg10" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg10"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-10.jpg"></i>
                                  <div>
                                    <span>10</span>
                                    <p>reduced
                                      inequalities</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg11" name="dg11" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg11"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-11.jpg"></i>
                                  <div>
                                    <span>11</span>
                                    <p>sustainable 
                                        cities and 
                                        communities</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg12" name="dg12" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg12"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-12.jpg"></i>
                                  <div>
                                    <span>12</span>
                                    <p>Responsiple 
                                    Consuption 
                                    & Production</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg13" name="dg13" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg13"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-13.jpg"></i>
                                  <div>
                                    <span>13</span>
                                    <p>climate 
                                      action</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg14" name="dg14" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg14"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-14.jpg"></i>
                                  <div>
                                    <span>14</span>
                                    <p>life below 
                                      water</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg15" name="dg15" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg15"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-15.jpg"></i>
                                  <div>
                                    <span>15</span>
                                    <p>life on 
                                      land</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg16" name="dg16" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg16"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-16.jpg"></i>
                                  <div>
                                    <span>16</span>
                                    <p>peace, justice
                                      and strong
                                      institutions</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                        <li>
                          <div class="filter-check-row clearfix">
                            <input type="checkbox" id="dg17" name="dg17" value="YES">
                            <span class="checkmark"></span> 
                            <label for="dg17"> 
                                <div class="dg-con">
                                  <i><img src="<?php echo THEME_URI ?>/assets/images/dg-img-17.jpg"></i>
                                  <div>
                                    <span>17</span>
                                    <p>partnerships
                                    for the goals</p>
                                  </div>
                                </div>
                            </label> 
                          </div>
                        </li>
                      </ul>
                    </div>
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
                  <li><a href="<?php echo esc_url( get_term_link($ccat).'?hashtag='.$tag->slug );?>">#<?php echo $tag->name; ?></a></li>
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