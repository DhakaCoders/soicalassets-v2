<?php 
$user = wp_get_current_user();
$m_title = !empty($umetas['mission_title'])? $umetas['mission_title']: '';
$mcontent = !empty($umetas['mission_content'])? $umetas['mission_content']: '';
$mposterID = !empty($umetas['vposter'])? $umetas['vposter']: '';
$mvideo_url = !empty($umetas['video_url'])? $umetas['video_url']: '';
$mbcontent = !empty($umetas['btm_content'])? $umetas['btm_content']: '';
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
      //var_dump($umetas);
      //echo $ngoname = get_field('_ngo_name', $user->ID);get_user_meta($user->ID, '_ngo_name', true )
    ?>
      <form action="" method="post">
        <div class="width-425">
          <div class="ncc-input-fields-row ncc-input-title-fields-row">
            <label>NGO Name</label>
            <input type="text" name="_ngo_name" value="<?php echo !empty($umetas['_ngo_name'])? $umetas['_ngo_name']: '';?>" placeholder="Type a Name here" required="required">
          </div>
        </div>
        <div class="pr-190">
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
                  $cam_galleries = get_field('ngo_galleries', $user->ID);
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