<?php
/**
 * Settings to display the "Ranking Transition" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'ranking_transition',
	'database_column_primary_key'   => 'ranking_transition_id',

	// Menu.
	'url_slug'                      => 'ranking-transitions',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Ranking Transition', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Ranking Transitions', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Ranking Transition', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Ranking Transition', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Ranking Transition', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Ranking Transition', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The ranking transition has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The ranking transition has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The ranking transition has been successfully updated.', 'soccer-engine-lite' ),

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'ranking_transition_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the ranking transition.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'team_id',
			'label'           => __( 'Team', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The team of the ranking transition.', 'soccer-engine-lite' ),
			'filter'          => 'get_team_name',
		),
		array(
			'database_column' => 'ranking_type_id',
			'label'           => __( 'Ranking Type', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ranking type.', 'soccer-engine-lite' ),
			'filter'          => 'get_ranking_type_name',
		),
		array(
			'database_column' => 'date',
			'label'           => __( 'Date', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The date of the ranking transition.', 'soccer-engine-lite' ),
			'filter'          => 'format_date_timestamp',
		),
		array(
			'database_column' => 'value',
			'label'           => __( 'Value', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ranking value.', 'soccer-engine-lite' ),
		),
	),

	// Pagination Items.
	'pagination_items'              => 10,

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'team_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Team', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The team of the ranking transition.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_teams(),
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'team_exists',
					'message'  => __( 'Please enter a valid value in the "Team" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'ranking_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Ranking Type', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The ranking type.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_ranking_types(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'ranking_type_exists',
					'message'  => __( 'Please enter a valid value in the "Ranking Type" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Date', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The date of the ranking transition.', 'soccer-engine-lite' ),
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
			'column'                  => 'value',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Value', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The ranking value.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_int_unsigned',
					'message'  => __( 'Please enter a valid value in the "Value" field.', 'soccer-engine-lite' ),
				),
			),
			'value'                   => '1',
			'required'                => true,
			'searchable'              => true,
		),
	),

	// Blocking Conditions.
	'blocking_conditions'           => array(
		array(
			'status' => $menu_utility->num_of_ranking_types() === 0,
			'code'   => 'num_of_ranking_types',
		),
		array(
			'status' => $menu_utility->num_of_teams() === 0,
			'code'   => 'num_of_teams',
		),
	),

);
$menu->generate_menu();
