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
define( 'DB_NAME', 'sourcus' );

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
define( 'AUTH_KEY',         '>O=Tm{}w0:p]?[DSCRQGEr6WjS[#&vK<*B&3Wh1/ZXTF~*v9IFCXY^EsLx&`#y+2' );
define( 'SECURE_AUTH_KEY',  ' q8(h;j7`lsaOhD&)Rr*~E7LD6w}D~Cvsl+4n/y COul6d^cNM<|j2n_T;?)}3%s' );
define( 'LOGGED_IN_KEY',    ')Rg+w(Q4Lz(hFmP&Qx;:U,&p/F!ob{sebW:=Y~58N+FId?~9WhQxa)0/3(hTbyiF' );
define( 'NONCE_KEY',        'pZZ-qE[O%p1o,(J,hYo*Jk&3/6bP*v1`*9B4]:H%D9kqA_LoB!,?H>S]#R__pV8q' );
define( 'AUTH_SALT',        'P((HzsqECZ&3iS_]82Jr+*eqpC`q+BPR+>:~> &*)sXJJm=XBakeM!,(*O.{JF6u' );
define( 'SECURE_AUTH_SALT', 'B/Ve_aE2K-Xm{w?R#EHkK=FiND.Z ZaKLX5/pMA35fHu#]/1l>(9-4R#pQ!5H$c%' );
define( 'LOGGED_IN_SALT',   ')cKUSZB7Pr0zq:h$H)>l-^-SN_$8L )%Ls`/vbn*k{%(W`_=V_nTbw/o,vEWJL&Z' );
define( 'NONCE_SALT',       '0i~x]=CX%Px&@{XiBO%9wfqFvy*#sDUTUd0;7l=-!T6e*xm~j,R$ejvh1k&4Y~OE' );

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
