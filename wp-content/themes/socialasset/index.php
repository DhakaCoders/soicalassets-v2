<?php 
  get_camp_header();
?>
<section class="hm-blog-sec">
  <div class="container-md">
    <div class="row">
      <div class="col-12">
        <div class="hm-blog-innr">
          <?php if(have_posts()): ?>
          <div class="hm-blog-grid-wrp clearfix">
            <?php 
              $blog_src = '';
              while(have_posts()): the_post();
                
                $attach_id = get_post_thumbnail_id(get_the_ID());
                if( !empty($attach_id) )
                  $blog_src = cbv_get_image_src($attach_id,'bloggrid');
                else
                  $blog_src = THEME_URI .'/assets/images/blogdef.png';
            ?>
            <div class="hm-blog-grid-item">
              <div class="hm-blog-grid-item-innr">
                <div class="hm-blog-grid-bg">
                  <div class="hm-blog-grid-bg-main" style="background: url('<?php echo $blog_src; ?>');"></div>
                </div>
                <div class="hm-blog-grid-des mHc">
                  <h6><?php the_title();?></h6>
                  <?php the_excerpt();?>
                </div>
                <a href="<?php the_permalink();?>" class="overlay-link"></a>              
              </div>  
            </div>
            <?php endwhile; ?>
          </div>
          <div class="pagi-select-area clearfix">
            <div class="fl-pagi-pagi-ctlr">
            <?php
              global $wp_query;

              $big = 999999999; // need an unlikely integer
              $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

              echo paginate_links( array(
                'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'type'      => 'list',
                'prev_text' => __('«'),
                'next_text' => __('»'),
                'format'    => '?paged=%#%',
                'current'   => $current,
                'total'     => $wp_query->max_num_pages
              ) );
            ?>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>    
</section>
<?php get_footer(); ?>