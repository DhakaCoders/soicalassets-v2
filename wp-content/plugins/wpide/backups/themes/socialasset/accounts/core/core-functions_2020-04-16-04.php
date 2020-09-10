<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2c179aeaff32"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/accounts/core/core-functions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/accounts/core/core-functions_2020-04-16-04.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
function get_ao_custom_logout($page_link = ''){
    if(!empty($page_link)){
      echo wp_logout_url( site_url() . '/'.$page_link );
    }else{
      echo wp_logout_url( site_url());
    }
    
}

add_action('admin_head', 'redirect_user_frontend_dashboard');
function redirect_user_frontend_dashboard(){
  $user = wp_get_current_user();
  if( is_admin() ){
    if ( in_array( 'ngo', (array) $user->roles ) && is_user_logged_in() ) {
      $redirect_to = site_url() . '/myaccount';
      echo '<script>window.location.href="'.$redirect_to.'"</script>';
      exit();
    }elseif(in_array( 'subscriber', (array) $user->roles ) && is_user_logged_in()){
      $redirect_to = site_url() . '/myaccount';
      echo '<script>window.location.href="'.$redirect_to.'"</script>';
      exit();
        
    }elseif(in_array( 'business', (array) $user->roles ) && is_user_logged_in()){
      $redirect_to = site_url() . '/myaccount';
      echo '<script>window.location.href="'.$redirect_to.'"</script>';
      exit();
    }
  }
   return false;
}

function custom_rewrite_rule() {
    add_rewrite_rule('^myaccount/([^/]+)([/]?)(.*)','index.php?pagename=myaccount&var1=$matches[1]&var2=$matches[3]&var3=$matches[5]&var4=$matches[7]','top');

}

function custom_rewrite_tag() {
  add_rewrite_tag('%var1%', '([^&]+)');
  add_rewrite_tag('%var2%', '([^&]+)');
  add_rewrite_tag('%var3%', '([^&]+)');
  add_rewrite_tag('%var4%', '([^&]+)');
}
add_action('init', 'custom_rewrite_tag', 10, 0);
add_filter('init', 'custom_rewrite_rule');

/*add_action('init', function(){
   add_rewrite_rule( 
      '^myaccount/([^/]+)([/]?)(.*)', 
      //!IMPORTANT! THIS MUST BE IN SINGLE QUOTES!:
      'index.php?pagename=myaccount&action=$matches[1]', 
      'top'
   ); 
});
add_filter('query_vars', function( $vars ){
    $vars[] = 'pagename'; 
    $vars[] = 'action'; 
    return $vars;
});*/

add_action('admin_init', 'activate_page_action');

function activate_page_action(){
  // page creation when activation
  if ( get_page_by_title('Myaccount') == null) {
     $my_post = array(
        'post_title'    => wp_strip_all_tags( 'Myaccount' ),
        'post_content'  => '[my_account]',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'     => 'page',
      );
      wp_insert_post( $my_post );
  }
}



add_action('admin_init', 'add_custom_role');

function add_custom_role(){
  if(!get_role( 'ngo' )){
  	add_role('ngo', __(
     'NGO')
  	);
  }
  if(!get_role( 'business' )){
  	add_role('business', __(
  		'Business')
  	);
  }

}
//add_action('admin_init', 'wpremove_role');
function wpremove_role(){
remove_role( 'business' );
remove_role( 'ngo' );
}

add_action('init', 'allow_ngo_uploads');
if(!function_exists('allow_ngo_uploads')){
  function allow_ngo_uploads() {
    $ngo_role = get_role('ngo');
    $ngo_role->add_cap('read');
    $ngo_role->add_cap('upload_files');
    //$ngo_role->add_cap('edit_posts');


    $b_role = get_role('business');
    $b_role->add_cap('read');
    $b_role->add_cap('upload_files');


    $sb_role = get_role('subscriber');
    $sb_role->add_cap('upload_files');
  }
}

if(!function_exists('get_custom_post_taxnomy_dropdown')){
  function get_custom_post_taxnomy_dropdown($tax = 'campaign', $value = ''){
    $args = array(
          'show_option_all'    => '',
          'show_option_none'  => 'Choose Category',
          'orderby'      => 'name',
          'tab_index'          => 2,
          'hide_empty'         => false,
          'name'               => $tax,
          'class'              => 'selectpicker',
          'taxonomy'           => $tax,
          'selected'          => isset( $value ) ? (int) $value : -1,
          'hide_if_empty'      => false,
          'value_field'        => 'term_id',
          'hierarchical' => true,
          'depth' => 2,
          'required'=> true
      );
    wp_dropdown_categories( $args );
  }
}

function get_custom_content_editor($editor, $content = NULL){
  $editor = isset($editor)? $editor: 'post_content';
  $content = isset($content)? $content:'';
  $editor_id = $editor;
  $settings =   array(
      'wpautop' => true,
      'media_buttons' => true,
      'textarea_name' => $editor_id, 
      'textarea_rows' =>get_option('default_post_edit_rows', 10), 
      'tabindex' => '',
      'editor_css' => '', 
      'editor_class' => '',
      'teeny' => false,
      'dfw' => false,
      'tinymce' => true,
      'quicktags' => true 
      );
  wp_editor( $content, $editor_id, $settings); 
}


