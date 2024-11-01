<?php
/**
 * Settings to display the "Events Wizard" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility = new Daextsoenl_Menu_Utility( $this->shared );

if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_attr__( 'You do not have sufficient permissions to access this page.', 'soccer-engine-lite' ) );
}

// Process data.
if ( isset( $_POST['form_submitted'] ) ) {

	// Nonce verification.
	check_admin_referer( 'daextsoenl_events_wizard', 'daextsoenl_events_wizard_nonce' );

	// Prepare data.
	$match_id             = intval( $_POST['match_id'], 10 );
	$team_1_goals         = intval( $_POST['team_1_goals'], 10 );
	$team_2_goals         = intval( $_POST['team_2_goals'], 10 );
	$team_1_yellow_cards  = intval( $_POST['team_1_yellow_cards'], 10 );
	$team_2_yellow_cards  = intval( $_POST['team_2_yellow_cards'], 10 );
	$team_1_red_cards     = intval( $_POST['team_1_red_cards'], 10 );
	$team_2_red_cards     = intval( $_POST['team_2_red_cards'], 10 );
	$team_1_substitutions = intval( $_POST['team_1_substitutions'], 10 );
	$team_2_substitutions = intval( $_POST['team_2_substitutions'], 10 );
	$total_query_results  = 0;

	$invalid_data_message = '';
	$invalid_data         = false;
	$events_counter       = 0;

	$match_exists = $this->shared->match_exists;

	if ( ! $match_exists( $match_id ) ) {
		$invalid_data_message .= '<div class="error settings-error notice is-dismissible below-h2"><p>' . esc_html__(
			'Please enter a valid match.',
			'soccer-engine-lite'
		) . '</p></div>';
		$invalid_data          = true;
	}

	if ( $team_1_goals < 0 or $team_1_goals > 100 ) {
		$invalid_data_message .= '<div class="error settings-error notice is-dismissible below-h2"><p>' . esc_html__(
			'Please enter a valid value in the "Team 1 Goals" field.',
			'soccer-engine-lite'
		) . '</p></div>';
		$invalid_data          = true;
	}

	if ( $team_2_goals < 0 or $team_2_goals > 100 ) {
		$invalid_data_message .= '<div class="error settings-error notice is-dismissible below-h2"><p>' . esc_html__(
			'Please enter a valid value in the "Team 2 Goals" field.',
			'soccer-engine-lite'
		) . '</p></div>';
		$invalid_data          = true;
	}

	if ( $team_1_yellow_cards < 0 or $team_1_yellow_cards > 100 ) {
		$invalid_data_message .= '<div class="error settings-error notice is-dismissible below-h2"><p>' . esc_html__(
			'Please enter a valid value in the "Team 1 Yellow Cards" field.',
			'soccer-engine-lite'
		) . '</p></div>';
		$invalid_data          = true;
	}

	if ( $team_2_yellow_cards < 0 or $team_2_yellow_cards > 100 ) {
		$invalid_data_message .= '<div class="error settings-error notice is-dismissible below-h2"><p>' . esc_html__(
			'Please enter a valid value in the "Team 2 Yellow Cards" field.',
			'soccer-engine-lite'
		) . '</p></div>';
		$invalid_data          = true;
	}

	if ( $team_1_red_cards < 0 or $team_1_red_cards > 100 ) {
		$invalid_data_message .= '<div class="error settings-error notice is-dismissible below-h2"><p>' . esc_html__(
			'Please enter a valid value in the "Team 1 Red Cards" field.',
			'soccer-engine-lite'
		) . '</p></div>';
		$invalid_data          = true;
	}

	if ( $team_2_red_cards < 0 or $team_2_red_cards > 100 ) {
		$invalid_data_message .= '<div class="error settings-error notice is-dismissible below-h2"><p>' . esc_html__(
			'Please enter a valid value in the "Team 2 Red Cards" field.',
			'soccer-engine-lite'
		) . '</p></div>';
		$invalid_data          = true;
	}

	if ( $team_1_substitutions < 0 or $team_1_substitutions > 100 ) {
		$invalid_data_message .= '<div class="error settings-error notice is-dismissible below-h2"><p>' . esc_html__(
			'Please enter a valid value in the "Team 1 Substitutions" field.',
			'soccer-engine-lite'
		) . '</p></div>';
		$invalid_data          = true;
	}

	if ( $team_2_substitutions < 0 or $team_2_substitutions > 100 ) {
		$invalid_data_message .= '<div class="error settings-error notice is-dismissible below-h2"><p>' . esc_html__(
			'Please enter a valid value in the "Team 2 Subsitutions" field.',
			'soccer-engine-lite'
		) . '</p></div>';
		$invalid_data          = true;
	}

	if ( $invalid_data === false ) {

		// Delete all the events of the specified match
		global $wpdb;
		$table_name   = $wpdb->prefix . $this->shared->get( 'slug' ) . '_event';
		$safe_sql     = $wpdb->prepare( "DELETE FROM $table_name WHERE match_id = %d", $match_id );
		$query_result = $wpdb->query( $safe_sql );

		/**
		 * Generate events in the selected match.
		 */

		// Generate an event for each goal of team 1.
		for ( $i = 0;$i < $team_1_goals;$i++ ) {

				// Insert into the database.
				global $wpdb;
				$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_event';
				$safe_sql   = $wpdb->prepare(
					"INSERT INTO $table_name SET 
                match_id = %d,
                part = %d,
                team_slot = %d,
                `time` = %d,
                additional_time = %d,
                description = %s,
                match_effect = %d,
                player_id = %d,
                player_id_substitution_out = %d,
                player_id_substitution_in = %d,
                staff_id = %d",
					$match_id,
					0,
					0,
					1,
					0,
					'',
					1,
					0,
					0,
					0,
					0
				);

				$query_result    = $wpdb->query( $safe_sql );
				$events_counter += intval( $query_result, 10 );

		}

		// Generate an event for each goal of team 2.
		for ( $i = 0;$i < $team_2_goals;$i++ ) {

			// Insert into the database.
			global $wpdb;
			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_event';
			$safe_sql   = $wpdb->prepare(
				"INSERT INTO $table_name SET 
                match_id = %d,
                part = %d,
                team_slot = %d,
                `time` = %d,
                additional_time = %d,
                description = %s,
                match_effect = %d,
                player_id = %d,
                player_id_substitution_out = %d,
                player_id_substitution_in = %d,
                staff_id = %d",
				$match_id,
				0,
				1,
				0,
				0,
				'',
				1,
				0,
				0,
				0,
				0
			);

			$query_result    = $wpdb->query( $safe_sql );
			$events_counter += intval( $query_result, 10 );

		}

		// Generate an event for each yellow card of team 1.
		for ( $i = 0;$i < $team_1_yellow_cards;$i++ ) {

			// Insert into the database.
			global $wpdb;
			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_event';
			$safe_sql   = $wpdb->prepare(
				"INSERT INTO $table_name SET 
                match_id = %d,
                part = %d,
                team_slot = %d,
                `time` = %d,
                additional_time = %d,
                description = %s,
                match_effect = %d,
                player_id = %d,
                player_id_substitution_out = %d,
                player_id_substitution_in = %d,
                staff_id = %d",
				$match_id,
				0,
				0,
				1,
				0,
				'',
				2,
				0,
				0,
				0,
				0
			);

			$query_result    = $wpdb->query( $safe_sql );
			$events_counter += intval( $query_result, 10 );

		}

		// Generate an event for each yellow card of team 2.
		for ( $i = 0;$i < $team_2_yellow_cards;$i++ ) {

			// Insert into the database.
			global $wpdb;
			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_event';
			$safe_sql   = $wpdb->prepare(
				"INSERT INTO $table_name SET 
                match_id = %d,
                part = %d,
                team_slot = %d,
                `time` = %d,
                additional_time = %d,
                description = %s,
                match_effect = %d,
                player_id = %d,
                player_id_substitution_out = %d,
                player_id_substitution_in = %d,
                staff_id = %d",
				$match_id,
				0,
				1,
				1,
				0,
				'',
				2,
				0,
				0,
				0,
				0
			);

			$query_result    = $wpdb->query( $safe_sql );
			$events_counter += intval( $query_result, 10 );

		}

		// Generate an event for each red card of team 1.
		for ( $i = 0;$i < $team_1_red_cards;$i++ ) {

			// Insert into the database.
			global $wpdb;
			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_event';
			$safe_sql   = $wpdb->prepare(
				"INSERT INTO $table_name SET 
                match_id = %d,
                part = %d,
                team_slot = %d,
                `time` = %d,
                additional_time = %d,
                description = %s,
                match_effect = %d,
                player_id = %d,
                player_id_substitution_out = %d,
                player_id_substitution_in = %d,
                staff_id = %d",
				$match_id,
				0,
				0,
				1,
				0,
				'',
				3,
				0,
				0,
				0,
				0
			);

			$query_result    = $wpdb->query( $safe_sql );
			$events_counter += intval( $query_result, 10 );

		}

		// Generate an event for each red card of team 2.
		for ( $i = 0;$i < $team_2_red_cards;$i++ ) {

			// Insert into the database.
			global $wpdb;
			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_event';
			$safe_sql   = $wpdb->prepare(
				"INSERT INTO $table_name SET 
                match_id = %d,
                part = %d,
                team_slot = %d,
                `time` = %d,
                additional_time = %d,
                description = %s,
                match_effect = %d,
                player_id = %d,
                player_id_substitution_out = %d,
                player_id_substitution_in = %d,
                staff_id = %d",
				$match_id,
				0,
				1,
				1,
				0,
				'',
				3,
				0,
				0,
				0,
				0
			);

			$query_result    = $wpdb->query( $safe_sql );
			$events_counter += intval( $query_result, 10 );

		}

		// Generate an event for each substitution of team 1.
		for ( $i = 0;$i < $team_1_substitutions;$i++ ) {

			// Insert into the database.
			global $wpdb;
			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_event';
			$safe_sql   = $wpdb->prepare(
				"INSERT INTO $table_name SET 
                match_id = %d,
                part = %d,
                team_slot = %d,
                `time` = %d,
                additional_time = %d,
                description = %s,
                match_effect = %d,
                player_id = %d,
                player_id_substitution_out = %d,
                player_id_substitution_in = %d,
                staff_id = %d",
				$match_id,
				0,
				0,
				1,
				0,
				'',
				4,
				0,
				0,
				0,
				0
			);

			$query_result    = $wpdb->query( $safe_sql );
			$events_counter += intval( $query_result, 10 );

		}

		// Generate an event for each substitution of team 2.
		for ( $i = 0;$i < $team_2_substitutions;$i++ ) {

			// Insert into the database.
			global $wpdb;
			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_event';
			$safe_sql   = $wpdb->prepare(
				"INSERT INTO $table_name SET 
                match_id = %d,
                part = %d,
                team_slot = %d,
                `time` = %d,
                additional_time = %d,
                description = %s,
                match_effect = %d,
                player_id = %d,
                player_id_substitution_out = %d,
                player_id_substitution_in = %d,
                staff_id = %d",
				$match_id,
				0,
				1,
				1,
				0,
				'',
				4,
				0,
				0,
				0,
				0
			);

			$query_result    = $wpdb->query( $safe_sql );
			$events_counter += intval( $query_result, 10 );

		}

		$process_data_message = '<div class="updated settings-error notice is-dismissible below-h2"><p>' . intval( $events_counter, 10 ) . '&nbsp' . esc_html__(
			'events have been successfully generated.',
			'soccer-engine-lite'
		) . '</p></div>';

	}
}

