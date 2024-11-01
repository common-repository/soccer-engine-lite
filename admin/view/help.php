<?php
/**
 * Settings to display the "Help" menu.
 *
 * @package soccer-engine-lite
 */

if ( ! current_user_can( 'edit_posts' ) ) {
	wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'soccer-engine-lite' ) );
}

?>

<!-- output -->

<div class="wrap">

	<h2><?php esc_html_e( 'Soccer Engine - Help', 'soccer-engine-lite' ); ?></h2>

	<div id="daext-menu-wrapper">

		<p><?php esc_html_e( 'Visit the resources below to find your answers or to ask questions directly to the plugin developers.', 'soccer-engine-lite' ); ?></p>
		<ul>
			<li><a href="https://daext.com/doc/soccer-engine-lite/"><?php esc_html_e( 'Plugin Documentation', 'soccer-engine-lite' ); ?>
			<li><a href="https://daext.com/support/"><?php esc_html_e( 'Support Conditions', 'soccer-engine-lite' ); ?>
			</li>
			<li><a href="https://daext.com"><?php esc_html_e( 'Developer Website', 'soccer-engine-lite' ); ?></a></li>
			<li><a href="https://daext.com/soccer-engine/"><?php esc_html_e( 'Pro Version', 'soccer-engine-lite' ); ?></a></li>
			<li>
				<a href="https://wordpress.org/plugins/soccer-engine-lite/"><?php esc_html_e( 'WordPress.org Plugin Page', 'soccer-engine-lite' ); ?></a></li>
			<li>
				<a href="https://wordpress.org/support/plugin/soccer-engine-lite/"><?php esc_html_e( 'WordPress.org Support Forum', 'soccer-engine-lite' ); ?></a></li>
		</ul>
		<p>

	</div>

</div>