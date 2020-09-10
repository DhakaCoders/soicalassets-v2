<?php 
  get_camp_header();
  $thisID = get_the_ID();
  $ccat = get_queried_object();
  $terms = get_terms( array(
    'taxonomy' => 'faq',
    'orderby' => 'name',
    'order' => 'DESC',
    'hide_empty' => false,
) );
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
?>
<div class="faq-page-sec-cntlr">
  <div class="container-xs">
    <div class="row">
      <div class="col-sm-12">
        <div class="faq-page-entry-hdr">
          <h1>Social Asset Story</h1>
          <ul class="clearfix ulc">
            <?php 
              foreach ( $terms as $term ) { 
            ?>
            <li <?php echo ($term->slug == $ccat->slug)? 'class="faq-tab-active"': ''; ?>><a href="<?php echo esc_url( get_term_link($term) );?>">FOR <strong> <?php echo $term->name; ?></strong></a></li>
            <?php } ?>
          </ul>
          <?php if( isset($ccat->description) && !empty($ccat->description)): ?>
          <h6><?php echo $ccat->description; ?></h6>
          <?php endif; ?>
        </div>
      </div>

     <?php 
      $query = new WP_Query(array( 
          'post_type'=> 'faqs',
          'post_status' => 'publish',
          'posts_per_page' => -1,
          'orderby' => 'date',
          'order'=> 'desc',
          'tax_query' => array(
            array(
              'taxonomy' => 'faq',
              'field' => 'term_id',
              'terms' => $ccat->term_id
            )
          )
        ) 
      );
      if($query->have_posts()):
     ?>   
    <div class="col-sm-12">
      <div class="faq-des-wrap">
        <?php 
          while($query->have_posts()): $query->the_post();
            $content = get_field('content', get_the_ID());
            $bcontent = get_field('bcontent', get_the_ID());
            $poster = get_field('poster', get_the_ID());
            $video_url = get_field('video_url', get_the_ID());


            $vposter_tag = '';
            if( !empty($poster) ) $vposter_tag = cbv_get_image_tag($poster,'faqgrid');

            if( !empty($video_url) ):
              $poster_tag = '<a data-fancybox href="{$video_url}">';
              $poster_tag .= $vposter_tag;
              $poster_tag .= '</a>';
            else:
              $poster_tag = $vposter_tag;
            endif;
        ?>
        <div class="hh-accordion-tab-row">
          <h6 class="hh-accordion-title"><?php the_title(); ?></h6>
          <div class="hh-accordion-des">
            <div>
              <?php
                if( !empty($content) ) echo wpautop($content); 
                if( !empty($poster_tag) ){
                  echo '<div class="video-play">';
                  echo $poster_tag;
                  echo '</div>';
                }
                if( !empty($bcontent) ) echo wpautop($bcontent); 
              ?>
            </div>
          </div>
          </div>
          <?php endwhile; ?>
      </div>
    </div>
    <?php 
    endif;  
    wp_reset_postdata();
    ?>



    </div>
  </div>
</div>
<?php } ?>
<?php get_footer(); ?>