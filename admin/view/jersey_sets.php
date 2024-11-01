<?php
/**
 * Settings to display the "Jersey Sets" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'jersey_set',
	'database_column_primary_key'   => 'jersey_set_id',

	// Menu.
	'url_slug'                      => 'jersey-sets',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Jersey Set', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Jersey Sets', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create New Jersey Set', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Jersey Set', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Jersey Set', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Jersey Set', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The jersey set has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The jersey set has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The jersey set has been successfully updated.', 'soccer-engine-lite' ),

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'jersey_set_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the jersey set.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The name of the jersey set.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'description',
			'label'           => __( 'Description', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The description of the jersey set.', 'soccer-engine-lite' ),
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
			'tooltip'                 => __( 'The name of the jersey set.', 'soccer-engine-lite' ),
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
			'tooltip'                 => __( 'The description of the jersey set.', 'soccer-engine-lite' ),
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

$menu->settings['fields'][] = array(
	'target' => 'players',
	'label'  => __( 'Players', 'soccer-engine-lite' ),
	'type'   => 'group-trigger',
);

for ( $i = 1;$i <= 50;$i++ ) {

	$menu->settings['fields'][] = array(
		'class'                   => 'players',
		'column'                  => 'player_id_' . $i,
		'query_placeholder_token' => 'd',
		'label'                   => __( 'Player', 'soccer-engine-lite' ) . ' ' . $i,
		'tooltip'                 => __( 'The player', 'soccer-engine-lite' ) . ' ' . $i . '.',
		'type'                    => 'select',
		'select_items'            => $menu_utility->select_players( true ),
		'validation_regex'        => null,
		'maxlength'               => '1',
		'validation_function'     => array(
			array(
				'function' => $this->shared->player_exists_none_allowed,
				'message'  => esc_attr__( 'Please enter a valid value in the "Player', 'soccer-engine-lite' ) . ' ' . $i .
							esc_attr__( ' field.', 'soccer-engine-lite' ),
			),
		),
		'required'                => false,
		'searchable'              => false,
	);

	$menu->settings['fields'][] = array(
		'class'                   => 'players',
		'column'                  => 'jersey_number_player_id_' . $i,
		'query_placeholder_token' => 'd',
		'label'                   => __( 'Jersey Number Player', 'soccer-engine-lite' ) . ' ' . $i,
		'tooltip'                 => __( 'The jersery number of player', 'soccer-engine-lite' ) . ' ' . $i . '.',
		'type'                    => 'text',
		'maxlength'               => '3',
		'validation_function'     => array(
			array(
				'function' => 'validate_jersey_number',
				'message'  => __( 'Please enter a valid value in the "Jersey" field.', 'soccer-engine-lite' ),
			),
		),
		'required'                => false,
		'searchable'              => false,
	);

}

$menu->generate_menu();
