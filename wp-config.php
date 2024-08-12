<?php
define( 'WP_CACHE', false ); // By SiteGround Optimizer

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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'osbaar29_wp902' );

/** desabilita FTP Localmente*/
define('FS_METHOD', 'direct');


/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '123456' );

/** Database hostname */
define( 'DB_HOST', 'DB' );

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
define( 'AUTH_KEY',         'ickrlcrrmdojo2dydfplmj3kq7oeafvxff6goelltm4bwxjffk0ydtwqwas5rdtp' );
define( 'SECURE_AUTH_KEY',  '4chau9rhfqs9soojnzd27jrkkcfjvydwgsbrevtqu55vluwalxoolihatsli4bzh' );
define( 'LOGGED_IN_KEY',    'i72wyfuvp2ncqw0hgccjgxumelealenebxvwid99szucu9x2licgaytux9c4qb9k' );
define( 'NONCE_KEY',        'grrilqjzp0cexgx4lh3wudinoeuhkgjzcp1vsfouzgujzpq4s6gonkmvodp9no2u' );
define( 'AUTH_SALT',        'txjga3rlzwmhzsn5pwgmc4irtdcysgq5qfoags5vndorgsgglfqmrgwcpunrveos' );
define( 'SECURE_AUTH_SALT', 'ihqajxiy39eponvxiwh5wqnnjclr0bnyvjekpguhrycevujjutm96epyi74erbqo' );
define( 'LOGGED_IN_SALT',   '15ecc53yhii8qwlz9ohxk72ouwdfmvozq9ob4xezf29wgmbvnjrfjusqgwb4cpea' );
define( 'NONCE_SALT',       'bwt1cndtq5zeypzjs5oewln9hzb7gxpwvhlcfjemia4mphk23aze1zxlwadjlnbg' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'aivvh_';

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
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
