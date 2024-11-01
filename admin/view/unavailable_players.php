<?php
/**
 * Settings to display the "Unavailable Players" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'unavailable_player',
	'database_column_primary_key'   => 'unavailable_player_id',

	// Menu.
	'url_slug'                      => 'unavailable-players',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Unavailable Player', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Unavailable Players', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Unavailable Player', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Unavailable Player', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Unavailable Player', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Unavailable Player', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The unavailable player has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The unavailable player has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The unavailable player has been successfully updated.', 'soccer-engine-lite' ),
	'custom_validation'             => 'menu_unavailable_players_custom_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'unavailable_player_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the unavailable player.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'player_id',
			'label'           => __( 'Player', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The unavailable player.', 'soccer-engine-lite' ),
			'filter'          => 'get_player_name',
		),
		array(
			'database_column' => 'unavailable_player_type_id',
			'label'           => __( 'Unavailable Player Type', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The unavailable player type.', 'soccer-engine-lite' ),
			'filter'          => 'get_unavailable_player_type_name',
		),
		array(
			'database_column' => 'start_date',
			'label'           => __( 'Start Date', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The start date.', 'soccer-engine-lite' ),
			'filter'          => 'format_date_timestamp',
		),
		array(
			'database_column' => 'end_date',
			'label'           => __( 'End Date', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The end date.', 'soccer-engine-lite' ),
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
			'tooltip'                 => __( 'The unavailable player.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_players(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'player_exists',
					'message'  => esc_attr__( 'Please enter a valid player in the "Player" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'unavailable_player_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Unavailable Player Type', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The unavailable player type.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_unavailable_player_types(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'unavailable_player_type_exists',
					'message'  => esc_attr__( 'Please enter a valid unavailable player type in the "Unavailable Player Type" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'start_date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Start Date', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The start date.', 'soccer-engine-lite' ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_date',
					'message'  => esc_attr__( 'Please enter a valid date in the "Start Date" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => false,
		),
		array(
			'column'                  => 'end_date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'End Date', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The end date.', 'soccer-engine-lite' ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_date',
					'message'  => esc_attr__( 'Please enter a valid date in the "End Date" field.', 'soccer-engine-lite' ),
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
			'status' => $menu_utility->num_of_unavailable_player_types() === 0,
			'code'   => 'num_of_unavailable_player_types',
		),
	),

);
$menu->generate_menu();
