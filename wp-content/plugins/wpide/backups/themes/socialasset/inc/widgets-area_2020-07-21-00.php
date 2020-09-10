<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "76c595500ff78af9f16cf4dc19fc455e6adcccef60"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/inc/widgets-area.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/inc/widgets-area_2020-07-21-00.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 

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
}
add_action( 'widgets_init', 'deploy_widgets_init' );
