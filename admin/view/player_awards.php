<?php
/**
 * Settings to display the "Player Awards" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'player_award',
	'database_column_primary_key'   => 'player_award_id',

	// Menu.
	'url_slug'                      => 'player-awards',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Player Award', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Player Awards', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Player Award', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Player Award', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Player Award', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Player Award', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The player award has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The player award has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The player award has been successfully updated.', 'soccer-engine-lite' ),

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'player_award_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the player award.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'player_id',
			'label'           => __( 'Player', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The player.', 'soccer-engine-lite' ),
			'filter'          => 'get_player_name',
		),
		array(
			'database_column' => 'player_award_type_id',
			'label'           => __( 'Player Award Type', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The player award type.', 'soccer-engine-lite' ),
			'filter'          => 'get_player_award_type_name',
		),
		array(
			'database_column' => 'assignment_date',
			'label'           => __( 'Assignment Date', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The assignment date of the player award.', 'soccer-engine-lite' ),
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
			'searchable'              => false,
		),
		array(
			'column'                  => 'player_award_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Player Award Type', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The player award type.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_player_award_types(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'player_award_type_exists',
					'message'  => esc_attr__( 'Please enter a valid value in the "Player Award Type" field.', 'soccer-engine-lite' ),
				),
			),
			'searchable'              => false,
		),
		array(
			'column'                  => 'assignment_date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Assignment Date', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The assignment date of the player award.', 'soccer-engine-lite' ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_date',
					'message'  => esc_attr__( 'Please enter a valid value in the "Assignment Date" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => false,
		),
	),

	// Blocking Conditions.
	'blocking_conditions'           => array(
		array(
			'status' => $menu_utility->num_of_player_award_types() === 0,
			'code'   => 'num_of_player_award_types',
		),
		array(
			'status' => $menu_utility->num_of_players() === 0,
			'code'   => 'num_of_players',
		),
	),

);
$menu->generate_menu();
