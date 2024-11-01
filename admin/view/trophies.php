<?php
/**
 * Settings to display the "Trophies" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'trophy',
	'database_column_primary_key'   => 'trophy_id',

	// Menu.
	'url_slug'                      => 'trophies',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Trophy', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Trophies', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Trophy', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Trophy', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Trophy', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Trophy', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The trophy has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The trophy has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The trophy has been successfully updated.', 'soccer-engine-lite' ),

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'trophy_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the trophy.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'trophy_type_id',
			'label'           => __( 'Trophy Type', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The trophy type.', 'soccer-engine-lite' ),
			'filter'          => 'get_trophy_type_name',
		),
		array(
			'database_column' => 'team_id',
			'label'           => __( 'Team', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The team.', 'soccer-engine-lite' ),
			'filter'          => 'get_team_name',
		),
		array(
			'database_column' => 'assignment_date',
			'label'           => __( 'Assignment Date', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The assignment date.', 'soccer-engine-lite' ),
			'filter'          => 'format_date_timestamp',
		),
	),

	// Pagination Items.
	'pagination_items'              => 10,

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'trophy_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Trophy Type', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The trophy type.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_trophy_types(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'trophy_type_exists',
					'message'  => esc_attr__( 'Please enter a valid value in the "Trophy Type" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'team_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Team', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The team associated with the trophy.', 'soccer-engine-lite' ),
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
			'column'                  => 'assignment_date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Assignment Date', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The assignment date.', 'soccer-engine-lite' ),
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
			'status' => $menu_utility->num_of_trophy_types() === 0,
			'code'   => 'num_of_trophy_types',
		),
		array(
			'status' => $menu_utility->num_of_teams() === 0,
			'code'   => 'num_of_teams',
		),
	),

);
$menu->generate_menu();
