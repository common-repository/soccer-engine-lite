<?php
/**
 * This file contains the class Daextsoenl_Ajax, used to include ajax actions.
 *
 * @package soccer-engine-lite
 */

/**
 * This class should be used to include ajax actions.
 */
class Daextsoenl_Ajax {


	protected static $instance = null;
	private $shared            = null;

	private function __construct() {

		// Assign an instance of Daextsoenl_Shared.
		$this->shared = Daextsoenl_Shared::get_instance();

		// AJAX requests for logged-in and not-logged-in users.
		add_action( 'wp_ajax_daextsoenl_get_paginated_table_data', array( $this, 'get_paginated_table_data' ) );
		add_action( 'wp_ajax_nopriv_daextsoenl_get_paginated_table_data', array( $this, 'get_paginated_table_data' ) );

		// AJAX requests for logged-in users.
		add_action( 'wp_ajax_daextsoenl_get_squad_data', array( $this, 'get_squad_data' ) );
		add_action( 'wp_ajax_daextsoenl_get_match_round_data', array( $this, 'get_match_round_data' ) );
		add_action( 'wp_ajax_daextsoenl_get_player_list', array( $this, 'get_player_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_team_list', array( $this, 'get_team_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_transfer_type_list', array( $this, 'get_transfer_type_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_team_contract_type_list', array( $this, 'get_team_contract_type_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_agency_list', array( $this, 'get_agency_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_agency_contract_type_list', array( $this, 'get_agency_contract_type_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_citizenship_list', array( $this, 'get_citizenship_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_foot_list', array( $this, 'get_foot_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_squad_list', array( $this, 'get_squad_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_player_position_list', array( $this, 'get_player_position_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_player_award_type_list', array( $this, 'get_player_award_type_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_unavailable_player_type_list', array( $this, 'get_unavailable_player_type_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_injury_type_list', array( $this, 'get_injury_type_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_match_effect_list', array( $this, 'get_match_effect_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_retired_list', array( $this, 'get_retired_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_gender_list', array( $this, 'get_gender_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_staff_award_type_list', array( $this, 'get_staff_award_type_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_trophy_type_list', array( $this, 'get_trophy_type_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_match_list', array( $this, 'get_match_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_team_slot_list', array( $this, 'get_team_slot_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_competition_list', array( $this, 'get_competition_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_round_list', array( $this, 'get_round_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_type_list', array( $this, 'get_type_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_staff_list', array( $this, 'get_staff_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_referee_list', array( $this, 'get_referee_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_ranking_type_list', array( $this, 'get_ranking_type_list' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_agency_contracts', array( $this, 'get_columns_agency_contracts' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_competition_round', array( $this, 'get_columns_competition_round' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_competition_standings_table', array( $this, 'get_columns_competition_standings_table' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_injuries', array( $this, 'get_columns_injuries' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_market_value_transition', array( $this, 'get_columns_market_value_transition' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_match_lineup', array( $this, 'get_columns_match_lineup' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_match_staff', array( $this, 'get_columns_match_staff' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_match_substitutions', array( $this, 'get_columns_match_substitutions' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_matches', array( $this, 'get_columns_matches' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_player_awards', array( $this, 'get_columns_player_awards' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_players', array( $this, 'get_columns_players' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_market_value_transitions', array( $this, 'get_columns_market_value_transitions' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_ranking_transitions', array( $this, 'get_columns_ranking_transitions' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_squad_lineup', array( $this, 'get_columns_squad_lineup' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_squad_staff', array( $this, 'get_columns_squad_staff' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_squad_substitutions', array( $this, 'get_columns_squad_substitutions' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_staff', array( $this, 'get_columns_staff' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_staff_awards', array( $this, 'get_columns_staff_awards' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_team_contracts', array( $this, 'get_columns_team_contracts' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_transfers', array( $this, 'get_columns_transfers' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_trophies', array( $this, 'get_columns_trophies' ) );
		add_action( 'wp_ajax_daextsoenl_get_columns_unavailable_players', array( $this, 'get_columns_unavailable_players' ) );
		add_action( 'wp_ajax_daextsoenl_get_pagination_list', array( $this, 'get_pagination_list' ) );
	}

	/**
	 * Return an instance of this class.
	 */
	public static function get_instance() {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Get the data of a squad.
	 *
	 * Used in the "Matches" menu.
	 */
	public function get_squad_data() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		// Check the capability.
		if ( ! current_user_can( 'edit_others_posts' ) ) {
			echo 'Invalid Capability';
			die();
		}

		// Get the data.
		$squad_id = intval( $_POST['squad_id'], 10 );

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_squad';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE squad_id = %d", $squad_id );
		$squad_obj  = $wpdb->get_row( $safe_sql );
		$data       = $squad_obj;

		echo json_encode( $data );
		die();
	}

	/**
	 * Get the paginated table data.
	 */
	public function get_paginated_table_data() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		// Sanitize data.
		$table_id                      = sanitize_key( $_POST['table_id'] );
		$current_page                  = intval( $_POST['current_page'], 10 );
		$filter_a                      = $this->shared->json_to_sanitized_object( $_POST['filter'] );
		$column_a                      = $this->shared->json_to_sanitized_array( $_POST['columns'] );
		$hidden_columns_breakpoint_1_a = $this->shared->json_to_sanitized_array( $_POST['hidden_columns_breakpoint_1'] );
		$hidden_columns_breakpoint_2_a = $this->shared->json_to_sanitized_array( $_POST['hidden_columns_breakpoint_2'] );
		$pagination                    = intval( $_POST['pagination'], 10 );

		$table_module = $this->shared->{'get_paginated_table_data_' . $table_id}( $current_page, $filter_a, $column_a, $hidden_columns_breakpoint_1_a, $hidden_columns_breakpoint_2_a, $pagination );

		echo json_encode( $table_module );
		die();
	}

	/*
	 * Get the competition data.
	 *
	 * Used in the "Matches" menu.
	 */
	public function get_match_round_data() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		// Check the capability.
		if ( ! current_user_can( 'edit_others_posts' ) ) {
			echo 'Invalid Capability';
			die();
		}

		// Get the data.
		$competition_id = intval( $_POST['competition_id'], 10 );
		$match_id       = intval( $_POST['match_id'], 10 );

		global $wpdb;
		$table_name      = $wpdb->prefix . $this->shared->get( 'slug' ) . '_competition';
		$safe_sql        = $wpdb->prepare( "SELECT * FROM $table_name WHERE competition_id = %d", $competition_id );
		$competition_obj = $wpdb->get_row( $safe_sql );

		if ( null === $competition_obj ) {
			$number_of_rounds = 0;
			$competition_type = 0;
		} else {
			$number_of_rounds = $competition_obj->rounds;
			$competition_type = $competition_obj->type;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d", $match_id );
		$match_obj  = $wpdb->get_row( $safe_sql );

		if ( null === $match_obj ) {
			$selected_round = 0;
		} else {
			$selected_round = $match_obj->round;
		}

		$result = array(
			'number_of_rounds' => $number_of_rounds,
			'competition_type' => $competition_type,
			'selected_round'   => $selected_round,
		);

		echo json_encode( $result );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the players is returned.
	 */
	function get_player_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		// Check the capability.
		if ( ! current_user_can( 'edit_others_posts' ) ) {
			echo 'Invalid Capability';
			die();
		}

		$default_label = isset( $_POST['default_label'] ) ? intval( $_POST['default_label'], 10 ) : 0;

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player';
		$sql        = "SELECT player_id, first_name, last_name FROM $table_name ORDER BY player_id DESC";
		$player_a   = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $player_a as $key => $player ) {
			$player_a[ $key ]['value'] = $player['player_id'];
			$player_a[ $key ]['label'] = stripslashes( $player['first_name'] ) . ' ' . stripslashes( $player['last_name'] );
			unset( $player_a[ $key ]['player_id'] );
			unset( $player_a[ $key ]['last_name'] );
		}

		// Set the default value at the beginning of the array.
		switch ( $default_label ) {

			case 0:
				$label = __( 'All', 'soccer-engine-lite' );
				break;

			case 1:
				$label = __( 'None', 'soccer-engine-lite' );
				break;

		}
		array_unshift(
			$player_a,
			array(
				'value' => '0',
				'label' => $label,
			)
		);

		echo json_encode( $player_a );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the teams is returned.
	 */
	function get_team_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$default_label = isset( $_POST['default_label'] ) ? intval( $_POST['default_label'], 10 ) : 0;

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team';
		$sql        = "SELECT team_id, name FROM $table_name ORDER BY team_id DESC";
		$team_a     = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $team_a as $key => $team ) {
			$team_a[ $key ]['value'] = $team['team_id'];
			$team_a[ $key ]['label'] = stripslashes( $team['name'] );
			unset( $team_a[ $key ]['team_id'] );
			unset( $team_a[ $key ]['name'] );
		}

		// Set the default value at the beginning of the array.
		switch ( $default_label ) {

			case 0:
				$label = __( 'All', 'soccer-engine-lite' );
				break;

			case 1:
				$label = __( 'None', 'soccer-engine-lite' );
				break;

		}
		array_unshift(
			$team_a,
			array(
				'value' => '0',
				'label' => $label,
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $team_a );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the transfer types is returned.
	 */
	function get_transfer_type_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		global $wpdb;
		$table_name      = $wpdb->prefix . $this->shared->get( 'slug' ) . '_transfer_type';
		$sql             = "SELECT transfer_type_id, name FROM $table_name ORDER BY transfer_type_id DESC";
		$transfer_type_a = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $transfer_type_a as $key => $transfer_type ) {
			$transfer_type_a[ $key ]['value'] = $transfer_type['transfer_type_id'];
			$transfer_type_a[ $key ]['label'] = stripslashes( $transfer_type['name'] );
			unset( $transfer_type_a[ $key ]['transfer_type_id'] );
			unset( $transfer_type_a[ $key ]['name'] );
		}

		// Set the default value at the beginning of the array.
		array_unshift(
			$transfer_type_a,
			array(
				'value' => '0',
				'label' => __( 'All', 'soccer-engine-lite' ),
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $transfer_type_a );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the contract types is returned.
	 */
	function get_team_contract_type_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		global $wpdb;
		$table_name           = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team_contract_type';
		$sql                  = "SELECT team_contract_type_id, name FROM $table_name ORDER BY team_contract_type_id DESC";
		$team_contract_type_a = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $team_contract_type_a as $key => $team_contract_type ) {
			$team_contract_type_a[ $key ]['value'] = $team_contract_type['team_contract_type_id'];
			$team_contract_type_a[ $key ]['label'] = stripslashes( $team_contract_type['name'] );
			unset( $team_contract_type_a[ $key ]['team_contract_type_id'] );
			unset( $team_contract_type_a[ $key ]['name'] );
		}

		// Set the default value at the beginning of the array.
		array_unshift(
			$team_contract_type_a,
			array(
				'value' => '0',
				'label' => __( 'All', 'soccer-engine-lite' ),
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $team_contract_type_a );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the agencies is returned.
	 */
	function get_agency_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency';
		$sql        = "SELECT agency_id, name FROM $table_name ORDER BY agency_id DESC";
		$agency_a   = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $agency_a as $key => $agency ) {
			$agency_a[ $key ]['value'] = $agency['agency_id'];
			$agency_a[ $key ]['label'] = stripslashes( $agency['name'] );
			unset( $agency_a[ $key ]['agency_id'] );
			unset( $agency_a[ $key ]['name'] );
		}

		// Set the default value at the beginning of the array.
		array_unshift(
			$agency_a,
			array(
				'value' => '0',
				'label' => __( 'All', 'soccer-engine-lite' ),
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $agency_a );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the contract types is returned.
	 */
	function get_agency_contract_type_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		global $wpdb;
		$table_name             = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency_contract_type';
		$sql                    = "SELECT agency_contract_type_id, name FROM $table_name ORDER BY agency_contract_type_id DESC";
		$agency_contract_type_a = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $agency_contract_type_a as $key => $agency_contract_type ) {
			$agency_contract_type_a[ $key ]['value'] = $agency_contract_type['agency_contract_type_id'];
			$agency_contract_type_a[ $key ]['label'] = stripslashes( $agency_contract_type['name'] );
			unset( $agency_contract_type_a[ $key ]['agency_contract_type_id'] );
			unset( $agency_contract_type_a[ $key ]['name'] );
		}

		// Set the default value at the beginning of the array.
		array_unshift(
			$agency_contract_type_a,
			array(
				'value' => '0',
				'label' => __( 'All', 'soccer-engine-lite' ),
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $agency_contract_type_a );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the citizenships is returned.
	 */
	function get_citizenship_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$country_a = $this->shared->get( 'countries' );

		$result = array();
		foreach ( $country_a as $key => $country ) {

			$result[] = array(
				'value' => $country,
				'label' => stripslashes( $key ),
			);

		}

		// Set the default value at the beginning of the array.
		array_unshift(
			$result,
			array(
				'value' => '0',
				'label' => __( 'All', 'soccer-engine-lite' ),
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $result );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the foot is returned.
	 */
	function get_foot_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$result = array(
			array(
				'value' => 1,
				'label' => esc_attr__( 'N/A', 'soccer-engine-lite' ),
			),
			array(
				'value' => 2,
				'label' => esc_attr__( 'Left', 'soccer-engine-lite' ),
			),
			array(
				'value' => 3,
				'label' => esc_attr__( 'Right', 'soccer-engine-lite' ),
			),
			array(
				'value' => 4,
				'label' => esc_attr__( 'Both', 'soccer-engine-lite' ),
			),
		);

		// Set the default value at the beginning of the array.
		array_unshift(
			$result,
			array(
				'value' => '0',
				'label' => __( 'All', 'soccer-engine-lite' ),
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $result );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the squads is returned.
	 */
	function get_squad_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$default_label = isset( $_POST['default_label'] ) ? intval( $_POST['default_label'], 10 ) : 0;

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_squad';
		$sql        = "SELECT squad_id, name FROM $table_name ORDER BY squad_id DESC";
		$squad_a    = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $squad_a as $key => $squad ) {
			$squad_a[ $key ]['value'] = $squad['squad_id'];
			$squad_a[ $key ]['label'] = stripslashes( $squad['name'] );
			unset( $squad_a[ $key ]['squad_id'] );
			unset( $squad_a[ $key ]['name'] );
		}

		// Set the default value at the beginning of the array.
		switch ( $default_label ) {

			case 0:
				$label = __( 'All', 'soccer-engine-lite' );
				break;

			case 1:
				$label = __( 'None', 'soccer-engine-lite' );
				break;

		}
		array_unshift(
			$squad_a,
			array(
				'value' => '0',
				'label' => $label,
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $squad_a );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the player positions is returned.
	 */
	function get_player_position_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		global $wpdb;
		$table_name        = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player_position';
		$sql               = "SELECT player_position_id, name FROM $table_name ORDER BY player_position_id DESC";
		$player_position_a = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $player_position_a as $key => $player_position ) {
			$player_position_a[ $key ]['value'] = $player_position['player_position_id'];
			$player_position_a[ $key ]['label'] = stripslashes( $player_position['name'] );
			unset( $player_position_a[ $key ]['player_position_id'] );
			unset( $player_position_a[ $key ]['name'] );
		}

		// Set the default value at the beginning of the array.
		array_unshift(
			$player_position_a,
			array(
				'value' => '0',
				'label' => __( 'All', 'soccer-engine-lite' ),
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $player_position_a );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the player awards is returned.
	 */
	function get_player_award_type_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		global $wpdb;
		$table_name          = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player_award_type';
		$sql                 = "SELECT player_award_type_id, name FROM $table_name ORDER BY player_award_type_id DESC";
		$player_award_type_a = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $player_award_type_a as $key => $player_award_type ) {
			$player_award_type_a[ $key ]['value'] = $player_award_type['player_award_type_id'];
			$player_award_type_a[ $key ]['label'] = stripslashes( $player_award_type['name'] );
			unset( $player_award_type_a[ $key ]['player_award_type_id'] );
			unset( $player_award_type_a[ $key ]['name'] );
		}

		// Set the default value at the beginning of the array.
		array_unshift(
			$player_award_type_a,
			array(
				'value' => '0',
				'label' => __( 'All', 'soccer-engine-lite' ),
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $player_award_type_a );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the unavailable players is returned.
	 */
	function get_unavailable_player_type_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		global $wpdb;
		$table_name                = $wpdb->prefix . $this->shared->get( 'slug' ) . '_unavailable_player_type';
		$sql                       = "SELECT unavailable_player_type_id, name FROM $table_name ORDER BY unavailable_player_type_id DESC";
		$unavailable_player_type_a = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $unavailable_player_type_a as $key => $unavailable_player_type ) {
			$unavailable_player_type_a[ $key ]['value'] = $unavailable_player_type['unavailable_player_type_id'];
			$unavailable_player_type_a[ $key ]['label'] = stripslashes( $unavailable_player_type['name'] );
			unset( $unavailable_player_type_a[ $key ]['unavailable_player_type_id'] );
			unset( $unavailable_player_type_a[ $key ]['name'] );
		}

		// Set the default value at the beginning of the array.
		array_unshift(
			$unavailable_player_type_a,
			array(
				'value' => '0',
				'label' => __( 'All', 'soccer-engine-lite' ),
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $unavailable_player_type_a );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the injury types is returned.
	 */
	function get_injury_type_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		global $wpdb;
		$table_name    = $wpdb->prefix . $this->shared->get( 'slug' ) . '_injury_type';
		$sql           = "SELECT injury_type_id, name FROM $table_name ORDER BY injury_type_id DESC";
		$injury_type_a = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $injury_type_a as $key => $injury_type ) {
			$injury_type_a[ $key ]['value'] = $injury_type['injury_type_id'];
			$injury_type_a[ $key ]['label'] = stripslashes( $injury_type['name'] );
			unset( $injury_type_a[ $key ]['injury_type_id'] );
			unset( $injury_type_a[ $key ]['name'] );
		}

		// Set the default value at the beginning of the array.
		array_unshift(
			$injury_type_a,
			array(
				'value' => '0',
				'label' => __( 'All', 'soccer-engine-lite' ),
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $injury_type_a );
		die();
	}

	/**
	 * Use in the Gutenberg blocks GenericReactSelect component.
	 *
	 * A JSON string that includes name and ID of all the tables is returned.
	 */
	function get_match_effect_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$result = array();

		foreach ( $this->shared->get( 'match_effects' ) as $key => $event_type ) {

			if ( $key > 0 ) {
				$result[] = array(
					'value' => $key,
					'label' => $event_type,
				);
			}
		}

		// Set the default value at the beginning of the array.
		array_unshift(
			$result,
			array(
				'value' => '0',
				'label' => __( 'All', 'soccer-engine-lite' ),
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $result );
		die();
	}


	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the ranking types is returned.
	 */
	function get_ranking_type_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$default_label = isset( $_POST['default_label'] ) ? intval( $_POST['default_label'], 10 ) : 0;

		global $wpdb;
		$table_name     = $wpdb->prefix . $this->shared->get( 'slug' ) . '_ranking_type';
		$sql            = "SELECT ranking_type_id, name FROM $table_name ORDER BY ranking_type_id DESC";
		$ranking_type_a = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $ranking_type_a as $key => $ranking_type ) {
			$ranking_type_a[ $key ]['value'] = $ranking_type['ranking_type_id'];
			$ranking_type_a[ $key ]['label'] = stripslashes( $ranking_type['name'] );
			unset( $ranking_type_a[ $key ]['ranking_type_id'] );
			unset( $ranking_type_a[ $key ]['name'] );
		}

		// Set the default value at the beginning of the array.
		switch ( $default_label ) {

			case 0:
				$label = __( 'All', 'soccer-engine-lite' );
				break;

			case 1:
				$label = __( 'None', 'soccer-engine-lite' );
				break;

		}
		array_unshift(
			$ranking_type_a,
			array(
				'value' => '0',
				'label' => $label,
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $ranking_type_a );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the retired is returned.
	 */

	function get_retired_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$result = array(
			array(
				'value' => '1',
				'label' => esc_attr__( 'No', 'soccer-engine-lite' ),
			),
			array(
				'value' => '2',
				'label' => esc_attr__( 'Yes', 'soccer-engine-lite' ),
			),
		);

		// Set the default value at the beginning of the array.
		array_unshift(
			$result,
			array(
				'value' => '0',
				'label' => __( 'All', 'soccer-engine-lite' ),
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $result );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the genders is returned.
	 */
	function get_gender_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$result = array(
			array(
				'value' => '1',
				'label' => esc_attr__( 'Male', 'soccer-engine-lite' ),
			),
			array(
				'value' => '2',
				'label' => esc_attr__( 'Female', 'soccer-engine-lite' ),
			),
		);

		// Set the default value at the beginning of the array.
		array_unshift(
			$result,
			array(
				'value' => '0',
				'label' => __( 'All', 'soccer-engine-lite' ),
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $result );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the tables is returned.
	 */
	function get_staff_award_type_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		global $wpdb;
		$table_name         = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff_award_type';
		$sql                = "SELECT staff_award_type_id, name FROM $table_name ORDER BY staff_award_type_id DESC";
		$staff_award_type_a = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $staff_award_type_a as $key => $staff_award_type ) {
			$staff_award_type_a[ $key ]['value'] = $staff_award_type['staff_award_type_id'];
			$staff_award_type_a[ $key ]['label'] = stripslashes( $staff_award_type['name'] );
			unset( $staff_award_type_a[ $key ]['staff_award_type_id'] );
			unset( $staff_award_type_a[ $key ]['name'] );
		}

		// Set the default value at the beginning of the array.
		array_unshift(
			$staff_award_type_a,
			array(
				'value' => '0',
				'label' => __( 'All', 'soccer-engine-lite' ),
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $staff_award_type_a );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the trophy types is returned.
	 */
	function get_trophy_type_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		global $wpdb;
		$table_name    = $wpdb->prefix . $this->shared->get( 'slug' ) . '_trophy_type';
		$sql           = "SELECT trophy_type_id, name FROM $table_name ORDER BY trophy_type_id DESC";
		$trophy_type_a = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $trophy_type_a as $key => $trophy_type ) {
			$trophy_type_a[ $key ]['value'] = $trophy_type['trophy_type_id'];
			$trophy_type_a[ $key ]['label'] = stripslashes( $trophy_type['name'] );
			unset( $trophy_type_a[ $key ]['trophy_type_id'] );
			unset( $trophy_type_a[ $key ]['name'] );
		}

		// Set the default value at the beginning of the array.
		array_unshift(
			$trophy_type_a,
			array(
				'value' => '0',
				'label' => __( 'All', 'soccer-engine-lite' ),
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $trophy_type_a );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the matches is returned.
	 */
	function get_match_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$default_label = isset( $_POST['default_label'] ) ? intval( $_POST['default_label'], 10 ) : 0;

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_match';
		$sql        = "SELECT match_id, name FROM $table_name ORDER BY match_id DESC";
		$match_a    = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $match_a as $key => $match ) {
			$match_a[ $key ]['value'] = $match['match_id'];
			$match_a[ $key ]['label'] = stripslashes( $match['name'] );
			unset( $match_a[ $key ]['match_id'] );
			unset( $match_a[ $key ]['name'] );
		}

		// Set the default value at the beginning of the array.
		switch ( $default_label ) {

			case 0:
				$label = __( 'All', 'soccer-engine-lite' );
				break;

			case 1:
				$label = __( 'None', 'soccer-engine-lite' );
				break;

		}
		array_unshift(
			$match_a,
			array(
				'value' => '0',
				'label' => $label,
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $match_a );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the team slots is returned.
	 */
	function get_team_slot_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$result = array(
			array(
				'value' => '1',
				'label' => esc_attr__( 'Team 1', 'soccer-engine-lite' ),
			),
			array(
				'value' => '2',
				'label' => esc_attr__( 'Team 2', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $result );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the competitions is returned.
	 */
	function get_competition_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$default_label = isset( $_POST['default_label'] ) ? intval( $_POST['default_label'], 10 ) : 0;

		global $wpdb;
		$table_name    = $wpdb->prefix . $this->shared->get( 'slug' ) . '_competition';
		$sql           = "SELECT competition_id, name FROM $table_name ORDER BY competition_id DESC";
		$competition_a = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $competition_a as $key => $competition ) {
			$competition_a[ $key ]['value'] = $competition['competition_id'];
			$competition_a[ $key ]['label'] = stripslashes( $competition['name'] );
			unset( $competition_a[ $key ]['competition_id'] );
			unset( $competition_a[ $key ]['name'] );
		}

		// Set the default value at the beginning of the array.
		switch ( $default_label ) {

			case 0:
				$label = __( 'All', 'soccer-engine-lite' );
				break;

			case 1:
				$label = __( 'None', 'soccer-engine-lite' );
				break;

		}
		array_unshift(
			$competition_a,
			array(
				'value' => '0',
				'label' => $label,
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $competition_a );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the rounds is returned.
	 */
	function get_round_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$default_label = isset( $_POST['default_label'] ) ? intval( $_POST['default_label'], 10 ) : 0;

		$result = array();
		for ( $i = 1;$i <= 128;$i++ ) {
			$result[] = array(
				'value' => (string) $i,
				'label' => esc_attr__( 'Round', 'soccer-engine-lite' ) . ' ' . $i,
			);
		}

		// Generate the response and terminate the script.
		echo json_encode( $result );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the round types is returned.
	 */
	function get_type_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$result = array(
			array(
				'value' => '0',
				'label' => esc_attr__( 'Single Leg', 'soccer-engine-lite' ),
			),
			array(
				'value' => '1',
				'label' => esc_attr__( 'First Leg', 'soccer-engine-lite' ),
			),
			array(
				'value' => '2',
				'label' => esc_attr__( 'Second Leg', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $result );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the staff members is returned.
	 */
	function get_staff_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$default_label = isset( $_POST['default_label'] ) ? intval( $_POST['default_label'], 10 ) : 0;

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff';
		$sql        = "SELECT staff_id, first_name, last_name FROM $table_name ORDER BY staff_id DESC";
		$staff_a    = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $staff_a as $key => $staff ) {
			$staff_a[ $key ]['value'] = $staff['staff_id'];
			$staff_a[ $key ]['label'] = stripslashes( $staff['first_name'] ) . ' ' . stripslashes( $staff['last_name'] );
			unset( $staff_a[ $key ]['staff_id'] );
			unset( $staff_a[ $key ]['last_name'] );
		}

		// Set the default value at the beginning of the array.
		switch ( $default_label ) {

			case 0:
				$label = __( 'All', 'soccer-engine-lite' );
				break;

			case 1:
				$label = __( 'None', 'soccer-engine-lite' );
				break;

		}
		array_unshift(
			$staff_a,
			array(
				'value' => '0',
				'label' => $label,
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $staff_a );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of multiple Gutenberg blocks.
	 *
	 * A JSON string that includes name and ID of all the referees is returned.
	 */
	function get_referee_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$default_label = isset( $_POST['default_label'] ) ? intval( $_POST['default_label'], 10 ) : 0;

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee';
		$sql        = "SELECT referee_id, first_name, last_name FROM $table_name ORDER BY referee_id DESC";
		$referee_a  = $wpdb->get_results( $sql, ARRAY_A );

		// Change the indexes to meet the requirements of the GenericReactSelect component.
		foreach ( $referee_a as $key => $referee ) {
			$referee_a[ $key ]['value'] = $referee['referee_id'];
			$referee_a[ $key ]['label'] = stripslashes( $referee['first_name'] ) . ' ' . stripslashes( $referee['last_name'] );
			unset( $referee_a[ $key ]['referee_id'] );
			unset( $referee_a[ $key ]['last_name'] );
		}

		// Set the default value at the beginning of the array.
		switch ( $default_label ) {

			case 0:
				$label = __( 'All', 'soccer-engine-lite' );
				break;

			case 1:
				$label = __( 'None', 'soccer-engine-lite' );
				break;

		}
		array_unshift(
			$referee_a,
			array(
				'value' => '0',
				'label' => $label,
			)
		);

		// Generate the response and terminate the script.
		echo json_encode( $referee_a );
		die();
	}


	/**
	 * Used in the MultiReactSelect component of the "Competition Round" Gutenberg block.
	 */
	function get_columns_competition_round() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'date',
				'label' => __( 'Date', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'time',
				'label' => __( 'Time', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'team_1',
				'label' => __( 'Team 1', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'result',
				'label' => __( 'Result', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'team_2',
				'label' => __( 'Team 2', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Competition Standings Table" Gutenberg block.
	 */
	function get_columns_competition_standings_table() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'position',
				'label' => __( 'Position', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'team',
				'label' => __( 'Team', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'played',
				'label' => __( 'Played', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'won',
				'label' => __( 'Won', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'drawn',
				'label' => __( 'Drawn', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'lost',
				'label' => __( 'Lost', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'goals_for',
				'label' => __( 'Goals For', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'goals_against',
				'label' => __( 'Goals Against', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'goal_difference',
				'label' => __( 'Goal Difference', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'points',
				'label' => __( 'Points', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Injuries" Gutenberg block.
	 */
	function get_columns_injuries() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'player',
				'label' => __( 'Player', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'injury_type',
				'label' => __( 'Injury Type', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'start_date',
				'label' => __( 'Start Date', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'end_date',
				'label' => __( 'End Date', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'age',
				'label' => __( 'Age', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'citizenship',
				'label' => __( 'Citizenship', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Market Value Transitions" Gutenberg block.
	 */
	function get_columns_market_value_transition() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'player',
				'label' => __( 'Player', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'age',
				'label' => __( 'Age', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'nat',
				'label' => __( 'Nat.', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'date',
				'label' => __( 'Date', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'value',
				'label' => __( 'Value', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Match Lineup" Gutenberg block.
	 */
	function get_columns_match_lineup() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(

			array(
				'value' => 'player',
				'label' => __( 'Player', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'citizenship',
				'label' => __( 'Citizenship', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'jersey_number',
				'label' => __( 'Jersey Number', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Match Staff" Gutenberg block.
	 */
	function get_columns_match_staff() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'staff',
				'label' => __( 'Staff', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'citizenship',
				'label' => __( 'Citizenship', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Match Substitutions" Gutenberg block.
	 */
	function get_columns_match_substitutions() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'player',
				'label' => __( 'Player', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'citizenship',
				'label' => __( 'Citizenship', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'jersey_number',
				'label' => __( 'Jersey Number', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}



	/**
	 * Used in the MultiReactSelect component of the "Match Lineup" Gutenberg block.
	 */
	function get_columns_matches() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'date',
				'label' => __( 'Date', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'time',
				'label' => __( 'Time', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'team_1',
				'label' => __( 'Team 1', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'result',
				'label' => __( 'Result', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'team_2',
				'label' => __( 'Team 2', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Player Awards" Gutenberg block.
	 */
	function get_columns_player_awards() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'player',
				'label' => __( 'Player', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'player_award_type',
				'label' => __( 'Player Award Type', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'assignment_date',
				'label' => __( 'Assignment Date', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'age',
				'label' => __( 'Age', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'citizenship',
				'label' => __( 'Citizenship', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Players" Gutenberg block.
	 */
	function get_columns_players() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'player',
				'label' => __( 'Player', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'age',
				'label' => __( 'Age', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'citizenship',
				'label' => __( 'Citizenship', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'foot',
				'label' => __( 'Foot', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'height',
				'label' => __( 'Height', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'current_club',
				'label' => __( 'Current Club', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'ownership',
				'label' => __( 'Ownership', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'contract_expires',
				'label' => __( 'Contract Expires', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'market_value',
				'label' => __( 'Market Value', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Ranking Transitions" Gutenberg block.
	 */
	function get_columns_ranking_transitions() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'team',
				'label' => __( 'Team', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'ranking_type',
				'label' => __( 'Ranking Type', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'date',
				'label' => __( 'Date', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'value',
				'label' => __( 'Value', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Market Value Transitions" Gutenberg block.
	 */
	function get_columns_market_value_transitions() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'player',
				'label' => __( 'Player', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'age',
				'label' => __( 'Age', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'citizenship',
				'label' => __( 'Citizenship', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'date',
				'label' => __( 'Date', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'value',
				'label' => __( 'Value', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Squad Lineup" Gutenberg block.
	 */
	function get_columns_squad_lineup() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'player',
				'label' => __( 'Player', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'date_of_birth',
				'label' => __( 'Date of Birth', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'citizenship',
				'label' => __( 'Citizenship', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'jersey_number',
				'label' => __( 'Jersey Number', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Squad Staff" Gutenberg block.
	 */
	function get_columns_squad_staff() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'staff',
				'label' => __( 'Staff', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'date_of_birth',
				'label' => __( 'Date of Birth', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'citizenship',
				'label' => __( 'Citizenship', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Squad Substitutions" Gutenberg block.
	 */
	function get_columns_squad_substitutions() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'player',
				'label' => __( 'Player', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'date_of_birth',
				'label' => __( 'Date of Birth', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'citizenship',
				'label' => __( 'Citizenship', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'jersey_number',
				'label' => __( 'Jersey Number', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Staff" Gutenberg block.
	 */
	function get_columns_staff() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'staff',
				'label' => __( 'Staff', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'age',
				'label' => __( 'Age', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'citizenship',
				'label' => __( 'Citizenship', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'staff_type',
				'label' => __( 'Staff Type', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Staff Awards" Gutenberg block.
	 */
	function get_columns_staff_awards() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'staff',
				'label' => __( 'Staff', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'staff_award_type',
				'label' => __( 'Staff Award Type', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'assignment_date',
				'label' => __( 'Assignment Date', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'age',
				'label' => __( 'Age', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'citizenship',
				'label' => __( 'Citizenship', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}


	/**
	 * Used in the MultiReactSelect component of the "Trophies" Gutenberg block.
	 */
	function get_columns_trophies() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'trophy_type',
				'label' => __( 'Trophy Type', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'team',
				'label' => __( 'Team', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'assignment_date',
				'label' => __( 'Assignment Date', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Unavailable Players" Gutenberg block.
	 */
	function get_columns_unavailable_players() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'player',
				'label' => __( 'Player', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'unavailable_player_type',
				'label' => __( 'Unavailable Player Type', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'start_date',
				'label' => __( 'Start Date', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'end_date',
				'label' => __( 'End Date', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'age',
				'label' => __( 'Age', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'citizenship',
				'label' => __( 'Citizenship', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Transfers" Gutenberg block.
	 */
	function get_columns_transfers() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'player',
				'label' => __( 'Player', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'transfer_type',
				'label' => __( 'Transfer Type', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'team_left',
				'label' => __( 'Team Left', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'team_joined',
				'label' => __( 'Team Joined', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'date',
				'label' => __( 'Date', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'fee',
				'label' => __( 'Fee', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'age',
				'label' => __( 'Age', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'citizenship',
				'label' => __( 'Citizenship', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'market_value',
				'label' => __( 'Market Value', 'soccer-engine-lite' ),
			),

		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Team Contracts" Gutenberg block.
	 */
	function get_columns_team_contracts() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'player',
				'label' => __( 'Player', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'age',
				'label' => __( 'Age', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'citizenship',
				'label' => __( 'Citizenship', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'start_date',
				'label' => __( 'Start Date', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'end_date',
				'label' => __( 'End Date', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'team',
				'label' => __( 'Team', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'team_contract_type',
				'label' => __( 'Team Contract Type', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'salary',
				'label' => __( 'Salary', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'market_value',
				'label' => __( 'Market Value', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'agency',
				'label' => __( 'Agency', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the MultiReactSelect component of the "Agency Contracts" Gutenberg block.
	 */
	function get_columns_agency_contracts() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => 'player',
				'label' => __( 'Player', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'agency',
				'label' => __( 'Agency', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'agency_contract_type',
				'label' => __( 'Agency Contract Type', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'start_date',
				'label' => __( 'Start Date', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'end_date',
				'label' => __( 'End date', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'age',
				'label' => __( 'Age', 'soccer-engine-lite' ),
			),
			array(
				'value' => 'citizenship',
				'label' => __( 'Citizenship', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}

	/**
	 * Used in the GenericReactSelect component of all the Gutenberg block used to display paginated tables.
	 */
	function get_pagination_list() {

		// Check the referer.
		if ( ! check_ajax_referer( 'daextsoenl', 'security', false ) ) {
			echo 'Invalid AJAX Request';
			die();
		}

		$columns = array(
			array(
				'value' => '0',
				'label' => __( 'None', 'soccer-engine-lite' ),
			),
			array(
				'value' => '10',
				'label' => __( '10', 'soccer-engine-lite' ),
			),
			array(
				'value' => '20',
				'label' => __( '20', 'soccer-engine-lite' ),
			),
			array(
				'value' => '30',
				'label' => __( '30', 'soccer-engine-lite' ),
			),
			array(
				'value' => '40',
				'label' => __( '40', 'soccer-engine-lite' ),
			),
			array(
				'value' => '50',
				'label' => __( '50', 'soccer-engine-lite' ),
			),
			array(
				'value' => '60',
				'label' => __( '60', 'soccer-engine-lite' ),
			),
			array(
				'value' => '70',
				'label' => __( '70', 'soccer-engine-lite' ),
			),
			array(
				'value' => '80',
				'label' => __( '80', 'soccer-engine-lite' ),
			),
			array(
				'value' => '90',
				'label' => __( '90', 'soccer-engine-lite' ),
			),
			array(
				'value' => '100',
				'label' => __( '100', 'soccer-engine-lite' ),
			),
		);

		// Generate the response and terminate the script.
		echo json_encode( $columns );
		die();
	}
}
