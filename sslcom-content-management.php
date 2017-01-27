<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.ssl.com
 * @since             2.0.0
 * @package           Sslcom_Content_Management
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Plugin Boilerplate
 * Plugin URI:        https://www.ssl.com/sslcom-content-management-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           2.0.0
 * Author:            Aaron Dancer or Your Company
 * Author URI:        https://www.ssl.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sslcom-content-management
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sslcom-content-management-activator.php
 */
function activate_Sslcom_Content_Management() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sslcom-content-management-activator.php';
	Sslcom_Content_ManagementActivator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sslcom-content-management-deactivator.php
 */
function deactivate_Sslcom_Content_Management() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sslcom-content-management-deactivator.php';
	Sslcom_Content_ManagementDeactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Sslcom_Content_Management' );
register_deactivation_hook( __FILE__, 'deactivate_Sslcom_Content_Management' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sslcom-content-management.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    2.0.0
 */
function run_Sslcom_Content_Management() {

	$plugin = new Sslcom_Content_Management();
	$plugin->run();

}
run_Sslcom_Content_Management();
