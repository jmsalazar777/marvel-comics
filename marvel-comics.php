<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://daxkotest.wpengine.com
 * @since             1.0.0
 * @package           Marvel_Comics
 *
 * @wordpress-plugin
 * Plugin Name:       Marvel Comics Plugin
 * Description:       List Marvel Characters
 * Version:           1.0.0
 * Author:            Jean Michael Salazar
 * Author URI:        Jean Michael Salazar
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       marvel-comics
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('MARVEL_COMICS_VERSION', '1.0.1');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-marvel-comics-activator.php
 */
function activate_marvel_comics()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-marvel-comics-activator.php';
	Marvel_Comics_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-marvel-comics-deactivator.php
 */
function deactivate_marvel_comics()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-marvel-comics-deactivator.php';
	Marvel_Comics_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_marvel_comics');
register_deactivation_hook(__FILE__, 'deactivate_marvel_comics');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-marvel-comics.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_marvel_comics()
{

	$plugin = new Marvel_Comics();
	$plugin->run();
}
run_marvel_comics();
