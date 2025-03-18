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
define( 'DB_NAME', 'hha-web' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'YpG*]dE:9dEL7b*AMF A$wW#k}FgV%|r.Y>EK/<11N0|?wBE,XkSgO-6MArOHN^i' );
define( 'SECURE_AUTH_KEY',  'y/l1w8h0NI4829E $YBq8~4S*%I`kqfJK~;aN<Ay}.UpX>AL>;hfkR:u{@Ew=C/&' );
define( 'LOGGED_IN_KEY',    'FmF!/aW*Z89Ec6~tKhsq26N?SpVu&V]IEbkkUS:hxI[afb~~NZE;(-+(^k*L[a@n' );
define( 'NONCE_KEY',        'isC~sFXp7oDfq94>z(i;FuZ1)+& W4ro?dVE6I_lK[9q<^g;Gx[v(t3q8v|*FRq*' );
define( 'AUTH_SALT',        'c-n>pOD%>Rj0z5;9Pt}F_~,oOzBknO;>HZt7:,p .T$LcOM`jS9SM@Cms{m3AXvX' );
define( 'SECURE_AUTH_SALT', 'DO^)x-@3Rj+q&HfV>*vgc[ zja8xNE8uDC);6Ym *|+IC3v2NAe;?}H=KJ+#=?>7' );
define( 'LOGGED_IN_SALT',   'C^Fm9]xjG.U dWu0;]Qd89CChAJ,- %5d4.g lkG[+rB;v06ob`r()!g2<6U4s{?' );
define( 'NONCE_SALT',       'zcL~($%*f}:li!dh8};giDUe8(%0dvS%Eng%7]%HHX07WC}znLUhaN0KB3)iWfqj' );

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
