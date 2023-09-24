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
define( 'DB_NAME', 'xxsim_blog' );

/** MySQL database username */
define( 'DB_USER', 'xxsim' );

/** MySQL database password */
define( 'DB_PASSWORD', '!VSG^7^tGh+(' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define('AUTH_KEY',         'e19oNbech{Cqx?gHkiU48Ks_->8CBx2n^?1;$Pv;qw6iZ[LXLjd$1d1z/oxlGZ?@');
define('SECURE_AUTH_KEY',  '>Eclk:)^|0,4.a,-C2 X:J)fC<|v=l$AtFJH.H`@tp=(|;lW0rTzi^|<!8kei0He');
define('LOGGED_IN_KEY',    '$Pu `!Wco  =|STW7A h/^T.))G(V j)dsxPDlN U-g:]e1lvy<r(VE5H*Ldww.4');
define('NONCE_KEY',        '7 6O+pvmud8 A6k>@2PfgUa<Dvtj)~V(h~<v1R75> M^Gdm(Tc[RKbOb_TvUl(H#');
define('AUTH_SALT',        'Btuk4s8EbgyO+@-N [MrU-Q|MOjAtq}$9F36V7je)=>LFU_?`]O4~v/+X*MRj8fn');
define('SECURE_AUTH_SALT', 'L}JJO*,a^~cX: ?^K4]^q_/MDr7rw( VTu[jHiJ;mi=$<@knaLE|S<{D0ScS mZ+');
define('LOGGED_IN_SALT',   'g&*x/^${o{QXee1_`!WzwAl4SFFm}(&a;sHL-Gw{g4,!RCjAK(AphsY>cpKKCmJ$');
define('NONCE_SALT',       '4-sSOS{`-irYem?)F+W*!KySZ_})$3y53naDPb5HEvG1rV{[!._w`hr6wvTOXy E');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
