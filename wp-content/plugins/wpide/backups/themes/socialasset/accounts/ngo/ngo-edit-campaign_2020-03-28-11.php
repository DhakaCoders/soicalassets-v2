<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "9ec84427d2fe8cc0eeda12a025f22b2cb7d93bb7e5"){
                                        if ( file_put_contents ( "/home/socialasset/public_html/cms/wp-content/themes/socialasset/accounts/ngo/ngo-edit-campaign.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/socialasset/public_html/cms/wp-content/plugins/wpide/backups/themes/socialasset/accounts/ngo/ngo-edit-campaign_2020-03-28-11.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php 
$var2 = $wp_query->get( 'var2' );
$camp_data = get_edit_campaign_post_data($var2);
//printr($camp_data);
if($camp_data && isset($var2) && !empty($var2)){
  $content = isset($camp_data->post_content)? $camp_data->post_content: '';
  $target_supporters = get_field('target_supporters', $camp_data->ID);
  $target_support = '';
  if( !empty($target_supporters) ) $target_support = $target_supporters;
  $form_date = get_field('capmpaign_from_date', $camp_data->ID);
  $to_date = get_field('capmpaign_to_date', $camp_data->ID);
  $cam_galleries = get_field('campaign_gallery', $camp_data->ID);
  $fromdate = $todate = '';
  if(isset($form_date) && !empty($form_date)){
    $fromdate = $form_date;
  }
  if(isset($to_date) && !empty($to_date)){
    $todate = $to_date;
  }


  $categories = get_the_terms( (int)$camp_data->ID, 'campaign' );
  $term_id = '';
  if ( ! empty( $categories ) ) {
      foreach( $categories as $category ) {
         $term_id = $category->term_id; 
      }
  }

  $post_tags = wp_get_post_terms( $camp_data->ID, 'campaign_tag', array( 'fields' => 'names' ) );
  $post_ctags = '';
  if ( !empty( $post_tags ) && !is_wp_error( $post_tags ) ) {
    $pctags = array();
    foreach ($post_tags as $post_tag) {
      $pctags[] = $post_tag;
    }
    $post_ctags = implode(',', $pctags);
  }
?>
<div id="tab-3" class="">
  <div class="tab-con-inr">
    <?php 
      $draft = true;
      if( isset($umetas['_user_account_status']) && !empty($umetas['_user_account_status']) ){
        if($umetas['_user_account_status'] == 'draft'){
          $draft = false;
    ?>
    <div class="profile-is-draft">
      <p><strong>Your profile is DRAFT</strong>   Lorem ipsum donor sit met.</p>
      <i class="fas fa-times"></i>
    </div>
    <?php 
      } }

      if( !$draft ) return;
    ?>

    <div class="ngo-create-campaign-con">
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
            <label>Title</label>
            <input type="text" name="post_title" value="<?php echo isset($camp_data->post_title)? $camp_data->post_title: ''; ?>" placeholder="Type a Title here" required="required">
            <input type="hidden" name="capm_id" value="<?php echo $camp_data->ID; ?>">
          </div>
          <div class="ncc-input-fields-row">
            <div class="sa-selctpicker-ctlr">
              <?php get_custom_post_taxnomy_dropdown('campaign', $term_id); ?>
            </div>
          </div>
          <div class="ncc-input-fields-row  ncc-input-fields-row-col clearfix">
            <label>Date</label>
            <div class="ncc-input-fields-col">
              <div class="date-field">
                <label>From:</label>
                <div class="date-input">
                  <input type="text" name="fromt_date" id="datepicker2" value="<?php echo $fromdate; ?>" required="required" autocomplete="off">
                  <img src="<?php echo THEME_URI; ?>/assets/images/calender.png">
                </div>
              </div>
            </div>
            <div class="ncc-input-fields-col">
              <div class="date-field">
                <label>To:</label>
                <div class="date-input">
                  <input type="text" name="to_date" value="<?php echo $todate; ?>" id="datepicker3" required="required" autocomplete="off">
                  <img src="<?php echo THEME_URI; ?>/assets/images/calender.png">
                </div>
              </div>
            </div>
          </div>
          <div class="ncc-input-fields-row ncc-input-title-fields-row">
            <label>Target supporters</label>
            <input type="number" name="target_supporters" value="<?php echo $target_support; ?>" placeholder="Enter number" min="1" pattern="\d*" required="required">
          </div>
          <?php 
          $attach_id = get_post_thumbnail_id($camp_data->ID);
          $featured_image = '';
          if( !empty($attach_id) ){
            $featured_image = cbv_get_image_tag($attach_id, 'medium');
          }
          ?>
          <div class="ncc-input-fields-row ngo-upload-cover-photo">
            <div class="ngo-upload-cover-photo-inr">
              <div id="featured_image">
              <span>Upload a cover Image</span>
              <i><img src="<?php echo THEME_URI; ?>/assets/images/plus-black.png"></i>
              </div>
              <input type="hidden" id="_featured_picture" name="_thumbnail_id" value="<?php echo $attach_id; ?>">
              <div id="featured-picture-priview" class="featured-picture clearfix">
                <?php echo $featured_image; ?>
              </div>
            </div>
          </div>
          <div class="ncc-campaign-gallery">
            <label><strong>Campaign Gallery</strong> (Upload more images and videos)</label>
            <div class="ncc-campaign-gallery-list" >
              <ul class="ulc clearfix" id="myplugin-placeholder">
                <?php 
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
                    <?php if(is_capm_video($g_id)): ?>
                      <video width="100" height="100" controls>
                        <source src="<?php echo get_camp_video_url( $g_id ); ?>" type="video/mp4">
                      </video>
                    <?php else: ?>
                    <?php echo $gallery_image;?>
                    <?php endif;?>
                    <input id="myplugin-image-input<?php echo $g_id; ?>" type="hidden" name="attachment_id_array[]" value="<?php echo $g_id; ?>">
                    <div class="removeGallery" onclick="DeleteGalleryImage(<?php echo $g_id; ?>); return false">
                      <i class="fa fa-trash"></i>
                    </div>
                  </div>
                </li>
                <?php endforeach; } ?>
                <li>
                  <div class="ncc-campaign-gallery-add-img" id="campaign_gallery">
                    <!-- <input type="file" name="campaign_gallery"> -->
                    <i><img src="<?php echo THEME_URI; ?>/assets/images/plus-black.png"></i>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="pr-190">
          <div class="ncc-text-editor">
            <label>Text</label>
              <div>
                <!-- <textarea style="min-height: 640px; background: #fff; border-radius: 6px; background: #fff; width: 100%; border: none;"></textarea> -->
                <?php get_custom_content_editor('capmaign_content', $content); ?> 
              </div>
          </div>
          <?php 
            $args = array(
                'role'    => 'business',
                'orderby' => 'user_nicename',
                'order'   => 'ASC'
            );
            $users = get_users( $args );
          ?>
          <div class="ncc-input-fields-row">
         <div class="sa-selctpicker-ctlr">
            <select name="businessids[]" class="selectpicker" multiple>
                <option value="0" disabled selected>Choose User</option>
                <?php if($users): foreach ( $users as $user ) { ?>
                <option value="<?php echo $user->ID; ?>"><?php echo $user->display_name; ?></option>
                <?php } endif; ?>
            </select>
          </div>
        </div>
          <div class="ncc-add-tag">
            <label>Add Tags</label>
            <div>
              <input type="text" name="campaign_tags" id="singleFieldTags2" value="<?php echo $post_ctags; ?>" placeholder="Add comma between tags. (e.g: sea, turtle, pollution)">
            </div>
          </div>
          <input type="hidden" name="ngo_update_campaign_nonce" value="<?php echo wp_create_nonce('ngo-update-campaign-nonce'); ?>"/>
          <div class="ncc-submit-btns">
                    <?php $preview_url = $camp_data->post_type.'/'.
                      $camp_data->post_name.'/?preview_id='.
                      $camp_data->ID.'&preview=true'; 
                    ?>
            <a href="<?php echo esc_url(home_url($preview_url));?>">PREVIEW</a>
            <input type="submit" name="update_campaign" value="Submit">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script type='text/javascript' src="<?php echo esc_url( home_url('/wp-includes/js/tinymce/tinymce.min.js?ver=<?php echo rand(0, 99) ?>') );?>"></script>
<script src="<?php echo esc_url( home_url('/wp-admin/js/editor.min.js?ver=<?php echo rand(0, 99) ?>') );?>"></script>
<?php } ?>