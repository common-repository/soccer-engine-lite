<?php
/**
 * Settings to display the "Agencies" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'agency',
	'database_column_primary_key'   => 'agency_id',

	// Menu.
	'url_slug'                      => 'agencies',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Agency', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Agencies', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Agency', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Agency', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Agency', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Agency', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The agency has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The agency has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The agency has been successfully updated.', 'soccer-engine-lite' ),

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'agency_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the Agency.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The name of the agency.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'description',
			'label'           => __( 'Description', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The description of the agency.', 'soccer-engine-lite' ),
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
			'tooltip'                 => __( 'The name of the agency.', 'soccer-engine-lite' ),
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
			'tooltip'                 => __( 'The description of the agency.', 'soccer-engine-lite' ),
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
			'column'                  => 'full_name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Full Name', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The full name of the agency.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_text_0_255',
					'message'  => esc_attr__( 'Please enter a valid value in the "Full Name" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'address',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Address', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The address of the agency.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_text_0_255',
					'message'  => esc_attr__( 'Please enter a valid value in the "Address" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'tel',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Telephone Number', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The telephone number of the agency.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_text_0_255',
					'message'  => esc_attr__( 'Please enter a valid value in the "Telephone" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'fax',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Fax Number', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The fax number of the agency.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_text_0_255',
					'message'  => esc_attr__( 'Please enter a valid value in the "Fax" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'website',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Website', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The website of the agency.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '2083',
			'validation_function'     => array(
				array(
					'function' => 'validate_url',
					'message'  => esc_attr__( 'Please enter a valid value in the "Website" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => true,
		),
	),
);
$menu->generate_menu();
