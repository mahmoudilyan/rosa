<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'rosa');

/** MySQL database username */
define('DB_USER', 'mahmoud');

/** MySQL database password */
define('DB_PASSWORD', 'a123123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Hq*e:ob?m6gZ51r<!T%.0J1S9+t)F<5wg7r8Jr=yZ5=_[ddDPi+RwJ|1wMc-_%d>');
define('SECURE_AUTH_KEY',  'SoW*f&iz`;>z-8Ckv&YcT4|i%q,vX9m!E.g+~;cI@S%O3wt+uW+{|_`5b@%Yp!8r');
define('LOGGED_IN_KEY',    'Jr^Qs$O@|IVJ{:je;Y%qk?3wM CbC/qA_)_~`E[8l0/}$X>1Gzmq]mWHAzUphAa>');
define('NONCE_KEY',        'VH(>_-bnY>^p$]wZnb,ITp+PZM}fr;cd.^#Yb*?%7`x=?^wTu2-&pwRlL{0+;)j0');
define('AUTH_SALT',        '9:*e$>BO-8|&?etxs~poA[T>ID^+_+%)IpCb0=cAj|Fv-0Dr,+YB0wUtQk_|G-Z|');
define('SECURE_AUTH_SALT', '[0fK|A5Ge-,K:.!dkq89j(%RC}Lp;NEX e{(/[,)Pqhwd(iW:@(A+S#Oe21+T_/#');
define('LOGGED_IN_SALT',   '[(Bk)``--5g`>x:BLONxbWO$m=1x5scOtC]v&+^Cll)p@D(Ci+@|B -q<h:Si3|o');
define('NONCE_SALT',       '(]]*(K!tGn d2}$ju6Rp$-Ww]y];er (RQd1<g,Vx{qa-kra+h lcu@?E#XZ#7`}');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
