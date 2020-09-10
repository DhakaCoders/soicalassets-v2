<?php 
/*
  Template Name: Contact
*/
  get_camp_header();
  $thisID = get_the_ID();
   get_template_part( 'templates/page', 'banner' );
?>
<?php
  $gwform = get_field('form', $thisID);
  $gmap = get_field('googlemaps', $thisID);
  $spacialArry = array(".", "/", "+", " ", "(", ")");$replaceArray = '';
  $adres = $gmap['address'];
  $gmapsurl = $gmap['google_map_url'];
  $email = $gmap['email'];
  $show_telefoon = $gmap['telephone'];
  $schedules = $gmap['schedule'];
  $telefoon = trim(str_replace($spacialArry, $replaceArray, $show_telefoon));
  $gmaplink = !empty($gmapsurl)?$gmapsurl: 'javascript:void()';
  $smedias = get_field('socialmedia', 'options');
  $google_map = $gmap['maps'];
?>
<section class="sa-contact-form-sec-wrp">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="sa-contact-form-block">
          <div class="sa-contact-form-wrp">
            <?php if( !empty( $gwform['form_shortcode'] ) ) echo do_shortcode( $gwform['form_shortcode'] ); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- end of sa-contact-form-sec-wrp-->


<section class="sa-google-map-sec-wrp">
  <div class="map-address">
    <div class="addr-box">
      <div class="addr-box-inner">
        <?php if( !empty( $gmap['title'] ) ) printf('<h3>%s</h3>', $gmap['title']);  ?>
        <ul>
          <?php if( !empty( $adres ) ) printf('<li><a href="%s">%s</a></li>', $gmaplink, $adres);  ?>
          <?php if( !empty( $show_telefoon ) ) printf('<li><a href="tel:%s">%s</a></li>', $telefoon, $show_telefoon);  ?>
          <?php if( !empty( $email ) ) printf('<li><a href="mailto:%s">%s</a></li>', $email, $email);  ?>
        </ul>
        <div class="map-socail">
          <?php 
            if(!empty($smedias)): 
            foreach($smedias as $smedia): 
          ?>
            <a target="_blank" href="<?php echo $smedia['url']; ?>">
              <?php echo $smedia['icon']; ?>
            </a>
          <?php 
            endforeach; 
            endif; 
          ?>
        </div>
        <?php if(!empty($schedules)): ?>
        <div class="map-date">
          <ul>
            <?php foreach($schedules as $schedule):  ?>
            <li>
              <?php 
                if( !empty($schedule['day']) ) printf('<span>%s</span>', $schedule['day']);
                if( !empty($schedule['time']) ) printf('<span>%s</span>', $schedule['time']);
              ?>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>
      </div>
      <div class="map-address-bg"></div>
    </div>
  </div>
  <?php if( !empty($google_map) && $google_map):?>
  <div id="googlemap" data-markerurl="<?php echo THEME_URI; ?>/assets/images/map-marker.png" data-latitude="<?php echo $google_map['lat']; ?>" data-longitude="<?php echo $google_map['lng']; ?>"></div>
  <?php endif; ?>
</section>
<?php get_footer(); ?>