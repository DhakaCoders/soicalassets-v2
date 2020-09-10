<?php 
/*
  Template Name: Terms & Conditions
*/
  get_camp_header();
  $thisID = get_the_ID();
?>
<?php
  $terms = get_field('terms_conditions', $thisID);
?>
<section class="policy-page-sec">  
     <div class="container">
       <div class="row">
        <div id="items-content" class="col-sm-12">
          <div class="policy-inner clearfix">
            <div id="sidebar">
              <div class="tcheadings sidebar__innner clearfix">
                 <div class="item-menu">
                   <h5>Contents</h5>
                   <?php if( !empty($terms) ): ?>
                   <ul id="scrollToAarea">
                    <?php 
                    foreach( $terms as $term ): 
                      $nonegap = str_replace(" ","", $term['title']);
                      $nonegap = preg_replace('/[^A-Za-z0-9\-]/', '', $nonegap);
                      if( !empty($term['title']) ) printf('<li><a href="#%s">%s</a></li>', $nonegap, $term['title'] );
                    endforeach;
                    ?>
                      <!-- <li><a href="#cookiesservices">Cookies</a></li> -->
                   </ul>
                   <?php endif; ?>
                 </div>
               </div>
            </div>
            <div class="itemsipcontent">
             <div class="item-dsce">
              <?php if( !empty($terms) ): ?>
                <?php 
                  foreach( $terms as $term ): 
                    $nonegap = str_replace(" ","", $term['title']);
                    $nonegap = preg_replace('/[^A-Za-z0-9\-]/', '', $nonegap);
                ?>
               <div id="<?php echo $nonegap; ?>" class="item-cont <?php echo $nonegap; ?>">
                <?php 
                  if( !empty($term['title']) ) printf('<h4>%s</h4>', $term['title']); 
                  if( !empty($term['content']) ) echo wpautop( $term['content'] );
                ?>
               </div>
                <?php endforeach; ?>
               <?php endif; ?>
            </div>
          </div>
       </div>
      </div>
     </div> 
   </div>
</section><!-- end of .policy-page-sec-->
<?php get_footer(); ?>