?>

<!-- output -->

<div class="wrap">

	<div id="daext-header-wrapper" class="daext-clearfix">

		<h2><?php esc_html_e( 'Soccer Engine - Events Wizard', 'soccer-engine-lite' ); ?></h2>

	</div>


	<?php

	if ( $this->shared->get_number_of_matches() === 0 ) {

		$blocking_condition_message = '<p>' . __( 'Please add at least one match with the', 'soccer-engine-lite' ) .
		'&nbsp' . '<a href="' . get_admin_url() . 'admin.php?page=daextsoenl-matches">' . __( 'Matches', 'soccer-engine-lite' ) . '</a> ' . __( 'menu', 'soccer-engine-lite' ) . '.</p>';

		echo $blocking_condition_message;

	}

	?>

<?php if ( ! isset( $blocking_condition_message ) ) : ?>

	<div id="daext-menu-wrapper">

		<?php
		if ( isset( $invalid_data_message ) ) {
			echo $invalid_data_message;
		}
		?>
		<?php
		if ( isset( $process_data_message ) ) {
			echo $process_data_message;
		}
		?>

		<!-- table -->

		<div>

			<form id="form-results" method="POST"
					action="admin.php?page=<?php echo esc_attr( $this->shared->get( 'slug' ) ); ?>-events-wizard"
					autocomplete="off">

				<input type="hidden" value="1" name="form_submitted">
				<?php wp_nonce_field( 'daextsoenl_events_wizard', 'daextsoenl_events_wizard_nonce' ); ?>

				<div class="daext-form-container">

					<div class="daext-form-title"><?php esc_html_e( 'Events Wizard', 'soccer-engine-lite' ); ?></div>

						<table class="daext-form daext-form-table">

							<!-- Match ID -->
							<tr>
								<th scope="row"><?php esc_html_e( 'Match', 'soccer-engine-lite' ); ?></th>
								<td>

									<select id="match_id" name="match_id" class="daext-display-none">
									<?php

									global $wpdb;
									$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_match';
									$sql        = "SELECT match_id, name FROM $table_name ORDER BY match_id DESC";
									$match_a    = $wpdb->get_results( $sql, ARRAY_A );

									foreach ( $match_a as $key => $match ) {
										echo '<option value="' . intval( $match['match_id'], 10 ) . '">' . esc_html( $match['name'] ) . '</option>';
									}

									?>
									</select>

									<div class="help-icon"
										title='<?php esc_attr_e( 'The match for which the result should be assigned.', 'soccer-engine-lite' ); ?>'></div>
								</td>
							</tr>

							<tr class="group-trigger" data-trigger-target="team-1">
								<th class="group-title" style="border-bottom-width: 1px;"><?php esc_html_e( 'Team 1', 'soccer-engine-lite' ); ?></th>
								<td style="border-bottom-width: 1px;">
									<div class="expand-icon"></div>
								</td>
							</tr>

							<!-- Team 1 Goals -->
							<tr class="team-1">
								<th><label for="from"><?php esc_html_e( 'Goals', 'soccer-engine-lite' ); ?></label></th>
								<td>
									<input type="text" id="team-1-goals" maxlength="3" size="3" name="team_1_goals" value="0"/>
									<div class="help-icon"
										title="<?php esc_attr_e( 'The goals of team 1.', 'soccer-engine-lite' ); ?>"></div>
								</td>
							</tr>

							<!-- Team 1 Yellow Cards -->
							<tr class="team-1">
								<th><label for="from"><?php esc_html_e( 'Yellow Cards', 'soccer-engine-lite' ); ?></label></th>
								<td>
									<input type="text" id="team-1-yellow-cards" maxlength="3" size="30" name="team_1_yellow_cards" value="0"/>
									<div class="help-icon"
										title="<?php esc_attr_e( 'The yellow cards of team 1.', 'soccer-engine-lite' ); ?>"></div>
								</td>
							</tr>

							<!-- Team 1 Red Cards -->
							<tr class="team-1">
								<th><label for="from"><?php esc_html_e( 'Red Cards', 'soccer-engine-lite' ); ?></label></th>
								<td>
									<input type="text" id="team-1-red-cards" maxlength="3" size="30" name="team_1_red_cards" value="0"/>
									<div class="help-icon"
										title="<?php esc_attr_e( 'The red cards of team 1.', 'soccer-engine-lite' ); ?>"></div>
								</td>
							</tr>

							<!-- Team 1 Substitutions -->
							<tr class="team-1">
								<th><label for="from"><?php esc_html_e( 'Substitutions', 'soccer-engine-lite' ); ?></label></th>
								<td>
									<input type="text" id="team-1-substitutions" maxlength="3" size="30" name="team_1_substitutions" value="0"/>
									<div class="help-icon"
										title="<?php esc_attr_e( 'The substitutions of team 1.', 'soccer-engine-lite' ); ?>"></div>
								</td>
							</tr>

							<tr class="group-trigger" data-trigger-target="team-2">
								<th class="group-title" style="border-bottom-width: 1px;"><?php esc_html_e( 'Team 2', 'soccer-engine-lite' ); ?></th>
								<td style="border-bottom-width: 1px;">
									<div class="expand-icon"></div>
								</td>
							</tr>

							<!-- Team 2 Goals -->
							<tr class="team-2">
								<th scope="row"><label for="to"><?php esc_html_e( 'Goals', 'soccer-engine-lite' ); ?></label></th>
								<td>
									<input type="text" id="team-2-goals" maxlength="3" size="30" name="team_2_goals" value="0"/>
									<div class="help-icon"
										title="<?php esc_attr_e( 'The goals of team 2.', 'soccer-engine-lite' ); ?>"></div>
								</td>
							</tr>

							<!-- Team 2 Yellow Cards -->
							<tr class="team-2">
								<th scope="row"><label for="to"><?php esc_html_e( 'Yellow Cards', 'soccer-engine-lite' ); ?></label></th>
								<td>
									<input type="text" id="team-2-yellow-cards" maxlength="3" size="30" name="team_2_yellow_cards" value="0"/>
									<div class="help-icon"
										title="<?php esc_attr_e( 'The yellow cards of team 2.', 'soccer-engine-lite' ); ?>"></div>
								</td>
							</tr>

							<!-- Team 2 Red Cards -->
							<tr class="team-2">
								<th scope="row"><label for="to"><?php esc_html_e( 'Red Cards', 'soccer-engine-lite' ); ?></label></th>
								<td>
									<input type="text" id="team-2-red-cards" maxlength="3" size="30" name="team_2_red_cards" value="0"/>
									<div class="help-icon"
										title="<?php esc_attr_e( 'The red cards of team 2.', 'soccer-engine-lite' ); ?>"></div>
								</td>
							</tr>

							<!-- Team 2 Substitutions -->
							<tr class="team-2">
								<th scope="row"><label for="to"><?php esc_html_e( 'Substitutions', 'soccer-engine-lite' ); ?></label></th>
								<td>
									<input type="text" id="team-2-substitutions" maxlength="3" size="30" name="team_2_substitutions" value="0"/>
									<div class="help-icon"
										title="<?php esc_attr_e( 'The substitutions of team 2.', 'soccer-engine-lite' ); ?>"></div>
								</td>
							</tr>

						</table>

						<!-- submit button -->
						<div class="daext-form-action">
							<input id="set-result" class="button" type="submit"
								value="<?php esc_attr_e( 'Generate Events', 'soccer-engine-lite' ); ?>">
						</div>

				</div>

			</form>

		</div>

	</div>

	<?php endif; ?>

</div>