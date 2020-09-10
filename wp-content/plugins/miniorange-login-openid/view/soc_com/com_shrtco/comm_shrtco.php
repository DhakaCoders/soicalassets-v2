<?php

function select_comment_shortcode(){
    ?>
    <div class="mo_openid_table_layout" id="openid_comments_shortcode" style="font-size:13px !important">
        <br/><code id="10">[miniorange_social_comments]</code>
        <i style= "width: 11px;height: 9px;padding-left:2px;padding-top:3px" class="mofa mofa-fw mofa-lg mofa-copy mo_copy mo_copytooltip" onclick="copyToClipboard(this, '#10', '#shortcode_url10_copy')"><span id="shortcode_url10_copy" class="mo_copytooltiptext">Copy to Clipboard</span></i>
        <br/><br/>
            1. <?php echo mo_sl('Configure Social Comments in the Social Comments tab of the plugin');?>.<br>
            2. <?php echo mo_sl('Keep both the display options checked and Save');?>.<br>
            3. <?php echo mo_sl('Enable Comments for the post/page you want to add');?> <br>
            4. <b><?php echo mo_sl('Pages-> Quick Edit-> Allow Comments');?></b> <?php echo mo_sl('(Skip this step if you already have Comments enabled.)');?><br>
            5. <?php echo mo_sl('Add the shortcode ');?>[miniorange_social_comments] <?php echo mo_sl('to an individual page/post');?>.<br>
    </div>
<script>
    jQuery('#mo_openid_page_heading').text('<?php echo mo_sl('Social Comments Shortcodes');?>');
</script>
    <?php

}
?>
