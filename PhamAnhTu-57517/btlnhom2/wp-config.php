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
define('DB_NAME', 'btlnhom2');

/** MySQL database username */
define('DB_USER', 'btlnhom2');

/** MySQL database password */
define('DB_PASSWORD', 'phamanhtu');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'SNVZ7=GqzIY}eZW)v^Q!,WBEosi8]vZ:0=H.,lQ#?q:}V~Yt_-j_^HWdcxD:{jO[');
define('SECURE_AUTH_KEY',  'Sgn #mZTo|au 2Qv@cj[b./A@i9|+t$>o_ Mj<t5/IC!T!nbS8O7mC/,mi7 w57L');
define('LOGGED_IN_KEY',    '0|5g~*)4u/0l?HX(K6P:~8UJ{4Q+dN:Yu(:bU6irdp2lL`pCWw)_~G>*sJ6<sZ,n');
define('NONCE_KEY',        '>?xh.3PwP+,E_hUvk -4G2Ob*7r=C5VVp4TBx=cjju,&v2A{tkJi(~,fW/:gj.!3');
define('AUTH_SALT',        '=ZaT~7N9dCuF3O8)s:o[E5EE4({K!&+HaVH,w 3?0:gV/T208QWW`v1Yedm72Gs:');
define('SECURE_AUTH_SALT', 'P8Xm6)NHm8LYs.^:_ro]=:0RaqdM!&bfxy_x}gfS-$B>8BI~[T|E6:R>Q!C<[j:y');
define('LOGGED_IN_SALT',   '+kzfue:AQ>AX_|Wk-w0eJa8dAYph2OzIV_NXKN;/lV 09:[Y.(6Z0>d%:$*$I#7v');
define('NONCE_SALT',       '6j~MSlED:Q{%Myx|}PC32P 2-]0=wW0oM^A`J)n#_%EENM/Tnq5u&xd6j${W)IVc');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
