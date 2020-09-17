<?php
/*
  Template Name: To Be Supported NGO
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


<section class="s2-to-be-supported-page-cntlr">
<?php 
$intro = get_field('introsec', $thisID);
if( $intro ): 
?>
	<div class="s2-to-be-supported-page-entry-hdr">
		<span class="s2tbspeh-top-bg"></span>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="s2tbspeh-con-block">
						<div class="s2tbspeh-des">
			            <?php 
			                if(!empty($intro['content'])){
			             	echo wpautop( $intro['content'] );
			            ?>
							<a class="pbitb-btn" href="<?php echo esc_url( home_url('account/?login=ngo') ); ?>">CREATE ACCOUNT</a>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php 
  $collalogos = get_field('collaborating_ngos', $thisID);
  $callogos = $collalogos['callogo'];
?>
	<div class="collaborating-ngos-area-sec">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="collaborating-ngos-area-sec-inr">
						<div class="cnas-lft-icon">
							<img src="<?php echo THEME_URI;?>/assets/images/cnas-lft-icon.png">
						</div>
						<div style="position: relative; z-index: 2;">
							<?php if( !empty($collalogos['title']) ) printf('<h3 class="cnas-title">%s</h3>',$collalogos['title']); ?>
							<?php if( $callogos ): ?>
							<ul class="ulc">
								<?php 
					              $clogo_tag = '';
					              foreach( $callogos as $callogo ): 
					                if( !empty($callogo['logo']) ) 
					                  $callogo_tag = cbv_get_image_tag($callogo['logo']);
					            ?>
								<li>
									<div>
										<?php echo $callogo_tag; ?>
									</div>
								</li>
								<?php endforeach; ?>
							</ul>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="thay-support-us">
		<div class="container">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="block-1000">
							<h3 class="tsu-title">They Support us</h3>
							<ul class="ulc">
								<li>
									<div>
										<img src="<?php echo THEME_URI;?>/assets/images/partner-2.png">
									</div>
								</li>
								<li>
									<div>
										<img src="<?php echo THEME_URI;?>/assets/images/partner-3.png">
									</div>
								</li>
								<li>
									<div>
										<img src="<?php echo THEME_URI;?>/assets/images/partner-1.png">
									</div>
								</li>
								<li>
									<div>
										<img src="<?php echo THEME_URI;?>/assets/images/partner-3.png">
									</div>
								</li>
								<li>
									<div>
										<img src="<?php echo THEME_URI;?>/assets/images/partner-1.png">
									</div>
								</li>
								<li>
									<div>
										<img src="<?php echo THEME_URI;?>/assets/images/partner-4.png">
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="press-section">
		<div class="container">
			<div class="row"> 
				<div class="col-sm-12">
					<div class="press-sec-hdr">
						<h3 class="press-sec-hdr-title">Press</h3>
						<p>Lorem ipsum dolor sit amen</p>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="press-sec-grds">
						<ul class="ulc clearfix">
							<li>
								<div class="press-sec-grd-item">
									<div class="press-sec-grd-item-fea-img">
										<a class="overlay-link" href="#"></a>
										<div class="inline-bg" style="background: url(<?php echo THEME_URI;?>/assets/images/press-sec-grd-item-fea-img-01.jpg);"></div>
									</div>
									<div class="press-sec-grd-item-des mHc">
										<h5 class="psgi-title mHc1">Writing in the Sciences</h5>
										<p>This course teaches scientists to become more effective writer. Topics include: principles of good writing,  the format of a scientific manuscript, ethical issues in scientific publications.</p>
									</div>
								</div>
							</li>
							<li>
								<div class="press-sec-grd-item">
									<div class="press-sec-grd-item-fea-img">
										<a class="overlay-link" href="#"></a>
										<div class="inline-bg" style="background: url(<?php echo THEME_URI;?>/assets/images/press-sec-grd-item-fea-img-02.jpg);"></div>
									</div>
									<div class="press-sec-grd-item-des mHc">
										<h5 class="psgi-title mHc1">Introduction to Translational Science</h5>
										<p>Translational science seeks to speed up the process of moving research discoveries from the laboratory into healthcare practices.</p>
									</div>
								</div>
							</li>
							<li>
								<div class="press-sec-grd-item">
									<div class="press-sec-grd-item-fea-img">
										<a class="overlay-link" href="#"></a>
										<div class="inline-bg" style="background: url(<?php echo THEME_URI;?>/assets/images/press-sec-grd-item-fea-img-03.jpg);"></div>
									</div>
									<div class="press-sec-grd-item-des mHc">
										<h5 class="psgi-title mHc1">Open Source tools for Data Science</h5>
										<p>In this course, you’ll learn about Jupyter Notebooks, RStudio IDE, Apache Zeppelin and Data Science Experience.</p>
									</div>
								</div>
							</li>
						</ul>
						<div>
							<a class="pbitb-btn" href="#">VIEW ALL ARTICLES</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>





<?php
get_footer();

?>