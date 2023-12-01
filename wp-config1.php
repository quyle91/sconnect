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
define( 'DB_NAME', 'sconnect' );

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
define( 'AUTH_KEY',         'PrE`]kM^{K+hdk>)BtUzf)4+O1C*8!$k<tPX/Ikzlym2~~HO-6#5~b;2rC,eu(?-' );
define( 'SECURE_AUTH_KEY',  'Iw~F0H2P~+/>0y_g] Z+NEP6R=)bhJlf$XdpNkt,Q)YMMC7a) +_Sq-,#9ow%jP^' );
define( 'LOGGED_IN_KEY',    ',:s.`]M,8yTZ)#PMt6<:h*&NW&}2ug0S(>vVys`:A1DR&`Np<3>hcvYvoMz}@P/C' );
define( 'NONCE_KEY',        'uIw1Vgav_~ 4HS}{SRJ&AC]bAz-x(m~@B6 GXVR5v=Y7=#{E]|o$u,>Pnvzyq}??' );
define( 'AUTH_SALT',        'CK44^qN*ZalEQs%>%;@$:IAOJxthn=DI(Us3|>HJ7/PK1#([YHB!>m`qD9!@%$|s' );
define( 'SECURE_AUTH_SALT', 'o#Zu@!n;&:uc+bvFPTff&vV}!thvwNH$C;[MIwYeNfj9fmY60_HT|&[NK+m1_o@5' );
define( 'LOGGED_IN_SALT',   '|.77S8`[CR99V*Rc=s7=:o>Eh)F_%Y_XeQ4^;qYb<|Jq1908t%4uzv!rE{*ylJgp' );
define( 'NONCE_SALT',       'MS6lGFzU4|8RSI&oI0t8GV&%w @9l`;Sz6GTA/Vt+`BqlG1#M@%&5Z0mntwwS?0f' );

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
