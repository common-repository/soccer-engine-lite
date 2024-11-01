<?php
/**
 * Settings to display the "Sounds" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'squad',
	'database_column_primary_key'   => 'squad_id',

	// Menu.
	'url_slug'                      => 'squads',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Squad', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Squads', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create Squad', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Squad', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Squad', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Squad', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The squad has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The squad has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The squad has been successfully updated.', 'soccer-engine-lite' ),
	'custom_validation'             => 'menu_squads_custom_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'squad_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the squad.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The name of the squad.', 'soccer-engine-lite' ),
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
			'tooltip'                 => __( 'The name of the squad.', 'soccer-engine-lite' ),
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
			'tooltip'                 => __( 'The description of the squad.', 'soccer-engine-lite' ),
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
	),

);

$menu->settings['fields'][] = array(
	'target' => 'lineup',
	'label'  => __( 'Lineup', 'soccer-engine-lite' ),
	'type'   => 'group-trigger',
);

for ( $i = 1;$i <= 11;$i++ ) {
	$menu->settings['fields'][] = array(
		'class'                   => 'lineup',
		'column'                  => 'lineup_player_id_' . $i,
		'query_placeholder_token' => 'd',
		'label'                   => __( 'Player', 'soccer-engine-lite' ) . ' ' . $i,
		'tooltip'                 => __( 'The player', 'soccer-engine-lite' ) . ' ' . $i . ' ' . __( 'of the squad.', 'soccer-engine-lite' ),
		'type'                    => 'select',
		'select_items'            => $menu_utility->select_players( true ),
		'validation_regex'        => null,
		'maxlength'               => '1',
		'validation_function'     => array(
			array(
				'function' => $this->shared->player_exists_none_allowed,
				'message'  => esc_attr__( 'Please enter a valid value in the "Player ', 'soccer-engine-lite' ) . $i .
				esc_attr__( ' field.', 'soccer-engine-lite' ),
			),
		),
		'required'                => false,
		'searchable'              => false,
	);
}

$menu->settings['fields'][] = array(
	'target' => 'substitutes',
	'label'  => __( 'Substitutes', 'soccer-engine-lite' ),
	'type'   => 'group-trigger',
);

for ( $i = 1;$i <= 20;$i++ ) {
	$menu->settings['fields'][] = array(
		'class'                   => 'substitutes',
		'column'                  => 'substitute_player_id_' . $i,
		'query_placeholder_token' => 'd',
		'label'                   => __( 'Substitute', 'soccer-engine-lite' ) . ' ' . $i,
		'tooltip'                 => __( 'The substitute', 'soccer-engine-lite' ) . ' ' . $i . ' ' . __( 'of the squad.', 'soccer-engine-lite' ),
		'type'                    => 'select',
		'select_items'            => $menu_utility->select_players( true ),
		'validation_regex'        => null,
		'maxlength'               => '1',
		'validation_function'     => array(
			array(
				'function' => $this->shared->player_exists_none_allowed,
				'message'  => esc_attr__( 'Please enter a valid value in the "Substitutes', 'soccer-engine-lite' ) . ' ' . $i .
							esc_attr__( ' field.', 'soccer-engine-lite' ),
			),
		),
		'required'                => false,
		'searchable'              => false,
	);
}

$menu->settings['fields'][] = array(
	'target' => 'staff',
	'label'  => __( 'Staff', 'soccer-engine-lite' ),
	'type'   => 'group-trigger',
);

for ( $i = 1;$i <= 20;$i++ ) {
	$menu->settings['fields'][] = array(
		'class'                   => 'staff',
		'column'                  => 'staff_id_' . $i,
		'query_placeholder_token' => 'd',
		'label'                   => __( 'Staff', 'soccer-engine-lite' ) . ' ' . $i,
		'tooltip'                 => __( 'The staff member', 'soccer-engine-lite' ) . ' ' . $i . '.',
		'type'                    => 'select',
		'select_items'            => $menu_utility->select_staff( true ),
		'validation_regex'        => null,
		'maxlength'               => '1',
		'validation_function'     => array(
			array(
				'function' => $this->shared->staff_exists_none_allowed,
				'message'  => esc_attr__( 'Please enter a valid value in the "Staff', 'soccer-engine-lite' ) . ' ' . $i .
							esc_attr__( ' field.', 'soccer-engine-lite' ),
			),
		),
		'required'                => false,
		'searchable'              => false,
	);
}

$menu->settings['fields'][] = array(
	'target' => 'advanced',
	'label'  => __( 'Advanced', 'soccer-engine-lite' ),
	'type'   => 'group-trigger',
);

$menu->settings['fields'][] = array(
	'class'                   => 'advanced',
	'column'                  => 'formation_id',
	'query_placeholder_token' => 'd',
	'label'                   => __( 'Formation', 'soccer-engine-lite' ),
	'tooltip'                 => __( 'The formation', 'soccer-engine-lite' ),
	'type'                    => 'select',
	'select_items'            => $menu_utility->select_formations( true ),
	'validation_regex'        => null,
	'maxlength'               => '1',
	'validation_function'     => array(
		array(
			'function' => 'formation_exists_none_allowed',
			'message'  => __( 'Please enter a valid value in the "Formation" field.', 'soccer-engine-lite' ),
		),
	),
	'required'                => false,
	'searchable'              => false,
);

$menu->settings['fields'][] = array(
	'class'                   => 'advanced',
	'column'                  => 'jersey_set_id',
	'query_placeholder_token' => 'd',
	'label'                   => __( 'Jersey Set', 'soccer-engine-lite' ),
	'tooltip'                 => __( 'The jersey set.', 'soccer-engine-lite' ),
	'type'                    => 'select',
	'select_items'            => $menu_utility->select_jersey_sets( true ),
	'validation_regex'        => null,
	'maxlength'               => '1',
	'validation_function'     => array(
		array(
			'function' => 'jersey_set_exists_none_allowed',
			'message'  => esc_attr__( 'Please enter a valid value in the "Jersey Set" field.', 'soccer-engine-lite' ),
		),
	),
	'required'                => false,
	'searchable'              => false,
);

$menu->generate_menu();
