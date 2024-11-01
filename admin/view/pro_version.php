<?php
/**
 * Settings to display the "Pro Version" menu.
 *
 * @package soccer-engine-lite
 */

if ( ! current_user_can( 'edit_posts' ) ) {
	wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'soccer-engine-lite' ) );
}

?>

<!-- output -->

<div class="wrap">

	<h2><?php esc_html_e( 'Soccer Engine - Pro Version', 'soccer-engine-lite' ); ?></h2>

	<div id="daext-menu-wrapper">

		<p><?php echo esc_html__( 'For professional users, we distribute a', 'soccer-engine-lite' ) . ' <a href="https://daext.com/soccer-engine/">' . esc_html__( 'Pro Version', 'soccer-engine-lite' ) . '</a> ' . esc_html__( 'of this plugin.', 'soccer-engine-lite' ) . '</p>'; ?>
		<h2><?php esc_html_e( 'Additional Features Included in the Pro Version', 'soccer-engine-lite' ); ?></h2>
		<ul>
			<ul>
				<li><?php echo '<strong>' . esc_html__( 'Additional Blocks', 'soccer-engine-lite' ) . '</strong> ' . esc_html__( 'like the Match Timeline, Ranking Transitions Chart, Market Value Transitions Chart, Referee Statistics by Competition, Referee Statistics by Team.', 'soccer-engine-lite' ); ?></li>
				<li><?php echo '<strong>' . esc_html__( 'REST API', 'soccer-engine-lite' ) . '</strong> ' . esc_html__( 'to optionally manage the Soccer Engine data with external applications, create new additional plugin features, automatically create match events, and more.', 'soccer-engine-lite' ); ?></li>
				<li>
				<?php
				echo '<strong>' . esc_html__( 'Import', 'soccer-engine-lite' ) . '</strong>' . '&nbsp' . esc_html__( 'and', 'soccer-engine-lite' ) . '&nbsp' .
								'<strong>' . esc_html__( 'Export', 'soccer-engine-lite' ) . '</strong> ' . esc_html__( 'menus to create a backup of the plugin data or move the plugin data between different WordPress installations.', 'soccer-engine-lite' );
				?>
				</li>
				<li><?php echo esc_html__( 'Additional options to set custom menu capabilities for all the plugin menus.', 'soccer-engine-lite' ); ?></li>
				<li><?php echo esc_html__( 'Additional options to customize the pagination system of the plugin.', 'soccer-engine-lite' ); ?></li>
		</ul>
		<h2><?php esc_html_e( 'Additional Benefits of the Pro Version', 'soccer-engine-lite' ); ?></h2>
		<ul>
			<li><?php esc_html_e( '24 hours support provided 7 days a week', 'soccer-engine-lite' ); ?></li>
			<li><?php echo esc_html__( '30 day money back guarantee (more information is available in the', 'soccer-engine-lite' ) . ' <a href="https://daext.com/refund-policy/">' . esc_html__( 'Refund Policy', 'soccer-engine-lite' ) . '</a> ' . esc_html__( 'page', 'soccer-engine-lite' ) . ')'; ?></li>
		</ul>
		<h2><?php esc_html_e( 'Get Started', 'soccer-engine-lite' ); ?></h2>
		<p><?php echo esc_html__( 'Download the', 'soccer-engine-lite' ) . ' <a href="https://daext.com/soccer-engine/">' . esc_html__( 'Pro Version', 'soccer-engine-lite' ) . '</a> ' . esc_html__( 'now by selecting one of the available licenses.', 'soccer-engine-lite' ); ?></p>
	</div>

</div>

