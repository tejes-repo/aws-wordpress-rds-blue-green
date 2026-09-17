h<?php
/**
 * WordPress configuration example for Amazon RDS MySQL.
 *
 * Copy this file to wp-config.php on the server and replace every placeholder.
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', '<DB_USERNAME>' );

/** Database password */
define( 'DB_PASSWORD', '<DB_PASSWORD>' );

/** Database hostname */
define( 'DB_HOST', '<RDS_ENDPOINT>' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication unique keys and salts.
 * Generate unique values at https://api.wordpress.org/secret-key/1.1/salt/
 */
define( 'AUTH_KEY',         '<GENERATE_WORDPRESS_SECRET>' );
define( 'SECURE_AUTH_KEY',  '<GENERATE_WORDPRESS_SECRET>' );
define( 'LOGGED_IN_KEY',    '<GENERATE_WORDPRESS_SECRET>' );
define( 'NONCE_KEY',        '<GENERATE_WORDPRESS_SECRET>' );
define( 'AUTH_SALT',        '<GENERATE_WORDPRESS_SECRET>' );
define( 'SECURE_AUTH_SALT', '<GENERATE_WORDPRESS_SECRET>' );
define( 'LOGGED_IN_SALT',   '<GENERATE_WORDPRESS_SECRET>' );
define( 'NONCE_SALT',       '<GENERATE_WORDPRESS_SECRET>' );

/** WordPress database table prefix. */
$table_prefix = 'wp_';

/** Keep debugging disabled in production. */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
