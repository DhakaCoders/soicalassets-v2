<?php
/**
Documentation
http://getbootstrap.com/
*/
wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.0.0');
wp_enqueue_style('bootstrap-select', get_template_directory_uri() . '/assets/css/bootstrap-select.min.css', array(), '4.0.0');
wp_enqueue_script('viewport-js', get_template_directory_uri() . '/assets/js/ie10-viewport-bug-workaround.js', array('jquery'), '1.0.0', true);
wp_enqueue_script('bootstrap.js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.0.0', true);
wp_enqueue_script('bootstrap.select', get_template_directory_uri() . '/assets/js/bootstrap-select.min.js', array('jquery'), '1.13.1', true);
?>