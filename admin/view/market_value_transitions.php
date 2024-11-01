<?php
/**
 * Settings to display the "Market Value Transitions" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'market_value_transition',
	'database_column_primary_key'   => 'market_value_transition_id',

	// Menu.
	'url_slug'                      => 'market-value-transitions',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Market Value Transition', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Market Value Transitions', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Market Value Transition', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Market Value Transition', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Market Value Transition', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Market Value Transition', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The market value transition has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The market value transition has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The market value transition has been successfully updated.', 'soccer-engine-lite' ),

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'market_value_transition_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the market value transition.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'player_id',
			'label'           => __( 'Player', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The player.', 'soccer-engine-lite' ),
			'filter'          => 'get_player_name',
		),
		array(
			'database_column' => 'date',
			'label'           => __( 'Date', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The date of the market value transition.', 'soccer-engine-lite' ),
			'filter'          => 'format_date_timestamp',
		),
		array(
			'database_column' => 'value',
			'label'           => __( 'Value', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The value of the player.', 'soccer-engine-lite' ),
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
			'column'                  => 'date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Date', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The date of the market value transition.', 'soccer-engine-lite' ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_date',
					'message'  => __( 'Please enter a valid value in the "Date" field.' ),
				),
			),
			'required'                => true,
			'searchable'              => false,
		),
		array(
			'column'                  => 'value',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Value', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The value of the player.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_decimal_15_2',
					'message'  => esc_attr__( 'Please enter a valid value in the "Value" field.', 'soccer-engine-lite' ),
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
	),

);
$menu->generate_menu();
