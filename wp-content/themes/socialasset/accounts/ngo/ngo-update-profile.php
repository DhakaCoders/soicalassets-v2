<?php 
$user = wp_get_current_user();
$var2 = $wp_query->get( 'var2' );
if(isset($var2) && !empty($var2)){
  $ngo_data = get_edit_campaign_post_data($var2);
}else{
  $args = array(
    'author'        =>  $user->ID, 
    'post_type' => 'ngo',
    'posts_per_page' => 1 // no limit
  );
  $ngo_posts = get_posts( $args );
  if( $ngo_posts ){
    foreach( $ngo_posts as $ngo_post ){
      $ngopostID = $ngo_post->ID;
    }
    $ngo_data = get_edit_campaign_post_data($ngopostID);
  }else{
    $ngo_data =  false;
  }
}
$ngotitle = !empty($umetas['_ngo_name'])? $umetas['_ngo_name']: '';
$posttitle = isset($ngo_data->post_title)? $ngo_data->post_title: $ngotitle;
$m_title = !empty(get_field('mission_title', $ngo_data->ID))? get_field('mission_title', $ngo_data->ID): '';
$mcontent = !empty(get_field('mission_content', $ngo_data->ID))? get_field('mission_content', $ngo_data->ID): '';
$mposterID = !empty(get_field('vposter', $ngo_data->ID))? get_field('vposter', $ngo_data->ID): '';
$mvideo_url = !empty(get_field('video_url', $ngo_data->ID))? get_field('video_url', $ngo_data->ID): '';
$mbcontent = !empty(get_field('btm_content', $ngo_data->ID))? get_field('btm_content', $ngo_data->ID): '';
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
        <div class="pr-190">
          <div class="ncc-input-fields-row ncc-input-title-fields-row">
            <label>NGO Name</label>
            <input type="text" name="_ngo_name" value="<?php echo $posttitle; ?>" placeholder="Type a Name here" required="required">
            <?php if($ngo_data){ ?>
            <input type="hidden" name="postid" value="<?php echo $ngo_data->ID ?>" required="required">
            <?php } ?>
          </div>
        </div>
        <div class="pr-190">
          <?php if( isset($ngo_data->guid) && !empty($ngo_data->guid)): ?>
          <div class="ncc-input-fields-row ncc-input-title-fields-row">
            <label>URL</label>
            <div class="editableurl">
              <input type="text" id="post_url" name="post_url" readonly value="<?php echo $ngo_data->guid;?>">
              <div class="editablebtn">
                <span class="editbtn">Edit</span>
                <span class="updatebtn" onclick="updatePostUrl(<?php echo $ngo_data->ID; ?>, 'ngo'); return false;">Ok</span>
                <span class="cancelbtn">Cancel</span>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <div class="width-425 ncc-input-fields-row ngo-upload-cover-photo">
            <?php 
            $bannerID = !empty(get_post_meta($ngo_data->ID, 'bannerimage', true))? get_post_meta($ngo_data->ID, 'bannerimage', true): '';
              $bannerimg = '';
              if( !empty($bannerID) ){
                $bannerimg = cbv_get_image_tag($bannerID, 'medium');
              }
            ?>
            <div class="upload-bannerimage-inner">
              <div class="ngo-upload-cover-photo-inr">
                <div id="featured_image">
                <span>Upload Banner Image</span>
                <i><img src="<?php echo THEME_URI; ?>/assets/images/plus-black.png"></i>
                </div>
                <input type="hidden" id="_featured_picture" name="bannerimage" value="<?php echo $bannerID; ?>">
                <div id="featured-picture-priview" class="vposter-picture clearfix">
                  <?php echo $bannerimg; ?>
                </div>
              </div>
            </div>
          </div>

          <label><strong>Our Mission</strong></label>
          <hr>
          <div class="ncc-input-fields-row ncc-input-title-fields-row">
            <label>Title</label>
            <input type="text" name="mission_title" value="<?php echo $m_title;?>" placeholder="Type a Title here">
          </div>
          <div class="ncc-text-editor">
            <label>Content</label>
              <div>
                <!-- <textarea style="min-height: 640px; background: #fff; border-radius: 6px; background: #fff; width: 100%; border: none;"></textarea> -->
                <?php get_custom_content_editor('mission_content', $mcontent); ?> 
              </div>
          </div>

          <div class="gallery-video-wrapp clearfix">

            <div class="ncc-campaign-gallery ngogallery">
            <label><strong>Gallery</strong> (Upload more images)</label>
            <div class="ncc-campaign-gallery-list" >
              <ul class="ulc clearfix" id="myplugin-placeholder">
              <span class="uploadedImage" 
                style="display: inline-block;vertical-align: top; margin-right: -4px;">
                <?php 
                  $cam_galleries = !empty(get_field('ngo_galleries', $ngo_data->ID))? get_field('ngo_galleries', $ngo_data->ID): '';
                  if($cam_galleries){
                    foreach( $cam_galleries as $gallery_id ):
                      if(isset($gallery_id['id']) && !empty($gallery_id['id'])){
                        $g_id = $gallery_id['id'];
                      }elseif(isset($gallery_id) && !empty($gallery_id)){
                        $g_id = $gallery_id;
                      }
                    if( !empty($g_id) ){
                      $gallery_image = cbv_get_image_tag($g_id, 'thumbnail');
                    }
                ?>
                
                <li id="myplugin-image-li<?php echo $g_id; ?>">
                  <div class="ncc-campaign-gallery-add-img">
                    <?php echo $gallery_image;?>

                    <input id="myplugin-image-input<?php echo $g_id; ?>" type="hidden" name="attachment_id_array[]" value="<?php echo $g_id; ?>">
                    <div class="removeGallery" onclick="DeleteGalleryImage(<?php echo $g_id; ?>); return false">
                      <i class="fa fa-trash"></i>
                    </div>
                  </div>
                </li>
                <?php endforeach; }?>
                </span>
                <li>
                  <div class="ncc-campaign-gallery-add-img" id="campaign_gallery">
                    <!-- <input type="file" name="campaign_gallery"> -->
                    <i><img src="<?php echo THEME_URI; ?>/assets/images/plus-black.png"></i>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="ngovideo">
            <label><strong>Video</strong></label>
            <hr>
            <div class="ncc-input-fields-row ngo-upload-cover-photo">
              <?php 
                $posterimg = '';
                if( !empty($mposterID) ){
                  $posterimg = cbv_get_image_tag($mposterID, 'medium');
                }
              ?>
              <div class="vposter-inner">
                <div class="ngo-upload-cover-photo-inr">
                  <div id="featured_image">
                  <span>Upload Poster</span>
                  <i><img src="<?php echo THEME_URI; ?>/assets/images/plus-black.png"></i>
                  </div>
                  <input type="hidden" id="_featured_picture" name="vposter" value="<?php echo $mposterID; ?>">
                  <div id="featured-picture-priview" class="vposter-picture clearfix">
                    <?php echo $posterimg; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="ncc-input-fields-row ncc-input-title-fields-row">
              <label>Video URL</label>
              <input type="text" name="video_url" value="<?php echo $mvideo_url;?>" placeholder="Enter Video URL" required="required">
            </div>
          </div>

          </div>

          <label><strong>Bottom Content</strong></label>
          <hr>
          <div class="ncc-text-editor">
              <div>
                <!-- <textarea style="min-height: 640px; background: #fff; border-radius: 6px; background: #fff; width: 100%; border: none;"></textarea> -->
                <?php get_custom_content_editor('btm_content', $mbcontent); ?> 
              </div>
          </div>
          <input type="hidden" name="add_ngo_profile_nonce" value="<?php echo wp_create_nonce('add-ngo-profile-nonce'); ?>"/>
          <div class="ncc-submit-btns">
            <input type="submit" name="add_ngo_profile" value="Update">
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
<script type='text/javascript' src="<?php echo esc_url( home_url('/wp-includes/js/tinymce/tinymce.min.js?ver=4960-20190918') );?>"></script>
<script src="<?php echo esc_url( home_url('/wp-admin/js/editor.min.js?ver=5.3.2') );?>"></script>