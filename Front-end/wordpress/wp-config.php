<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'newsfeeder_nfwp');

/** MySQL database username */
define('DB_USER', 'newsfeeder');

/** MySQL database password */
define('DB_PASSWORD', 'Ewv3M5dMFHvEWSGT');

/** MySQL hostname */
define('DB_HOST', 'nbs.im');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'o1^_j!n9GA62|uj&<n<0QV1v[@UB3O]k=Z`Axp*v%lheVN{)UwU=o~`r`+@ ,z_L');
define('SECURE_AUTH_KEY',  'OV7TVRO%fn7P{Kdl8PXMmsR5#S&@$gEg=rfsDX4ei$Z_K#gZzJ| YEJV.G=sV+]=');
define('LOGGED_IN_KEY',    'yTaz#3T;kp/%S?IV)ZX3yWl#+2sJ*,rqPn1)_%-m]pq=bR]2h&1%A.Gj<igC=-OK');
define('NONCE_KEY',        '}k[fPBH;Nju}w(*(tUlsB9[MRHvyK?O<A~sfT=s2q#cy!D~|_<Z&y7D5kLEH|v!y');
define('AUTH_SALT',        'yW ~Wwv4S0g+twm~nS}FUlFSg%a[aZ c4Z] -5FKCIMIEH~hr?@bV>g>l1z9+[We');
define('SECURE_AUTH_SALT', 'yEd>BK3S)j &wH-3]j)~3RUN:(e.lG1;W-6:G#1@:bA}h!D8x>!ok?q WSVP**70');
define('LOGGED_IN_SALT',   'oNd?m4f)8=Tc4;0(=jv0-D^yj6<%rok+W`M0CF+;_SBM!3xn8me%Vd:4Zp8V,[VI');
define('NONCE_SALT',       'Q-4Ow@YVT{eDph 0WSbA|ro7;W,@C]fX_MNiuu=:SR29[XBms,I||P(M;_EV=5Uf');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
