<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://happycoding.it
 * @since             1.0.0
 * @package           Gdpr_Cookies_Gtm
 *
 * @wordpress-plugin
 * Plugin Name:       GDPR Cookies with Google Tag Manager
 * Plugin URI:        https://happycoding.it
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Matthias Radscheit
 * Author URI:        https://happycoding.it
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gdpr-cookies-gtm
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'GDPR_COOKIES_GTM_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gdpr-cookies-gtm-activator.php
 */
function activate_gdpr_cookies_gtm() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gdpr-cookies-gtm-activator.php';
	Gdpr_Cookies_Gtm_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gdpr-cookies-gtm-deactivator.php
 */
function deactivate_gdpr_cookies_gtm() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gdpr-cookies-gtm-deactivator.php';
	Gdpr_Cookies_Gtm_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_gdpr_cookies_gtm' );
register_deactivation_hook( __FILE__, 'deactivate_gdpr_cookies_gtm' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-gdpr-cookies-gtm.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_gdpr_cookies_gtm() {

	$plugin = new Gdpr_Cookies_Gtm();
	$plugin->run();

}
run_gdpr_cookies_gtm();
