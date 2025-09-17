<?php


/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u813921520_SX7Xp' );

/** Database username */
define( 'DB_USER', 'u813921520_juiX0' );

/** Database password */
define( 'DB_PASSWORD', 'NdIrlmcyXM' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'mXvnAY9+,5=1ok0FL!!^Pmvi.^z<BhfnQX#4/M8)V_G?zVCfwiK:UXPhX1~3V<;J' );
define( 'SECURE_AUTH_KEY',   '3&/>Pb .PX-U[/J1?_j](lylUhu i_7tT86#^p4f~lZS{!AG3VziaC#`WT<VHwIL' );
define( 'LOGGED_IN_KEY',     'J3WrDqVJo{=hw|5Gd=rC;iQ,x1tc2a^$hLjYnp9Y^|A|nvn*eIMLmaNp@Eqn4D9>' );
define( 'NONCE_KEY',         '?=i{^DrsHPK3qLu_4y6YQi9h>c]g9.KuKp3-SO>gl(U*KcGLb(V`;7;> o)l7`=Q' );
define( 'AUTH_SALT',         'wHUNLrm*} K*<I6 k(0N2h#RAZP@GWR#3@@fP P6tJcd_PEgtpACi9#5,6:u:lgx' );
define( 'SECURE_AUTH_SALT',  '~#E=b&=(sMcu68F;VK9$;sQ@m:;^Q9g$CS3aSY{(yDcY{^o}+:lQ=:pHQhMyEa6W' );
define( 'LOGGED_IN_SALT',    '$PVn10U74CB(Vu}fV>[yglQ~{VE56X1hxv tMiO6|hRfBCJ5YXD^GnIw8!V<C$+u' );
define( 'NONCE_SALT',        'MDlK/{t!tW6VkiV02,57FAceq(xgD9j{rS!<:y;N--ID{6B,akGYfrV@/DTXu]iH' );
define( 'WP_CACHE_KEY_SALT', 'r>QgD,MxlRr]+uPJu^,v|T-=4x~2a2yEh&{0}KF6?Mq*_NE|zssm.u,0pr:ob*n,' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', 'b920f7c5b4946bdc0f221b062e84c4d7' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
