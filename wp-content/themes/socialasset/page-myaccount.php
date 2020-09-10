<?php 
/*
	Template Name: Myaccount
*/
get_camp_header(); ?>
<?php while( have_posts() ): the_post(); ?>

<?php shortcode_user_myaccount2(); ?>

<?php endwhile; ?>

<?php get_footer(); ?>