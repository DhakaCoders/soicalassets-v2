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


<section class="s2-for-businesses-page-cntlr">
	<div class="s2-to-be-supported-page-entry-hdr">
		<span class="s2tbspeh-top-bg"></span>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="s2tbspeh-con-block">
						<div class="s2tbspeh-des">
							<p>Social Asset was founded with Solving Social Problems in mind. 
							Our vision is to build a seamless platform that is easy and transparent, for both NGOs and Businesses to transact. We envision Social Asset as the go-to place for all lore ipsum</p>
							<div class="video-play">
				                <a data-fancybox href="https://youtu.be/_Nua3Cjdik0">
				                  <img alt="" src="<?php echo THEME_URI;?>/assets/images/page-video-img-2.jpg">
				                </a>
			              	</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="sa-testimonial-section">
	  <div class="container-xs">
	    <div class="row">
	      <div class="col-sm-12">
	        <div class="sa-testimonial-sec-top">
	          <h4>Testimonials</h4>
	          <p>Here’re what our clients have to say about our services</p>
	        </div>
	        <div class="sa-testimonial-section-wrap">
	          <div class="sa-testimonial-slider">
	            <div class="sa-testimonial-section-inner">
	              <div class="sa-testimonial-sec-profile">
	                <img src="<?php echo THEME_URI;?>/assets/images/sa-testimonial-profile.png">
	              </div>
	              <div class="sa-testimonial-sec-blockquot">
	                <div class="sa-testimonial-sec-blockquot-inner">
	                  <p><strong>MYMENTOR</strong> makes me feel confident about my Qualifications and my daly performance in my job. I suggest to all women who work in STEAM domain to try this product.</p>
	                  <h6>Mary M.</h6>
	                  <a href="#">Junior Developer</a>
	                </div>
	              </div>
	            </div>
	            <div class="sa-testimonial-section-inner">
	              <div class="sa-testimonial-sec-profile">
	                <img src="<?php echo THEME_URI;?>/assets/images/sa-testimonial-profile.png">
	              </div>
	              <div class="sa-testimonial-sec-blockquot">
	                <div class="sa-testimonial-sec-blockquot-inner">
	                  <p><strong>MYMENTOR</strong> makes me feel confident about my Qualifications and my daly performance in my job. I suggest to all women who work in STEAM domain to try this product.</p>
	                  <h6>Mary M.</h6>
	                  <a href="#">Junior Developer</a>
	                </div>
	              </div>
	            </div>
	            <div class="sa-testimonial-section-inner">
	              <div class="sa-testimonial-sec-profile">
	                <img src="<?php echo THEME_URI;?>/assets/images/sa-testimonial-profile.png">
	              </div>
	              <div class="sa-testimonial-sec-blockquot">
	                <div class="sa-testimonial-sec-blockquot-inner">
	                  <p><strong>MYMENTOR</strong> makes me feel confident about my Qualifications and my daly performance in my job. I suggest to all women who work in STEAM domain to try this product.</p>
	                  <h6>Mary M.</h6>
	                  <a href="#">Junior Developer</a>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	        <div class="sa-testimonial-icon">
	          <img src="<?php echo THEME_URI;?>/assets/images/sa-testimonial-icon.png">
	        </div>
	      </div>
	    </div>
	  </div>
	</div><!-- end of sa-testimonial-section -->

	<?php 
	  $complogos = get_field('companieslogos', $thisID);
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