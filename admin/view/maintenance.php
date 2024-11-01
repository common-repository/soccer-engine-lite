<?php
/**
 * Settings to display the "Maintenanc" menu.
 *
 * @package soccer-engine-lite
 */

if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_attr__( 'You do not have sufficient permissions to access this page.', 'soccer-engine-lite' ) );
}

?>

<?php

// Initialize variables -----------------------------------------------------------------------------------------------.
$dismissible_notice_a = array();

if ( isset( $_POST['form_submitted'] ) ) {

	// Nonce verification.
	check_admin_referer( 'daextsoenl_execute_task', 'daextsoenl_execute_task_nonce' );

	// Prepare data.
	$task = isset( $_POST['task'] ) ? intval( $_POST['task'], 10 ) : null;

	if ( $task !== null ) {

		switch ( $task ) {

			// Delete Data.
			case 0:
				$total_counter = 0;

				$database_table_a = $this->shared->get( 'database_tables' );
				foreach ( $database_table_a as $key => $database_table ) {

					global $wpdb;
					$table_name   = $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $database_table['name'];
					$query_result = $wpdb->query( "DELETE FROM $table_name" );

					if ( $query_result !== false and $query_result > 0 ) {
						$total_counter += $query_result;
					}
				}

				if ( $total_counter > 0 ) {

					$dismissible_notice_a[] = array(
						'message' => intval( $total_counter, 10 ) . ' ' . __( 'records have been successfully deleted.', 'soccer-engine-lite' ),
						'class'   => 'updated',
					);

				} else {

					$dismissible_notice_a[] = array(
						'message' => __( 'The are no deletable records.', 'soccer-engine-lite' ),
						'class'   => 'error',
					);

				}

				break;

			// Delete Transients.
			case 1:
				$result = $this->shared->delete_plugin_transients();

				// Generate message.
				if ( $result ) {

					$dismissible_notice_a[] = array(
						'message' => __( 'The transients have been successfully deleted.', 'soccer-engine-lite' ),
						'class'   => 'updated',
					);

				} else {

					$dismissible_notice_a[] = array(
						'message' => __( 'There are no transients at the moment.', 'soccer-engine-lite' ),
						'class'   => 'error',
					);

				}

				break;

			// Add Demo Data.
			case 2:
				$result = $this->shared->add_demo_data();

				// Generate message.
				if ( $result ) {

					$dismissible_notice_a[] = array(
						'message' => __( 'The demo data have been successfully added.', 'soccer-engine-lite' ),
						'class'   => 'updated',
					);

				} else {

					$dismissible_notice_a[] = array(
						'message' => __( 'There was an error generating the demo data.', 'soccer-engine-lite' ),
						'class'   => 'error',
					);

				}

				break;

		}
	}
}

?>

<!-- output -->

<div class="wrap">

	<div id="daext-header-wrapper" class="daext-clearfix">

		<h2><?php esc_attr_e( 'Soccer Engine - Maintenance', 'soccer-engine-lite' ); ?></h2>

	</div>

	<div id="daext-menu-wrapper">

		<?php $this->dismissible_notice( $dismissible_notice_a ); ?>

		<!-- table -->

		<div>

			<form id="form-maintenance" method="POST"
					action="admin.php?page=<?php echo $this->shared->get( 'slug' ); ?>-maintenance"
					autocomplete="off">

				<input type="hidden" value="1" name="form_submitted">

				<?php wp_nonce_field( 'daextsoenl_execute_task', 'daextsoenl_execute_task_nonce' ); ?>

				<div class="daext-form-container">

					<div class="daext-form-title"><?php esc_html_e( 'Maintenance', 'soccer-engine-lite' ); ?></div>

					<table class="daext-form daext-form-table">

						<!-- Task -->
						<tr>
							<th scope="row"><?php esc_attr_e( 'Task', 'soccer-engine-lite' ); ?></th>
							<td>
								<select id="task" name="task" class="daext-display-none">
									<option value="0" selected="selected"><?php esc_html_e( 'Delete Data', 'soccer-engine-lite' ); ?></option>
									<option value="1"><?php esc_html_e( 'Delete Transients', 'soccer-engine-lite' ); ?></option>
									<option value="2"><?php esc_html_e( 'Add Demo Data', 'soccer-engine-lite' ); ?></option>
								</select>
								<div class="help-icon"
									title='<?php esc_attr_e( 'The task that should be performed.', 'soccer-engine-lite' ); ?>'></div>
							</td>
						</tr>

					</table>

					<!-- submit button -->
					<div class="daext-form-action">
						<input id="execute-task" class="button" type="submit"
								value="<?php esc_attr_e( 'Execute Task', 'soccer-engine-lite' ); ?>">
					</div>

				</div>

			</form>

		</div>

	</div>

</div>

<!-- Dialog Confirm -->
<div id="dialog-confirm" title="<?php esc_attr_e( 'Execute the task?', 'soccer-engine-lite' ); ?>" class="daext-display-none">
	<p><?php esc_html_e( 'Do you really want to proceed?', 'soccer-engine-lite' ); ?></p>
</div>