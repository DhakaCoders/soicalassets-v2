<?php get_camp_header(); ?>
<?php while( have_posts() ): the_post(); ?>
<section class="post-single policy-page-sec">  
	<div class="container">
		<div class="row">
			<div id="items-content" class="col-sm-12">
				 <div class="policy-inner clearfix">
				  <?php the_content(); ?>
				 </div>
			</div>
		</div> 
	</div>
</section><!-- end of .policy-page-sec-->
<?php endwhile; ?>

<?php get_footer(); ?>