<?php
/**
 * Settings to display the "Agency Contracts" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'agency_contract',
	'database_column_primary_key'   => 'agency_contract_id',

	// Menu.
	'url_slug'                      => 'agency-contracts',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Agency Contract', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Agency Contracts', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Agency Contract', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Agency Contract', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Agency Contract', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Agency Contract', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The contract has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The contract has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The contract has been successfully updated.', 'soccer-engine-lite' ),
	'custom_validation'             => 'menu_agency_contracts_custom_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'agency_contract_id',
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
			'database_column' => 'agency_id',
			'label'           => __( 'Agency', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The agency of the player.', 'soccer-engine-lite' ),
			'filter'          => 'get_agency_name',
		),
		array(
			'database_column' => 'agency_contract_type_id',
			'label'           => __( 'Agency Contract Type', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The contract type.', 'soccer-engine-lite' ),
			'filter'          => 'get_agency_contract_type_name',
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
					'message'  => esc_attr__( 'Please enter a valid value in the "Player" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'agency_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Agency', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The agency.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_agencies(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'agency_exists',
					'message'  => esc_attr__( 'Please enter a valid value in the "Agency" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'agency_contract_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Contract Type', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The contract type.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_agency_contract_types(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'agency_contract_type_exists',
					'message'  => esc_attr__( 'Please enter a valid value in the "Agency Contract Type" field.', 'soccer-engine-lite' ),
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
	),

	// Blocking Conditions.
	'blocking_conditions'           => array(
		array(
			'status' => $menu_utility->num_of_players() === 0,
			'code'   => 'num_of_players',
		),
		array(
			'status' => $menu_utility->num_of_agency_contract_types() === 0,
			'code'   => 'num_of_agency_contract_types',
		),
		array(
			'status' => $menu_utility->num_of_agencies() === 0,
			'code'   => 'num_of_agencies',
		),
	),

);
$menu->generate_menu();
