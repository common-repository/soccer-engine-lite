<?php
/**
 * Settings to display the "Referee Badges" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'referee_badge',
	'database_column_primary_key'   => 'referee_badge_id',

	// Menu.
	'url_slug'                      => 'referee-badges',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Referee Badge', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Referee Badges', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Referee Badge', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Referee Badge', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Referee Badge', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Referee Badge', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The referee badge has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The referee badge has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The referee badge has been successfully updated.', 'soccer-engine-lite' ),
	'custom_validation'             => 'menu_referee_badges_custom_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'referee_badge_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the referee badge.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'referee_id',
			'label'           => __( 'Referee', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The referee.', 'soccer-engine-lite' ),
			'filter'          => 'get_referee_name',
		),
		array(
			'database_column' => 'referee_badge_type_id',
			'label'           => __( 'Referee Badge Type', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The name of the referee badge type.', 'soccer-engine-lite' ),
			'filter'          => 'get_referee_badge_type_name',
		),
		array(
			'database_column' => 'start_date',
			'label'           => __( 'Start Date', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The start date of the referee badge.', 'soccer-engine-lite' ),
			'filter'          => 'format_date_timestamp',
		),
		array(
			'database_column' => 'end_date',
			'label'           => __( 'End Date', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The end date of the referee badge.', 'soccer-engine-lite' ),
			'filter'          => 'format_date_timestamp',
		),
	),

	// Pagination Items.
	'pagination_items'              => 10,

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'referee_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Referee', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The referee.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_referees(),
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'referee_exists',
					'message'  => __( 'Please enter a valid value in the "Referee" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'referee_badge_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Referee Badge Type', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The referee badge type.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_referee_badge_types(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'referee_badge_type_exists',
					'message'  => __( 'Please enter a valid value in the "Referee Badge Type" field.', 'soccer-engine-lite' ),
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
					'message'  => __( 'Please enter a valid value in the "Start Date" field.', 'soccer-engine-lite' ),
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
					'message'  => __( 'Please enter a valid value in the "End Date" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => false,
		),
	),

	// Blocking Conditions.
	'blocking_conditions'           => array(
		array(
			'status' => $menu_utility->num_of_referees() === 0,
			'code'   => 'num_of_referees',
		),
		array(
			'status' => $menu_utility->num_of_referee_badge_types() === 0,
			'code'   => 'num_of_referee_badge_types',
		),
	),

);
$menu->generate_menu();
