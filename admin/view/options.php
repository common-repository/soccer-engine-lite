<?php
/**
 * File used to display the "Options" menu.
 *
 * @package soccer-engine-lite
 */

if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_attr__( 'You do not have sufficient capabilities to access this page.', 'soccer-engine-lite' ) );
}

// Sanitization -------------------------------------------------------------------------------------------------------.

// phpcs:disable WordPress.Security.NonceVerification -- Nonce verification is done in the settings_fields() function
// and it's not necessary for tabs and for the flag settings-updated.
$data['settings_updated'] = isset( $_GET['settings-updated'] ) ? sanitize_key( $_GET['settings-updated'] ) : null;
$data['active_tab']       = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'colors_options';
// phpcs:enable WordPress.Security.NonceVerification

?>

<div class="wrap">

	<h2><?php esc_html_e( 'Soccer Engine - Options', 'soccer-engine-lite' ); ?></h2>

	<?php

	// settings errors
	if ( ! is_null( $data['settings_updated'] ) && $data['settings_updated'] == 'true' ) {
		if ( $this->write_custom_css() === false ) {
			?>
			<div id="setting-error-settings_updated" class="error settings-error notice is-dismissible below-h2">
				<p><strong><?php esc_html_e( "The plugin can't write files in the upload directory.", 'soccer-engine-lite' ); ?></strong></p>
				<button type="button" class="notice-dismiss"><span
							class="screen-reader-text"><?php esc_html_e( 'Dismiss this notice.', 'soccer-engine-lite' ); ?></span></button>
			</div>
			<?php
		}
		settings_errors();
	}

	?>

	<div id="daext-options-wrapper">

		<div class="nav-tab-wrapper">
			<a href="?page=daextsoenl-options&tab=colors_options"
				class="nav-tab <?php echo $data['active_tab'] === 'colors_options' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Colors', 'soccer-engine-lite' ); ?></a>
			<a href="?page=daextsoenl-options&tab=advanced_options"
				class="nav-tab <?php echo $data['active_tab'] === 'advanced_options' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Advanced', 'soccer-engine-lite' ); ?></a>
		</div>

		<form method="post" action="options.php" autocomplete="off">

			<?php

			if ( $data['active_tab'] === 'colors_options' ) {

				settings_fields( $this->shared->get( 'slug' ) . '_colors_options' );
				do_settings_sections( $this->shared->get( 'slug' ) . '_colors_options' );

			}

			if ( $data['active_tab'] === 'advanced_options' ) {

				settings_fields( $this->shared->get( 'slug' ) . '_advanced_options' );
				do_settings_sections( $this->shared->get( 'slug' ) . '_advanced_options' );

			}

			?>

			<div class="daext-options-action">
				<input type="submit" name="submit" id="submit" class="button"
						value="<?php esc_attr_e( 'Save Changes', 'soccer-engine-lite' ); ?>">
			</div>

		</form>

	</div>

</div>