<?php
/**
 * Settings to display the "Staff Awards" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'staff_award',
	'database_column_primary_key'   => 'staff_award_id',

	// Menu.
	'url_slug'                      => 'staff-awards',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Staff Award', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Staff Awards', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Staff Award', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Staff Award', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Staff Award', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Staff Award', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The staff award has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The staff award has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The staff award has been successfully updated.', 'soccer-engine-lite' ),

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'staff_award_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the staff award.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'staff_id',
			'label'           => __( 'Staff', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The staff name.', 'soccer-engine-lite' ),
			'filter'          => 'get_staff_name',
		),
		array(
			'database_column' => 'staff_award_type_id',
			'label'           => __( 'Staff Award Type', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The staff award type.', 'soccer-engine-lite' ),
			'filter'          => 'get_staff_award_type_name',
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
			'column'                  => 'staff_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Staff', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The staff member.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_staff(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'staff_exists',
					'message'  => esc_attr__( 'Please enter a valid value in the "Staff Exists" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'staff_award_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Staff Award Type', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The staff award type.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_staff_award_types(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'staff_award_type_exists',
					'message'  => esc_attr__( 'Please enter a valid value in the "Staff Award Type" field.', 'soccer-engine-lite' ),
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
			'status' => $menu_utility->num_of_staff_award_types() === 0,
			'code'   => 'num_of_staff_award_types',
		),
		array(
			'status' => $menu_utility->num_of_staffs() === 0,
			'code'   => 'num_of_staffs',
		),
	),

);
$menu->generate_menu();
