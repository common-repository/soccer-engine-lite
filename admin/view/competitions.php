<?php
/**
 * Settings to display the "Competitions" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'competition',
	'database_column_primary_key'   => 'competition_id',

	// Menu.
	'url_slug'                      => 'competitions',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Competition', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Competitions', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create Competition', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Competition', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Competition', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Competition', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The competition has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The competition has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The competition has been successfully updated.', 'soccer-engine-lite' ),
	'custom_validation'             => 'menu_competitions_custom_validation',

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'competition_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the competition.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The name of the competition.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'type',
			'label'           => __( 'Type', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The type of competition.', 'soccer-engine-lite' ),
			'filter'          => 'get_competition_type_name',
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
			'tooltip'                 => __( 'The name of the competition.', 'soccer-engine-lite' ),
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
			'tooltip'                 => __( 'The description of the competition.', 'soccer-engine-lite' ),
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
			'instructions'            => __( 'Select a logo that represents this competition.', 'soccer-engine-lite' ),
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
			'searchable'              => false,
		),
		array(
			'column'                  => 'rounds',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Rounds', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The number of rounds of the competition.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'value'                   => '8',
			'maxlength'               => '3',
			'validation_function'     => array(
				array(
					'function' => 'validate_rounds',
					'message'  => __( 'Please enter a valid value in the "Rounds" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => true,
			'searchable'              => true,
		),
		array(
			'column'                  => 'type',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Type', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The type of competition.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 0,
					'text'     => esc_attr__( 'Elimination', 'soccer-engine-lite' ),
					'selected' => true,
				),
				array(
					'value'    => 1,
					'text'     => esc_attr__( 'Round Robin', 'soccer-engine-lite' ),
					'selected' => false,
				),
			),
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_bool',
					'message'  => __( 'Please enter a valid value in the "Hidden" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
	),

);

$menu->settings['fields'][] = array(
	'target' => 'teams',
	'label'  => __( 'Teams', 'soccer-engine-lite' ),
	'type'   => 'group-trigger',
);

for ( $i = 1;$i <= 128;$i++ ) {
	$menu->settings['fields'][] = array(
		'class'                   => 'teams',
		'column'                  => 'team_id_' . $i,
		'query_placeholder_token' => 'd',
		'label'                   => __( 'Team', 'soccer-engine-lite' ) . ' ' . $i,
		'tooltip'                 => __( 'The team', 'soccer-engine-lite' ) . ' ' . $i . '.',
		'type'                    => 'select',
		'select_items'            => $menu_utility->select_teams( true ),
		'validation_regex'        => null,
		'maxlength'               => '1',
		'validation_function'     => array(
			array(
				'function' => 'team_exists_none_allowed',
				'message'  => esc_attr__( 'Please enter a valid value in the "Team', 'soccer-engine-lite' ) .
							' ' . $i . '"',
				esc_attr__( 'field.', 'soccer-engine-lite' ),
			),
		),
		'required'                => false,
		'searchable'              => false,
	);
}

$menu->settings['fields'][] = array(
	'target' => 'round-robin',
	'label'  => __( 'Round Robin', 'soccer-engine-lite' ),
	'type'   => 'group-trigger',
);
$menu->settings['fields'][] = array(
	'class'                   => 'round-robin',
	'column'                  => 'rr_victory_points',
	'query_placeholder_token' => 's',
	'label'                   => __( 'Victory Points', 'soccer-engine-lite' ),
	'tooltip'                 => __( 'The number of points assigned to a team when a victory is achieved in a Round Robin competition.', 'soccer-engine-lite' ),
	'type'                    => 'text',
	'value'                   => '3',
	'maxlength'               => '255',
	'validation_function'     => array(
		array(
			'function' => 'validate_tinyint_unsigned',
			'message'  => __( 'Please enter a valid value in the "Victory Points" field.', 'soccer-engine-lite' ),
		),
	),
	'required'                => true,
	'searchable'              => true,
);
$menu->settings['fields'][] = array(
	'class'                   => 'round-robin',
	'column'                  => 'rr_draw_points',
	'query_placeholder_token' => 's',
	'label'                   => __( 'Draw Points', 'soccer-engine-lite' ),
	'tooltip'                 => __( 'The number of points assigned to a team when a draw is achieved in a Round Robin competition.', 'soccer-engine-lite' ),
	'type'                    => 'text',
	'value'                   => '1',
	'maxlength'               => '255',
	'validation_function'     => array(
		array(
			'function' => 'validate_tinyint_unsigned',
			'message'  => __( 'Please enter a valid value in the "Draw Points" field.', 'soccer-engine-lite' ),
		),
	),
	'required'                => true,
	'searchable'              => true,
);
$menu->settings['fields'][] = array(
	'class'                   => 'round-robin',
	'column'                  => 'rr_defeat_points',
	'query_placeholder_token' => 's',
	'label'                   => __( 'Defeat Points', 'soccer-engine-lite' ),
	'tooltip'                 => __( 'The number of points assigned to a team when a defeat is achieved in a Round Robin competition.', 'soccer-engine-lite' ),
	'type'                    => 'text',
	'value'                   => '0',
	'maxlength'               => '255',
	'validation_function'     => array(
		array(
			'function' => 'validate_tinyint_unsigned',
			'message'  => __( 'Please enter a valid value in the "Defeat Points" field.', 'soccer-engine-lite' ),
		),
	),
	'required'                => true,
	'searchable'              => true,
);
$menu->settings['fields'][] = array(
	'class'                   => 'round-robin',
	'column'                  => 'rr_sorting_order_1',
	'query_placeholder_token' => 'd',
	'label'                   => __( 'Order (Priority 1)', 'soccer-engine-lite' ),
	'tooltip'                 => __( 'This option allows you to enable (in descending or ascending order) or disable the order for the specified column.', 'soccer-engine-lite' ),
	'type'                    => 'select',
	'select_items'            => array(
		array(
			'value'    => 0,
			'text'     => __( 'Descending', 'soccer-engine-lite' ),
			'selected' => true,
		),
		array(
			'value'    => 1,
			'text'     => __( 'Ascending', 'soccer-engine-lite' ),
			'selected' => false,
		),
	),
	'maxlength'               => '1',
	'validation_function'     => array(
		array(
			'function' => 'validate_competition_order_type',
			'message'  => __( 'Please enter a valid value in the "Order 1" field.', 'soccer-engine-lite' ),
		),
	),
	'searchable'              => false,
);
$rr_sorting_order_by_1      = array(
	array(
		'value'    => 0,
		'text'     => __( 'Won', 'soccer-engine-lite' ),
		'selected' => false,
	),
	array(
		'value'    => 1,
		'text'     => __( 'Drawn', 'soccer-engine-lite' ),
		'selected' => false,
	),
	array(
		'value'    => 2,
		'text'     => __( 'Lost', 'soccer-engine-lite' ),
		'selected' => false,
	),
	array(
		'value'    => 3,
		'text'     => __( 'Goals', 'soccer-engine-lite' ),
		'selected' => false,
	),
	array(
		'value'    => 4,
		'text'     => __( 'Goal Difference', 'soccer-engine-lite' ),
		'selected' => false,
	),
	array(
		'value'    => 5,
		'text'     => __( 'Points', 'soccer-engine-lite' ),
		'selected' => true,
	),
);
$menu->settings['fields'][] = array(
	'class'                   => 'round-robin',
	'column'                  => 'rr_sorting_order_by_1',
	'query_placeholder_token' => 'd',
	'label'                   => __( 'Order by (Priority 1)', 'soccer-engine-lite' ),
	'tooltip'                 => __( 'This option allows you to determine for which column the order should be applied.', 'soccer-engine-lite' ),
	'type'                    => 'select',
	'select_items'            => $rr_sorting_order_by_1,
	'maxlength'               => '1',
	'validation_function'     => array(
		array(
			'function' => 'validate_competition_order_by',
			'message'  => __( 'Please enter a valid value in the "Order by 1" field.', 'soccer-engine-lite' ),
		),
	),
	'searchable'              => false,
);
$menu->settings['fields'][] = array(
	'class'                   => 'round-robin',
	'column'                  => 'rr_sorting_order_2',
	'query_placeholder_token' => 'd',
	'label'                   => __( 'Order (Priority 2)', 'soccer-engine-lite' ),
	'tooltip'                 => __( 'This option allows you to enable (in descending or ascending order) or disable the order for the specified column.', 'soccer-engine-lite' ),
	'type'                    => 'select',
	'select_items'            => array(
		array(
			'value'    => 0,
			'text'     => __( 'Descending', 'soccer-engine-lite' ),
			'selected' => false,
		),
		array(
			'value'    => 1,
			'text'     => __( 'Ascending', 'soccer-engine-lite' ),
			'selected' => false,
		),
	),
	'maxlength'               => '1',
	'validation_function'     => array(
		array(
			'function' => 'validate_competition_order_type',
			'message'  => __( 'Please enter a valid value in the "Order 2" field.', 'soccer-engine-lite' ),
		),
	),
	'searchable'              => false,
);
$rr_sorting_order_by_2      = array(
	array(
		'value'    => 0,
		'text'     => __( 'Won', 'soccer-engine-lite' ),
		'selected' => false,
	),
	array(
		'value'    => 1,
		'text'     => __( 'Drawn', 'soccer-engine-lite' ),
		'selected' => false,
	),
	array(
		'value'    => 2,
		'text'     => __( 'Lost', 'soccer-engine-lite' ),
		'selected' => false,
	),
	array(
		'value'    => 3,
		'text'     => __( 'Goals', 'soccer-engine-lite' ),
		'selected' => false,
	),
	array(
		'value'    => 4,
		'text'     => __( 'Goal Difference', 'soccer-engine-lite' ),
		'selected' => true,
	),
	array(
		'value'    => 5,
		'text'     => __( 'Points', 'soccer-engine-lite' ),
		'selected' => false,
	),
);
$menu->settings['fields'][] = array(
	'class'                   => 'round-robin',
	'column'                  => 'rr_sorting_order_by_2',
	'query_placeholder_token' => 'd',
	'label'                   => __( 'Order by (Priority 2)', 'soccer-engine-lite' ),
	'tooltip'                 => __( 'This option allows you to determine for which column the order should be applied.', 'soccer-engine-lite' ),
	'type'                    => 'select',
	'select_items'            => $rr_sorting_order_by_2,
	'maxlength'               => '1',
	'validation_function'     => array(
		array(
			'function' => 'validate_competition_order_by',
			'message'  => __( 'Please enter a valid value in the "Order by 2" field.', 'soccer-engine-lite' ),
		),
	),
	'searchable'              => false,
);

$menu->generate_menu();
