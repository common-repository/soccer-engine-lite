<?php
/**
 * This class used to add the options with the related callbacks and validations.
 *
 * @package soccer-engine-lite
 */

/**
 * This class adds the options with the related callbacks and validations.
 */
class Daextsoenl_Menu_Options {

	private $shared = null;

	public function __construct( $shared ) {

		// Assign an instance of Daextsoenl_Shared.
		$this->shared = $shared;

		// Style Section ----------------------------------------------------------------------------------------------.
		add_settings_section(
			'daextsoenl_colors_settings_section',
			null,
			null,
			'daextsoenl_colors_options'
		);

		add_settings_field(
			'table_header_background_color',
			esc_attr__( 'Table Header Background', 'soccer-engine-lite' ),
			array( $this, 'table_header_background_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_table_header_background_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'table_header_border_color',
			esc_attr__( 'Table Header Border', 'soccer-engine-lite' ),
			array( $this, 'table_header_border_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_table_header_border_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'table_header_font_color',
			esc_attr__( 'Table Header Font', 'soccer-engine-lite' ),
			array( $this, 'table_header_font_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_table_header_font_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'table_body_background_color',
			esc_attr__( 'Table Body Background', 'soccer-engine-lite' ),
			array( $this, 'table_body_background_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_table_body_background_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'table_body_border_color',
			esc_attr__( 'Table Body Border', 'soccer-engine-lite' ),
			array( $this, 'table_body_border_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_table_body_border_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'table_body_font_color',
			esc_attr__( 'Table Body Font', 'soccer-engine-lite' ),
			array( $this, 'table_body_font_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_table_body_font_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'table_pagination_background_color',
			esc_attr__( 'Table Pagination Background', 'soccer-engine-lite' ),
			array( $this, 'table_pagination_background_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_table_pagination_background_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'table_pagination_border_color',
			esc_attr__( 'Table Pagination Border', 'soccer-engine-lite' ),
			array( $this, 'table_pagination_border_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_table_pagination_border_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'table_pagination_font_color',
			esc_attr__( 'Table Pagination Font', 'soccer-engine-lite' ),
			array( $this, 'table_pagination_font_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_table_pagination_font_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'table_pagination_disabled_background_color',
			esc_attr__( 'Table Pagination Disabled Background', 'soccer-engine-lite' ),
			array( $this, 'table_pagination_disabled_background_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_table_pagination_disabled_background_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'table_pagination_disabled_border_color',
			esc_attr__( 'Table Pagination Disabled Border', 'soccer-engine-lite' ),
			array( $this, 'table_pagination_disabled_border_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_table_pagination_disabled_border_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'table_pagination_disabled_font_color',
			esc_attr__( 'Table Pagination Disabled Font', 'soccer-engine-lite' ),
			array( $this, 'table_pagination_disabled_font_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_table_pagination_disabled_font_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'formation_field_background_color',
			esc_attr__( 'Formation Field Background', 'soccer-engine-lite' ),
			array( $this, 'formation_field_background_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_formation_field_background_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'formation_field_line_color',
			esc_attr__( 'Formation Field Line', 'soccer-engine-lite' ),
			array( $this, 'formation_field_line_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_formation_field_line_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'formation_field_player_number_background_color',
			esc_attr__( 'Formation Player Number Background', 'soccer-engine-lite' ),
			array( $this, 'formation_field_player_number_background_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_formation_field_player_number_background_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'formation_field_player_number_border_color',
			esc_attr__( 'Formation Player Number Border', 'soccer-engine-lite' ),
			array( $this, 'formation_field_player_number_border_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_formation_field_player_number_border_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'formation_field_player_number_font_color',
			esc_attr__( 'Formation Player Number Font', 'soccer-engine-lite' ),
			array( $this, 'formation_field_player_number_font_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_formation_field_player_number_font_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'formation_field_player_name_font_color',
			esc_attr__( 'Formation Player Name Font', 'soccer-engine-lite' ),
			array( $this, 'formation_field_player_name_font_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_formation_field_player_name_font_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'clock_background_color',
			esc_attr__( 'Clock Background', 'soccer-engine-lite' ),
			array( $this, 'clock_background_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_clock_background_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'clock_primary_ticks_color',
			esc_attr__( 'Clock Primary Ticks', 'soccer-engine-lite' ),
			array( $this, 'clock_primary_ticks_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_clock_primary_ticks_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'clock_secondary_ticks_color',
			esc_attr__( 'Clock Secondary Ticks', 'soccer-engine-lite' ),
			array( $this, 'clock_secondary_ticks_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_clock_secondary_ticks_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'clock_border_color',
			esc_attr__( 'Clock Border', 'soccer-engine-lite' ),
			array( $this, 'clock_border_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_clock_border_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'clock_overlay_color',
			esc_attr__( 'Clock Overlay', 'soccer-engine-lite' ),
			array( $this, 'clock_overlay_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_clock_overlay_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'clock_extra_time_overlay_color',
			esc_attr__( 'Clock Extra Time Overlay', 'soccer-engine-lite' ),
			array( $this, 'clock_extra_time_overlay_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_clock_extra_time_overlay_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'event_icon_goal_color',
			esc_attr__( 'Event Icon Goal', 'soccer-engine-lite' ),
			array( $this, 'event_icon_goal_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_event_icon_goal_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'event_icon_yellow_card_color',
			esc_attr__( 'Event Icon Yellow Card', 'soccer-engine-lite' ),
			array( $this, 'event_icon_yellow_card_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_event_icon_yellow_card_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'event_icon_red_card_color',
			esc_attr__( 'Event Icon Red Card', 'soccer-engine-lite' ),
			array( $this, 'event_icon_red_card_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_event_icon_red_card_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'event_icon_substitution_left_arrow_color',
			esc_attr__( 'Event Icon Substitution Left Arrow', 'soccer-engine-lite' ),
			array( $this, 'event_icon_substitution_left_arrow_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_event_icon_substitution_left_arrow_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'event_icon_substitution_right_arrow_color',
			esc_attr__( 'Event Icon Substitution Right Arrow', 'soccer-engine-lite' ),
			array( $this, 'event_icon_substitution_right_arrow_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_event_icon_substitution_right_arrow_color',
			array( $this, 'color_validationn' )
		);

		add_settings_field(
			'default_avatar_color',
			esc_attr__( 'Default Avatar', 'soccer-engine-lite' ),
			array( $this, 'default_avatar_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_default_avatar_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'default_avatar_background_color',
			esc_attr__( 'Default Avatar Background', 'soccer-engine-lite' ),
			array( $this, 'default_avatar_background_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_default_avatar_background_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'default_team_logo_color',
			esc_attr__( 'Default Team Logo', 'soccer-engine-lite' ),
			array( $this, 'default_team_logo_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_default_team_logo_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'default_team_logo_background_color',
			esc_attr__( 'Default Team Logo Background', 'soccer-engine-lite' ),
			array( $this, 'default_team_logo_background_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_default_team_logo_background_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'default_competition_logo_color',
			esc_attr__( 'Default Competition Logo', 'soccer-engine-lite' ),
			array( $this, 'default_competition_logo_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_default_competition_logo_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'default_competition_logo_background_color',
			esc_attr__( 'Default Competition Logo Background', 'soccer-engine-lite' ),
			array( $this, 'default_competition_logo_background_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_default_competition_logo_background_color',
			array( $this, 'color_validationn' )
		);

		add_settings_field(
			'default_trophy_type_logo_color',
			esc_attr__( 'Default Trophy Type Logo', 'soccer-engine-lite' ),
			array( $this, 'default_trophy_type_logo_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_default_trophy_type_logo_color',
			array( $this, 'color_validation' )
		);

		add_settings_field(
			'default_trophy_type_logo_background_color',
			esc_attr__( 'Default Trophy Type Logo Background', 'soccer-engine-lite' ),
			array( $this, 'default_trophy_type_logo_background_color_callback' ),
			'daextsoenl_colors_options',
			'daextsoenl_colors_settings_section'
		);

		register_setting(
			'daextsoenl_colors_options',
			'daextsoenl_default_trophy_type_logo_background_color',
			array( $this, 'color_validation' )
		);

		// Advanced Section ---------------------------------------------------------------------------------------------
		add_settings_section(
			'daextsoenl_advanced_settings_section',
			null,
			null,
			'daextsoenl_advanced_options'
		);

		add_settings_field(
			'money_format_decimal_separator',
			esc_attr__( 'Money Format Decimal Separator', 'soccer-engine-lite' ),
			array( $this, 'money_format_decimal_separator_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_money_format_decimal_separator',
			array( $this, 'money_format_decimal_separator_validation' )
		);

		add_settings_field(
			'money_format_thousands_separator',
			esc_attr__( 'Money Format Thousands Separator', 'soccer-engine-lite' ),
			array( $this, 'money_format_thousands_separator_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_money_format_thousands_separator',
			array( $this, 'money_format_thousands_separator_validation' )
		);

		add_settings_field(
			'money_format_decimals',
			esc_attr__( 'Money Format Decimals', 'soccer-engine-lite' ),
			array( $this, 'money_format_decimals_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_money_format_decimals',
			array( $this, 'money_format_decimals_validation' )
		);

		add_settings_field(
			'money_format_simplify_million',
			esc_attr__( 'Money Format Simplify Million', 'soccer-engine-lite' ),
			array( $this, 'money_format_simplify_million_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_money_format_simplify_million',
			array( $this, 'money_format_simplify_million_validation' )
		);

		add_settings_field(
			'money_format_simplify_million_decimals',
			esc_attr__( 'Money Format Simplify Million Decimals', 'soccer-engine-lite' ),
			array( $this, 'money_format_simplify_million_decimals_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_money_format_simplify_million_decimals',
			array( $this, 'money_format_simplify_million_decimals_validation' )
		);

		add_settings_field(
			'money_format_million_symbol',
			esc_attr__( 'Money Format Million Symbol', 'soccer-engine-lite' ),
			array( $this, 'money_format_million_symbol_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_money_format_million_symbol',
			array( $this, 'money_format_million_symbol_validation' )
		);

		add_settings_field(
			'money_format_simplify_thousands',
			esc_attr__( 'Money Format Simplify Thousands', 'soccer-engine-lite' ),
			array( $this, 'money_format_simplify_thousands_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_money_format_simplify_thousands',
			array( $this, 'money_format_simplify_thousands_validation' )
		);

		add_settings_field(
			'money_format_simplify_thousands_decimals',
			esc_attr__( 'Money Format Simplify Thousands Decimals', 'soccer-engine-lite' ),
			array( $this, 'money_format_simplify_thousands_decimals_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_money_format_simplify_thousands_decimals',
			array( $this, 'money_format_simplify_thousands_decimals_validation' )
		);

		add_settings_field(
			'money_format_thousands_symbol',
			esc_attr__( 'Money Format Thousands Symbol', 'soccer-engine-lite' ),
			array( $this, 'money_format_thousands_symbol_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_money_format_thousands_symbol',
			array( $this, 'money_format_thousands_symbol_validation' )
		);

		add_settings_field(
			'money_format_currency',
			esc_attr__( 'Money Format Currency', 'soccer-engine-lite' ),
			array( $this, 'money_format_currency_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_money_format_currency',
			array( $this, 'money_format_currency_validation' )
		);

		add_settings_field(
			'money_format_currency_position',
			esc_attr__( 'Money Format Currency Position', 'soccer-engine-lite' ),
			array( $this, 'money_format_currency_position_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_money_format_currency_position',
			array( $this, 'money_format_currency_position_validation' )
		);

		add_settings_field(
			'height_measurement_unit',
			esc_attr__( 'Height Measurement Unit', 'soccer-engine-lite' ),
			array( $this, 'height_measurement_unit_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_height_measurement_unit',
			array( $this, 'height_measurement_unit_validation' )
		);

		add_settings_field(
			'set_max_execution_time',
			esc_attr__( 'Set Max Execution Time', 'soccer-engine-lite' ),
			array( $this, 'set_max_execution_time_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_set_max_execution_time',
			array( $this, 'set_max_execution_time_validation' )
		);

		add_settings_field(
			'max_execution_time_value',
			esc_attr__( 'Max Execution Time Value', 'soccer-engine-lite' ),
			array( $this, 'max_execution_time_value_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_max_execution_time_value',
			array( $this, 'max_execution_time_value_validation' )
		);

		add_settings_field(
			'set_memory_limit',
			esc_attr__( 'Set Memory Limit', 'soccer-engine-lite' ),
			array( $this, 'set_memory_limit_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_set_memory_limit',
			array( $this, 'set_memory_limit_validation' )
		);

		add_settings_field(
			'memory_limit_value',
			esc_attr__( 'Memory Limit Value', 'soccer-engine-lite' ),
			array( $this, 'memory_limit_value_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_memory_limit_value',
			array( $this, 'memory_limit_value_validation' )
		);

		add_settings_field(
			'transient_expiration',
			esc_attr__( 'Transient Expiration', 'soccer-engine-lite' ),
			array( $this, 'transient_expiration_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_transient_expiration',
			array( $this, 'transient_expiration_validation' )
		);

		add_settings_field(
			'formation_field_line_stroke_width',
			esc_attr__( 'Formation Field Line Stroke Width', 'soccer-engine-lite' ),
			array( $this, 'formation_field_line_stroke_width_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_formation_field_line_stroke_width',
			array( $this, 'formation_field_line_stroke_width_validation' )
		);

		add_settings_field(
			'block_margin_top',
			esc_attr__( 'Block Margin Top', 'soccer-engine-lite' ),
			array( $this, 'block_margin_top_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_block_margin_top',
			array( $this, 'block_margin_top_validation' )
		);

		add_settings_field(
			'block_margin_bottom',
			esc_attr__( 'Block Margin Bottom', 'soccer-engine-lite' ),
			array( $this, 'block_margin_bottom_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_block_margin_bottom',
			array( $this, 'block_margin_bottom_validation' )
		);

		add_settings_field(
			'responsive_breakpoint_1',
			esc_attr__( 'Responsive Breakpoint 1', 'soccer-engine-lite' ),
			array( $this, 'responsive_breakpoint_1_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_responsive_breakpoint_1',
			array( $this, 'responsive_breakpoint_1_validation' )
		);

		add_settings_field(
			'responsive_breakpoint_2',
			esc_attr__( 'Responsive Breakpoint 2', 'soccer-engine-lite' ),
			array( $this, 'responsive_breakpoint_2_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_responsive_breakpoint_2',
			array( $this, 'responsive_breakpoint_2_validation' )
		);

		add_settings_field(
			'font_family',
			esc_attr__( 'Font Family', 'soccer-engine-lite' ),
			array( $this, 'font_family_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_font_family',
			array( $this, 'font_family_validation' )
		);

		add_settings_field(
			'google_font_url',
			esc_attr__( 'Google Font URL', 'soccer-engine-lite' ),
			array( $this, 'google_font_url_callback' ),
			'daextsoenl_advanced_options',
			'daextsoenl_advanced_settings_section'
		);

		register_setting(
			'daextsoenl_advanced_options',
			'daextsoenl_google_font_url',
			array( $this, 'google_font_url_validation' )
		);
	}

	// Colors -----------------------------------------------------------------------------------------------------------

	public function color_validation( $input ) {

		return sanitize_hex_color( $input );
	}

	public function text_primary_color_callback() {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_text_primary_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_text_primary_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_text_primary_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__(
			'The primary text color of the layout elements generated by the plugin.',
			'soccer-engine-lite'
		) . '"></div>';
	}

	public function table_header_background_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_header_background_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_header_background_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_table_header_background_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the header background color.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function table_header_border_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_header_border_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_header_border_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_table_header_border_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the header border color.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function table_header_font_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_header_font_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_header_font_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_table_header_font_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the header font color.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function table_body_background_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_body_background_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_body_background_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_table_body_background_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the body background color.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function table_body_border_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_body_border_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_body_border_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_table_body_border_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the body border color.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function table_body_font_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_body_font_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_body_font_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_table_body_font_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the body font color.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function table_pagination_background_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_pagination_background_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_pagination_background_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_table_pagination_background_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the pagination background color.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function table_pagination_border_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_pagination_border_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_pagination_border_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_table_pagination_border_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the pagination border color.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function table_pagination_font_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_pagination_font_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_pagination_font_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_table_pagination_font_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the pagination font color.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function table_pagination_disabled_background_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_pagination_disabled_background_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_pagination_disabled_background_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_table_pagination_disabled_background_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the pagination disabled background color.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function table_pagination_disabled_border_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_pagination_disabled_border_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_pagination_disabled_border_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_table_pagination_disabled_border_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the pagination disabled border color.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function table_pagination_disabled_font_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_pagination_disabled_font_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_table_pagination_disabled_font_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_table_pagination_disabled_font_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the pagination disabled font color.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function formation_field_background_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_formation_field_background_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_formation_field_background_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_formation_field_background_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the background of the field.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function formation_field_line_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_formation_field_line_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_formation_field_line_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_formation_field_line_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the lines of the field.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function formation_field_player_number_background_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_formation_field_player_number_background_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_formation_field_player_number_background_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_formation_field_player_number_background_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the background of the player number.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function formation_field_player_number_border_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_formation_field_player_number_border_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_formation_field_player_number_border_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_formation_field_player_number_border_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the border of the player number.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function formation_field_player_number_font_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_formation_field_player_number_font_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_formation_field_player_number_font_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_formation_field_player_number_font_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the font of the player number.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function formation_field_player_name_font_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_formation_field_player_name_font_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_formation_field_player_name_font_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_formation_field_player_name_font_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the font of the player name.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function clock_background_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_clock_background_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_clock_background_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_clock_background_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the background color of the clock.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function clock_primary_ticks_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_clock_primary_ticks_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_clock_primary_ticks_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_clock_primary_ticks_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the primary ticks of the clock.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function clock_secondary_ticks_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_clock_secondary_ticks_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_clock_secondary_ticks_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_clock_secondary_ticks_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the secondary ticks of the clock.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function clock_border_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_clock_border_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_clock_border_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_clock_border_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the border of the clock.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function clock_overlay_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_clock_overlay_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_clock_overlay_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_clock_overlay_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the overlay of the clock.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function clock_extra_time_overlay_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_clock_extra_time_overlay_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_clock_extra_time_overlay_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_clock_extra_time_overlay_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'A color that will be used for the extra time overlay of the clock.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function event_icon_goal_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_event_icon_goal_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_event_icon_goal_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_event_icon_goal_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The color of the goal event icon.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function event_icon_yellow_card_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_event_icon_yellow_card_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_event_icon_yellow_card_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_event_icon_yellow_card_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The color of the yellow card event icon.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function event_icon_red_card_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_event_icon_red_card_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_event_icon_red_card_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_event_icon_red_card_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The color of the red card event icon.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function event_icon_substitution_left_arrow_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_event_icon_substitution_left_arrow_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_event_icon_substitution_left_arrow_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_event_icon_substitution_left_arrow_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The color of the subsitution left arrow event icon.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function event_icon_substitution_right_arrow_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_event_icon_substitution_right_arrow_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_event_icon_substitution_right_arrow_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_event_icon_substitution_right_arrow_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The color of the subsitution right arrow event icon.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function default_avatar_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_default_avatar_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_default_avatar_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_default_avatar_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The color of the default avatar.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function default_avatar_background_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_default_avatar_background_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_default_avatar_background_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_default_avatar_background_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The background color of the default avatar.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function default_team_logo_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_default_team_logo_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_default_team_logo_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_default_team_logo_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The color of the default team logo.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function default_team_logo_background_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_default_team_logo_background_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_default_team_logo_background_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_default_team_logo_background_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The background color of the default team logo.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function default_competition_logo_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_default_competition_logo_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_default_competition_logo_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_default_competition_logo_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The color of the default competition logo.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function default_competition_logo_background_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_default_competition_logo_background_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_default_competition_logo_background_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_default_competition_logo_background_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The background color of the default competition logo.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function default_trophy_type_logo_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_default_trophy_type_logo_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_default_trophy_type_logo_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_default_trophy_type_logo_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The color of the default trophy type logo.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function default_trophy_type_logo_background_color_callback( $args ) {

		echo '<input class="wp-color-picker" type="text" id="' . esc_attr( $this->shared->get( 'slug' ) ) . '_default_trophy_type_logo_background_color" name="' . esc_attr( $this->shared->get( 'slug' ) ) . '_default_trophy_type_logo_background_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_default_trophy_type_logo_background_color' ) ) . '" class="color" maxlength="7" size="6" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The background color of the trophy type logo.', 'soccer-engine-lite' ) . '"></div>';
	}

	// Advanced Section -------------------------------------------------------------------------------------------------
	public function money_format_decimal_separator_callback( $args ) {

		echo '<input autocomplete="off" type="text" id="daextsoenl-money-format-decimal-separator" name="daextsoenl_money_format_decimal_separator" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_money_format_decimal_separator' ) ) . '" />';
		echo '<div maxlength="3" class="help-icon" title="' . esc_attr__( 'The number of decimals displayed in the money format.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function money_format_decimal_separator_validation( $input ) {

		if ( strlen( $input ) > 3 ) {
			add_settings_error(
				'daextsoenl_money_format_decimal_separator',
				'daextsoenl_money_format_decimal_separator',
				esc_html__( 'Please enter a valid decimal separator in the "Money Format Decimal Separator" field.', 'soccer-engine-lite' )
			);
			$output = get_option( 'daextsoenl_money_format_decimal_separator' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function money_format_thousands_separator_callback( $args ) {

		echo '<input autocomplete="off" type="text" id="daextsoenl-money-format-thousands-separator" name="daextsoenl_money_format_thousands_separator" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_money_format_thousands_separator' ) ) . '" />';
		echo '<div maxlength="3" class="help-icon" title="' . esc_attr__( 'The thousands separator displayed in the money format.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function money_format_thousands_separator_validation( $input ) {

		if ( strlen( $input ) > 3 ) {
			add_settings_error(
				'daextsoenl_money_format_thousands_separator',
				'daextsoenl_money_format_thousands_separator',
				esc_html__( 'Please enter a valid decimal separator in the "Money Format Thousands Separator" field.', 'soccer-engine-lite' )
			);
			$output = get_option( 'daextsoenl_money_format_thousands_separator' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function money_format_decimals_callback( $args ) {

		echo '<input maxlength=1 autocomplete="off" type="text" id="daextsoenl-money-format-decimals" name="daextsoenl_money_format_decimals" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_money_format_decimals' ) ) . '" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The number of decimals displayed in the money format.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function money_format_decimals_validation( $input ) {

		if ( intval( $input, 10 ) < 0 or intval( $input, 10 ) > 9 ) {
			add_settings_error(
				'daextsoenl_money_format_decimals',
				'daextsoenl_money_format_decimals',
				esc_html__( 'Please enter a valid number of decimals in the "Money Format Decimals" field.', 'soccer-engine-lite' )
			);
			$output = get_option( 'daextsoenl_money_format_decimals' );
		} else {
			$output = $input;
		}

		return intval( $output, 10 );
	}

	public function money_format_simplify_million_callback( $args ) {

		echo '<select id="daextsoenl-money-format-simplify-million" name="daextsoenl_money_format_simplify_million" class="daext-display-none">';
		echo '<option ' . selected( intval( get_option( 'daextsoenl_money_format_simplify_million' ) ), 0, false ) . ' value="0">' . esc_html__( 'No', 'soccer-engine-lite' ) . '</option>';
		echo '<option ' . selected( intval( get_option( 'daextsoenl_money_format_simplify_million' ) ), 1, false ) . ' value="1">' . esc_html__( 'Yes', 'soccer-engine-lite' ) . '</option>';
		echo '</select>';
		echo '<div class="help-icon" title="' . esc_attr__( 'This option determines if the values over one million should be simplified.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function money_format_simplify_million_validation( $input ) {

		return intval( $input, 10 ) == 1 ? '1' : '0';
	}

	public function money_format_simplify_million_decimals_callback( $args ) {

		echo '<input maxlength=1 autocomplete="off" type="text" id="daextsoenl-money-format-simplify-million-decimals" name="daextsoenl_money_format_simplify_million_decimals" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_money_format_simplify_million_decimals' ) ) . '" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The number of decimals displayed in the money format simplify million.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function money_format_simplify_million_decimals_validation( $input ) {

		if ( intval( $input, 10 ) < 0 or intval( $input, 10 ) > 9 ) {
			add_settings_error(
				'daextsoenl_money_format_simplify_million_decimals',
				'daextsoenl_money_format_simplify_million_decimals',
				esc_html__( 'Please enter a valid number of decimals in the "Money Format Simplify Million Decimals" field.', 'soccer-engine-lite' )
			);
			$output = get_option( 'daextsoenl_money_format_simplify_million_decimals' );
		} else {
			$output = $input;
		}

		return intval( $output, 10 );
	}

	public function money_format_million_symbol_callback( $args ) {

		echo '<input autocomplete="off" type="text" id="daextsoenl-money-format-million-symbol" name="daextsoenl_money_format_million_symbol" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_money_format_million_symbol' ) ) . '" />';
		echo '<div maxlength="3" class="help-icon" title="' . esc_attr__( 'The million symbol in the money format.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function money_format_million_symbol_validation( $input ) {

		if ( strlen( $input ) > 3 ) {
			add_settings_error(
				'daextsoenl_money_format_million_symbol',
				'daextsoenl_money_format_million_symbol',
				esc_html__( 'Please enter a valid million symbol in the "Money Format Million Symbol" field.', 'soccer-engine-lite' )
			);
			$output = get_option( 'daextsoenl_money_format_million_symbol' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function money_format_simplify_thousands_callback( $args ) {

		echo '<select id="daextsoenl-money-format-simplify-thousands" name="daextsoenl_money_format_simplify_thousands" class="daext-display-none">';
		echo '<option ' . selected( intval( get_option( 'daextsoenl_money_format_simplify_thousands' ) ), 0, false ) . ' value="0">' . esc_html__( 'No', 'soccer-engine-lite' ) . '</option>';
		echo '<option ' . selected( intval( get_option( 'daextsoenl_money_format_simplify_thousands' ) ), 1, false ) . ' value="1">' . esc_html__( 'Yes', 'soccer-engine-lite' ) . '</option>';
		echo '</select>';
		echo '<div class="help-icon" title="' . esc_attr__( 'This option determines if the values over one thousand should be simplified.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function money_format_simplify_thousands_validation( $input ) {

		return intval( $input, 10 ) == 1 ? '1' : '0';
	}

	public function money_format_simplify_thousands_decimals_callback( $args ) {

		echo '<input maxlength=1 autocomplete="off" type="text" id="daextsoenl-money-format-simplify-thousands-decimals" name="daextsoenl_money_format_simplify_thousands_decimals" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_money_format_simplify_thousands_decimals' ) ) . '" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The number of decimals displayed in the money format simplify thousands.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function money_format_simplify_thousands_decimals_validation( $input ) {

		if ( intval( $input, 10 ) < 0 or intval( $input, 10 ) > 9 ) {
			add_settings_error(
				'daextsoenl_money_format_simplify_thousands_decimals',
				'daextsoenl_money_format_simplify_thousands_decimals',
				esc_html__( 'Please enter a valid number of decimals in the "Money Format Simplify Thousands Decimals" field.', 'soccer-engine-lite' )
			);
			$output = get_option( 'daextsoenl_money_format_simplify_thousands_decimals' );
		} else {
			$output = $input;
		}

		return intval( $output, 10 );
	}

	public function money_format_thousands_symbol_callback( $args ) {

		echo '<input autocomplete="off" type="text" id="daextsoenl-money-format-thousands-symbol" name="daextsoenl_money_format_thousands_symbol" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_money_format_thousands_symbol' ) ) . '" />';
		echo '<div maxlength="3" class="help-icon" title="' . esc_attr__( 'The thousands symbol in the money format.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function money_format_thousands_symbol_validation( $input ) {

		if ( strlen( $input ) > 3 ) {
			add_settings_error(
				'daextsoenl_money_format_thousands_symbol',
				'daextsoenl_money_format_thousands_symbol',
				esc_html__( 'Please enter a valid thousands symbol in the "Money Format Thousands Symbol" field.', 'soccer-engine-lite' )
			);
			$output = get_option( 'daextsoenl_money_format_thousands_symbol' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function money_format_currency_callback( $args ) {

		echo '<input autocomplete="off" type="text" id="daextsoenl-money-format-currency" name="daextsoenl_money_format_currency" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_money_format_currency' ) ) . '" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The currency of the money format.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function money_format_currency_validation( $input ) {

		if ( strlen( trim( $input ) ) < 1 or strlen( trim( $input ) ) > 10 ) {
			add_settings_error(
				'daextsoenl_money_format_currency',
				'daextsoenl_money_format_currency',
				esc_html__( 'Please enter a valid currency in the "Money Format Currency" field.', 'soccer-engine-lite' )
			);
			$output = get_option( 'daextsoenl_money_format_currency' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function money_format_currency_position_callback( $args ) {

		echo '<select id="daextsoenl-money-format-currency-position" name="daextsoenl_money_format_currency_position" class="daext-display-none">';
		echo '<option ' . selected( intval( get_option( 'daextsoenl_money_format_currency_position' ) ), 0, false ) . ' value="0">' . esc_html__( 'Left', 'soccer-engine-lite' ) . '</option>';
		echo '<option ' . selected( intval( get_option( 'daextsoenl_money_format_currency_position' ) ), 1, false ) . ' value="1">' . esc_html__( 'Right', 'soccer-engine-lite' ) . '</option>';
		echo '</select>';
		echo '<div class="help-icon" title="' . esc_attr__( 'The currency position in the money format.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function money_format_currency_position_validation( $input ) {

		return intval( $input, 10 ) == 1 ? '1' : '0';
	}

	public function height_measurement_unit_callback( $args ) {

		echo '<select id="daextsoenl-height-measurement-unit" name="daextsoenl_height_measurement_unit" class="daext-display-none">';
		echo '<option ' . selected( intval( get_option( 'daextsoenl_height_measurement_unit' ) ), 0, false ) . ' value="0">' . esc_html__( 'Meter', 'soccer-engine-lite' ) . '</option>';
		echo '<option ' . selected( intval( get_option( 'daextsoenl_height_measurement_unit' ) ), 1, false ) . ' value="1">' . esc_html__( 'Inch', 'soccer-engine-lite' ) . '</option>';
		echo '</select>';
		echo '<div class="help-icon" title="' . esc_attr__( 'The measurement unit used for the height.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function height_measurement_unit_validation( $input ) {

		return intval( $input, 10 ) == 1 ? '1' : '0';
	}

	public function set_max_execution_time_callback( $args ) {

		echo '<select id="daextsoenl-set-max-execution-time" name="daextsoenl_set_max_execution_time" class="daext-display-none">';
		echo '<option ' . selected( intval( get_option( 'daextsoenl_set_max_execution_time' ) ), 0, false ) . ' value="0">' . esc_html__( 'No', 'soccer-engine-lite' ) . '</option>';
		echo '<option ' . selected( intval( get_option( 'daextsoenl_set_max_execution_time' ) ), 1, false ) . ' value="1">' . esc_html__( 'Yes', 'soccer-engine-lite' ) . '</option>';
		echo '</select>';
		echo '<div class="help-icon" title="' . esc_attr__( 'Select "Yes" to enable a custom "Max Execution Time Value" on resource intensive scripts.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function set_max_execution_time_validation( $input ) {

		return intval( $input, 10 ) == 1 ? '1' : '0';
	}

	public function max_execution_time_value_callback( $args ) {

		echo '<input autocomplete="off" type="text" id="daextsoenl-max-execution-time-value" name="daextsoenl_max_execution_time_value" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_max_execution_time_value' ) ) . '" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'This value determines the maximum number of seconds allowed to execute resource intensive scripts.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function max_execution_time_value_validation( $input ) {

		if ( intval( $input, 10 ) < 1 || intval( $input, 10 ) > 1000000 ) {
			add_settings_error(
				'daextsoenl_max_execution_time_value',
				'daextsoenl_max_execution_time_value',
				esc_html__( 'Please enter a number from 1 to 1000000 in the "Max Execution Time Value" option.', 'soccer-engine-lite' )
			);
			$output = get_option( 'daextsoenl_max_execution_time_value' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function set_memory_limit_callback( $args ) {

		echo '<select id="daextsoenl-set-memory-limit" name="daextsoenl_set_memory_limit" class="daext-display-none">';
		echo '<option ' . selected( intval( get_option( 'daextsoenl_set_memory_limit' ) ), 0, false ) . ' value="0">' . esc_html__( 'No', 'soccer-engine-lite' ) . '</option>';
		echo '<option ' . selected( intval( get_option( 'daextsoenl_set_memory_limit' ) ), 1, false ) . ' value="1">' . esc_html__( 'Yes', 'soccer-engine-lite' ) . '</option>';
		echo '</select>';
		echo '<div class="help-icon" title="' . esc_attr__( 'Select "Yes" to enable a custom "Memory Limit Value" on resource intensive scripts.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function set_memory_limit_validation( $input ) {

		return intval( $input, 10 ) == 1 ? '1' : '0';
	}

	public function memory_limit_value_callback( $args ) {

		echo '<input autocomplete="off" type="text" id="daextsoenl-memory-limit-value" name="daextsoenl_memory_limit_value" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_memory_limit_value' ) ) . '" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'This value determines the PHP memory limit in megabytes allowed to execute resource intensive scripts.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function memory_limit_value_validation( $input ) {

		if ( intval( $input, 10 ) < 0 || intval( $input, 10 ) > 1000000 ) {
			add_settings_error(
				'daextsoenl_memory_limit_value',
				'daextsoenl_memory_limit_value',
				esc_html__( 'Please enter a number from 1 to 1000000 in the "Memory Limit Value" option.', 'soccer-engine-lite' )
			);
			$output = get_option( 'daextsoenl_memory_limit_value' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function transient_expiration_callback( $args ) {

		echo '<input autocomplete="off" type="text" id="daextsoenl-transient-expiration" name="daextsoenl_transient_expiration" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_transient_expiration' ) ) . '" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'Enter the transient expiration in seconds or set 0 to not use a transient.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function transient_expiration_validation( $input ) {

		if ( intval( $input, 10 ) < 0 || intval( $input, 10 ) > 1000000 ) {
			add_settings_error(
				'daextsoenl_transient_expiration',
				'daextsoenl_transient_expiration',
				esc_html__( 'Please enter a number from 1 to 1000000 in the "Transient Expiration" option.', 'soccer-engine-lite' )
			);
			$output = get_option( 'daextsoenl_transient_expiration' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function formation_field_line_stroke_width_callback( $args ) {

		echo '<input autocomplete="off" type="text" id="daextsoenl-formation-field-line-stroke-width" name="daextsoenl_formation_field_line_stroke_width" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_formation_field_line_stroke_width' ) ) . '" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The stroke width used for the lines of the field.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function formation_field_line_stroke_width_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 0 or $input > 100 ) {
			add_settings_error( 'daextsoenl_formation_field_line_stroke_width', 'daextsoenl_formation_field_line_stroke_width', esc_html__( 'Please enter a valid value in the "Formation Field Line Stroke Width" option.', 'soccer-engine-lite' ) );
			$output = get_option( 'daextsoenl_formation_field_line_stroke_width' );
		} else {
			$output = $input;
		}

		return $output;
	}

	public function block_margin_top_callback( $args ) {

		echo '<input autocomplete="off" type="text" id="daextsoenl-block-margin-top" name="daextsoenl_block_margin_top" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_block_margin_top' ) ) . '" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The top margin of the blocks.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function block_margin_top_validation( $input ) {

		if ( intval( $input, 10 ) < 0 && intval( $input, 10 ) > 1000000 ) {
			add_settings_error(
				'daextsoenl_block_margin_top',
				'daextsoenl_block_margin_top',
				esc_html__( 'Please enter a number from 0 to 1000000 in the "Block Margin Top" option.', 'soccer-engine-lite' )
			);
			$output = get_option( 'daextsoenl_block_margin_top' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function block_margin_bottom_callback( $args ) {

		echo '<input autocomplete="off" type="text" id="daextsoenl-block-margin-bottom" name="daextsoenl_block_margin_bottom" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_block_margin_bottom' ) ) . '" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The bottom margin of the blocks.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function block_margin_bottom_validation( $input ) {

		if ( intval( $input, 10 ) < 0 && intval( $input, 10 ) > 1000000 ) {
			add_settings_error(
				'daextsoenl_block_margin_bottom',
				'daextsoenl_block_margin_bottom',
				esc_html__( 'Please enter a number from 0 to 1000000 in the "Block Margin Bottom" option.', 'soccer-engine-lite' )
			);
			$output = get_option( 'daextsoenl_block_margin_bottom' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function responsive_breakpoint_1_callback( $args ) {

		echo '<input autocomplete="off" type="text" id="daextsoenl-responsive-breakpoint-1" name="daextsoenl_responsive_breakpoint_1" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_responsive_breakpoint_1' ) ) . '" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'When the browser viewport width goes below the value in pixels defined with this option the first responsive version of the layout elements generated by the plugin will be enabled.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function responsive_breakpoint_1_validation( $input ) {

		if ( intval( $input, 10 ) < 1 && intval( $input, 10 ) > 1000000 ) {
			add_settings_error(
				'daextsoenl_responsive_breakpoint_1',
				'daextsoenl_responsive_breakpoint_1',
				esc_html__( 'Please enter a number from 1 to 1000000 in the "Responsive Breakpoint 1" option.', 'soccer-engine-lite' )
			);
			$output = get_option( 'daextsoenl_responsive_breakpoint_1' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function responsive_breakpoint_2_callback( $args ) {

		echo '<input autocomplete="off" type="text" id="daextsoenl-responsive-breakpoint-2" name="daextsoenl_responsive_breakpoint_2" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_responsive_breakpoint_2' ) ) . '" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'When the browser viewport width goes below the value in pixels defined with this option the second responsive version of the layout elements generated by the plugin will be enabled.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function responsive_breakpoint_2_validation( $input ) {

		if ( intval( $input, 10 ) < 1 && intval( $input, 10 ) > 1000000 ) {
			add_settings_error(
				'daextsoenl_responsive_breakpoint_2',
				'daextsoenl_responsive_breakpoint_2',
				esc_html__( 'Please enter a number from 1 to 1000000 in the "Responsive Breakpoint 2" option.', 'soccer-engine-lite' )
			);
			$output = get_option( 'daextsoenl_responsive_breakpoint_2' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function font_family_callback( $args ) {

		echo '<input autocomplete="off" type="text" id="daextsoenl-font-family" name="daextsoenl_font_family" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_font_family' ) ) . '" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The font family of the text displayed in all the layout elements generated by the plugin.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function font_family_validation( $input ) {

		if ( ! preg_match( $this->shared->regex_font_family_or_font_families, $input ) ) {
			add_settings_error( 'daextsoenl_font_family', 'daextsoenl_table_pagination_font_family', esc_html__( 'Please enter a valid font family in the "Font Family" option.', 'soccer-engine-lite' ) );
			$output = get_option( 'daextsoenl_font_family' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}

	public function google_font_url_callback( $args ) {

		echo '<input autocomplete="off" type="text" id="daextsoenl-google-font-url" name="daextsoenl_google_font_url" class="regular-text" value="' . esc_attr( get_option( 'daextsoenl_google_font_url' ) ) . '" />';
		echo '<div class="help-icon" title="' . esc_attr__( 'The URL of the Google Font loaded by the plugin in the front-end.', 'soccer-engine-lite' ) . '"></div>';
	}

	public function google_font_url_validation( $input ) {

		if ( ! preg_match( $this->shared->url_regex, $input ) && strlen( trim( $input ) ) > 0 ) {
			add_settings_error( 'daextsoenl_google_font_url', 'daextsoenl_google_font_url', esc_html__( 'Please enter a valid URL in the "Google Font 1" option.', 'soccer-engine-lite' ) );
			$output = get_option( 'daextsoenl_google_font_url' );
		} else {
			$output = $input;
		}

		return trim( $output );
	}
}
