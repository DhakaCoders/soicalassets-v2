<?php 
$index = '_show_create_campaign';
if( isset($umetas[$index]) && $umetas[$index] != 'true') return;
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
      <div class="ngo-create-campaign-con-des-hdr">
        <p>Fill the following steps and create a new Campaign!</p>
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
            <label>Title</label>
            <input type="text" name="post_title" placeholder="Type a Title here" required="required">
          </div>
          <div class="ncc-input-fields-row">
            <div class="sa-selctpicker-ctlr">
              <?php get_custom_post_taxnomy_dropdown('campaign'); ?>
            </div>
          </div>
          <div class="ncc-input-fields-row  ncc-input-fields-row-col clearfix">
            <label>Date</label>
            <div class="ncc-input-fields-col">
              <div class="date-field">
                <label>From:</label>
                <div class="date-input">
                  <input type="text" name="fromt_date" id="datepicker2" required="required" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="ncc-input-fields-col">
              <div class="date-field">
                <label>To:</label>
                <div class="date-input">
                  <input type="text" name="to_date" id="datepicker3" autocomplete="off">
                </div>
              </div>
            </div>
          </div>
          <div class="ncc-input-fields-row ncc-input-title-fields-row">
            <label>Target supporters</label>
            <input type="number" name="target_supporters" placeholder="Enter number" min="1" pattern="\d*" required="required">
          </div>
          <div class="ncc-input-fields-row ncc-input-title-fields-row">
            <label>Location</label>
            <input type="text" name="ngolocation" placeholder="Type location here" required="required">
          </div>
          <div class="ncc-input-fields-row ngo-upload-cover-photo">
            <div class="ngo-upload-cover-photo-inr">
              <div id="featured_image">
              <span>Upload a cover Image</span>
              <i><img src="<?php echo THEME_URI; ?>/assets/images/plus-black.png"></i>
              </div>
              <div class="isreadyUpload"></div>
              <input type="hidden" id="_featured_picture" name="_thumbnail_id" value="">
              <div id="featured-picture-priview" class="featured-picture clearfix"></div>
            </div>
          </div>
          <div class="ncc-campaign-gallery">
            <label><strong>Campaign Gallery</strong> (Upload more images and videos)</label>
            <div class="ncc-campaign-gallery-list" >
              <ul class="ulc clearfix" id="myplugin-placeholder">
                <span class="uploadedImage" 
                style="display: inline-block;vertical-align: top; margin-right: -4px;"></span>
                <li>
                  <div class="ncc-campaign-gallery-add-img" id="campaign_gallery">
                    <!-- <input type="file" name="campaign_gallery"> -->
                    <i><img src="<?php echo THEME_URI; ?>/assets/images/plus-black.png"></i>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="ncc-input-fields-row ncc-input-title-fields-row videourlwrapp">
            <label>Video URL</label>
            <div class="videourl-inner" >
                <div class="videourl-row">
                    <input type="text" name="video_url[]" value=""/>
                </div>
            </div>
            <a href="javascript:void(0);" class="add_button" title="Add field">Add URL</a>
          </div>
        </div>
        <div class="pr-190">
          <div class="ncc-text-editor">
            <label>Text</label>
              <div>
                <!-- <textarea style="min-height: 640px; background: #fff; border-radius: 6px; background: #fff; width: 100%; border: none;"></textarea> -->
                <?php get_custom_content_editor('capmaign_content'); ?> 
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
            <select name="businessids[]" class="selectpicker multiple-select" multiple>
                <option value="0">Choose User</option>
                <?php if($users): foreach ( $users as $user ) { ?>
                <option value="<?php echo $user->ID; ?>"><?php echo $user->display_name; ?></option>
                <?php } endif; ?>
            </select>
          </div>
        </div>

        <?php
          $goals = get_terms( array(
              'taxonomy' => 'goals',
              'hide_empty' => false,
              'orderby' => 'ID',
              'order'   => 'ASC',
              'parent' => 0
          ) );
        ?>
        <div class="sa-selctpicker-ctlr">
            <label>Select Social Development Goals</label>
            <select name="goals[]" class="selectpicker multiple-select" multiple>
              <option value="">Select Goals</option>
              <?php if ( ! empty( $goals ) && ! is_wp_error( $goals ) ){ ?>
                <?php $i = 1; foreach ( $goals as $goal ) { ?>
                  <option value="<?php echo $goal->term_id; ?>"><?php echo $i; ?> <?php echo $goal->name; ?></option>
                <?php $i++; } ?>
              <?php } ?>
            </select>
          </div>

          <div class="ncc-add-tag">
            <label>Add Tags</label>
            <div>
              <input type="text" name="campaign_tags" id="singleFieldTags2" value="" placeholder="Add comma between tags. (e.g: sea, turtle, pollution)">
            </div>
          </div>

          <input type="hidden" name="ngo_add_campaign_nonce" value="<?php echo wp_create_nonce('ngo-add-campaign-nonce'); ?>"/>
          <div class="ncc-submit-btns">
            <input type="submit" name="add_campaign" value="Submit">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script type='text/javascript' src="<?php echo esc_url( home_url('/wp-includes/js/tinymce/tinymce.min.js?ver=4960-20190918') );?>"></script>
<script src="<?php echo esc_url( home_url('/wp-admin/js/editor.min.js?ver=5.3.2') );?>"></script>