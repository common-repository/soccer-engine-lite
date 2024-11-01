<?php
/**
 * Settings to display the "Export" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'formation',
	'database_column_primary_key'   => 'formation_id',

	// Menu.
	'url_slug'                      => 'formations',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Formation', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Formations', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Formation', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Formation', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Formation', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Formation', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The formation has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The formation has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The formation has been successfully updated.', 'soccer-engine-lite' ),

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'formation_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the formation.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The name of the formation.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'description',
			'label'           => __( 'Description', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The description of the formation.', 'soccer-engine-lite' ),
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
			'tooltip'                 => __( 'The name of the formation.', 'soccer-engine-lite' ),
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
			'tooltip'                 => __( 'The description of the formation.', 'soccer-engine-lite' ),
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
	),
);

for ( $i = 1;$i <= 11;$i++ ) {
	$menu->settings['fields'][] = array(
		'column'                  => 'x_position_' . $i,
		'query_placeholder_token' => 's',
		'label'                   => __( 'X Position', 'soccer-engine-lite' ) . ' ' . $i,
		'tooltip'                 => __( 'The X position of player', 'soccer-engine-lite' ) . ' ' . $i . '.',
		'type'                    => 'text',
		'maxlength'               => '3',
		'validation_function'     => array(
			array(
				'function' => 'validate_formation_position',
				'message'  => esc_attr__( 'Please enter a valid value in the "X Position', 'soccer-engine-lite' ) . ' ' . $i . ' ' .
							esc_attr__( 'field.', 'soccer-engine-lite' ),
			),
		),
		'value'                   => '1',
		'required'                => true,
		'searchable'              => true,
	);

	$menu->settings['fields'][] = array(
		'column'                  => 'y_position_' . $i,
		'query_placeholder_token' => 's',
		'label'                   => __( 'Y Position ', 'soccer-engine-lite' ) . ' ' . $i,
		'tooltip'                 => __( 'The Y position of player', 'soccer-engine-lite' ) . ' ' . $i . '.',
		'type'                    => 'text',
		'maxlength'               => '3',
		'validation_function'     => array(
			array(
				'function' => 'validate_formation_position',
				'message'  => esc_attr__( 'Please enter a valid value in the "Y Position', 'soccer-engine-lite' ) . ' ' . $i .
							esc_attr__( ' field.', 'soccer-engine-lite' ),
			),
		),
		'value'                   => '1',
		'required'                => true,
		'searchable'              => true,
	);

}

$menu->generate_menu();
