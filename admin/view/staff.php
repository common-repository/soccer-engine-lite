<?php
/**
 * Settings to display the "Staff" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'staff',
	'database_column_primary_key'   => 'staff_id',

	// Menu.
	'url_slug'                      => 'staff',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Staff', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Staff', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Staff', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Staff', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Staff', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Staff', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The staff has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The staff has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The staff has been successfully updated.', 'soccer-engine-lite' ),
	'custom_validation'             => 'menu_staff_custom_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'staff_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the staff member.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'first_name',
			'label'           => __( 'First Name', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The first name of the staff member.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'last_name',
			'label'           => __( 'Last Name', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The last name of the staff member.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'staff_type_id',
			'label'           => __( 'Staff Type', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The staff member type.', 'soccer-engine-lite' ),
			'filter'          => 'get_staff_type_name',
		),
	),

	// Pagination Items.
	'pagination_items'              => 10,

	// Form Fields.
	'fields'                        => array(
		array(
			'column'                  => 'first_name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'First Name', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The first name of the staff member.', 'soccer-engine-lite' ),
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
			'column'                  => 'last_name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Last Name', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The last name of the staff member.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_text_1_255',
					'message'  => esc_attr__( 'Please enter a valid value in the "Last Name" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'image',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Image', 'soccer-engine-lite' ),
			'instructions'            => __( 'Select an image that represents this staff member.', 'soccer-engine-lite' ),
			'set_image'               => __( 'Set Image', 'soccer-engine-lite' ),
			'remove_image'            => __( 'Remove Image', 'soccer-engine-lite' ),
			'type'                    => 'image',
			'maxlength'               => '2083',
			'validation_function'     => array(
				array(
					'function' => 'validate_url_empty_allowed',
					'message'  => __( 'Please enter a valid value in the "Image" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'gender',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Gender', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The gender of the staff member.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 0,
					'text'     => __( 'Male', 'soccer-engine-lite' ),
					'selected' => true,
				),
				array(
					'value'    => 1,
					'text'     => __( 'Female', 'soccer-engine-lite' ),
					'selected' => false,
				),
			),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_bool',
					'message'  => esc_attr__( 'Please enter a valid value in the "Gender" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'date_of_birth',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Date of Birth', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The date of birth of the staff member.', 'soccer-engine-lite' ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_date_empty_allowed',
					'message'  => esc_attr__( 'Please enter a valid value in the "Date of Birth" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'date_of_death',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Date of Death', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The date of death of the staff member.', 'soccer-engine-lite' ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_date_empty_allowed',
					'message'  => esc_attr__( 'Please enter a valid value in the "Date of Death" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'citizenship',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Citizenship', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The citizenship of the staff member.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_countries( false ),
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_country',
					'message'  => esc_attr__( 'Please enter a valid value in the "Citizenship" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'second_citizenship',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Second Citizenship', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The second citizenship of the staff member.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_countries( true ),
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_country_none_allowed',
					'message'  => esc_attr__( 'Please enter a valid value in the "Second Citizenship" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'retired',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Retired', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The retired status of the staff member.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 0,
					'text'     => 'No',
					'selected' => true,
				),
				array(
					'value'    => 1,
					'text'     => 'Yes',
					'selected' => false,
				),
			),
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_bool',
					'message'  => esc_attr__( 'Please enter a valid value in the "Retired" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'staff_type_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Staff Type', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The staff member type.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_staff_types(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'staff_type_exists',
					'message'  => esc_attr__( 'Please enter a valid value in the "Staff Type" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
	),

	// Blocking Conditions.
	'blocking_conditions'           => array(
		array(
			'status' => $menu_utility->num_of_staff_types() === 0,
			'code'   => 'num_of_staff_types',
		),
	),

);
$menu->generate_menu();