function get_campaign_tags(){
  $camp_tags = get_terms( array(
      'taxonomy' => 'campaign_tag',
      'hide_empty' => false
  ) );
  $imp_ctags = '';
  if ( !empty( $camp_tags ) && !is_wp_error( $camp_tags ) ) {
    $ctags = array();
    foreach ($camp_tags as $camp_tags) {
      $ctags[] = $camp_tags->name;
    }
    $imp_ctags = implode('", "', $ctags);
  }
  if( isset($imp_ctags) && !empty($imp_ctags) ){
    return $imp_ctags;
  }else{
    return false;
  }
  
}

function camp_excerpt($limit = 13, $dot = ' ...') {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).$dot;
  } else {
    $excerpt = implode(" ",$excerpt).$dot;
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`',$dot,$excerpt);
  return $excerpt;
}

function get_custom_excerpt($cont, $limit = 13, $dot = '') {
  $excerpt = explode(' ', $cont, $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).$dot;
  } else {
    $excerpt = implode(" ",$excerpt).$dot;
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`',$dot,$excerpt);
  return $excerpt;
}

function camp_expire_date($post_id){ 
  if( !empty($post_id) ){
    $from_expiredate = get_field('capmpaign_from_date', $post_id);
    $to_expiredate = get_field('capmpaign_to_date', $post_id);
    if( !empty($to_expiredate) )  
        $expiredate = $to_expiredate;
    else
        $expiredate = $from_expiredate;
    $expire = strtotime($expiredate);
    $today = strtotime("today midnight"); 
    if( $today >= $expire ){
      return true;
    }
    return false;
  }else{
    return false;
  }

}

function date_remaining($post_id){
  $diff = false; 
  if( !empty($post_id) ){
    
  $expiredate = get_field('capmpaign_to_date', $post_id);
  $time = new DateTime($expiredate);
  $timediff = $time->diff(new DateTime());

  $expire = strtotime($expiredate);
  $today = strtotime("today midnight"); 
  if(!empty($timediff) && ($today <= $expire)):
    if( $timediff->y >=2){
      $diff = $timediff->format('%y years left');
    }
    elseif($timediff->y == 1  ){
      $diff = $timediff->format('%y year left');
    }
    elseif($timediff->m >=2){
      $diff = $timediff->format('%m months left');
    }
    elseif($timediff->m == 1){
      $diff = $timediff->format('%m month left');
    }
    elseif($timediff->d >= 2){
      $diff = $timediff->format('%d days left');
    }
    elseif( ($timediff->d == 1)){
      $diff = $timediff->format('%d day left');
    }
    elseif( ($timediff->h >= 0) ){
      $diff = $timediff->format('1 day left');
    }
  endif;
  return $diff;
  }
  return false;
}

function get_camp_video_url($video_id){
  if( empty($video_id) ) return;
  $video_url = wp_get_attachment_url($video_id);
  if( !empty($video_url) )
    return $video_url;
  else
    return false;
  
}
function is_capm_video( $video_id ){
  if( empty($video_id) ) return;

  $isVedio = wp_attachment_is('video', $video_id );
  if( $isVedio )
    return true;
  else
    return false;
}

function camp_is_date($date){
  if( preg_match("/\d{2}\-\d{2}-\d{4}/", $date) ) {
    return true;
  }
  return false;
}


function stop_fom_resubmittion(){
  echo '<script>
      if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
      }
      </script>';
}

function cam_generate_password($_len) {

    $_alphaSmall = 'abcdefghijklmnopqrstuvwxyz';            // small letters
    $_alphaCaps  = strtoupper($_alphaSmall);                // CAPITAL LETTERS
    $_numerics   = '1234567890';                            // numerics
    $_specialChars = '`~!@#$%^&*()-_=+]}[{;:,./?\'"\|';   // Special Characters

    $_container = $_alphaSmall.$_alphaCaps.$_numerics.$_specialChars;   // Contains all characters
    $password = '';         // will contain the desired pass

    for($i = 0; $i < $_len; $i++) {                                 // Loop till the length mentioned
        $_rand = rand(0, strlen($_container) - 1);                  // Get Randomized Length
        $password .= substr($_container, $_rand, 1);                // returns part of the string [ high tensile strength ;) ] 
    }

    return $password;       // Returns the generated Pass
}

function get_camp_support_ids(){
  $expIDs = $scamIDs = array();
  $user = wp_get_current_user();
  if( !$user && empty($user) ) return;
  $campIDs = get_user_meta( $user->ID, '_support_camp_ids', true );
  if( isset($campIDs) && !empty($campIDs) ) {
    $expIDs = preg_split ("/\,/", $campIDs);
    foreach ($expIDs as $key => $scid) {
      $scamIDs[] = $scid;
    }
    return $scamIDs;
  }
  return $scamIDs;
}