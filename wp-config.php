<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', '2020_09_socialasset_v2' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '9]~.|XEFr0&!O)XPGVq5.;8PEp5Yq(.3~{3e(lc2Pn<j%U:-#=8I}xbCb=R2eW?#' );
define( 'SECURE_AUTH_KEY',  '91et(P:%07MR+?RrXb7?N`?{@oQR VL=!X^JQUjes*Xs4c8`a&U&im])5n48-@_+' );
define( 'LOGGED_IN_KEY',    'O2o&^FODZ[rHo>I=0qcz@:TlZQt{tu4^eeAA.}NhRBR}X?|BRLSFR@mun&RrSQ|O' );
define( 'NONCE_KEY',        'bf90E3.H;a6[uE^|loTwnYW-Gntd+AdWyT1]*T$:$95!JX(7vg4yA6U/j}eNMIf]' );
define( 'AUTH_SALT',        'Cg+LuFF^nv&I*P3;7g4w4=ReTK]aq,vF.Th?BiS|xjWhxRmSjf.N5UYtUFwmD86(' );
define( 'SECURE_AUTH_SALT', '7O}MH04cr$IPyiH2<LI%;gfF{vb%@0pA2qtXt?_]6 ->lj@(^Ia<=,L$B*8Ax|[t' );
define( 'LOGGED_IN_SALT',   'BYm)w~2+vzy+EE:7dS !%/0%y@F&#`fxZYe`w+M=oUF-Xg U$(F-~jHc%]%2wy*h' );
define( 'NONCE_SALT',       'Eu5/CY]FP.JZOrj&}3b@t6gnI/FR/=+zAW^PTT)B*z95^S2B@W5T5TDjJeq+9ez~' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
