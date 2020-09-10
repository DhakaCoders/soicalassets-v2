<?php 
defined( 'ABSPATH' ) || exit;

/*Remove Archive Woocommerce Hooks & Filters are below*/

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_filter( 'woocommerce_show_page_title' , 'woo_hide_page_title' );
function woo_hide_page_title() {
	
	return false;
	
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


/**
 * Add wc custom content wrapper
 */
add_action('woocommerce_before_main_content', 'get_custom_wc_output_content_wrapper', 10);
add_action('woocommerce_after_main_content', 'get_custom_wc_output_content_wrapper_end', 10, 1);

function get_custom_wc_output_content_wrapper(){

	if(is_shop() OR is_product_category()){ $customClass = ' product-cat-sec'; $controlClass = ' cat-controller product-des-controller';}elseif(is_product()){$customClass = ' product-des-sec';$controlClass = ' product-des-controller'; }else{ $customClass = ''; $controlClass = '';}
	echo '<section class="main-content-sec-wrp'.$customClass.'"><div class="container"><div class="row"><div class="col-12"><div class="main-content-wrp'.$controlClass.' clearfix">';
    echo '<div class="main-content-lft hide-sm"><div class="main-content-lft-dsc clearfix">';
    if ( is_active_sidebar( 'dshop-widget' ) ) dynamic_sidebar( 'dshop-widget' );
    echo '</div></div>';

    echo '<div class="main-content-rgt">';
    if(is_product_category()):
        $cate = get_queried_object();
        $gettop_content = get_field('tcontent', 'product_cat' . '_' . $cate->term_id);
        echo '<div class="main-content-top">';
            if(!empty($gettop_content)) echo wpautop( $gettop_content );
        echo '</div>';

        echo '<div class="product-select show-sm"> <div class="news-grid-select-3">';
        pcategory_dropdown();
        echo '</div></div>';
    endif;
}

function get_custom_wc_output_content_wrapper_end(){
    if(is_product_category()):
        $cate = get_queried_object();
        $getbtm_content = get_field('bcontent', 'product_cat' . '_' . $cate->term_id);
        echo '<div class="main-content-btm">';
            if(!empty($getbtm_content)) echo wpautop( $getbtm_content );
        echo '</div>';
    endif;
	echo '</div></div></div></div></div></section>';
}


/*Loop Hooks*/


/**
 * Add loop inner details are below
 */
 
 remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 3; // 3 products per row
    }
}


add_action('woocommerce_shop_loop_item_title', 'add_shorttext_below_title_loop', 5);
if (!function_exists('add_shorttext_below_title_loop')) {
	function add_shorttext_below_title_loop() {
		global $product, $woocommerce, $post;
        $product_thumb = '';
        $thumb_id = get_post_thumbnail_id($product->get_id());
        if(!empty($thumb_id)){
            $product_thumb = cbv_get_image_tag($thumb_id, 'prodgrid');
        }
		echo '<div class="product-grid-inr">
        <div class="product-grid-img"><a href="'.get_permalink( $product->get_id() ).'" class="overlay-link"></a>';
        echo $product_thumb;
        woocommerce_template_loop_add_to_cart( );
        echo '</div>
        <div class="product-grid-title">
        <h5><a href="'.get_permalink( $product->get_id() ).'">'.get_the_title().'</a></h5>
        </div>
        </div>';
	}
}

add_action('woocommerce_before_shop_loop', 'shop_loop_custom_wrapper_start', 30, 2);
add_action('woocommerce_after_shop_loop', 'shop_loop_custom_wrapper_end', 10, 2);
function shop_loop_custom_wrapper_start(){
    echo '<div class="product-grid-wrp">';
}

function shop_loop_custom_wrapper_end(){
    echo '</div>';
}

add_action('woocommerce_before_single_product_summary', 'open_add_custom_div_inside_loop', 10);
add_action('woocommerce_after_single_product_summary', 'close_add_custom_div_inside_loop', 20);

function open_add_custom_div_inside_loop(){
    echo '<div class="home-top-content clearfix"><div class="fl-product clearfix">';
}

function close_add_custom_div_inside_loop(){
    echo '</div></div>';
}


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action('woocommerce_single_product_summary', 'add_custom_box_product_summary', 5);
if (!function_exists('add_custom_box_product_summary')) {
    function add_custom_box_product_summary() {
        global $product, $woocommerce, $post;
        $sh_desc = '';
        $sh_desc = $product->get_short_description();
        
        echo '<div class="summary-grid">';
        echo '<div class="summary-des-box">';
        echo '<h1 class="product_title entry-title">'.$product->get_title().'</h1><div class="shortdes">'; 
        if( !empty($sh_desc) ) echo $sh_desc;  
        echo '</div><div class="single-price">';
        echo $product->get_price_html();
        echo '</div></div>';
        woocommerce_template_single_add_to_cart();
        echo '</div>';
    }
}


add_action('woocommerce_after_single_product_summary', 'add_custom_long_text', 20);


function add_custom_long_text(){
    global $product;
    $sh_desc = $product->get_description();
    if(empty($sh_desc)) return;
    echo '<div class="wclong-desc bottom-content  clearfix">';
    echo $sh_desc;
    echo '</div>';
}


/**
 * Get HTML for a gallery image.
 *
 * Woocommerce_gallery_thumbnail_size, woocommerce_gallery_image_size and woocommerce_gallery_full_size accept name based image sizes, or an array of width/height values.
 *
 * @since 3.3.2
 * @param int  $attachment_id Attachment ID.
 * @param bool $main_image Is this the main image or a thumbnail?.
 * @return string
 */
if (!function_exists('cbv_wc_get_gallery_image_html')) {
function cbv_wc_get_gallery_image_html( $attachment_id, $main_image = false ) {
    $flexslider        = (bool) apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) );
    $gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
    $thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
    $image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size );
    $full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
    $thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
    $full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
    $alt_text          = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
    $image             = wp_get_attachment_image(
        $attachment_id,
        $image_size,
        false,
        apply_filters(
            'woocommerce_gallery_image_html_attachment_image_params',
            array(
                'title'                   => _wp_specialchars( get_post_field( 'post_title', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
                'data-caption'            => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
                'data-src'                => esc_url( $full_src[0] ),
                'data-large_image'        => esc_url( $full_src[0] ),
                'data-large_image_width'  => esc_attr( $full_src[1] ),
                'data-large_image_height' => esc_attr( $full_src[2] ),
                'class'                   => esc_attr( $main_image ? 'wp-post-image' : '' ),
            ),
            $attachment_id,
            $image_size,
            $main_image
        )
    );

    return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="woocommerce-product-gallery__image"><a rel="fancybox" data-fancybox="gallery" class="woocommerce-main-image zoom fancybox" href="' . esc_url( $full_src[0] ) . '">' . $image . '</a></div>';
}

}