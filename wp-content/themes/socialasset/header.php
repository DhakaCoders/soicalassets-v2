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
  }?>
<header class="header">
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
            <div class="hdr-rgt">
              <nav class="main-nav logout-main-nav">
                <div class="main-nav-menu">
                 <?php 
                    $logoutOptions = array( 
                        'theme_location' => 'cbv_main_menu', 
                        'menu_class' => 'clearfix ulc',
                        'container' => 'logoutm',
                        'container_class' => 'logoutm'
                      );
                    wp_nav_menu( $logoutOptions );
                  ?>
                </div>
                <div class="hdr-btns clearfix">
                  <div class="login-btn">
                    <button>LOGIN</button>
                    <ul class="ulc">
                      <li><a href="<?php echo esc_url(home_url('account/?login=ngo')); ?>">For <strong>NGOs</strong></a></li>
                      <li><a href="<?php echo esc_url(home_url('account/?login=user')); ?>">For <strong>USERs</strong></a></li>

                    </ul>
                  </div>
                  <button onclick='window.location.href = "<?php echo home_url('account/?login=ngo'); ?>"' class="campaign-btn">Start a Campaign</button>
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

            <div class="humberger-menu humberger-menu-xs clearfix">
              <div class="humberger-menu-items clearfix">
                <?php 
                  $logoutOptions = array( 
                      'theme_location' => 'cbv_main_menu', 
                      'menu_class' => 'clearfix ulc xs-logout-inner-menu',
                      'container' => 'logoutm',
                      'container_class' => 'logoutm'
                    );
                  wp_nav_menu( $logoutOptions );

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
                <div class="xs-login-area">
                  <h6>Login</h6>
                  <div>
                    <a href="<?php echo esc_url(home_url('account/?login=ngo')); ?>">For <strong>NGOs</strong></a>
                    <a href="<?php echo esc_url(home_url('account/?login=user')); ?>">For <strong>USERs</strong></a>
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