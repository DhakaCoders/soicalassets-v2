<?php
/**
Theme specific styles and scripts
	wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
	wp_enqueue_style( $handle, $src, $deps, $ver );
*/ 
wp_enqueue_style('fancy-style', get_template_directory_uri() . '/assets/fancybox3/dist/jquery.fancybox.min.css', array(), '1.0.0');

wp_enqueue_script('fancy-js', get_template_directory_uri() . '/assets/fancybox3/dist/jquery.fancybox.min.js', array('jquery'), '1.0.0', true);
?>