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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         's1#i_jkz^jc3?:jfU_/i`&iQ/agD&b:Pxplu_?noc.;nj40qm1VZ.Y]RgpN},eWF' );
define( 'SECURE_AUTH_KEY',  ')[D394`rjRcjm.QH{_Z[&.8YM..(qM]*:nQy:cK1BAaAzprrRw1?;jF!vy&qR00q' );
define( 'LOGGED_IN_KEY',    '.]_hJjIb1Vb@&=rMP[BRqGSb8ULX4g(vK]xj#MKk72G (/5#D:m5TwZZ*-s;;%vX' );
define( 'NONCE_KEY',        '7f6tdYi?DK+,H>eJi>uQO`H*2qQ.0%fA!f_6X?oY( }ZDnUF:$||%A0v|NoOFz?6' );
define( 'AUTH_SALT',        'h@)[QrIN&*SLHL9fHUri%~q5Q[l.HH[@bMob.X<$SQ kss0jW!70cj<2/T`-p{t7' );
define( 'SECURE_AUTH_SALT', '.R,m/K#trM:X^w~/*;S)7D:,5-b.R;uNG&UcF)nrl~wA|-|S]|h|B-N]dYpMDz>w' );
define( 'LOGGED_IN_SALT',   '&mt,7XDUlB.|mqT{:z4+UJ!r!m!&!6b7L`:PmY/u[$W,IZs|gNLm66!1PmqE>|!g' );
define( 'NONCE_SALT',       'iL:VuyxDw8dl`$9.O2jL213Gc<8F;>v3zc[aM>jPm321$O(cF<V0){y0q8mh :Lt' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
