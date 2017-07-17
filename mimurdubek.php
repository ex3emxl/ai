<?php

/**
 * Description
 *
 * 
 *
 * @link              www.zfort.com.ua
 * @since             1.0.0
 * @package           Mimurdubek
 *
 * @wordpress-plugin
 * Plugin Name:       Mimurdubek
 * Plugin URI:        www.zfort.com.ua
 * Description:       
 * Version:           1.0.0
 * Author:            Mimurdubek Team
 * Author URI:        www.zfort.com.ua
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mimurdubek
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mimurdubek-activator.php
 */
function activate_mimurdubek() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mimurdubek-activator.php';
	Mimurdubek_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mimurdubek-deactivator.php
 */
function deactivate_mimurdubek() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mimurdubek-deactivator.php';
	Mimurdubek_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mimurdubek' );
register_deactivation_hook( __FILE__, 'deactivate_mimurdubek' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mimurdubek.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
 
 
add_action( 'wp_ajax_get_link_ai', 'get_link_ai' );
add_action( 'wp_ajax_nopriv_get_link_ai', 'get_link_ai' );
function get_link_ai(){
	$link = get_permalink( get_page_by_path( $_POST['slug'] ));
	wp_send_json($link);
}

function run_mimurdubek() {

	$plugin = new Mimurdubek();
	$plugin->run();

}
run_mimurdubek();

	



