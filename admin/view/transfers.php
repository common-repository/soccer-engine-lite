<?php
/**
 * Settings to display the "Transfers" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'transfer',
	'database_column_primary_key'   => 'transfer_id',

	// Menu.
	'url_slug'                      => 'transfers',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Transfers', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Transfers', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Transfer', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Transfer', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Transfer', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Transfer', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The transfer has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The transfer has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The transfer has been successfully updated.', 'soccer-engine-lite' ),

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'transfer_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the transfer.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'player_id',
			'label'           => __( 'Player', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The player.', 'soccer-engine-lite' ),
			'filter'          => 'get_player_name',
		),
		array(
			'database_column' => 'transfer_type_id',
			'label'           => __( 'Transfer Type', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The transfer type.', 'soccer-engine-lite' ),
			'filter'          => 'get_transfer_type_name',
		),
		array(
			'database_column' => 'team_id_left',
			'label'           => __( 'Team Left', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The team left by the player.', 'soccer-engine-lite' ),
			'filter'          => 'get_team_name',
		),
		array(
			'database_column' => 'team_id_joined',
			'label'           => __( 'Team Joined', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The team joined by the player.', 'soccer-engine-lite' ),
			'filter'          => 'get_team_name',
		),
		array(
			'database_column' => 'date',
			'label'           => __( 'Date', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The date of the transfer.', 'soccer-engine-lite' ),
			'filter'          => 'format_date_timestamp',
		),
		array(
			'database_column' => 'fee',
			'label'           => __( 'Fee', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The transfer fee.', 'soccer-engine-lite' ),
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
					'message'  => esc_attr__( 'Please enter a valid value in the "Player" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'transfer_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Transfer Type', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The transfer type.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_transfer_types(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'transfer_type_exists',
					'message'  => esc_attr__( 'Please enter a valid value in the "Transfer Type" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'team_id_left',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Team Left', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The team left by the player.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_teams( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'team_exists_none_allowed',
					'message'  => esc_attr__( 'Please enter a valid value in the "Team Left" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'team_id_joined',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Team Joined', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The team joined by the player.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_teams( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'team_exists_none_allowed',
					'message'  => esc_attr__( 'Please enter a valid value in the "Team Joined" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Date', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The date of the transfer.', 'soccer-engine-lite' ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_date',
					'message'  => esc_attr__( 'Please enter a valid value in the "Date" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => false,
		),
		array(
			'column'                  => 'fee',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Fee', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The fee of the transfer.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_decimal_15_2',
					'message'  => esc_attr__( 'Please enter a valid value in the "Fee" field.', 'soccer-engine-lite' ),
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
			'status' => $menu_utility->num_of_teams() === 0,
			'code'   => 'num_of_teams',
		),
		array(
			'status' => $menu_utility->num_of_transfer_types() === 0,
			'code'   => 'num_of_transfer_types',
		),
	),

);
$menu->generate_menu();
