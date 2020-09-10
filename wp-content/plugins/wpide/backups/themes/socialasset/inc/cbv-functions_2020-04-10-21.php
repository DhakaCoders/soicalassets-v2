<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2cfef04046aa"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/inc/cbv-functions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/inc/cbv-functions_2020-04-10-21.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
/**
* Get the image tag with alt/title tag
*/
function cbv_get_image_tag( $id, $size = 'full', $title = false ){
	if( isset( $id ) ){
		$output = '';
		$image_title = get_the_title($id);
		$image_alt = get_post_meta( $id, '_wp_attachment_image_alt', true);
    if( empty( $image_alt ) ){
      $image_alt = $image_title;
    }
		$image_src = wp_get_attachment_image_src( $id, $size, false );

		if( $title ){
			$output = '<img src="'.$image_src[0].'" alt="'.$image_alt.'" title="'.$image_title.'">';
		}else{
			$output = '<img src="'.$image_src[0].'" alt="'.$image_alt.'">';
		}

		return $output;
	}
	return false;
}

/**
* Get the image src url by attachement it
*/
function cbv_get_image_src( $id, $size = 'full' ){
  if( isset( $id ) ){
    $afbeelding = wp_get_attachment_image_src($id, $size, false );
    if( is_array( $afbeelding ) && isset( $afbeelding[0] ) ){
      return $afbeelding[0];
    }
  }
  return false;
}
/**
* Get the image tag with alt/title tag
*/
function cbv_get_image_alt( $url ){
  if( isset( $url ) ){
    $output = '';
    $id = attachment_url_to_postid($url);
    $image_title = get_the_title($id);
    $image_alt = get_post_meta( $id, '_wp_attachment_image_alt', true);
    if( empty( $image_alt ) ){
      $image_alt = $image_title;
    }
    $image_alt = str_replace('-', ' ', $image_alt);
    $output = $image_alt;

    return $output;
  }
  return false;
}

function cbv_imagegrid( $image, $desc, $position = 'left' ){
	$output = '';
	if( !empty( $image ) && !empty( $desc ) ){
		$output = ( $position == 'left' ) ? 
			"<div class='df-text-rgt-img-grd-2 clearfix'>" : 
			"<div class='df-text-lft-img-grd-2 clearfix'>";
		$output .= '<div>' .cbv_get_image_tag( $image ). '</div>';
		$output .= '<div>' .wpautop( $desc ). '</div>';
		$output .= "</div>";
	}
	return $output;
}
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function get_camp_header(){
    if( is_user_logged_in() ){
        get_header('logged');
    }else{
        get_header();
    }
}

 function get_count_posts_by_author($post_type = 'post', $authorID){
   global $wpdb;
   $expire_camp = 0;
   if( empty($authorID) ) return;
    $query = "SELECT ID FROM $wpdb->posts WHERE post_author = '$authorID' AND post_status = 'publish'";
    $posts = $wpdb->get_results($query);
    $Count = count($posts);
    foreach ($posts as $key => $post) {
      if( camp_expire_date($post->ID) ){
        $expire_camp += 1;
      }
    }
    if( $expire_camp > 0 )
      $totalCount = ( $Count - $expire_camp );
    else
      $totalCount = $Count;
    if( $totalCount > 0 )
      return $totalCount;
    else
      return false;
}
function get_count_posts_by_cat($post_type = 'post', $catid){
 global $wpdb;
 if( empty($catid) ) return;
 
  $result_count = the_count_active_post_by_cat($post_type, $catid);
  if($result_count)
    return $result_count;
  else
    return false;
}

 function the_count_active_post_by_cat($post_type, $catid){
    $expire_camp = 0;
    $Query = new WP_Query(array( 
      'post_type'=> $post_type,
      'post_status' => array('publish'),
      'posts_per_page' => -1,
      'tax_query' => array(
        array(
          'taxonomy' => 'campaign',
          'field' => 'term_id',
          'terms' => $catid
        )
      )
    ) 
    );
    if($Query->have_posts()){
      $totalCount = 0;
      $Count = $Query->found_posts;
      while($Query->have_posts()): $Query->the_post(); 
        if( camp_expire_date(get_the_ID())){
          $expire_camp += 1;
        }
      endwhile;
      $totalCount = ( $Count - $expire_camp );
      wp_reset_postdata();
      return $totalCount;
    }
    return false;
 }

function array_insert(&$array, $position, $insert_arr)
{
    if (is_int($position)) {
        return array_merge(array_slice($array, 0, $position), $insert_arr, array_slice($array, $position));
    }
    return false;
}

add_filter( 'wp_dropdown_users_args', 'change_user_dropdown', 10, 2 );

function change_user_dropdown( $query_args, $r ){
    // get screen object
    $screen = get_current_screen();
    
    // list users whose role is e.g. 'Editor' for 'post' post type
    if( $screen->post_type == 'campaigns' ):
        $query_args['role'] = array('ngo');
    
        // unset default role 
        unset( $query_args['who'] );
    endif;
    
    return $query_args;
}

function book_cpt_columns($columns) {
	
	unset(
		$columns['author']
		//$columns['comments']
	);
	$new_columns = array(
		//'publisher' => __('Publisher', 'ThemeName'),
		'campaigns_author' => __('Book Author', 'socialasset')
	);
    return array_merge($columns, $new_columns);
}
//add_filter('manage_campaigns_posts_columns' , 'book_cpt_columns');

add_filter( 'manage_edit-campaigns_columns', 'so_25737839' );

function so_25737839( $columns ) 
{
    $columns['author'] = 'NGO';
    return $columns;
}
add_action('add_meta_boxes', 'change_author_metabox');
function change_author_metabox() {
    global $wp_meta_boxes;
    $wp_meta_boxes['post']['normal']['core']['authordiv']['title']= 'NGO';
}