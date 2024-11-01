<?php
/**
 * Settings to display the "Team Contracts" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'team_contract',
	'database_column_primary_key'   => 'team_contract_id',

	// Menu.
	'url_slug'                      => 'team-contracts',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Team Contract', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Team Contracts', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Team Contract', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Team Contract', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Team Contract', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Team Contract', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The contract has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The contract has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The contract has been successfully updated.', 'soccer-engine-lite' ),
	'custom_validation'             => 'menu_team_contracts_custom_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'team_contract_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the contract.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'player_id',
			'label'           => __( 'Player', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The player.', 'soccer-engine-lite' ),
			'filter'          => 'get_player_name',
		),
		array(
			'database_column' => 'team_id',
			'label'           => __( 'Team', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The team of the player.', 'soccer-engine-lite' ),
			'filter'          => 'get_team_name',
		),
		array(
			'database_column' => 'team_contract_type_id',
			'label'           => __( 'Contract Type', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The contract type.', 'soccer-engine-lite' ),
			'filter'          => 'get_team_contract_type_name',
		),
		array(
			'database_column' => 'start_date',
			'label'           => __( 'Start Date', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The start date of the contract.', 'soccer-engine-lite' ),
			'filter'          => 'format_date_timestamp',
		),
		array(
			'database_column' => 'end_date',
			'label'           => __( 'End Date', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The end date of the contract.', 'soccer-engine-lite' ),
			'filter'          => 'format_date_timestamp',
		),
		array(
			'database_column' => 'salary',
			'label'           => __( 'Salary', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The salary of the player.', 'soccer-engine-lite' ),
			'filter'          => 'money_format',
		),
	),

	// Pagination Items.
	'pagination_items'              => 10,

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'player_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Player', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The player.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_players(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'player_exists',
					'message'  => esc_attr__( 'Please enter a valid value in the "First Name" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'team_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Team', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The team of the player.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_teams(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'team_exists',
					'message'  => esc_attr__( 'Please enter a valid value in the "Team" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'team_contract_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Contract Type', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The contract type.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_team_contract_types(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'team_contract_type_exists',
					'message'  => esc_attr__( 'Please enter a valid value in the "Contract Type" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'start_date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Start Date', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The start date of the contract.', 'soccer-engine-lite' ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_date',
					'message'  => esc_attr__( 'Please enter a valid value in the "Start Date" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => false,
		),
		array(
			'column'                  => 'end_date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'End Date', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The end date of the contract.', 'soccer-engine-lite' ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_date',
					'message'  => esc_attr__( 'Please enter a valid value in the "End Date" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => false,
		),
		array(
			'column'                  => 'salary',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Salary', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The salary of the contract.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_decimal_15_2',
					'message'  => esc_attr__( 'Please enter a valid value in the "Salary" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => true,
		),
	),

	// Blocking Conditions.
	'blocking_conditions'           => array(
		array(
			'status' => $menu_utility->num_of_players() === 0,
			'code'   => 'num_of_players',
		),
		array(
			'status' => $menu_utility->num_of_team_contract_types() === 0,
			'code'   => 'num_of_team_contract_types',
		),
		array(
			'status' => $menu_utility->num_of_teams() === 0,
			'code'   => 'num_of_teams',
		),
	),

);
$menu->generate_menu();
