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
define( 'DB_NAME', 'db1tgppkxmdz2w' );

/** MySQL database username */
define( 'DB_USER', 'uw6x8e2hj1g2s' );

/** MySQL database password */
define( 'DB_PASSWORD', '5%@@r1$`e#2?' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'SGBIQ6r./bsNu@<5j<hC?K)GS(s[[kEuwg.E&;+k<l;re}c1a;P)w`CEydU9@&5n' );
define( 'SECURE_AUTH_KEY',   'fq7j()BRKV?,}4S_`SbAk?h_c)3/-jPn){-AaU|rQR^%E9/sHgjjY4<:M2B!-8~5' );
define( 'LOGGED_IN_KEY',     'h<zTBv`)vRpFQ`fi&j8@{Mb>|!Wuw>=l+?vf7`<u,Bo#m%vK-(pjY<KLl.}>&*vd' );
define( 'NONCE_KEY',         ' NO43q5C;aO5f{BZ6lJ=6-G/f!~unA4,7rL|(BE>75<01`K5mNx6V &hHt|lfY.!' );
define( 'AUTH_SALT',         '@TDg>Amd9$EniYelc;jb$)uzBdR<;RIp[Esne_N:}3TRkNqby|<6pB0#B<!G^PNW' );
define( 'SECURE_AUTH_SALT',  'PTFq(U$SR}[=8OU1HA_p?#GNPCJg[B+h;D;GA j/ttFj&5pWMQ9t5vpWQ;DH z!6' );
define( 'LOGGED_IN_SALT',    '`8lzM^T xe6,Mxo;x;~ B,>=3fD$<`)V0l?!JQ<D!0uK}xV_l;FSa^u&Ak- |^M{' );
define( 'NONCE_SALT',        'wwEysb?:_$!*M*H4ZUx%4GZu7v&<|Z0^Nq,.99o&dz&@TP,gMY68,0GB?rNO4$Xx' );
define( 'WP_CACHE_KEY_SALT', 'Uvup5@DRl;,oM0 5fbsO@qkLAt$HUw@PSW} u~S7l1CX?JVNdo[(2I(98e1F g6N' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ptk_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
