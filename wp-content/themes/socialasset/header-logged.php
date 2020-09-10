<!DOCTYPE html>
<html <?php language_attributes(); ?>> 
<head> 
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php $favicon = get_theme_mod('favicon'); if(!empty($favicon)) { ?> 
  <link rel="shortcut icon" href="<?php echo $favicon; ?>" />
  <?php } ?>
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->  
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
  $headertab = get_field('headertab', 'options');
  $logoObj = $headertab['logo'];
  if( is_array($logoObj) ){
    $logo_tag = '<img src="'.$logoObj['url'].'" alt="'.$logoObj['alt'].'" title="'.$logoObj['title'].'">';
  }else{
    $logo_tag = '';
  }
?>
<header class="header hdr-has-shadow">
  <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="header-inr clearfix">
            <div class="hdr-lft">
              <div class="logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                  <?php echo $logo_tag; ?>
                </a>
              </div>
            </div>
            <!-- 
              If you want logged navbar. please use the class on '.hdr-rgt .logged-menu'
             -->
            <div class="hdr-rgt logged-menu">
              <nav class="main-nav logged-main-nav">
                <div class="main-nav-menu">
                  <?php 
                    $logOptions = array( 
                        'theme_location' => 'cbv_logmain_menu', 
                        'menu_class' => 'clearfix ulc',
                        'container' => 'loggedinm',
                        'container_class' => 'loggedinm'
                      );
                    wp_nav_menu( $logOptions );
                  ?>
                  <?php if ( camp_user_role('ngo') ) { ?>
                    <ul class="ulc clearfix">
                      <li><a href="<?php echo esc_url(home_url('myaccount/add-campaign')); ?>">Create a Campaign</a></li>
                    </ul>
                  <?php }elseif( camp_user_role('subscriber') ){ ?>
                    <ul class="ulc clearfix">
                      <li><a href="<?php echo esc_url(home_url('campaigns')); ?>">Support a Campaign</a></li>
                    </ul>
                  <?php }elseif( camp_user_role('business') ){ ?>
                    <ul class="ulc clearfix">
                      <li><a href="<?php echo esc_url(home_url('campaigns')); ?>">Support a Campaign</a></li>
                    </ul>
                  <?php } ?>
                </div>
                <div class="hdr-login-profile">
                  <div class="hdr-login-profile-img hide-md">
                    <?php get_author_avatar(); ?>
                  </div>
                  <?php if( get_current_user_name() ): ?>
                  <strong><?php echo get_current_user_name(); ?></strong>
                  <?php endif; ?>
                  <ul class="ulc clearfix">
                    <?php if ( camp_user_role('ngo') ) { ?>
                      <li><a href="<?php echo home_url('myaccount/mycampaigns/'); ?>">My Campaigns</a></li>
                    <?php }elseif( camp_user_role('subscriber')){ ?>
                      <li><a href="<?php echo home_url('myaccount/contributions/'); ?>">My Contributions</a></li>
                    <?php }elseif(camp_user_role('business')){ ?>
                    <li><a href="<?php echo home_url('myaccount/supported-campaigns/'); ?>">My Contributions</a></li>
                    <?php } ?>
                    <?php if ( camp_user_role('ngo') || camp_user_role('subscriber') || camp_user_role('business')) { ?>
                    <li><a href="<?php echo home_url('myaccount'); ?>">My Profile</a></li>
                  <?php } ?>
                    <li>
                      <i class="fas fa-sign-out-alt"></i>
                      <?php if ( camp_user_role('ngo') ) { ?>
                      <a href="<?php get_ao_custom_logout('account'); ?>">Log out</a>
                      <?php }elseif( camp_user_role('subscriber') ){ ?>
                      <a href="<?php get_ao_custom_logout('account'); ?>">Log out</a>
                      <?php }elseif(camp_user_role('business')){ ?>
                      <a href="<?php get_ao_custom_logout('business-login'); ?>">Log out</a>
                      <?php }else{ ?>
                        <a href="<?php get_ao_custom_logout('wp-admin'); ?>">Log out</a>
                      <?php } ?>
                    </li>
                  </ul>
                </div>
              </nav>
              
              <div class="humberger-menu-btn">
                <strong>MENU</strong>
                <div class="humberger-menu-btn-lines">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
              </div>
              
            </div>
            <div class="humberger-menu humberger-menu-xlg">
              <?php 
                $catOptions = array( 
                    'theme_location' => 'cbv_popup_menu1', 
                    'menu_class' => 'clearfix ulc',
                    'container' => 'pupnavs',
                    'container_class' => 'pupnavs'
                  );
                wp_nav_menu( $catOptions );

                $menuOptions = array( 
                    'theme_location' => 'cbv_popup_menu2', 
                    'menu_class' => 'clearfix ulc',
                    'container' => 'pupnava',
                    'container_class' => 'pupnava'
                  );
                wp_nav_menu( $menuOptions ); 
              ?>
              <div class="languages-area">
                <label>Languages:</label>
                <div class="site-lang-holder clearfix">
                  <div class="site-lang">
                    <a href="#" class="active">En <span class="ede-down-angle"></span></a>
                    <a href="#">Gr</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="humberger-menu humberger-menu-xs logged-menu clearfix">
              <div class="humberger-menu-items clearfix">
                <?php 
                  $logOptions = array( 
                      'theme_location' => 'cbv_logmain_menu', 
                      'menu_class' => 'clearfix ulc xs-logged-inner-menu',
                      'container' => 'loggedinm',
                      'container_class' => 'loggedinm'
                    );
                  wp_nav_menu( $logOptions );
                ?>
                <?php if ( camp_user_role('ngo') ) { ?>
                    <ul class="clearfix ulc xs-logged-inner-menu">
                      <li><a href="<?php echo esc_url(home_url('myaccount/add-campaign')); ?>">Create a Campaign</a></li>
                    </ul>
                  <?php }elseif( camp_user_role('subscriber') ){ ?>
                    <ul class="clearfix ulc xs-logged-inner-menu">
                      <li><a href="<?php echo esc_url(home_url('campaigns')); ?>">Support a Campaign</a></li>
                    </ul>
                  <?php }elseif( camp_user_role('business') ){ ?>
                    <ul class="clearfix ulc xs-logged-inner-menu">
                      <li><a href="<?php echo esc_url(home_url('campaigns')); ?>">Support a Campaign</a></li>
                    </ul>
                <?php } ?>
                <?php 
                $catOptions = array( 
                    'theme_location' => 'cbv_popup_menu1', 
                    'menu_class' => 'clearfix ulc',
                    'container' => 'pupnavs',
                    'container_class' => 'pupnavs'
                  );
                wp_nav_menu( $catOptions );

                $menuOptions = array( 
                    'theme_location' => 'cbv_popup_menu2', 
                    'menu_class' => 'clearfix ulc',
                    'container' => 'pupnava',
                    'container_class' => 'pupnava'
                  );
                wp_nav_menu( $menuOptions ); 
              ?>
              </div>
              <div class="xs-menu-footer clearfix">
                <div class="xs-hdr-login-profile">
                  <div class="hdr-login-profile">
                    <div>
                      <div class="hdr-login-profile-img">
                        <?php get_author_avatar(); ?>
                      </div>
                      <?php if( get_current_user_name() ): ?>
                      <strong><?php echo get_current_user_name(); ?></strong>
                      <?php endif; ?>
                    </div>
                    <ul class="ulc clearfix">
                    <?php if ( camp_user_role('ngo') ) { ?>
                        <li><a href="<?php echo home_url('myaccount/mycampaigns/'); ?>">My Campaigns</a></li>
                    <?php }elseif( camp_user_role('subscriber')){ ?>
                        <li><a href="<?php echo home_url('myaccount/contributions/'); ?>">My Contributions</a></li>
                    <?php }elseif(camp_user_role('business')){ ?>
                      <li><a href="<?php echo home_url('myaccount/supported-campaigns/'); ?>">My Contributions</a></li>
                    <?php } ?>
                    <?php if ( camp_user_role('ngo') || camp_user_role('subscriber') || camp_user_role('business')) { ?>
                      <li><a href="<?php echo home_url('myaccount'); ?>">My Profile</a></li>
                    <?php } ?>

                      <li>
                      <i class="fas fa-sign-out-alt"></i>
                      <?php if ( camp_user_role('ngo') ) { ?>
                      <a href="<?php get_ao_custom_logout('account'); ?>">Log out</a>
                      <?php }elseif( camp_user_role('subscriber') ){ ?>
                      <a href="<?php get_ao_custom_logout('account'); ?>">Log out</a>
                      <?php }elseif(camp_user_role('business')){ ?>
                      <a href="<?php get_ao_custom_logout('business-login'); ?>">Log out</a>
                      <?php }else{ ?>
                        <a href="<?php get_ao_custom_logout('wp-admin'); ?>">Log out</a>
                      <?php } ?>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="languages-area">
                  <label>Languages:</label>
                  <div class="site-lang-holder clearfix">
                    <div class="site-lang">
                      <a href="#" class="active">En <span class="ede-down-angle"></span></a>
                      <a href="#">Gr</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
  </div>
</header>