<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.murdesign.at
 * @since             1.0.0
 * @package           Faq_Generator
 *
 * @wordpress-plugin
 * Plugin Name:       FAQ Generator
 * Plugin URI:        www.murdesign.at
 * Description:       Create new Questions and Categories for the FAQ-Generator
 * Version:           1.0.0
 * Author:            Christoph Murauer
 * Author URI:        www.murdesign.at
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       faq-generator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-faq-generator-activator.php
 */
function activate_faq_generator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-faq-generator-activator.php';
	Faq_Generator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-faq-generator-deactivator.php
 */
function deactivate_faq_generator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-faq-generator-deactivator.php';
	Faq_Generator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_faq_generator' );
register_deactivation_hook( __FILE__, 'deactivate_faq_generator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-faq-generator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_faq_generator() {

	$plugin = new Faq_Generator();
	$plugin->run();

}
run_faq_generator();
