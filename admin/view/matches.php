<?php
/**
 * Settings to display the "Matches" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'match',
	'database_column_primary_key'   => 'match_id',

	// Menu.
	'url_slug'                      => 'matches',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Match', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Matches', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create Match', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Match', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Match', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Match', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The match has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The match has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The match has been successfully updated.', 'soccer-engine-lite' ),
	'custom_validation'             => 'menu_matches_custom_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'match_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the match.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The name of the match.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'team_id_1',
			'label'           => __( 'Team 1', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The team 1 of the match.', 'soccer-engine-lite' ),
			'filter'          => 'get_team_name',
		),
		array(
			'database_column' => 'team_id_2',
			'label'           => __( 'Team 2', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The team 2 of the match.', 'soccer-engine-lite' ),
			'filter'          => 'get_team_name',
		),
		array(
			'database_column' => 'date',
			'label'           => __( 'Date', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The date of the match.', 'soccer-engine-lite' ),
			'filter'          => 'format_date_timestamp',
		),
		array(
			'database_column' => 'time',
			'label'           => __( 'Time', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The time of the match.', 'soccer-engine-lite' ),
			'filter'          => 'format_time',
		),
	),

	// Pagination Items.
	'pagination_items'              => 10,

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Name', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The name of the match.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_text_1_255',
					'message'  => __( 'Please enter a valid value in the "Name" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'description',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Description', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The description of the team.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_text_1_255',
					'message'  => __( 'Please enter a valid value in the "Description" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'competition_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Competition', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The competition of the match.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_competitions( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'competition_exists_none_allowed',
					'message'  => __( 'Please enter a valid value in the "Competition" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'round',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Round', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The round of the competition.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 1,
					'text'     => '1',
					'selected' => true,
				),
				array(
					'value'    => 2,
					'text'     => '2',
					'selected' => false,
				),
				array(
					'value'    => 3,
					'text'     => '3',
					'selected' => false,
				),
				array(
					'value'    => 4,
					'text'     => '4',
					'selected' => false,
				),
			),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'type',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Type', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The type of round of the competition.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 0,
					'text'     => __( 'Single Leg', 'soccer-engine-lite' ),
					'selected' => true,
				),
				array(
					'value'    => 1,
					'text'     => __( 'First Leg', 'soccer-engine-lite' ),
					'selected' => false,
				),
				array(
					'value'    => 2,
					'text'     => __( 'Second Leg', 'soccer-engine-lite' ),
					'selected' => false,
				),
			),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'team_id_1',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Team 1', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The team 1 of the match.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_teams(),
			'validation_regex'        => null,
			'validation_function'     => array(
				array(
					'function' => 'team_exists',
					'message'  => __( 'Please enter a valid value in the "Team 1" field.', 'soccer-engine-lite' ),
				),
			),
			'maxlength'               => '1',
			'searchable'              => false,
		),
		array(
			'column'                  => 'team_id_2',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Team 2', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The team 2 of the match.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_teams(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'team_exists',
					'message'  => __( 'Please enter a valid value in the "Team 2" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'squad_id_1',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Import Squad 1', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'Use this selector to import the lineup, the substitutes, the staff members and the advanced options of team 1 from a squad.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_squads( true ),
			'validation_regex'        => null,
			'searchable'              => false,
			'unsaved'                 => true,
		),
		array(
			'column'                  => 'squad_id_2',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Import Squad 2', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'Use this selector to import the lineup, the substitutes, the staff members and the advanced options of team 2 from a squad.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_squads( true ),
			'validation_regex'        => null,
			'searchable'              => false,
			'required'                => false,
			'unsaved'                 => true,
		),
		array(
			'column'                  => 'date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Date', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The date of the match.', 'soccer-engine-lite' ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_date',
					'message'  => __( 'Please enter a valid value in the "Date" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => false,
		),
		array(
			'column'                  => 'time',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Time', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The time of the match in the HH:MM format. E.g. 9:30, 15:00, 20:45', 'soccer-engine-lite' ),
			'type'                    => 'time',
			'maxlength'               => '5',
			'validation_function'     => array(
				array(
					'function' => 'validate_time',
					'message'  => __( 'Please enter a valid value in the "Time" field. E.g. 9:30, 15:00, 20:45', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => false,
		),
		array(
			'target' => 'additional-information',
			'label'  => __( 'Additional Information', 'soccer-engine-lite' ),
			'type'   => 'group-trigger',
		),
		array(
			'class'                   => 'additional-information',
			'column'                  => 'fh_additional_time',
			'query_placeholder_token' => 's',
			'label'                   => __( 'First Half Additional Time', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The additional time of the first half in minutes.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_tinyint_unsigned',
					'message'  => __( 'Please enter a valid value in the "First Half Extra Time" field.', 'soccer-engine-lite' ),
				),
			),
			'value'                   => '0',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'class'                   => 'additional-information',
			'column'                  => 'sh_additional_time',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Second Half Additional Time', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The additional time of the second half in minutes.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_tinyint_unsigned',
					'message'  => __( 'Please enter a valid value in the "Second Half Additional Time" field.', 'soccer-engine-lite' ),
				),
			),
			'value'                   => '0',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'class'                   => 'additional-information',
			'column'                  => 'fh_extra_time_additional_time',
			'query_placeholder_token' => 's',
			'label'                   => __( 'First Half Extra Time Additional Time', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The additional time of the first half extra time in minutes.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_tinyint_unsigned',
					'message'  => __( 'Please enter a valid value in the "First Half Extra Time Additional Time" field.', 'soccer-engine-lite' ),
				),
			),
			'value'                   => '0',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'class'                   => 'additional-information',
			'column'                  => 'sh_extra_time_additional_time',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Second Half Extra Time Additional Time', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The additional time of the second half extra time in minutes.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_tinyint_unsigned',
					'message'  => __( 'Please enter a valid value in the "Second Half Extra Time Additional Time" field.', 'soccer-engine-lite' ),
				),
			),
			'value'                   => '0',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'class'                   => 'additional-information',
			'column'                  => 'referee_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Referee', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The referee of the match.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_referees( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'referee_exists_none_allowed',
					'message'  => __( 'Please enter a valid value in the "Referee" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'class'                   => 'additional-information',
			'column'                  => 'stadium_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Stadium', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The stadium of the match.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_stadiums( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'stadium_exists_none_allowed',
					'message'  => __( 'Please enter a valid value in the "Stadium" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'class'                   => 'additional-information',
			'column'                  => 'attendance',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Attendance', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The attendance of the match.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '10',
			'validation_function'     => array(
				array(
					'function' => 'validate_attendance',
					'message'  => __( 'Please enter a valid value in the "Attendance" field.', 'soccer-engine-lite' ),
				),
			),
			'value'                   => '0',
			'required'                => false,
			'searchable'              => true,
		),
	),

	// Blocking Conditions
	'blocking_conditions'           => array(
		array(
			'status' => $menu_utility->num_of_teams() === 0,
			'code'   => 'num_of_teams',
		),
	),

);

for ( $t = 1;$t <= 2;$t++ ) {

	$menu->settings['fields'][] = array(
		'target' => 'lineup-team-' . $t,
		'label'  => __( 'Lineup Team', 'soccer-engine-lite' ) . ' ' . $t,
		'type'   => 'group-trigger',
	);

	for ( $i = 1;$i <= 11;$i++ ) {
		$menu->settings['fields'][] = array(
			'class'                   => 'lineup-team-' . $t,
			'column'                  => 'team_' . $t . '_lineup_player_id_' . $i,
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Player', 'soccer-engine-lite' ) . ' ' . $i,
			'tooltip'                 => __( 'The player', 'soccer-engine-lite' ) . ' ' . $i . ' ' . __( 'of team', 'soccer-engine-lite' ) . ' ' . $t . '.',
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_players( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => $this->shared->player_exists_none_allowed,
					'message'  => esc_attr__( 'Please enter a valid value in the "Player ', 'soccer-engine-lite' ) . $i .
								esc_attr__( ' field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		);
	}

	$menu->settings['fields'][] = array(
		'target' => 'substitutes-team-' . $t,
		'label'  => __( 'Substitutes Team', 'soccer-engine-lite' ) . ' ' . $t,
		'type'   => 'group-trigger',
	);

	for ( $i = 1;$i <= 20;$i++ ) {
		$menu->settings['fields'][] = array(
			'class'                   => 'substitutes-team-' . $t,
			'column'                  => 'team_' . $t . '_substitute_player_id_' . $i,
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Substitute', 'soccer-engine-lite' ) . ' ' . $i,
			'tooltip'                 => __( 'The substitute', 'soccer-engine-lite' ) . ' ' . $i . ' ' . __( 'of team', 'soccer-engine-lite' ) . ' ' . $t . '.',
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_players( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => $this->shared->player_exists_none_allowed,
					'message'  => esc_attr__( 'Please enter a valid value in the "Substitute', 'soccer-engine-lite' ) . ' ' . $i .
								esc_attr__( ' field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		);
	}

	$menu->settings['fields'][] = array(
		'target' => 'staff-team-' . $t,
		'label'  => __( 'Staff Team', 'soccer-engine-lite' ) . ' ' . $t,
		'type'   => 'group-trigger',
	);

	for ( $i = 1;$i <= 20;$i++ ) {
		$menu->settings['fields'][] = array(
			'class'                   => 'staff-team-' . $t,
			'column'                  => 'team_' . $t . '_staff_id_' . $i,
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Staff', 'soccer-engine-lite' ) . ' ' . $i,
			'tooltip'                 => __( 'The staff', 'soccer-engine-lite' ) . ' ' . $i . ' ' . __( 'of team', 'soccer-engine-lite' ) . ' ' . $t . '.',
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_staff( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => $this->shared->staff_exists_none_allowed,
					'message'  => esc_attr__( 'Please enter a valid value in the "Staff', 'soccer-engine-lite' ) . ' ' . $i .
								esc_attr__( ' field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		);
	}

	$menu->settings['fields'][] = array(
		'target' => 'advanced-team-' . $t,
		'label'  => __( 'Advanced Team', 'soccer-engine-lite' ) . ' ' . $t,
		'type'   => 'group-trigger',
	);

	$menu->settings['fields'][] = array(
		'class'                   => 'advanced-team-' . $t,
		'column'                  => 'team_' . $t . '_formation_id',
		'query_placeholder_token' => 'd',
		'label'                   => __( 'Formation', 'soccer-engine-lite' ),
		'tooltip'                 => __( 'The formation', 'soccer-engine-lite' ) . ' ' . __( 'of team', 'soccer-engine-lite' ) . ' ' . $t . '.',
		'type'                    => 'select',
		'select_items'            => $menu_utility->select_formations( true ),
		'validation_regex'        => null,
		'maxlength'               => '1',
		'validation_function'     => array(
			array(
				'function' => 'formation_exists_none_allowed',
				'message'  => __( 'Please enter a valid value in the "Formation" field.', 'soccer-engine-lite' ),
			),
		),
		'required'                => false,
		'searchable'              => false,
	);

	$menu->settings['fields'][] = array(
		'class'                   => 'advanced-team-' . $t,
		'column'                  => 'team_' . $t . '_jersey_set_id',
		'query_placeholder_token' => 'd',
		'label'                   => __( 'Jersey Set', 'soccer-engine-lite' ),
		'tooltip'                 => __( 'The jersey set', 'soccer-engine-lite' ) . ' ' . __( 'of team', 'soccer-engine-lite' ) . ' ' . $t . '.',
		'type'                    => 'select',
		'select_items'            => $menu_utility->select_jersey_sets( true ),
		'validation_regex'        => null,
		'maxlength'               => '1',
		'validation_function'     => array(
			array(
				'function' => 'jersey_set_exists_none_allowed',
				'message'  => esc_attr__( 'Please enter a valid value in the "Jersey Set" field.', 'soccer-engine-lite' ),
			),
		),
		'required'                => false,
		'searchable'              => false,
	);

}





$menu->generate_menu();
