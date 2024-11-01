<?php
/**
 * Uninstall plugin.
 *
 * @package soccer-engine-lite
 */

// Exit if this file is called outside WordPress.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die();
}

require_once plugin_dir_path( __FILE__ ) . 'shared/class-daextsoenl-shared.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/class-daextsoenl-admin.php';

// Delete options and tables.
Daextsoenl_Admin::un_delete();
