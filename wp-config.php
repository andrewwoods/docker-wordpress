<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * This has been slightly modified (to read environment variables) for use in Docker.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// IMPORTANT: this file needs to stay in-sync with https://github.com/WordPress/WordPress/blob/master/wp-config-sample.php
// (it gets parsed by the upstream wizard in https://github.com/WordPress/WordPress/blob/f27cb65e1ef25d11b535695a660e7282b98eb742/wp-admin/setup-config.php#L356-L392)

// a helper function to lookup "env_FILE", "env", then fallback
if (!function_exists('getenv_docker')) {
    // https://github.com/docker-library/wordpress/issues/588 (WP-CLI will load this file 2x)
    function getenv_docker($env, $default)
    {
        if ($fileEnv = getenv($env . '_FILE')) {
            return rtrim(file_get_contents($fileEnv), "\r\n");
        }
        else if (($val = getenv($env)) !== false) {
            return $val;
        }
        else {
            return $default;
        }
    }
}

// ** Database settings - You can get this info from your web host ** //
/**
 * The name of the database for WordPress 
*/
define('DB_NAME', getenv_docker('WORDPRESS_DB_NAME', 'wordpress'));

/**
 * Database username 
*/
define('DB_USER', getenv_docker('WORDPRESS_DB_USER', 'example username'));

/**
 * Database password 
*/
define('DB_PASSWORD', getenv_docker('WORDPRESS_DB_PASSWORD', 'example password'));

/**
 * Docker image fallback values above are sourced from the official WordPress installation wizard:
 * https://github.com/WordPress/WordPress/blob/1356f6537220ffdc32b9dad2a6cdbe2d010b7a88/wp-admin/setup-config.php#L224-L238
 * (However, using "example username" and "example password" in your database is strongly discouraged.  Please use strong, random credentials!)
 */

/**
 * Database hostname 
*/
define('DB_HOST', getenv_docker('WORDPRESS_DB_HOST', 'mysql'));

/**
 * Database charset to use in creating database tables. 
*/
define('DB_CHARSET', getenv_docker('WORDPRESS_DB_CHARSET', 'utf8mb4'));

/**
 * The database collate type. Don't change this if in doubt. 
*/
define('DB_COLLATE', getenv_docker('WORDPRESS_DB_COLLATE', ''));

/**
* #@+
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
define('AUTH_KEY',         getenv_docker('WORDPRESS_AUTH_KEY',         'dccc01745d41bf04cfe1923ed84004e85a0adcc9'));
define('SECURE_AUTH_KEY',  getenv_docker('WORDPRESS_SECURE_AUTH_KEY',  '2f870e6f78fc27f5a9e04f1b9ea01462e5488c79'));
define('LOGGED_IN_KEY',    getenv_docker('WORDPRESS_LOGGED_IN_KEY',    'b03327b18194d32998757a5f0ad0fb5ef079bcf3'));
define('NONCE_KEY',        getenv_docker('WORDPRESS_NONCE_KEY',        '8808a18df27717d984f37e36c2703b12944ee8b0'));
define('AUTH_SALT',        getenv_docker('WORDPRESS_AUTH_SALT',        '68e93331b78e15058d4d14345cd3021c50fc099e'));
define('SECURE_AUTH_SALT', getenv_docker('WORDPRESS_SECURE_AUTH_SALT', '09afac3374c8839c0abdc48c0d4c8f33e64c1962'));
define('LOGGED_IN_SALT',   getenv_docker('WORDPRESS_LOGGED_IN_SALT',   '837e17cb904580ca52e2eb08f50bc0964c34e10d'));
define('NONCE_SALT',       getenv_docker('WORDPRESS_NONCE_SALT',       'aa0e534a98472c92f64dc8e4aa4cf3f062931c30'));
// (See also https://wordpress.stackexchange.com/a/152905/199287)

/**
* #@-
*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = getenv_docker('WORDPRESS_TABLE_PREFIX', 'wp_');

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_USER_DEPRECATED);
define('WP_DEBUG', !!getenv_docker('WORDPRESS_DEBUG', ''));
if (WP_DEBUG) {
    define('WP_DEBUG_DISPLAY', false);
    define('SAVEQUERIES', true);
    define('SCRIPT_DEBUG', true);
}


/* Add any custom values between this line and the "stop editing" line. */

// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also https://wordpress.org/support/article/administration-over-ssl/#using-a-reverse-proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
    $_SERVER['HTTPS'] = 'on';
}
// (we include this by default because reverse proxying is extremely common in container environments)

if ($configExtra = getenv_docker('WORDPRESS_CONFIG_EXTRA', '')) {
    eval($configExtra);
}

define('WP_DEBUG_LOG', '/var/www/html/wp-content/uploads/debug-log-manager/localhost_20260106233013481179_debug.log');
define('DISALLOW_FILE_EDIT', false);
/* That's all, stop editing! Happy publishing. */

/**
 * Absolute path to the WordPress directory. 
*/
if (! defined('ABSPATH') ) {
    define('ABSPATH', __DIR__ . '/');
}

/**
 * Sets up WordPress vars and included files. 
*/
require_once ABSPATH . 'wp-settings.php';
