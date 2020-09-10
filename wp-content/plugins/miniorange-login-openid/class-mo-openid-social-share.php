<?php


if(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'){
	$http = "https://";
} else {
	$http =  "http://";
}
$url = $http . $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'];


    $selected_theme = esc_attr(get_option('mo_openid_share_theme'));
    $selected_direction = esc_attr(get_option('mo_openid_share_widget_customize_direction'));
    $sharingSize = esc_attr(get_option('mo_sharing_icon_custom_size'));
    $custom_color = esc_attr(get_option('mo_sharing_icon_custom_color'));
    $custom_theme = esc_attr(get_option('mo_openid_share_custom_theme'));
    $fontColor = esc_attr(get_option('mo_sharing_icon_custom_font'));
    $spaceBetweenIcons = esc_attr(get_option('mo_sharing_icon_space'));
    $twitter_username = esc_attr(get_option('mo_openid_share_twitter_username'));
    $heading_text = esc_html(get_option('mo_openid_share_widget_customize_text'));
    $heading_color = esc_attr(get_option('mo_openid_share_widget_customize_text_color'));

    $email_subject = esc_attr(get_option('mo_openid_share_email_subject'));
    $email_body = get_option('mo_openid_share_email_body');
	$email_body = str_replace('##url##', $url, $email_body);

	$orientation = 'hor';
	if($landscape) {
		if($landscape == 'horizontal') {
			$orientation = 'hor';
		} else if($landscape == 'vertical') {
			$orientation = 'ver';
		}
	} else {
		if(get_option('mo_openid_share_widget_customize_direction_horizontal')) {
			$orientation = 'hor';
		} else if(get_option('mo_openid_share_widget_customize_direction_vertical')) {
			$orientation = 'ver';
		}
	}
