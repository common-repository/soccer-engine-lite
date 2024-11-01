<?php
/**
 * Settings to display the "Teams" menu.
 *
 * @package soccer-engine-lite
 */

require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu.php';
$menu = new Daextsoenl_Menu( $this->shared );
require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-utility.php';
$menu_utility   = new Daextsoenl_Menu_Utility( $this->shared );
$menu->settings = array(

	// Database.
	'database_table_name'           => 'team',
	'database_column_primary_key'   => 'team_id',

	// Menu.
	'url_slug'                      => 'teams',
	'enable_clone_button'           => false,

	// Labels.
	'plugin_name'                   => __( 'Soccer Engine', 'soccer-engine-lite' ),
	'label_singular'                => __( 'Team', 'soccer-engine-lite' ),
	'label_plural'                  => __( 'Teams', 'soccer-engine-lite' ),
	'label_create_new_item'         => __( 'Create Team', 'soccer-engine-lite' ),
	'label_edit_item'               => __( 'Edit Team', 'soccer-engine-lite' ),
	'label_add_item'                => __( 'Add Team', 'soccer-engine-lite' ),
	'label_update_item'             => __( 'Update Team', 'soccer-engine-lite' ),
	'label_cancel_item'             => __( 'Cancel', 'soccer-engine-lite' ),
	'label_perform_your_search'     => __( 'Perform your Search', 'soccer-engine-lite' ),
	'label_no_results_match_filter' => __( 'There are no results that match your filter.', 'soccer-engine-lite' ),
	'label_item_deleted'            => __( 'The team has been successfully deleted.', 'soccer-engine-lite' ),
	'label_item_added'              => __( 'The team has been successfully added.', 'soccer-engine-lite' ),
	'label_item_updated'            => __( 'The team has been successfully updated.', 'soccer-engine-lite' ),

	// Pagination Columns.
	'pagination_columns'            => array(
		array(
			'database_column' => 'team_id',
			'label'           => __( 'ID', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The ID of the team.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'name',
			'label'           => __( 'Name', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The name of the team.', 'soccer-engine-lite' ),
		),
		array(
			'database_column' => 'type',
			'label'           => __( 'Type', 'soccer-engine-lite' ),
			'tooltip'         => __( 'The type of team.', 'soccer-engine-lite' ),
			'filter'          => 'get_team_type_name',
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
			'tooltip'                 => __( 'The name of the team.', 'soccer-engine-lite' ),
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
			'tooltip'                 => __( 'The description of the team.', 'soccer-engine-lite' ),
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
			'column'                  => 'logo',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Logo', 'soccer-engine-lite' ),
			'instructions'            => __( 'Select a logo that represents this team.', 'soccer-engine-lite' ),
			'set_image'               => __( 'Set Image', 'soccer-engine-lite' ),
			'remove_image'            => __( 'Remove Image', 'soccer-engine-lite' ),
			'type'                    => 'image',
			'maxlength'               => '2083',
			'validation_function'     => array(
				array(
					'function' => 'validate_url_empty_allowed',
					'message'  => esc_attr__( 'Please enter a valid value in the "Logo" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'type',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Type', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The type of team.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => array(
				array(
					'value'    => 0,
					'text'     => 'Club',
					'selected' => true,
				),
				array(
					'value'    => 1,
					'text'     => 'National Team',
					'selected' => false,
				),
			),
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_bool',
					'message'  => esc_attr__( 'Please enter a valid value in the "Type" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'club_nation',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Club Nation', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The club nation.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_countries(),
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_country',
					'message'  => esc_attr__( 'Please enter a valid value in the "Club Nation" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'national_team_confederation',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'National Team Confederation', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The national team confederation.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_national_team_confederations(),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_national_team_confederation',
					'message'  => esc_attr__( 'Please enter a valid value in the "National Team Confederation" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'stadium_id',
			'query_placeholder_token' => 'd',
			'label'                   => __( 'Stadium', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The stadium of the team.', 'soccer-engine-lite' ),
			'type'                    => 'select',
			'select_items'            => $menu_utility->select_stadiums( true ),
			'validation_regex'        => null,
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'stadium_exists_none_allowed',
					'message'  => esc_attr__( 'Please enter a valid value in the "Stadium" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
		array(
			'column'                  => 'full_name',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Full Name', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The full name of the team.', 'soccer-engine-lite' ),
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
			'tooltip'                 => __( 'The address of the team.', 'soccer-engine-lite' ),
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
			'label'                   => __( 'Tel', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The telephone number of the team.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_text_0_255',
					'message'  => esc_attr__( 'Please enter a valid value in the "Tel" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'fax',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Fax', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The fax number of the team.', 'soccer-engine-lite' ),
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
			'column'                  => 'website_url',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Website URL', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The website URL of the team.', 'soccer-engine-lite' ),
			'type'                    => 'text',
			'maxlength'               => '255',
			'validation_function'     => array(
				array(
					'function' => 'validate_text_0_255',
					'message'  => esc_attr__( 'Please enter a valid value in the "Website URL" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => true,
		),
		array(
			'column'                  => 'foundation_date',
			'query_placeholder_token' => 's',
			'label'                   => __( 'Foundation Date', 'soccer-engine-lite' ),
			'tooltip'                 => __( 'The foundation date of the team.', 'soccer-engine-lite' ),
			'type'                    => 'date',
			'maxlength'               => '1',
			'validation_function'     => array(
				array(
					'function' => 'validate_date_empty_allowed',
					'message'  => esc_attr__( 'Please enter a valid value in the "Foundation Date" field.', 'soccer-engine-lite' ),
				),
			),
			'required'                => false,
			'searchable'              => false,
		),
	),

);
$menu->generate_menu();
