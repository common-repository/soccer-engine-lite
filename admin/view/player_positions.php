<?php
/**
 * Settings to display the "Player Positions" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'player_position',
	'database_column_primary_key'   => 'player_position_id',

	// Menu.
	'url_slug'                      => 'player-positions',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Player Position', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Player Positions', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Player Position', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Player Position', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Player Position', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Player Position', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The player position has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The player position has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The player position has been successfully updated.', 'soccer-engine-lite' ),

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'player_position_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the player position.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The name of the player position.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'description',
			'label'           => __( 'Description', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The description of the player position.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'abbreviation',
			'label'           => __( 'Abbreviation', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The abbreviation of the player position.', 'soccer-engine-lite' ),
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
			'tooltip'                 => __( 'The name of the player position.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_text_1_255',
					'message'  => esc_attr__( 'Please enter a valid value in the "Name" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'description',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Description', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The description of the player position.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_text_1_255',
					'message'  => esc_attr__( 'Please enter a valid value in the "Description" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'abbreviation',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Abbreviation', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The abbreviation of the player position.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '3',
			'validation_function'     => array(
				array(
					'function' => 'validate_player_position_abbreviation',
					'message'  => esc_attr__( 'Please enter a valid value in the "Abbreviation" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => true,
		),
	),
);
$menu->generate_menu();
