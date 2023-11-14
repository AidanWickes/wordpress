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
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'local_dev_mysql_80' );

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
define( 'AUTH_KEY',         '_-LrZT;YG[jy_e6GsaK7{CZ,M{FuU}U.HzCY]6>bQvz;;>`tPGxz|Ac%<jqb1,`?' );
define( 'SECURE_AUTH_KEY',  '}y])Om<eHkg5,c:]?(C4ABbsk)ttD|~2H&VNxh@[xC^+8QH $tpEL=P!(Pvs2!l(' );
define( 'LOGGED_IN_KEY',    '{|*I8YV/5cWsS&_w7]zXWHFrI1l],`Nua3Y:}i[I;8cVjG^~!Um2K_&ph)4T=U2m' );
define( 'NONCE_KEY',        'b94l+?/lZY9!%ns97.M4:S8Bi`8t@VfPk/;#!Pn-11 O/]E_1|:;=|RAntWaJVjh' );
define( 'AUTH_SALT',        ',%ZFG1F5qK+7vZTvO`)9^i%>^wPqYtS/5Bs=R2)udhic.aYDLt#H<M19eA3Jq(~n' );
define( 'SECURE_AUTH_SALT', 'f2ZCD`4EC>GKbCdVr/Z@L)fhOmj`CL%0wtLm*-` Pd75H%y~qhVxF.&/->8>HP,t' );
define( 'LOGGED_IN_SALT',   '6Bl_[mo{;idFe&s3Ujyt#O~Ha$<6jnW|~*.<t.G2C=d4Pzd}|DJJ-RCi;d!OzHD0' );
define( 'NONCE_SALT',       'A{h0FNC)*ji4_HT>A:@js3b786:{.s;`OA94[6Eeq$Wx$3~F<X(Q#Wi`q+-+mu3F' );

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