?>
<script>

	function popupCenter(pageURL, w,h) {
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
		var targetWin = window.open (pageURL, "_blank",'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	}
	function pinIt()
	{
       var e = document.createElement('script');
       e.setAttribute('type','text/javascript');
       e.setAttribute('charset','UTF-8');
       e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);
	   document.body.appendChild(e);
	}
</script>


<div class="mo-openid-app-icons circle ">
	<p style="color: #<?php echo $heading_color; ?>;"><?php
		if( $orientation == 'hor' ) {
			echo $heading_text;
	 	?></p>
	 		<div class="horizontal">
				<?php
				if($custom_theme == 'custom'){
					if( get_option('mo_openid_facebook_share_enable') ) {
                        $link = esc_url('https://www.facebook.com/dialog/share?app_id=766555246789034&amp;display=popup&amp;href='.$url);
                        ?>
						<a rel='nofollow' title="Facebook" onclick="popupCenter('<?php echo $link; ?>', 800, 400);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-facebook" style="padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_twitter_share_enable') ) {
						$link = esc_url(empty($twitter_username) ? 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$url : 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$url. '&amp;via='.$twitter_username);
						?>
						<a rel='nofollow' title="Twitter" onclick="popupCenter('<?php echo $link; ?>', 600, 300);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-twitter" style="padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_google_share_enable') ) {
						$link = esc_url('https://plus.google.com/share?url='.$url);
						?>
						<a rel='nofollow' title="Google" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-google-plus" style="padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;"></i></a>
						<?php
					}

					if( get_option('mo_openid_vkontakte_share_enable') ) {
						$link = esc_url('http://vk.com/share.php?url='.$url.'&amp;title='.$title.'&amp;description='.$excerpt);
						?>
						<a rel='nofollow' title="Vkontakte"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-vk" style="padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_tumblr_share_enable') ) {
						$link = esc_url('http://www.tumblr.com/share/link?url='.$url.'&amp;title='.$title.'&amp;description='.$excerpt);
						?>
						<a rel='nofollow' title="Tumblr"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-tumblr" style="padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_stumble_share_enable') ) {
						$link = esc_url('http://www.stumbleupon.com/submit?url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="StumbleUpon"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-stumbleupon" style="padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_linkedin_share_enable') ) {
						$link = esc_url('https://www.linkedin.com/shareArticle?mini=true&amp;title='.$title.'&amp;url='.$url.'&amp;summary='.$excerpt);
						?>
						<a rel='nofollow' title="LinkekIn" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-linkedin" style="padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_reddit_share_enable') ) {
						$link = esc_url('http://www.reddit.com/submit?url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="Reddit"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-reddit" style="padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_pinterest_share_enable') ) {
						?>
						<a rel='nofollow' title="Pinterest"  href='javascript:pinIt();' class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-pinterest" style="padding-top:3px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-10); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_pocket_share_enable') ) {
						$link = esc_url('https://getpocket.com/save?url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="Pocket"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-get-pocket" style="padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_digg_share_enable') ) {
						$link = esc_url('http://digg.com/submit?url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="Digg"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-digg" style="padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_delicious_share_enable') ) {
						$link = esc_url('http://www.delicious.com/save?v=5&noui&jump=close&url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="Delicious"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-delicious" style="padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_odnoklassniki_share_enable') ) {
						$link = esc_url('http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st.comments='.$excerpt.'&amp;st._surl='.$url);
						?>
						<a rel='nofollow' title="Odnoklassniki"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-odnoklassniki" style="padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}
					if( get_option('mo_openid_mail_share_enable') ) {
						?>
						<a rel='nofollow' title="Email this page" onclick="popupCenter('mailto:?subject=<?php echo $email_subject ?>&amp;body=<?php echo $email_body ?>',800,500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important">
						<i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-envelope" style="padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}
					if( get_option('mo_openid_print_share_enable') ) {
						?>
						<a rel='nofollow' title="Print this page" onclick="javascript:window.print()"class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important">
						<i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-print" style="padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}
                    if( get_option('mo_openid_whatsapp_share_enable') && wp_is_mobile()) {

                        ?>
                        <a rel='nofollow'  title="Whatsapp" href='whatsapp://send?text=<?php echo $url?>'  class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important">
                            <i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-whatsapp" style="padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
                        <?php
                    }
                    else if( get_option('mo_openid_whatsapp_share_enable') ) {

                        ?>
                        <a rel='nofollow' title="Whatsapp" target ='_blank' href='https://web.whatsapp.com/send?text=<?php echo $url?>'  class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important">
                            <i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-whatsapp" style="padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
                        <?php
                    }
				}

				else if($custom_theme == 'customFont'){
					if( get_option('mo_openid_facebook_share_enable') ) {
                        $link = esc_url('https://www.facebook.com/dialog/share?app_id=766555246789034&amp;display=popup&amp;href='.$url);
                        ?>
						<a rel='nofollow' title="Facebook" onclick="popupCenter('<?php echo $link; ?>', 800, 400);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons-6?>px !important"><i class=" <?php echo $selected_theme; ?> mofa mofa-facebook" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_twitter_share_enable') ) {
						$link = esc_url(empty($twitter_username) ? 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$url : 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$url. '&amp;via='.$twitter_username);
						?>
						<a rel='nofollow' title="Twitter" onclick="popupCenter('<?php echo $link; ?>', 600, 300);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons-6?>px !important"><i class=" <?php echo $selected_theme; ?> mofa mofa-twitter" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_google_share_enable') ) {
						$link = esc_url('https://plus.google.com/share?url='.$url);
						?>
						<a rel='nofollow' title="Google" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons-6?>px !important"><i class=" <?php echo $selected_theme; ?> mofa mofa-google-plus" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_vkontakte_share_enable') ) {
						$link = esc_url('http://vk.com/share.php?url='.$url.'&amp;title='.$title.'&amp;description='.$excerpt);
						?>
						<a rel='nofollow' title="Vkontakte" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons-6?>px !important"><i class=" <?php echo $selected_theme; ?> mofa mofa-vk" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_tumblr_share_enable') ) {
						$link = esc_url('http://www.tumblr.com/share/link?url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="Tumblr"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons-6?>px !important"><i class=" <?php echo $selected_theme; ?> mofa mofa-tumblr" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_stumble_share_enable') ) {
						$link = esc_url('http://www.stumbleupon.com/submit?url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="StumbleUpon"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons-6?>px !important"><i class=" <?php echo $selected_theme; ?> mofa mofa-stumbleupon" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_linkedin_share_enable') ) {
						$link = esc_url('https://www.linkedin.com/shareArticle?mini=true&amp;title='.$title.'&amp;url='.$url.'&amp;summary='.$excerpt);
						?>
						<a rel='nofollow' title="LinkedIn" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons-6?>px !important"><i class=" <?php echo $selected_theme; ?> mofa mofa-linkedin" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_reddit_share_enable') ) {
						$link = esc_url('http://www.reddit.com/submit?url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="Reddit"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons-6?>px !important"><i class=" <?php echo $selected_theme; ?> mofa mofa-reddit" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_pinterest_share_enable') ) {
						?>
						<a rel='nofollow' title="Pinterest"  href='javascript:pinIt();' class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons-6?>px !important"><i class=" <?php echo $selected_theme; ?> mofa mofa-pinterest" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_pocket_share_enable') ) {
						$link = esc_url('https://getpocket.com/save?url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="Pocket"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons-6?>px !important"><i class=" <?php echo $selected_theme; ?> mofa mofa-get-pocket" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_digg_share_enable') ) {
						$link = esc_url('http://digg.com/submit?url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="Digg"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons-6?>px !important"><i class=" <?php echo $selected_theme; ?> mofa mofa-digg" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}

					if( get_option('mo_openid_delicious_share_enable') ) {
						$link = esc_url('http://www.delicious.com/save?v=5&noui&jump=close&url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="Delicious"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons-6?>px !important"><i class=" <?php echo $selected_theme; ?> mofa mofa-delicious" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}
					if( get_option('mo_openid_odnoklassniki_share_enable') ) {
						$link = esc_url('http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st.comments='.$excerpt.'&amp;st._surl='.$url);
						?>
						<a rel='nofollow' title="Odnoklassniki"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons-6?>px !important"><i class=" <?php echo $selected_theme; ?> mofa mofa-odnoklassniki" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}
					if( get_option('mo_openid_mail_share_enable') ) {
						?>
						<a rel='nofollow' title="Email this page" onclick="popupCenter('mailto:?subject=<?php echo $email_subject ?>&amp;body=<?php echo $email_body ?>',800,500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important">
						<i class=" <?php echo $selected_theme; ?> mofa mofa-envelope" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}
					if( get_option('mo_openid_print_share_enable') ) {
						?>
						<a rel='nofollow' title="Print this page" onclick="javascript:window.print()" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important">
						<i class=" <?php echo $selected_theme; ?> mofa mofa-print" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
						<?php
					}
                    if( get_option('mo_openid_whatsapp_share_enable')&& wp_is_mobile() ) {

                        ?>
                        <a rel='nofollow'  title="Whatsapp" href='whatsapp://send?text=<?php echo $url?>'  class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important">
                            <i class=" <?php echo $selected_theme; ?> mofa mofa-whatsapp" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
                        <?php
                    }
                    else if( get_option('mo_openid_whatsapp_share_enable') ) {

                        ?>
                        <a rel='nofollow' title="Whatsapp" target ='_blank' href='https://web.whatsapp.com/send?text=<?php echo $url?>'  class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important">
                            <i class=" <?php echo $selected_theme; ?> mofa mofa-whatsapp" style="padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-4; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
                        <?php
                    }
                }

				else{


					if( get_option('mo_openid_facebook_share_enable') ) {
                        $link = esc_url('https://www.facebook.com/dialog/share?app_id=766555246789034&amp;display=popup&amp;href='.$url);
                        ?>
						<a rel='nofollow' title="Facebook" onclick="popupCenter('<?php echo $link; ?>', 800, 400);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><img alt='Facebook' style= 'padding-top:2px; height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/facebook.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
						<?php
					}

					if( get_option('mo_openid_twitter_share_enable') ) {
						$link = esc_url(empty($twitter_username) ? 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$url : 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$url. '&amp;via='.$twitter_username);
						?>
						<a rel='nofollow' title="Twitter" onclick="popupCenter('<?php echo $link; ?>', 600, 300);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><img alt='Twitter' style= 'padding-top:2px; height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/twitter.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
						<?php
					}

					if( get_option('mo_openid_google_share_enable') ) {
						$link = esc_url('https://plus.google.com/share?url='.$url);
						?>
						<a rel='nofollow' title="Google" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><img alt='Google' style= 'padding-top:2px; height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;background-color: <?php echo $selected_theme; ?>' src="<?php echo plugins_url( 'includes/images/icons/google.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
						<?php
					}

					if( get_option('mo_openid_vkontakte_share_enable') ) {
						$link = esc_url('http://vk.com/share.php?url='.$url.'&amp;title='.$title.'&amp;description='.$excerpt);
						?>
						<a rel='nofollow' title="Vkontakte" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><img alt='Vkontakte' style= 'padding-top:2px; height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;background-color: <?php echo $selected_theme; ?>' src="<?php echo plugins_url( 'includes/images/icons/vk.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
						<?php
					}

					if( get_option('mo_openid_tumblr_share_enable') ) {
						$link = esc_url('http://www.tumblr.com/share/link?url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="Tumblr"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><img alt='Tumblr' style= 'padding-top:2px; height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/tumblr.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
						<?php
					}

					if( get_option('mo_openid_stumble_share_enable') ) {
						$link = esc_url('http://www.stumbleupon.com/submit?url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="StumbleUpon"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><img alt='StumbleUpon' style= 'padding-top:2px; height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/stumble.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
						<?php
					}

					if( get_option('mo_openid_linkedin_share_enable') ) {
						$link = esc_url('https://www.linkedin.com/shareArticle?mini=true&amp;title='.$title.'&amp;url='.$url.'&amp;summary='.$excerpt);
						?>
						<a rel='nofollow' title="LinkedIn" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><img alt='LinkedIn' style= 'padding-top:2px; height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/linkedin.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
						<?php
					}

					if( get_option('mo_openid_reddit_share_enable') ) {
						$link = esc_url('http://www.reddit.com/submit?url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="Reddit"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><img alt='Reddit' style= 'padding-top:2px; height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/reddit.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
						<?php
					}
					if( get_option('mo_openid_pinterest_share_enable') ) {
						?>
						<a rel='nofollow' title="Pinterest"  href='javascript:pinIt();' class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><img alt='Pinterest' style= 'padding-top:2px; height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/pinterest.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
						<?php
					}
					if( get_option('mo_openid_pocket_share_enable') ) {
						$link = esc_url('https://getpocket.com/save?url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="Pocket"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><img alt='Pocket' style= 'padding-top:2px; height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/pocket.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
						<?php
					}
					if( get_option('mo_openid_digg_share_enable') ) {
						$link = esc_url('http://digg.com/submit?url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="Digg"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><img alt='Digg' style= 'padding-top:2px; height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/digg.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
						<?php
					}
					if( get_option('mo_openid_delicious_share_enable') ) {
						$link = esc_url('http://www.delicious.com/save?v=5&noui&jump=close&url='.$url.'&amp;title='.$title);
						?>
						<a rel='nofollow' title="Delicious"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><img alt='Delicious' style= 'padding-top:2px; height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/delicious.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
						<?php
					}
					if( get_option('mo_openid_odnoklassniki_share_enable') ) {
						$link = esc_url('http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st.comments='.$excerpt.'&amp;st._surl='.$url);
						?>
						<a rel='nofollow' title="Odnoklassniki"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important"><img alt='Odnoklassniki' style= 'padding-top:2px; height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/odnoklassniki.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
						<?php
					}
					if( get_option('mo_openid_mail_share_enable') ) {
						?>
						<a rel='nofollow' title="Email this page" onclick="popupCenter('mailto:?subject=<?php echo $email_subject ?>&amp;body=<?php echo $email_body ?>',800,500);" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important">
						<img alt='Email' style= 'padding-top:2px; height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/mail.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>">
						</a>
						<?php
					}
					if( get_option('mo_openid_print_share_enable') ) {
						?>
						<a rel='nofollow' title="Print this page" onclick="javascript:window.print()" class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important">
						<img alt='Print' style= 'padding-top:2px; height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/print.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>">
						</a>
						<?php
					}
                    if( get_option('mo_openid_whatsapp_share_enable') && wp_is_mobile()) {

                        ?>
                        <a rel='nofollow'  title="Whatsapp" href='whatsapp://send?text=<?php echo $url?>'  class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important">
                            <img alt='Whatsapp' style= 'height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/whatsapp.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>"  data-action="share/whatsapp/share"></a>
                        <?php
                    }
                    else if( get_option('mo_openid_whatsapp_share_enable') ) {

                    ?>
                    <a rel='nofollow'title="Whatsapp" target ='_blank' href='https://web.whatsapp.com/send?text=<?php echo $url?>'  class="mo-openid-share-link" style="margin-left : <?php echo $spaceBetweenIcons?>px !important">
                        <img alt='Whatsapp' style= 'height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/whatsapp.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>"  data-action="share/whatsapp/share"></a>
                    <?php
                    }
				}
			?></p>
		</div>
		<?php
	}?>
	<?php if( $orientation == 'ver' ) {?>
		<div id="mo_floating_vertical_widget">
			<?php
			if($custom_theme == 'custom'){
				if( get_option('mo_openid_facebook_share_enable') ) {
                    $link = esc_url('https://www.facebook.com/dialog/share?app_id=766555246789034&amp;display=popup&amp;href='.$url);
                    ?>
					<a rel='nofollow' title="Facebook" onclick="popupCenter('<?php echo $link; ?>', 800, 400);" class="mo-openid-share-link" style="margin-bottom:<?php echo $space_icons?>px !important;"><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-facebook" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_twitter_share_enable') ) {
					$link = esc_url(empty($twitter_username) ? 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$url : 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$url. '&amp;via='.$twitter_username);
					?>
					<a rel='nofollow' title="Twitter" onclick="popupCenter('<?php echo $link; ?>', 600, 300);" class="mo-openid-share-link" ><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-twitter" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_google_share_enable') ) {
					$link = esc_url('https://plus.google.com/share?url='.$url);
					?>
					<a rel='nofollow' title="Google" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-bottom:<?php echo $space_icons?>px !important;"><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-google-plus" style="margin-bottom:<?php echo $space_icons-4?>px!important; padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_vkontakte_share_enable') ) {
					$link = esc_url('http://vk.com/share.php?url='.$url.'&amp;title='.$title.'&amp;description='.$excerpt);
					?>
					<a rel='nofollow' title="Vkontakte" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" style="margin-bottom:<?php echo $space_icons?>px !important;"><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-vk" style="margin-bottom:<?php echo $space_icons-4?>px!important; padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_tumblr_share_enable') ) {
					$link = esc_url('http://www.tumblr.com/share/link?url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="Tumblr"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-tumblr" style="margin-bottom:<?php echo $space_icons-4?>px!important;padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_stumble_share_enable') ) {
					$link = esc_url('http://www.stumbleupon.com/submit?url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="StumbleUpon"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-stumbleupon" style="margin-bottom:<?php echo $space_icons-4?>px!important;padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_linkedin_share_enable') ) {
					$link = esc_url('https://www.linkedin.com/shareArticle?mini=true&amp;title='.$title.'&amp;url='.$url.'&amp;summary='.$excerpt);
					?>
					<a rel='nofollow' title="LinkedIn" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-linkedin" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_reddit_share_enable') ) {
					$link = esc_url('http://www.reddit.com/submit?url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="Reddit"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-reddit" style="margin-bottom:<?php echo $space_icons-4?>px!important;padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_pinterest_share_enable') ) {
					?>
					<a rel='nofollow' title="Pinterest"  href='javascript:pinIt();' class="mo-openid-share-link" ><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-pinterest" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:3px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-10); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_pocket_share_enable') ) {
					$link = esc_url('https://getpocket.com/save?url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="Pocket"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-get-pocket" style="margin-bottom:<?php echo $space_icons-4?>px!important;padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_digg_share_enable') ) {
					$link = esc_url('http://digg.com/submit?url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="Digg"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-digg" style="margin-bottom:<?php echo $space_icons-4?>px!important;padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_delicious_share_enable') ) {
					$link = esc_url('http://www.delicious.com/save?v=5&noui&jump=close&url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="Delicious"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-delicious" style="margin-bottom:<?php echo $space_icons-4?>px!important;padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_odnoklassniki_share_enable') ) {
					$link = esc_url('http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st.comments='.$excerpt.'&amp;st._surl='.$url);
					?>
					<a rel='nofollow' title="Odnoklassniki"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-odnoklassniki" style="margin-bottom:<?php echo $space_icons-4?>px!important;padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}
				if( get_option('mo_openid_mail_share_enable') ) {
					?>
					<a rel='nofollow' title="Email this page" onclick="popupCenter('mailto:?subject=<?php echo $email_subject ?>&amp;body=<?php echo $email_body ?>',800,500);" class="mo-openid-share-link">
					<i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-envelope" style="margin-bottom:<?php echo $space_icons-4?>px!important;padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
					}
				if( get_option('mo_openid_print_share_enable') ) {
					?>
					<a rel='nofollow' title="Print this page" onclick="javascript:window.print()"class="mo-openid-share-link">
					<i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-print" style="margin-bottom:<?php echo $space_icons-4?>px!important;padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
					}
                if( get_option('mo_openid_whatsapp_share_enable')&& wp_is_mobile() ) {

                    ?>
                    <a rel='nofollow' title="Whatsapp" href='whatsapp://send?text=<?php echo $url?>'  class="mo-openid-share-link">
                        <i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-whatsapp" style="margin-bottom:<?php echo $space_icons-4?>px!important;padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
                    <?php
                }
                else if( get_option('mo_openid_whatsapp_share_enable') ) {

                    ?>
                    <a rel='nofollow' title="Whatsapp" target ='_blank' href='https://web.whatsapp.com/send?text=<?php echo $url?>'  class="mo-openid-share-link">
                        <i class="mo-custom-share-icon <?php echo $selected_theme; ?> mofa mofa-whatsapp" style="margin-bottom:<?php echo $space_icons-4?>px!important;padding-top:8px;text-align:center;color:#ffffff;font-size:<?php echo ($sharingSize-16); ?>px !important;background-color:#<?php echo $custom_color?>;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
                    <?php
                }
			}
			else if($custom_theme == 'customFont'){
				if( get_option('mo_openid_facebook_share_enable') ) {
                    $link = esc_url('https://www.facebook.com/dialog/share?app_id=766555246789034&amp;display=popup&amp;href='.$url);
                    ?>
					<a rel='nofollow' title="Facebook" onclick="popupCenter('<?php echo $link; ?>', 800, 400);" class="mo-openid-share-link"><i class=" <?php echo $selected_theme; ?> mofa mofa-facebook" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top : 4px !important;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_twitter_share_enable') ) {
					$link = esc_url(empty($twitter_username) ? 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$url : 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$url. '&amp;via='.$twitter_username);
					?>
					<a rel='nofollow' title="Twitter" onclick="popupCenter('<?php echo $link; ?>', 600, 300);" class="mo-openid-share-link" ><i class=" <?php echo $selected_theme; ?> mofa mofa-twitter" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_google_share_enable') ) {
					$link = esc_url('https://plus.google.com/share?url='.$url);
					?>
					<a rel='nofollow' title="Google" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link"><i class=" <?php echo $selected_theme; ?> mofa mofa-google-plus" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_vkontakte_share_enable') ) {
					$link = esc_url('http://vk.com/share.php?url='.$url.'&amp;title='.$title.'&amp;description='.$excerpt);
					?>
					<a rel='nofollow' title="Vkontakte" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link"><i class=" <?php echo $selected_theme; ?> mofa mofa-vk" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_tumblr_share_enable') ) {
					$link = esc_url('http://www.tumblr.com/share/link?url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="Tumblr" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><i class=" <?php echo $selected_theme; ?> mofa mofa-tumblr" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_stumble_share_enable') ) {
					$link = esc_url('http://www.stumbleupon.com/submit?url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="StumbleUpon" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><i class=" <?php echo $selected_theme; ?> mofa mofa-stumbleupon" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_linkedin_share_enable') ) {
					$link = esc_url('https://www.linkedin.com/shareArticle?mini=true&amp;title='.$title.'&amp;url='.$url.'&amp;summary='.$excerpt);
					?>
					<a rel='nofollow' title="LinkedIn" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><i class=" <?php echo $selected_theme; ?> mofa mofa-linkedin" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:4px !important;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_reddit_share_enable') ) {
					$link = esc_url('http://www.reddit.com/submit?url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="Reddit" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><i class=" <?php echo $selected_theme; ?> mofa mofa-reddit" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_pinterest_share_enable') ) {
					?>
					<a rel='nofollow' title="Pinterest" href='javascript:pinIt();' class="mo-openid-share-link" ><i class=" <?php echo $selected_theme; ?> mofa mofa-pinterest" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize-5; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_pocket_share_enable') ) {
					$link = esc_url('https://getpocket.com/save?url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="Pocket" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><i class=" <?php echo $selected_theme; ?> mofa mofa-get-pocket" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_digg_share_enable') ) {
					$link = esc_url('http://digg.com/submit?url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="Digg" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><i class=" <?php echo $selected_theme; ?> mofa mofa-digg" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_delicious_share_enable') ) {
					$link = esc_url('http://www.delicious.com/save?v=5&noui&jump=close&url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="Delicious" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><i class=" <?php echo $selected_theme; ?> mofa mofa-delicious" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}

				if( get_option('mo_openid_odnoklassniki_share_enable') ) {
					$link = esc_url('http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st.comments='.$excerpt.'&amp;st._surl='.$url);
					?>
					<a rel='nofollow' title="Odnoklassniki" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><i class=" <?php echo $selected_theme; ?> mofa mofa-odnoklassniki" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
				}
				if( get_option('mo_openid_mail_share_enable') ) {
					?>
					<a rel='nofollow' title="Email this page" onclick="popupCenter('mailto:?subject=<?php echo $email_subject ?>&amp;body=<?php echo $email_body ?>',800,500);" class="mo-openid-share-link">
					<i class=" <?php echo $selected_theme; ?> mofa mofa-envelope" style=" padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
					}
				if( get_option('mo_openid_print_share_enable') ) {
					?>
					<a rel='nofollow' title="Print this page" onclick="javascript:window.print()" class="mo-openid-share-link">
					<i class=" <?php echo $selected_theme; ?> mofa mofa-print" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
					<?php
					}
                if( get_option('mo_openid_whatsapp_share_enable') && wp_is_mobile()) {

                    ?>
                    <a rel='nofollow'title="Whatsapp" href='whatsapp://send?text=<?php echo $url?>'  class="mo-openid-share-link">
                        <i class=" <?php echo $selected_theme; ?> mofa mofa-whatsapp" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
                    <?php
                }
                else if( get_option('mo_openid_whatsapp_share_enable') ) {

                    ?>
                    <a rel='nofollow' title="Whatsapp" target ='_blank' href='https://web.whatsapp.com/send?text=<?php echo $url?>'  class="mo-openid-share-link">
                        <i class=" <?php echo $selected_theme; ?> mofa mofa-whatsapp" style="margin-bottom:<?php echo $space_icons-4?>px !important;padding-top:4px;text-align:center;color:#<?php echo $fontColor ?> !important;font-size:<?php echo $sharingSize; ?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important"></i></a>
                    <?php
                }
			}
			else{
				if( get_option('mo_openid_facebook_share_enable') ) {
                    $link = esc_url('https://www.facebook.com/dialog/share?app_id=766555246789034&amp;display=popup&amp;href='.$url);
                    ?>
					<a rel='nofollow' title="Facebook" onclick="popupCenter('<?php echo $link; ?>', 800, 400);" class="mo-openid-share-link"><img alt='Facebook' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;background-color:white;' src="<?php echo plugins_url( 'includes/images/icons/facebook.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
					<?php
				}

				if( get_option('mo_openid_twitter_share_enable') ) {
					$link = esc_url(empty($twitter_username) ? 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$url : 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$url. '&amp;via='.$twitter_username);
					?>
					<a rel='nofollow' title="Twitter" onclick="popupCenter('<?php echo $link; ?>', 600, 300);" class="mo-openid-share-link" ><img alt='Twitter' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;background-color:white;' src="<?php echo plugins_url( 'includes/images/icons/twitter.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
					<?php
				}

				if( get_option('mo_openid_google_share_enable') ) {
					$link = esc_url('https://plus.google.com/share?url='.$url);
					?>
					<a rel='nofollow' title="Google" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link"><img alt='Google' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;background-color: <?php echo $selected_theme; ?>' src="<?php echo plugins_url( 'includes/images/icons/google.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
					<?php
				}

				if( get_option('mo_openid_vkontakte_share_enable') ) {
					$link = esc_url('http://vk.com/share.php?url='.$url.'&amp;title='.$title.'&amp;description='.$excerpt);
					?>
					<a rel='nofollow' title="Vkontakte" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link"><img alt='Vkontakte' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;background-color: <?php echo $selected_theme; ?>' src="<?php echo plugins_url( 'includes/images/icons/vk.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
					<?php
				}

				if( get_option('mo_openid_tumblr_share_enable') ) {
					$link = esc_url('http://www.tumblr.com/share/link?url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="Tumblr"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><img alt='Tumblr' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/tumblr.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
					<?php
				}

				if( get_option('mo_openid_stumble_share_enable') ) {
					$link = esc_url('http://www.stumbleupon.com/submit?url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="StumbleUpon"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><img alt='StumbleUpon' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/stumble.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
					<?php
				}

				if( get_option('mo_openid_linkedin_share_enable') ) {
					$link = esc_url('https://www.linkedin.com/shareArticle?mini=true&amp;title='.$title.'&amp;url='.$url.'&amp;summary='.$excerpt);
					?>
					<a rel='nofollow' title="LinkedIn" onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><img alt='LinkedIn' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;background-color:white;' src="<?php echo plugins_url( 'includes/images/icons/linkedin.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
					<?php
				}

				if( get_option('mo_openid_reddit_share_enable') ) {
					$link = esc_url('http://www.reddit.com/submit?url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="Reddit"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><img alt='Reddit' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/reddit.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
					<?php
				}

				if( get_option('mo_openid_pinterest_share_enable') ) {
					?>
					<a rel='nofollow' title="Pinterest"  href='javascript:pinIt();' class="mo-openid-share-link" ><img alt='Pinterest' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/pinterest.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
					<?php
				}

				if( get_option('mo_openid_pocket_share_enable') ) {
					$link = esc_url('https://getpocket.com/save?url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="Pocket"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><img alt='Pocket' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/pocket.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
					<?php
				}

				if( get_option('mo_openid_digg_share_enable') ) {
					$link = esc_url('http://digg.com/submit?url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="Digg"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><img alt='Digg' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/digg.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
					<?php
				}

				if( get_option('mo_openid_delicious_share_enable') ) {
					$link = esc_url('http://www.delicious.com/save?v=5&noui&jump=close&url='.$url.'&amp;title='.$title);
					?>
					<a rel='nofollow' title="Delicious"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><img alt='Delicoius' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/delicious.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
					<?php
				}

				if( get_option('mo_openid_odnoklassniki_share_enable') ) {
					$link = esc_url('http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st.comments='.$excerpt.'&amp;st._surl='.$url);
					?>
					<a rel='nofollow' title="Odnoklassniki"  onclick="popupCenter('<?php echo $link; ?>', 800, 500);" class="mo-openid-share-link" ><img  alt='Odnoklassniki' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/odnoklassniki.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>" ></a>
					<?php
				}

				if( get_option('mo_openid_mail_share_enable') ) {
					?>
					<a rel='nofollow' title="Email this page" onclick="popupCenter('mailto:?subject=<?php echo $email_subject ?>&amp;body=<?php echo $email_body ?>',800,500);" class="mo-openid-share-link">
					<img  alt='Email this page' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/mail.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>"></a>
					<?php
				}
				if( get_option('mo_openid_print_share_enable') ) {
					?>
					<a rel='nofollow' title="Print this page" onclick="javascript:window.print()"class="mo-openid-share-link">
					<img  alt='Print this page' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/print.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>"></a>
					<?php
				}
                if( get_option('mo_openid_whatsapp_share_enable') && wp_is_mobile()) {

                    ?>
                    <a rel='nofollow' title="Whatsapp" href='whatsapp://send?text=<?php echo $url?>'  class="mo-openid-share-link">
                        <img  alt='Whatsapp' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/whatsapp.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>"></a>
                    <?php
                }
                else if( get_option('mo_openid_whatsapp_share_enable')) {
                ?>
                <a rel='nofollow' title="Whatsapp" target ='_blank' href='https://web.whatsapp.com/send?text=<?php echo $url?>'  class="mo-openid-share-link">
                    <img  alt='Whatsapp' style= 'margin-bottom:<?php echo $space_icons-6?>px !important;height:<?php echo $sharingSize; ?>px !important;width:<?php echo $sharingSize; ?>px !important;' src="<?php echo plugins_url( 'includes/images/icons/whatsapp.png', __FILE__ )?>" class="mo-openid-app-share-icons <?php echo $selected_theme; ?>"></a>
                <?php
                }
			}
		?></p>
	</div>
	<?php if(get_option("mo_share_vertical_hide_mobile")) { ?>
		<script>
			function hideVerticalShare() {
		        var isMobile = false; //initiate as false
		        // device detection
		        if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
		            || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
		            isMobile = true;
		        }

		        if(isMobile) {
		            if(jQuery("#mo_floating_vertical_widget"))
		                jQuery("#mo_floating_vertical_widget").hide();
		        }
		    }
			hideVerticalShare();
		</script>
	<?php } ?>

<?php }?>
</div><br>
<?php

?>