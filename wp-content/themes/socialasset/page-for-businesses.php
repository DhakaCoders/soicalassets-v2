<?php
/*
  Template Name: For Businesses
*/
get_header();

?>
<?php
$thisID = get_the_ID();
$pageTitle = get_the_title($thisID);
$standaardbanner = get_field('bannerimage', $thisID);
if( empty($standaardbanner) ) $standaardbanner = THEME_URI.'/assets/images/for-bsns-bg.png';
  $custom_page_title = get_field('custom_page_titel', $thisID);
  if(!empty(str_replace(' ', '', $custom_page_title))){
    $pageTitle = $custom_page_title;
  }
?>
<section class="page-bnr-itb-cntlr inline-bg" style="background: url(<?php echo $standaardbanner; ?>);">
	<div class="page-bnr-itb-con">
		<div class="page-bnr-itb-icon">
			<img src="<?php echo THEME_URI;?>/assets/images/page-bnr-itb-icon-01.png">
		</div>
		<h1 class="page-bnr-itb-title"><?php echo $pageTitle; ?></h1>
		<a class="pbitb-btn" href="<?php echo esc_url( home_url('account/?login=ngo') ); ?>">CREATE ACCOUNT</a>
	</div>
</section>

<?php
  $introsec = get_field('introsec', $thisID);
  if( $introsec ):
  $posterID = $introsec['poster'];
  $video_url = $introsec['video_url'];
?>
<section class="s2-for-businesses-page-cntlr">
	<div class="s2-to-be-supported-page-entry-hdr">
		<span class="s2tbspeh-top-bg"></span>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="s2tbspeh-con-block">
						<div class="s2tbspeh-des">
							<?php if( !empty($introsec['content']) ) echo wpautop( $introsec['content'] ); ?>
							<?php 
		          				if( !empty( $video_url ) ){
		                          $atag = "data-fancybox href='{$video_url}'";
		                        }else{
		                          $atag = "class='no-video'";
		                        }
		                        $posterimg = '';
				                if( !empty($posterID) ){
				                  $posterimg = cbv_get_image_tag($posterID, 'vposter');
				                }
							?>
							<?php if( !empty( $video_url ) ){ ?>
							<div class="video-play">
				                <a <?php echo $atag; ?>>
				                  <?php echo $posterimg; ?>
				                </a>
			              	</div>
			              <?php }else{ ?>
			              	<?php echo $posterimg; ?>
			              <?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
	<?php
	  $coreValue = get_field('core_values', 95);
	  $corevalues = $coreValue['corevalues'];
	?>
	<div class="core-value-sec text-center text-white">
	  <span class="core-value-lft-btm-bg">
	    <img src="<?php echo THEME_URI; ?>/assets/images/core-value-lft-btm-icon.png" alt="">
	  </span>
	  <div class="container">
	    <div class="row">
	      <div class="col-12">
	        <div class="core-value-head">
	          <?php if( !empty($coreValue['title']) ) printf('<h2>%s</h2>', $coreValue['title']);?>
	        </div>
	      </div>
	      <?php if( !empty($corevalues) ): ?>
	        <?php 
	          $coreicon = '';
	          foreach( $corevalues as $corev ): 
	          if( !empty($corev['icon']) ) 
	            $coreicon = cbv_get_image_tag($corev['icon']);
	        ?>
	        <div class="col-md-4 col-sm-12">
	        <div class="core-value-col-innr">
	          <i><?php echo $coreicon; ?></i>
	          <?php 
	          if( !empty($corev['title']) ) printf('<h6>%s</h6>', $corev['title']);
	          if( !empty($corev['content']) ) echo wpautop( $corev['content'] );
	          ?>
	        </div>
	        </div>
	        <?php endforeach; ?>
	      <?php endif; ?>
	    </div>
	  </div> 
	</div>
	<?php 
	  $testmls = get_field('testimonials', HOMEID);
	  $quotes = $testmls['quote'];
	?>
		<div class="hm-testimonials-sec">
		  <div class="container-xs">
		    <div class="row">
		      <div class="col-sm-12">
	        <div class="hm-testimonials-innr">
	          <div class="hm-testimonials-head text-center text-white">
	          <?php 
	            if( !empty($testmls['title']) ) printf('<h4>%s</h4>',$testmls['title']); 
	            if( !empty($testmls['content']) ) echo wpautop( $testmls['content'] );
	          ?>
	          </div>
	          <?php if( !empty($quotes) ): ?>
	          <div class="hm-testimonials-slider dft-slider-dot-con">
	            <?php 
	              foreach( $quotes as $quote ): 
	                $quote_tag = '';
	                if( !empty($quote['image']) ) 
	                  $quote_tag = cbv_get_image_tag($quote['image']);
	            ?>
	            <div class="hm-testimonials-slider-item">
	              <i><?php echo $quote_tag; ?></i>              
	              <?php if( !empty($quote['content']) ) echo wpautop( $quote['content'] ); ?>
	              <div class="hm-testimonials-ftr">
	                <?php 
	                  if( !empty($quote['name']) ) printf('<span>%s</span>',$quote['name']);
	                  if( !empty($quote['designation']) ) printf('<strong>%s</strong>',$quote['designation']);
	                ?>              
	              </div>
	              <span class="top-q-icon"><img src="<?php echo THEME_URI; ?>/assets/images/testimonials-top-q-icon.png" alt=""></span>
	              <span class="btm-q-icon"><img src="<?php echo THEME_URI; ?>/assets/images/testimonials-btm-q-icon.png" alt=""></span>
	            </div>
	            <?php endforeach; ?>
	          </div>
	          <span class="hm-testimonials-icon"><img src="<?php echo THEME_URI; ?>/assets/images/hm-testimonials-icon.png" alt=""></span>
	          <?php endif; ?>
	        </div>
	      </div>
	    </div>
	  </div>
	</div><!-- end of sa-testimonial-section -->

	<?php 
	  $complogos = get_field('csocialassets', HOMEID);
	  if( $complogos ):
	  $camlogos = $complogos['clogo'];
	?>
	<div class="sa-companies-section">
	  <div class="container">
	    <div class="row">
	      <div class="col-sm-12">
	        <div class="sa-companies-sec-inner">
	          <?php if( !empty($complogos['title']) ) printf('<h4>%s</h4>',$complogos['title']); ?>
	          <?php if( $camlogos ): ?>
	          <div class="sa-company-name">
				<?php 
	              $camlogo_tag = '';
	              foreach( $camlogos as $camlogo ): 
	                if( !empty($camlogo['logo']) ) 
	                  $camlogo_tag = cbv_get_image_tag($camlogo['logo']);
	            ?>
	            <div class="sa-copany-name-slider-item">
	              <i><?php echo $camlogo_tag; ?></i>
	            </div>
	            <?php endforeach; ?>
	          </div>
	          <?php endif; ?>
	        </div>
	      </div>
	    </div>
	  </div>
	</div><!-- end of sa-companies-section -->
	<?php endif; ?>
</section>





<?php
get_footer();

?>