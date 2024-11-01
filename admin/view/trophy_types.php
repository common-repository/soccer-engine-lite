<?php
/**
 * Settings to display the "Trophy Types" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'trophy_type',
	'database_column_primary_key'   => 'trophy_type_id',

	// Menu.
	'url_slug'                      => 'trophy-types',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Trophy Type', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Trophy Types', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Trophy Type', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Trophy Type', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Trophy Type', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Trophy Type', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The trophy type has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The trophy type has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The trophy type has been successfully updated.', 'soccer-engine-lite' ),

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'trophy_type_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the trophy type.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The name of the trophy type.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'description',
			'label'           => __( 'Description', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The description of the trophy type.', 'soccer-engine-lite' ),
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
			'tooltip'                 => __( 'The name of the trophy type.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_text_1_255',
					'message'  => __( 'Please enter a valid value in the "Name" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'description',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Description', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The description of the trophy type.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_text_1_255',
					'message'  => __( 'Please enter a valid value in the "Description" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'logo',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Logo', 'soccer-engine-lite' ),
			'instructions'            => __( 'Select a logo that represents this trophy.', 'soccer-engine-lite' ),
			'set_image'               => __( 'Set Image', 'soccer-engine-lite' ),
			'remove_image'            => __( 'Remove Image', 'soccer-engine-lite' ),
			'type'                    => 'image',
			'maxlength'               => '2083',
			'validation_function'     => array(
				array(
					'function' => 'validate_url_empty_allowed',
					'message'  => __( 'Please enter a valid value in the "Logo" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => true,
		),
	),
);
$menu->generate_menu();
