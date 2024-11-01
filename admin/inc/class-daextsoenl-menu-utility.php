<?php
/**
 * This class includes a class with the utility function used only in the back-end menus of the plugin except the "Options" menu.
 *
 * @package soccer-engine-lite
 */

/**
 * This class includes utility function used only in the back-end menus of the plugin except the "Options" menu.
 */
class Daextsoenl_Menu_Utility {

	private $shared = null;

	public function __construct( $shared ) {

		// assign an instance of Daextsoenl_Shared
		$this->shared = $shared;
	}

	/**
	 * Generates the array used in the "Citizenship" select.
	 */
	public function select_countries( $none = false ) {

		$country_a = $this->shared->get( 'countries' );

		$result = array();
		if ( $none === true ) {

			$result[] = array(
				'value'    => '',
				'text'     => __( 'None', 'soccer-engine-lite' ),
				'selected' => true,
			);

		}

		foreach ( $country_a as $key => $country ) {

			$result[] = array(
				'value'    => $country,
				'text'     => stripslashes( $key ),
				'selected' => $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Ranking Type" select.
	 */
	public function select_ranking_types() {

		global $wpdb;
		$table_name     = $wpdb->prefix . $this->shared->get( 'slug' ) . '_ranking_type';
		$sql            = "SELECT * FROM $table_name ORDER BY ranking_type_id DESC";
		$ranking_type_a = $wpdb->get_results( $sql, ARRAY_A );

		$result = array();
		foreach ( $ranking_type_a as $key => $ranking_type ) {

			$result[] = array(
				'value'    => $ranking_type['ranking_type_id'],
				'text'     => stripslashes( $ranking_type['name'] ),
				'selected' => $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Staff Type" select.
	 */
	public function select_staff_types() {

		global $wpdb;
		$table_name   = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff_type';
		$sql          = "SELECT * FROM $table_name ORDER BY staff_type_id DESC";
		$staff_type_a = $wpdb->get_results( $sql, ARRAY_A );

		$result = array();
		foreach ( $staff_type_a as $key => $staff_type ) {

			$result[] = array(
				'value'    => $staff_type['staff_type_id'],
				'text'     => stripslashes( $staff_type['name'] ),
				'selected' => $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Agency" select.
	 */
	public function select_agencies() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency';
		$sql        = "SELECT * FROM $table_name ORDER BY agency_id DESC";
		$agency_a   = $wpdb->get_results( $sql, ARRAY_A );

		$result = array();
		foreach ( $agency_a as $key => $agency ) {

			$result[] = array(
				'value'    => $agency['agency_id'],
				'text'     => stripslashes( $agency['name'] ),
				'selected' => $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Team" select.
	 */
	public function select_teams( $none = false ) {

		$result = array();
		if ( $none === true ) {

			$result[] = array(
				'value'    => 0,
				'text'     => __( 'None', 'soccer-engine-lite' ),
				'selected' => true,
			);

		}
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team';
		$sql        = "SELECT * FROM $table_name ORDER BY team_id DESC";
		$team_a     = $wpdb->get_results( $sql, ARRAY_A );

		foreach ( $team_a as $key => $team ) {

			$result[] = array(
				'value'    => $team['team_id'],
				'text'     => stripslashes( $team['name'] ),
				'selected' => false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Player Positions" select.
	 */
	public function select_player_positions( $not_available = false ) {

		$result = array();
		if ( $not_available === true ) {

			$result[] = array(
				'value'    => 0,
				'text'     => __( 'N/A', 'soccer-engine-lite' ),
				'selected' => true,
			);

		}
		global $wpdb;
		$table_name        = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player_position';
		$sql               = "SELECT * FROM $table_name ORDER BY player_position_id DESC";
		$player_position_a = $wpdb->get_results( $sql, ARRAY_A );

		foreach ( $player_position_a as $key => $player_position ) {

			$result[] = array(
				'value'    => $player_position['player_position_id'],
				'text'     => stripslashes( $player_position['name'] ),
				'selected' => false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Player" select.
	 */
	public function select_players( $none = false ) {

		$result = array();
		if ( $none === true ) {

			$result[] = array(
				'value'    => 0,
				'text'     => __( 'None', 'soccer-engine-lite' ),
				'selected' => true,
			);

		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player';
		$sql        = "SELECT * FROM $table_name ORDER BY player_id DESC";
		$player_a   = $wpdb->get_results( $sql, ARRAY_A );

		foreach ( $player_a as $key => $player ) {

			$result[] = array(
				'value'    => $player['player_id'],
				'text'     => stripslashes( $player['first_name'] ) . ' ' . stripslashes( $player['last_name'] ),
				'selected' => ! $none && $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Staff" select.
	 */
	public function select_staff( $none = false ) {

		$result = array();
		if ( $none === true ) {

			$result[] = array(
				'value'    => 0,
				'text'     => __( 'None', 'soccer-engine-lite' ),
				'selected' => true,
			);

		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff';
		$sql        = "SELECT * FROM $table_name ORDER BY staff_id DESC";
		$staff_a    = $wpdb->get_results( $sql, ARRAY_A );

		foreach ( $staff_a as $key => $staff ) {

			$result[] = array(
				'value'    => $staff['staff_id'],
				'text'     => stripslashes( $staff['first_name'] ) . ' ' . stripslashes( $staff['last_name'] ),
				'selected' => ! $none and $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Referee" select.
	 */
	public function select_referees( $none = false ) {

		$result = array();
		if ( $none === true ) {

			$result[] = array(
				'value'    => 0,
				'text'     => __( 'None', 'soccer-engine-lite' ),
				'selected' => true,
			);

		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee';
		$sql        = "SELECT * FROM $table_name ORDER BY referee_id DESC";
		$referee_a  = $wpdb->get_results( $sql, ARRAY_A );

		foreach ( $referee_a as $key => $referee ) {

			$result[] = array(
				'value'    => $referee['referee_id'],
				'text'     => stripslashes( $referee['first_name'] ) . ' ' . stripslashes( $referee['last_name'] ),
				'selected' => ! $none && $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Referee Badge Types" select.
	 */
	public function select_referee_badge_types( $none = false ) {

		$result = array();
		if ( $none === true ) {

			$result[] = array(
				'value'    => 0,
				'text'     => __( 'None', 'soccer-engine-lite' ),
				'selected' => true,
			);

		}

		global $wpdb;
		$table_name           = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee_badge_type';
		$sql                  = "SELECT * FROM $table_name ORDER BY referee_badge_type_id DESC";
		$referee_badge_type_a = $wpdb->get_results( $sql, ARRAY_A );

		foreach ( $referee_badge_type_a as $key => $referee_badge_type ) {

			$result[] = array(
				'value'    => $referee_badge_type['referee_badge_type_id'],
				'text'     => stripslashes( $referee_badge_type['name'] ),
				'selected' => ! $none && $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Jersey Sets" select.
	 */
	public function select_jersey_sets( $none = false ) {

		$result = array();
		if ( $none === true ) {

			$result[] = array(
				'value'    => 0,
				'text'     => __( 'None', 'soccer-engine-lite' ),
				'selected' => true,
			);

		}

		global $wpdb;
		$table_name   = $wpdb->prefix . $this->shared->get( 'slug' ) . '_jersey_set';
		$sql          = "SELECT * FROM $table_name ORDER BY jersey_set_id DESC";
		$jersey_set_a = $wpdb->get_results( $sql, ARRAY_A );

		foreach ( $jersey_set_a as $key => $jersey_set ) {

			$result[] = array(
				'value'    => $jersey_set['jersey_set_id'],
				'text'     => stripslashes( $jersey_set['name'] ),
				'selected' => ! $none and $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Squads" select.
	 */
	public function select_squads( $none = false ) {

		$result = array();
		if ( $none === true ) {

			$result[] = array(
				'value'    => 0,
				'text'     => __( 'None', 'soccer-engine-lite' ),
				'selected' => true,
			);

		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_squad';
		$sql        = "SELECT * FROM $table_name ORDER BY squad_id DESC";
		$squad_a    = $wpdb->get_results( $sql, ARRAY_A );

		foreach ( $squad_a as $key => $squad ) {

			$result[] = array(
				'value'    => $squad['squad_id'],
				'text'     => stripslashes( $squad['name'] ),
				'selected' => ! $none and $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "National Team Confederation" select.
	 */
	function select_national_team_confederations() {

		$result = array();

		$result[] = array(
			'value'    => 0,
			'text'     => 'AFC',
			'selected' => false,
		);

		$result[] = array(
			'value'    => 1,
			'text'     => 'CAF',
			'selected' => false,
		);

		$result[] = array(
			'value'    => 2,
			'text'     => 'CONCACAF',
			'selected' => false,
		);

		$result[] = array(
			'value'    => 3,
			'text'     => 'CONMEBOL',
			'selected' => false,
		);

		$result[] = array(
			'value'    => 4,
			'text'     => 'OFC',
			'selected' => false,
		);

		$result[] = array(
			'value'    => 5,
			'text'     => 'UEFA',
			'selected' => false,
		);

		return $result;
	}

	/**
	 * Generates the array used in the "Agency" select.
	 */
	public function select_player_award_types() {

		global $wpdb;
		$table_name          = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player_award_type';
		$sql                 = "SELECT * FROM $table_name ORDER BY player_award_type_id DESC";
		$player_award_type_a = $wpdb->get_results( $sql, ARRAY_A );

		$result = array();
		foreach ( $player_award_type_a as $key => $player_award_type ) {

			$result[] = array(
				'value'    => $player_award_type['player_award_type_id'],
				'text'     => stripslashes( $player_award_type['name'] ),
				'selected' => $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Stadiums" select.
	 */
	public function select_stadiums( $none = false ) {

		$result = array();
		if ( $none === true ) {

			$result[] = array(
				'value'    => 0,
				'text'     => __( 'None', 'soccer-engine-lite' ),
				'selected' => true,
			);

		}
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_stadium';
		$sql        = "SELECT * FROM $table_name ORDER BY stadium_id DESC";
		$stadium_a  = $wpdb->get_results( $sql, ARRAY_A );

		foreach ( $stadium_a as $key => $stadium ) {

			$result[] = array(
				'value'    => $stadium['stadium_id'],
				'text'     => stripslashes( $stadium['name'] ),
				'selected' => false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Agency" select.
	 */
	public function select_staff_award_types() {

		global $wpdb;
		$table_name         = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff_award_type';
		$sql                = "SELECT * FROM $table_name ORDER BY staff_award_type_id DESC";
		$staff_award_type_a = $wpdb->get_results( $sql, ARRAY_A );

		$result = array();
		foreach ( $staff_award_type_a as $key => $staff_award_type ) {

			$result[] = array(
				'value'    => $staff_award_type['staff_award_type_id'],
				'text'     => stripslashes( $staff_award_type['name'] ),
				'selected' => $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Injury Type" select.
	 */
	public function select_injury_types() {

		global $wpdb;
		$table_name    = $wpdb->prefix . $this->shared->get( 'slug' ) . '_injury_type';
		$sql           = "SELECT * FROM $table_name ORDER BY injury_type_id DESC";
		$injury_type_a = $wpdb->get_results( $sql, ARRAY_A );

		$result = array();
		foreach ( $injury_type_a as $key => $injury_type ) {

			$result[] = array(
				'value'    => $injury_type['injury_type_id'],
				'text'     => stripslashes( $injury_type['name'] ),
				'selected' => $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Transfer Type" select.
	 */
	public function select_transfer_types() {

		global $wpdb;
		$table_name      = $wpdb->prefix . $this->shared->get( 'slug' ) . '_transfer_type';
		$sql             = "SELECT * FROM $table_name ORDER BY transfer_type_id DESC";
		$transfer_type_a = $wpdb->get_results( $sql, ARRAY_A );

		$result = array();
		foreach ( $transfer_type_a as $key => $transfer_type ) {

			$result[] = array(
				'value'    => $transfer_type['transfer_type_id'],
				'text'     => stripslashes( $transfer_type['name'] ),
				'selected' => $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Unavailable Player Type" select.
	 */
	public function select_unavailable_player_types() {

		global $wpdb;
		$table_name                = $wpdb->prefix . $this->shared->get( 'slug' ) . '_unavailable_player_type';
		$sql                       = "SELECT * FROM $table_name ORDER BY unavailable_player_type_id DESC";
		$unavailable_player_type_a = $wpdb->get_results( $sql, ARRAY_A );

		$result = array();
		foreach ( $unavailable_player_type_a as $key => $unavailable_player_type ) {

			$result[] = array(
				'value'    => $unavailable_player_type['unavailable_player_type_id'],
				'text'     => stripslashes( $unavailable_player_type['name'] ),
				'selected' => $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Trophy Type" select.
	 */
	public function select_trophy_types() {

		global $wpdb;
		$table_name    = $wpdb->prefix . $this->shared->get( 'slug' ) . '_trophy_type';
		$sql           = "SELECT * FROM $table_name ORDER BY trophy_type_id DESC";
		$trophy_type_a = $wpdb->get_results( $sql, ARRAY_A );

		$result = array();
		foreach ( $trophy_type_a as $key => $trophy_type ) {

			$result[] = array(
				'value'    => $trophy_type['trophy_type_id'],
				'text'     => stripslashes( $trophy_type['name'] ),
				'selected' => $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Contracts" select.
	 */
	public function select_contracts() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_contract';
		$sql        = "SELECT * FROM $table_name ORDER BY contract_id DESC";
		$contract_a = $wpdb->get_results( $sql, ARRAY_A );

		$result = array();
		foreach ( $contract_a as $key => $contract ) {

			$result[] = array(
				'value'    => $contract['contract_id'],
				'text'     => stripslashes( $contract['contract_id'] ),
				'selected' => $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Team Contract Type" select.
	 */
	public function select_team_contract_types() {

		global $wpdb;
		$table_name           = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team_contract_type';
		$sql                  = "SELECT * FROM $table_name ORDER BY team_contract_type_id DESC";
		$team_contract_type_a = $wpdb->get_results( $sql, ARRAY_A );

		$result = array();
		foreach ( $team_contract_type_a as $key => $team_contract_type ) {

			$result[] = array(
				'value'    => $team_contract_type['team_contract_type_id'],
				'text'     => stripslashes( $team_contract_type['name'] ),
				'selected' => $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Agency Contract Type" select.
	 */
	public function select_agency_contract_types() {

		global $wpdb;
		$table_name             = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency_contract_type';
		$sql                    = "SELECT * FROM $table_name ORDER BY agency_contract_type_id DESC";
		$agency_contract_type_a = $wpdb->get_results( $sql, ARRAY_A );

		$result = array();
		foreach ( $agency_contract_type_a as $key => $agency_contract_type ) {

			$result[] = array(
				'value'    => $agency_contract_type['agency_contract_type_id'],
				'text'     => stripslashes( $agency_contract_type['name'] ),
				'selected' => $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Citizenship" select.
	 */
	public function select_formations( $none = false ) {

		$result = array();
		if ( $none === true ) {

			$result[] = array(
				'value'    => 0,
				'text'     => __( 'None', 'soccer-engine-lite' ),
				'selected' => true,
			);

		}
		global $wpdb;
		$table_name  = $wpdb->prefix . $this->shared->get( 'slug' ) . '_formation';
		$sql         = "SELECT * FROM $table_name ORDER BY formation_id DESC";
		$formation_a = $wpdb->get_results( $sql, ARRAY_A );

		foreach ( $formation_a as $key => $formation ) {

			$result[] = array(
				'value'    => $formation['formation_id'],
				'text'     => stripslashes( $formation['name'] ),
				'selected' => false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Part" select of the events menu.
	 */
	function select_parts() {

		$result = array();

		$result[] = array(
			'value'    => 0,
			'text'     => __( 'First Half', 'soccer-engine-lite' ),
			'selected' => false,
		);

		$result[] = array(
			'value'    => 1,
			'text'     => __( 'Second Half', 'soccer-engine-lite' ),
			'selected' => false,
		);

		$result[] = array(
			'value'    => 2,
			'text'     => __( 'First Half Extra Time', 'soccer-engine-lite' ),
			'selected' => false,
		);

		$result[] = array(
			'value'    => 3,
			'text'     => __( 'Second Half Extra Time', 'soccer-engine-lite' ),
			'selected' => false,
		);

		$result[] = array(
			'value'    => 4,
			'text'     => __( 'Penalty', 'soccer-engine-lite' ),
			'selected' => false,
		);

		return $result;
	}

	/**
	 * Generates the array used in the "Foot" select of the "Players" menu.
	 */
	public function select_foot() {

		$result = array(
			array(
				'value'    => 0,
				'text'     => __( 'N/A', 'soccer-engine-lite' ),
				'selected' => true,
			),
			array(
				'value'    => 1,
				'text'     => __( 'Left', 'soccer-engine-lite' ),
				'selected' => false,
			),
			array(
				'value'    => 2,
				'text'     => __( 'Right', 'soccer-engine-lite' ),
				'selected' => false,
			),
			array(
				'value'    => 3,
				'text'     => __( 'Both', 'soccer-engine-lite' ),
				'selected' => false,
			),
		);

		return $result;
	}

	/**
	 * Generates the array used in the "Match Effect" select of the "Events" menu.
	 */
	public function select_match_effects() {

		$result = array();

		foreach ( $this->shared->get( 'match_effects' ) as $key => $match_effect ) {

			$result[] = array(
				'value'    => $key,
				'text'     => $match_effect,
				'selected' => false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Competition" select of the "Matches" menu.
	 */
	public function select_competitions( $none = false ) {

		$result = array();
		if ( $none === true ) {

			$result[] = array(
				'value'    => 0,
				'text'     => __( 'None', 'soccer-engine-lite' ),
				'selected' => true,
			);

		}
		global $wpdb;
		$table_name    = $wpdb->prefix . $this->shared->get( 'slug' ) . '_competition';
		$sql           = "SELECT * FROM $table_name ORDER BY competition_id DESC";
		$competition_a = $wpdb->get_results( $sql, ARRAY_A );

		foreach ( $competition_a as $key => $competition ) {

			$result[] = array(
				'value'    => $competition['competition_id'],
				'text'     => stripslashes( $competition['name'] ),
				'selected' => false,
			);

		}

		return $result;
	}

	/**
	 * Generates the array used in the "Match" select of the "Events" menu.
	 */
	public function select_matches() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_match';
		$sql        = "SELECT * FROM $table_name ORDER BY match_id DESC";
		$match_a    = $wpdb->get_results( $sql, ARRAY_A );

		$result = array();
		foreach ( $match_a as $key => $match ) {

			$result[] = array(
				'value'    => $match['match_id'],
				'text'     => stripslashes( $match['name'] ),
				'selected' => $key === 0 ? true : false,
			);

		}

		return $result;
	}

	/**
	 * Return the number of injuries present in the "player_position" db table.
	 *
	 * @return int
	 */
	public function num_of_player_positions() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player_position';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of records present in the "player_award_type" db table.
	 *
	 * @return int The number of player award types.
	 */
	public function num_of_player_award_types() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player_award_type';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of records present in the "player" db table.
	 *
	 * @return int
	 */
	public function num_of_players() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of records present in the "unavailable_player_type" db table.
	 *
	 * @return int
	 */
	public function num_of_unavailable_player_types() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_unavailable_player_type';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of injuries present in the "injury_type" db table.
	 *
	 * @return int
	 */
	public function num_of_injurie_types() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_injury_type';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of records present in the "staff_type" db table.
	 *
	 * @return int
	 */
	public function num_of_staff_types() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff_type';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of records present in the "staff_award_type" db table.
	 *
	 * @return int
	 */
	public function num_of_staff_award_types() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff_award_type';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of records present in the "referee_badge_type" db table.
	 *
	 * @return int
	 */
	public function num_of_referee_badge_types() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee_badge_type';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of records present in the "referee" db table.
	 *
	 * @return int
	 */
	public function num_of_referees() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of records present in the "staff" db table.
	 *
	 * @return int
	 */
	public function num_of_staffs() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of stadiums present in the "stadium" db table.
	 *
	 * @return int
	 */
	public function num_of_stadiums() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_stadium';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of records present in the "team" db table.
	 *
	 * @return int
	 */
	public function num_of_teams() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of records present in the "trophy_type" db table.
	 *
	 * @return int
	 */
	public function num_of_trophy_types() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_trophy_type';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Returns the number of records present in the "ranking_type" db table.
	 *
	 * @return int
	 */
	public function num_of_ranking_types() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_ranking_type';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of records present in the "competition" db table.
	 *
	 * @return int
	 */
	public function num_of_competitions() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_competition';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of records present in the "formation" db table.
	 *
	 * @return int
	 */
	public function num_of_formations() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_formation';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of injuries present in the "transfer_type" db table.
	 *
	 * @return int
	 */
	public function num_of_transfer_types() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_transfer_type';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of records present in the "team_contract_type" db table.
	 *
	 * @return int
	 */
	public function num_of_team_contract_types() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team_contract_type';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of records present in the "agency_contract_type" db table.
	 *
	 * @return int
	 */
	public function num_of_agency_contract_types() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency_contract_type';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}

	/**
	 * Return the number of records present in the "agencies" db table.
	 *
	 * @return int
	 */
	public function num_of_agencies() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency';
		$sql        = "SELECT COUNT(*) FROM $table_name";
		$user_count = $wpdb->get_var( $sql );

		return intval( $user_count, 10 );
	}
}
