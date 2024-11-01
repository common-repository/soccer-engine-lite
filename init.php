<?php
/**
 * Plugin Name: Soccer Engine
 * Description: Store, analyze and display soccer data in your WordPress website. (Lite Version)
 * Version: 1.13
 * Author: DAEXT
 * Author URI: https://daext.com
 *
 * @package soccer-engine-lite
 */

// Prevent direct access to this file.
if ( ! defined( 'WPINC' ) ) {
	die();
}

// Class shared across public and admin.
require_once plugin_dir_path( __FILE__ ) . 'shared/class-daextsoenl-shared.php';

// Public.
require_once plugin_dir_path( __FILE__ ) . 'public/class-daextsoenl-public.php';
add_action( 'plugins_loaded', array( 'Daextsoenl_Public', 'get_instance' ) );

// Perform the Gutenberg related activities only if Gutenberg is present.
if ( function_exists( 'register_block_type' ) ) {
	require_once plugin_dir_path( __FILE__ ) . 'blocks/src/init.php';
}

// Admin.
if ( is_admin() ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-daextsoenl-admin.php' );

	// If this is not an AJAX request, create a new singleton instance of the admin class.
	if(! defined( 'DOING_AJAX' ) || ! DOING_AJAX ){
		add_action( 'plugins_loaded', array( 'Daextsoenl_Admin', 'get_instance' ) );
	}

	// Activate the plugin using only the class static methods.
	register_activation_hook( __FILE__, array( 'Daextsoenl_Admin', 'ac_activate' ) );

}

// Ajax.
if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {

	// Admin.
	require_once plugin_dir_path( __FILE__ ) . 'class-daextsoenl-ajax.php';
	add_action( 'plugins_loaded', array( 'Daextsoenl_Ajax', 'get_instance' ) );

}

/**
 * Customize the action links in the "Plugins" menu.
 *
 * @param array $actions The actions links.
 *
 * @return mixed The modified actions links.
 */
function daextsoenl_customize_action_links( $actions ) {
	$actions[] = '<a href="https://daext.com/soccer-engine/">' . esc_html__( 'Buy the Pro Version', 'soccer-engine-lite' ) . '</a>';
	return $actions;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'daextsoenl_customize_action_links' );
