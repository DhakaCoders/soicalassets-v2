<?php 

function deploy_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar Widget', 'demula' ),
		'id'            => 'dshop-widget',
		'description'   => __( 'Add widgets here to appear in your shop page.', 'demula' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<span>',
		'after_title'   => '</span>',
	) );
	register_sidebar( array(
		'name'          => __( 'Social Login Widget', 'demula' ),
		'id'            => 'slogin-widget',
		'description'   => __( 'Add widgets here to appear in your social login.', 'demula' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<span>',
		'after_title'   => '</span>',
	) );
}
add_action( 'widgets_init', 'deploy_widgets_init' );
