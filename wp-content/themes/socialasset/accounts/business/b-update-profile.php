<?php 
$user = wp_get_current_user();
$content = get_user_meta($user->ID, 'profile_content', true); 
$bcontent = !empty($content)? $content:'';


$user = wp_get_current_user();
$var2 = $wp_query->get( 'var2' );
if(isset($var2) && !empty($var2)){
  $bus_data = get_edit_campaign_post_data($var2);
}else{
  $args = array(
    'author'        =>  $user->ID, 
    'post_type' => 'business',
    'posts_per_page' => 1 // no limit
  );
  $bus_posts = get_posts( $args );
  if( $bus_posts ){
    foreach( $bus_posts as $bus_post ){
      $buspostID = $bus_post->ID;
    }
    $bus_data = get_edit_campaign_post_data($buspostID);
  }else{
    $bus_data =  false;
  }
}
$bustitle = !empty($user->first_name)? $user->first_name: '';
$posttitle = isset($bus_data->post_title)? $bus_data->post_title: $bustitle;

$bcontent = !empty(get_field('profile_content', $bus_data->ID))? get_field('profile_content', $bus_data->ID): '';
?>
<div id="tab-3" class="">
  <div class="tab-con-inr">

    <div class="ngo-create-campaign-con">
      <div class="ngo-create-campaign-con-des-hdr">
        <p>Fill the following steps.</p>
      </div>
      <?php 
      if(isset($msg) && array_key_exists("error",$msg)){ 
        printf('<div class="profile-is-draft"><p><strong>%s</strong></p><span class="actionHide" data-target=".profile-is-draft"><i class="fas fa-times"></i></span></div>', $msg['error']);
      }
      if(isset($msg) && array_key_exists("success",$msg)){ 
        printf('<div class="action-success"><p><strong>%s</strong></p><span class="actionHide" data-target=".action-success"><i class="fas fa-times"></i></span></div>', $msg['success']);
      }
    ?>
      <form action="" method="post">
        <div class="width-425">
          <div class="ncc-input-fields-row ncc-input-title-fields-row">
            <label>Business Name</label>
            <input type="text" name="first_name" value="<?php echo !empty($user->first_name)? $user->first_name: '';?>" placeholder="Type a Name here" required="required">
            <?php if($bus_data){ ?>
            <input type="hidden" name="postid" value="<?php echo $bus_data->ID ?>" required="required">
            <?php } ?>
          </div>
        </div>
        <div class="pr-190">
          <?php if( isset($bus_data->guid) && !empty($bus_data->guid)): ?>
          <div class="ncc-input-fields-row ncc-input-title-fields-row">
            <label>URL</label>
            <input type="text" name="post_url" value="<?php echo $bus_data->guid;?>" >
          </div>
          <?php endif; ?>
          <div class="ncc-text-editor">
            <label>Text</label>
              <div>
                <!-- <textarea style="min-height: 640px; background: #fff; border-radius: 6px; background: #fff; width: 100%; border: none;"></textarea> -->
                <?php get_custom_content_editor('business_profile_content', $bcontent); ?> 
              </div>
          </div>
          <input type="hidden" name="add_business_profile_nonce" value="<?php echo wp_create_nonce('add-business-profile-nonce'); ?>"/>
          <div class="ncc-submit-btns">
            <input type="submit" name="add_business_profile" value="Update">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script type='text/javascript' src="<?php echo esc_url( home_url('/wp-includes/js/tinymce/tinymce.min.js?ver=4960-20190918') );?>"></script>
<script src="<?php echo esc_url( home_url('/wp-admin/js/editor.min.js?ver=5.3.2') );?>"></script>