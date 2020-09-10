<?php
wp_enqueue_style('slick-theme-css', get_template_directory_uri() . '/assets/slick.slider/slick-theme.css', array(), null);
wp_enqueue_style('slick-css', get_template_directory_uri() . '/assets/slick.slider/slick.css', array(), null);
wp_enqueue_script('slick-slider-js', get_template_directory_uri() . '/assets/slick.slider/slick.js', array('jquery'), '1.0.0', true);