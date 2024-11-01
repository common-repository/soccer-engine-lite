<?php
/**
 * Settings to display the "Events" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'event',
	'database_column_primary_key'   => 'event_id',

	// Menu.
	'url_slug'                      => 'events',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Event', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Events', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Event', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Event', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Event', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Event', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The event has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The event has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The event has been successfully updated.', 'soccer-engine-lite' ),
	'custom_validation'             => 'menu_events_custom_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'event_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the event.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'data',
			'label'           => __( 'Data', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The type of data associated with the event.', 'soccer-engine-lite' ),
			'filter'          => 'get_data_name',
		),
		array(
			'database_column' => 'match_id',
			'label'           => __( 'Match', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The match of the event.', 'soccer-engine-lite' ),
			'filter'          => 'get_match_name',
		),
		array(
			'database_column' => 'team_slot',
			'label'           => __( 'Team', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The team of the event.', 'soccer-engine-lite' ),
			'filter'          => 'get_team_slot_name',
		),
		array(
			'database_column' => 'match_effect',
			'label'           => __( 'Match Effect', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The effect of the event on the match.', 'soccer-engine-lite' ),
			'filter'          => 'get_match_effect_name',
		),
	),

	// Pagination Items.
	'pagination_items'              => 10,

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'data',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Data', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The type of data associated with the event.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 0,
					'text'     => __( 'Basic', 'soccer-engine-lite' ),
					'selected' => false,
				),
				array(
					'value'    => 1,
					'text'     => __( 'Complete', 'soccer-engine-lite' ),
					'selected' => true,
				),
			),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_bool',
					'message'  => __( 'Please enter a valid value in the "Data" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'match_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Match', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The match of the event.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_matches(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => $this->shared->match_exists,
					'message'  => __( 'Please enter a valid value in the "Match" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'team_slot',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Team', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The team of the event.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 0,
					'text'     => __( 'Team 1', 'soccer-engine-lite' ),
					'selected' => false,
				),
				array(
					'value'    => 1,
					'text'     => __( 'Team 2', 'soccer-engine-lite' ),
					'selected' => false,
				),
			),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_team_slot',
					'message'  => __( 'Please enter a valid value in the "Team" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'match_effect',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Match Effect', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The effect of the event on the match.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_match_effects(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => $this->shared->match_effect_exists,
					'message'  => __( 'Please enter a valid value in the "Match Effect" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'player_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Player', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The player who caused the event.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_players( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => $this->shared->player_exists_none_allowed,
					'message'  => __( 'Please enter a valid value in the "Player" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'player_id_substitution_out',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Player Substitution Out', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The replaced player of a substitution event.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_players( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => $this->shared->player_exists_none_allowed,
					'message'  => __( 'Please enter a valid value in the "Player Substitution Out" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'player_id_substitution_in',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Player Substitution In', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The new player of a substitution event.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_players( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => $this->shared->player_exists_none_allowed,
					'message'  => __( 'Please enter a valid value in the "Player Substitution In" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'staff_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Staff', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The staff member who caused the event.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_staff( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => $this->shared->staff_exists_none_allowed,
					'message'  => __( 'Please enter a valid value in the "Staff" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'part',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Part', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The part of the match.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_parts(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_match_part',
					'message'  => __( 'Please enter a valid value in the "Part" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'time',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Time', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The time of the event in the selected match part.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '2',
			'value'                   => '1',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'additional_time',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Additional Time', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The additional time of the event in the selected match part.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '2',
			'value'                   => '0',
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'description',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Description', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The description of the event.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '1000',
			'required'                => true,
			'searchable'              => true,
		),
	),

	// Blocking Conditions.
	'blocking_conditions'           => array(
		array(
			'status' => $this->shared->get_number_of_matches() === 0,
			'code'   => 'number_of_matches',
		),
		array(
			'status' => $menu_utility->num_of_teams() === 0,
			'code'   => 'num_of_teams',
		),
	),

);
$menu->generate_menu();
