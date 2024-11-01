<?php
/**
 * Settings to display the "Export to Pro" menu.
 *
 * @package soccer-engine-lite
 */

if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_attr__( 'You do not have sufficient permissions to access this page.', 'soccer-engine-lite' ) );
}

?>

<!-- output -->

<div class="wrap">

	<h2><?php esc_attr_e( 'Soccer Engine - Export to Pro', 'soccer-engine-lite' ); ?></h2>

	<div id="daext-menu-wrapper">

		<p><?php esc_attr_e( 'Click the Export button to generate an XML file that includes all the plugin data.', 'soccer-engine-lite' ); ?></p>
		<p><?php esc_attr_e( 'Note that you can import the resulting file in the Import menu of the ', 'soccer-engine-lite' ); ?>
			<a href="https://daext.com/soccer-engine/"><?php esc_html_e( 'Pro Version', 'soccer-engine-lite' ); ?></a>.</p>

		<!-- the data sent through this form are handled by the export_xml_controller() method called with the WordPress init action -->
		<form method="POST" action="admin.php?page=daextsoenl-export">

			<div class="daext-widget-submit">
				<?php wp_nonce_field( 'daim_tools_export', 'daim_tools_export' ); ?>
				<input name="daextsoenl_export" class="button button-primary" type="submit"
						value="<?php esc_attr_e( 'Export', 'soccer-engine-lite' ); ?>">
			</div>

		</form>

	</div>

</div>