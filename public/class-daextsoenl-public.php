<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package soccer-engine-lite
 */

/*
 * This class should be used to work with the public side of WordPress.
 */

class Daextsoenl_Public {

	// general class properties
	protected static $instance = null;
	private $shared            = null;

	private function __construct() {

		// Assign an instance of Daextsoenl_Shared.
		$this->shared = Daextsoenl_Shared::get_instance();

		// Load public css.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

		// Load public js.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// shortcodes.
		add_shortcode( 'se-transfers', array( $this, 'transfers' ) );
		add_shortcode( 'se-team-contracts', array( $this, 'team_contracts' ) );
		add_shortcode( 'se-agency-contracts', array( $this, 'agency_contracts' ) );
		add_shortcode( 'se-players', array( $this, 'players' ) );
		add_shortcode( 'se-player-awards', array( $this, 'player_awards' ) );
		add_shortcode( 'se-unavailable-players', array( $this, 'unavailable_players' ) );
		add_shortcode( 'se-injuries', array( $this, 'injuries' ) );
		add_shortcode( 'se-staff', array( $this, 'staff' ) );
		add_shortcode( 'se-staff-awards', array( $this, 'staff_awards' ) );
		add_shortcode( 'se-trophies', array( $this, 'trophies' ) );
		add_shortcode( 'se-matches', array( $this, 'matches' ) );
		add_shortcode( 'se-ranking-transitions', array( $this, 'ranking_transitions' ) );
		add_shortcode( 'se-market-value-transitions', array( $this, 'market_value_transitions' ) );
		add_shortcode( 'se-match-commentary', array( $this, 'match_commentary' ) );
		add_shortcode( 'se-match-lineup', array( $this, 'match_lineup' ) );
		add_shortcode( 'se-match-visual-lineup', array( $this, 'match_visual_lineup' ) );
		add_shortcode( 'se-match-substitutions', array( $this, 'match_substitutions' ) );
		add_shortcode( 'se-match-staff', array( $this, 'match_staff' ) );
		add_shortcode( 'se-squad-lineup', array( $this, 'squad_lineup' ) );
		add_shortcode( 'se-squad-substitutions', array( $this, 'squad_substitutions' ) );
		add_shortcode( 'se-squad-staff', array( $this, 'squad_staff' ) );
		add_shortcode( 'se-competition-standings-table', array( $this, 'competition_standings_table' ) );
		add_shortcode( 'se-competition-round', array( $this, 'competition_round' ) );
		add_shortcode( 'se-match-score', array( $this, 'match_score' ) );
		add_shortcode( 'se-player-summary', array( $this, 'player_summary' ) );
		add_shortcode( 'se-staff-summary', array( $this, 'staff_summary' ) );
		add_shortcode( 'se-referee-summary', array( $this, 'referee_summary' ) );
	}

	/**
	 * Creates an instance of this class.
	 */
	public static function get_instance() {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	// Load public css.
	public function enqueue_styles() {

		// Adds the Google Fonts if they are defined in the "Google Font URL" option.
		if ( strlen( trim( get_option( $this->shared->get( 'slug' ) . '_google_font_url' ) ) ) > 0 ) {
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-google-font',
				esc_url( get_option( $this->shared->get( 'slug' ) . '_google_font_url' ) ),
				false
			);
		}

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-general',
			$this->shared->get( 'url' ) . 'public/assets/css/general.css',
			array(),
			$this->shared->get( 'ver' )
		);

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-paginated-table',
			$this->shared->get( 'url' ) . 'public/assets/css/paginated-table.css',
			array(),
			$this->shared->get( 'ver' )
		);

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-match-commentary',
			$this->shared->get( 'url' ) . 'public/assets/css/match-commentary.css',
			array(),
			$this->shared->get( 'ver' )
		);

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-match-score',
			$this->shared->get( 'url' ) . 'public/assets/css/match-score.css',
			array(),
			$this->shared->get( 'ver' )
		);

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-match-visual-lineup',
			$this->shared->get( 'url' ) . 'public/assets/css/match-visual-lineup.css',
			array(),
			$this->shared->get( 'ver' )
		);

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-person-summary',
			$this->shared->get( 'url' ) . 'public/assets/css/person-summary.css',
			array(),
			$this->shared->get( 'ver' )
		);

		$upload_dir_data = wp_upload_dir();
		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-custom',
			$upload_dir_data['baseurl'] . '/daextsoenl_uploads/custom-' . get_current_blog_id() . '.css',
			array(),
			$this->shared->get( 'ver' )
		);
	}

	// Load public js.
	public function enqueue_scripts() {

		// Generate the array that will be passed to wp_localize_script().
		$php_data = array(
			'nonce'   => wp_create_nonce( 'daextsoenl' ),
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		);

		// Paginated Table Utility.
		wp_enqueue_script(
			$this->shared->get( 'slug' ) . '-paginated-table',
			$this->shared->get( 'url' ) . 'public/assets/js/paginated-table-class.js',
			array(),
			$this->shared->get( 'ver' ),
			true
		);

		// Event Tooltip Handler.
		wp_enqueue_script(
			$this->shared->get( 'slug' ) . '-event-tooltip-handler',
			$this->shared->get( 'url' ) . 'public/assets/js/event-tooltip-handler.js',
			array(),
			$this->shared->get( 'ver' ),
			true
		);

		// Match Visual Lineup.
		wp_enqueue_script(
			$this->shared->get( 'slug' ) . '-match-visual-lineup',
			$this->shared->get( 'url' ) . 'public/assets/js/match-visual-lineup.js',
			array(),
			$this->shared->get( 'ver' ),
			true
		);

		// Make a series of useful PHP data available to the JavaScript part in the DAEXTSOENL_PHPDATA object.
		wp_localize_script( $this->shared->get( 'slug' ) . '-paginated-table', 'DAEXTSOENL_PHPDATA', $php_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Transfers" blocks and is also the
	 * callback of the [transfers] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function transfers( $atts ) {

		// Set the default values if needed.
		$atts = shortcode_atts(
			array(
				'player-id'                   => 0,
				'transfer-type-id'            => 0,
				'team-id-left'                => 0,
				'team-id-joined'              => 0,
				'start-date'                  => '',
				'end-date'                    => '',
				'fee-lower-limit'             => 0,
				'fee-higher-limit'            => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'transfers';
		$table_data['filter']                      = array();
		$table_data['filter']['player_id']         = intval( $atts['player-id'], 10 );
		$table_data['filter']['transfer_type_id']  = intval( $atts['transfer-type-id'], 10 );
		$table_data['filter']['team_id_left']      = intval( $atts['team-id-left'], 10 );
		$table_data['filter']['team_id_joined']    = intval( $atts['team-id-joined'], 10 );
		$table_data['filter']['start_date']        = sanitize_key( $atts['start-date'] );
		$table_data['filter']['end_date']          = sanitize_key( $atts['end-date'] );
		$table_data['filter']['fee_lower_limit']   = intval( $atts['fee-lower-limit'], 10 );
		$table_data['filter']['fee_higher_limit']  = intval( $atts['fee-higher-limit'], 10 );
		$table_data['columns']                     = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'], 10 );

		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Players" blocks and is also the
	 * callback of the [players] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function players( $atts ) {

		// Set the default values if needed.
		$atts = shortcode_atts(
			array(
				'start-date-of-birth'         => '',
				'end-date-of-birth'           => '',
				'citizenship'                 => '',
				'foot'                        => '',
				'player-position-id'          => '',
				'squad-id'                    => '',
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                  = array();
		$table_data['table_name']                    = 'players';
		$table_data['filter']                        = array();
		$table_data['filter']['start_date_of_birth'] = sanitize_key( $atts['start-date-of-birth'] );
		$table_data['filter']['end_date_of_birth']   = sanitize_key( $atts['end-date-of-birth'] );
		$table_data['filter']['citizenship']         = sanitize_text_field( $atts['citizenship'] );
		$table_data['filter']['foot']                = sanitize_text_field( $atts['foot'] );
		$table_data['filter']['player_position_id']  = intval( $atts['player-position-id'], 10 );
		$table_data['filter']['squad_id']            = intval( $atts['squad-id'], 10 );
		$table_data['columns']                       = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1']   = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2']   = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                    = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Player Awards" blocks and is also the
	 * callback of the [player-awards] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function player_awards( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'player-award-type-id'        => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                   = array();
		$table_data['table_name']                     = 'player_awards';
		$table_data['filter']                         = array();
		$table_data['filter']['player_award_type_id'] = intval( $atts['player-award-type-id'], 10 );
		$table_data['columns']                        = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1']    = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2']    = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                     = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Unavailable Players" blocks and is
	 * also the callback of the [unavailable-players] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function unavailable_players( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'player-id'                   => 0,
				'unavailable-player-type-id'  => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                        = array();
		$table_data['table_name']          = 'unavailable_player';
		$table_data['filter']              = array();
		$table_data['filter']['player_id'] = intval( $atts['player-id'], 10 );
		$table_data['filter']['unavailable_player_type_id'] = intval( $atts['unavailable-player-type-id'], 10 );
		$table_data['columns']                              = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1']          = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2']          = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                           = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Injuries" blocks and is also the
	 * callback of the [injuries] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function injuries( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'player-id'                   => 0,
				'injury-type-id'              => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'injuries';
		$table_data['filter']                      = array();
		$table_data['filter']['player_id']         = intval( $atts['player-id'], 10 );
		$table_data['filter']['injury_type_id']    = intval( $atts['injury-type-id'], 10 );
		$table_data['columns']                     = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Staff" blocks and is also the
	 * callback of the [staff] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function staff( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'staff-type-id'               => 0,
				'retired'                     => 0,
				'gender'                      => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'staff';
		$table_data['filter']                      = array();
		$table_data['filter']['staff_type_id']     = intval( $atts['staff-type-id'], 10 );
		$table_data['filter']['retired']           = intval( $atts['retired'], 10 );
		$table_data['filter']['gender']            = intval( $atts['gender'], 10 );
		$table_data['columns']                     = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Staff Awards" blocks and is also the
	 * callback of the [staff-awards] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function staff_awards( $atts ) {

		// Set the default values if needed.
		$atts = shortcode_atts(
			array(
				'staff-award-type-id'         => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                  = array();
		$table_data['table_name']                    = 'staff_award';
		$table_data['filter']                        = array();
		$table_data['filter']['staff_award_type_id'] = intval( $atts['staff-award-type-id'], 10 );
		$table_data['columns']                       = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1']   = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2']   = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                    = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Trophies" blocks and is also the
	 * callback of the [trophies] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function trophies( $atts ) {

		// Set the default values if needed.
		$atts = shortcode_atts(
			array(
				'trophy-type-id'              => 0,
				'team-id'                     => 0,
				'start-assignment-date'       => '',
				'end-assignment-date'         => '',
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                    = array();
		$table_data['table_name']                      = 'trophy';
		$table_data['filter']                          = array();
		$table_data['filter']['trophy_type_id']        = intval( $atts['trophy-type-id'], 10 );
		$table_data['filter']['team_id']               = intval( $atts['team-id'], 10 );
		$table_data['filter']['start_assignment_date'] = sanitize_key( $atts['start-assignment-date'] );
		$table_data['filter']['end_assignment_date']   = sanitize_key( $atts['end-assignment-date'] );
		$table_data['columns']                         = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1']     = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2']     = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                      = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Team Contracts" blocks and is also
	 * the callback of the [team-contracts] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function team_contracts( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'team-id'                     => 0,
				'team-contract-type-id'       => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                    = array();
		$table_data['table_name']                      = 'team_contract';
		$table_data['filter']                          = array();
		$table_data['filter']['team_id']               = intval( $atts['team-id'], 10 );
		$table_data['filter']['team_contract_type_id'] = intval( $atts['team-contract-type-id'], 10 );
		$table_data['columns']                         = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1']     = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2']     = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                      = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Agency Contracts" blocks and is
	 * also the callback of the [agency-contracts] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function agency_contracts( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'agency-id'                   => 0,
				'agency-contract-type-id'     => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                      = array();
		$table_data['table_name']                        = 'agency_contract';
		$table_data['filter']                            = array();
		$table_data['filter']['agency_id']               = intval( $atts['agency-id'], 10 );
		$table_data['filter']['agency_contract_type_id'] = intval( $atts['agency-contract-type-id'], 10 );
		$table_data['columns']                           = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1']       = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2']       = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                        = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Market Value Transitions" blocks and
	 * is also the callback of the [market-value-transitions] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function market_value_transitions( $atts ) {

		// Set the default values if needed.
		$atts = shortcode_atts(
			array(
				'player-id'                   => 0,
				'start-date'                  => '',
				'end-date'                    => '',
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'market_value_transition';
		$table_data['filter']['player_id']         = intval( $atts['player-id'], 10 );
		$table_data['filter']['start_date']        = sanitize_key( $atts['start-date'] );
		$table_data['filter']['end_date']          = sanitize_key( $atts['end-date'] );
		$table_data['columns']                     = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Ranking Transitions" blocks and is
	 * also the callback of the [ranking-transitions] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function ranking_transitions( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'team-id'                     => 0,
				'ranking-type-id'             => 0,
				'start-date'                  => '',
				'end-date'                    => '',
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'ranking_transition';
		$table_data['filter']                      = array();
		$table_data['filter']['team_id']           = intval( $atts['team-id'], 10 );
		$table_data['filter']['ranking_type_id']   = intval( $atts['ranking-type-id'], 10 );
		$table_data['filter']['start_date']        = sanitize_key( $atts['start-date'] );
		$table_data['filter']['end_date']          = sanitize_key( $atts['end-date'] );
		$table_data['columns']                     = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Matches" blocks and is also the
	 * callback of the [matches] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function matches( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'team-id-1'                   => 0,
				'team-id-2'                   => 0,
				'start-date'                  => '',
				'end-date'                    => '',
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'match';
		$table_data['filter']                      = array();
		$table_data['filter']['team_id_1']         = intval( $atts['team-id-1'], 10 );
		$table_data['filter']['team_id_2']         = intval( $atts['team-id-2'], 10 );
		$table_data['filter']['start_date']        = sanitize_key( $atts['start-date'] );
		$table_data['filter']['end_date']          = sanitize_key( $atts['end-date'] );
		$table_data['columns']                     = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Match Lineup" blocks and is also the
	 * callback of the [match-lineup] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function match_lineup( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'match-id'                    => 0,
				'team-slot'                   => 1,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'match_lineup';
		$table_data['filter']                      = array();
		$table_data['filter']['match_id']          = intval( $atts['match-id'], 10 );
		$table_data['filter']['team_slot']         = intval( $atts['team-slot'], 10 );
		$table_data['columns']                     = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Match Substitutions" blocks and is
	 * also the callback of the [match-substitutions] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function match_substitutions( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'match-id'                    => 0,
				'team-slot'                   => 1,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'match_substitutions';
		$table_data['filter']                      = array();
		$table_data['filter']['match_id']          = intval( $atts['match-id'], 10 );
		$table_data['filter']['team_slot']         = intval( $atts['team-slot'], 10 );
		$table_data['columns']                     = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Match Staff" blocks and is also the
	 * callback of the [match-staff] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function match_staff( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'match-id'                    => 0,
				'team-slot'                   => 1,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'match_staff';
		$table_data['filter']                      = array();
		$table_data['filter']['match_id']          = intval( $atts['match-id'], 10 );
		$table_data['filter']['team_slot']         = intval( $atts['team-slot'], 10 );
		$table_data['columns']                     = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Competition Standings Table" blocks
	 * and is also the callback of the [competition-standings-table] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function competition_standings_table( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'competition-id'              => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'competition_standings_table';
		$table_data['filter']                      = array();
		$table_data['filter']['competition_id']    = intval( $atts['competition-id'], 10 );
		$table_data['columns']                     = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Competition Round" blocks and is
	 * also the callback of the [competition-round] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function competition_round( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'competition-id'              => 0,
				'round'                       => 0,
				'type'                        => 0,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'competition_round';
		$table_data['filter']                      = array();
		$table_data['filter']['competition_id']    = intval( $atts['competition-id'], 10 );
		$table_data['filter']['round']             = intval( $atts['round'], 10 );
		$table_data['filter']['type']              = intval( $atts['type'], 10 );
		$table_data['columns']                     = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Match Score" blocks and is also the
	 * callback of the [match-score] shortcode.
	 *
	 * Returns the HTML of match score.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function match_score( $atts ) {

		// If a transient is available return the transient.
		$transient_name = 'daextsoenl_' . hash( 'sha512', json_encode( __FUNCTION__ . json_encode( $atts ) ) );
		$data           = get_transient( $transient_name );
		if ( $data !== false ) {
			return $data; }

		// get the data.
		$atts     = shortcode_atts(
			array(
				'match-id' => 0,
			),
			$atts
		);
		$match_id = intval( $atts['match-id'], 10 );

		// Get match.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d", $match_id );
		$match_obj  = $wpdb->get_row( $safe_sql );

		if ( null === $match_obj ) {
			return '<p class="daextsoenl-no-data-paragraph">' . esc_html__( 'There are no data associated with your selection.', 'soccer-engine-lite' ) . '</p>';
		}

		// Competition image and name.
		if ( $match_obj->competition_id > 0 ) {
			$competition_turn_name = $this->shared->get_competition_turn( $match_obj->match_id );
			$competition_turn_type = $this->shared->get_competition_turn_type( $match_obj->match_id );
		} else {
			$competition_turn_name = '';
			$competition_turn_type = '';
		}

		// Team 1 logo.
		$team_1_logo_url = $this->shared->get_team_logo_url( $match_obj->team_id_1 );

		// Team 1 name.
		$team_1_name = $this->shared->get_team_name( $match_obj->team_id_1 );

		// Team 1 position (only if it's the match of round robin competition).
		$team_1_position = $this->shared->get_team_position_in_competition( $match_obj->team_id_1, $match_obj->competition_id );

		// Team 2 logo.
		$team_2_logo_url = $this->shared->get_team_logo_url( $match_obj->team_id_2 );

		// Team 2 name.
		$team_2_name = $this->shared->get_team_name( $match_obj->team_id_2 );

		// Team 2 position (only if it's the match of round-robin competition).
		$team_2_position = $this->shared->get_team_position_in_competition( $match_obj->team_id_2, $match_obj->competition_id );

		// Round of the competition.
		$competition_round = $match_obj->round;

		// Date of the match.
		$match_date = date( 'D, M j, Y', strtotime( $match_obj->date ) );

		// Time of the match.
		$match_time = date( 'g:i A', strtotime( $match_obj->time ) );

		// Match result.
		$match_result = $this->shared->get_match_result( $match_obj->match_id );

		// Name of the stadium.
		$stadium_name = $this->shared->get_stadium_name( $match_obj->stadium_id );

		// Number of attendance.
		$match_attendance = number_format( $match_obj->attendance, 0, ',', '.' );

		// Name of the referee.
		$match_referee = $this->shared->get_referee_name( $match_obj->referee_id );

		// Additional info 1.
		$additional_info_1 = '';
		if ( strlen( $competition_turn_name ) > 0 && strlen( $competition_round ) > 0 ) {
			$additional_info_1 = $competition_turn_name . ' ' . intval( $competition_round, 10 ) . ' ';
		if ( false !== $competition_turn_type ) {
				$additional_info_1 .= '(' . $competition_turn_type . ') |';
			}
		}
		$additional_info_1 .= $match_date . ' | ' . $match_time;

		ob_start();

		?>

		<div class="daextsoenl-match-score">

			<div class="daextsoenl-match-score-header"><?php esc_html_e( 'Match Score', 'soccer-engine-lite' ); ?></div>
			<div class="daextsoenl-match-score-body">
				<div class="daextsoenl-match-score-body-team-1">
					<div class="daextsoenl-match-score-body-team-1-logo">
						<?php if ( strlen( $team_1_logo_url ) > 0 ) : ?>
							<?php echo '<img src="' . esc_url( stripslashes( $team_1_logo_url ) ) . '">'; ?>
						<?php else : ?>
							<?php echo $this->shared->get_default_team_logo_svg(); ?>
						<?php endif; ?>
					</div>
					<div class="daextsoenl-match-score-body-team-1-details">
						<div class="daextsoenl-match-score-body-team-1-name">
							<?php esc_html_e( stripslashes( $team_1_name ) ); ?>
						</div>
						<?php if ( $team_1_position !== false ) : ?>
							<div class="daextsoenl-match-score-body-team-1-position">
								<?php echo esc_html__( 'Position:', 'soccer-engine-lite' ) . ' ' . intval( $team_1_position, 10 ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="daextsoenl-match-score-body-center">
					<div class="daextsoenl-match-score-body-info"><?php echo esc_html( $additional_info_1 ); ?></div>
					<div class="daextsoenl-match-score-body-result">
						<div class="daextsoenl-match-score-body-match-result"><?php echo esc_html( $match_result ); ?></div>
					</div>
					<div class="daextsoenl-match-score-body-additional-info">
						<?php

						if ( $stadium_name !== false and $match_attendance !== 0 ) {
							$separator = '| ';
						} else {
							$separator = '';
						}

						?>
						<div class="daextsoenl-match-score-body-additional-info-stadium-attendance"><?php echo $stadium_name !== false ? esc_html( $stadium_name ) : ''; ?> <?php echo intval( $match_attendance, 10 ) !== 0 ? $separator . esc_html__( 'Attendance', 'soccer-engine-lite' ) . ': ' . esc_html( $match_attendance ) : ''; ?></div>
						<div class="daextsoenl-match-score-body-additional-info-referee"><?php echo $match_referee !== false ? esc_html__( 'Referee', 'soccer-engine-lite' ) . ': ' . esc_html( $match_referee ) : ''; ?></div>
					</div>
				</div>
				<div class="daextsoenl-match-score-body-team-2">
					<div class="daextsoenl-match-score-body-team-2-logo">
						<div class="daextsoenl-match-score-body-team-2-logo">
							<?php if ( strlen( $team_2_logo_url ) > 0 ) : ?>
								<?php echo '<img src="' . esc_url( stripslashes( $team_2_logo_url ) ) . '">'; ?>
							<?php else : ?>
								<?php echo $this->shared->get_default_team_logo_svg(); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="daextsoenl-match-score-body-team-2-details">
						<div class="daextsoenl-match-score-body-team-2-name">
							<?php esc_attr_e( stripslashes( $team_2_name ) ); ?>
						</div>
						<?php if ( $team_2_position !== false ) : ?>
							<div class="daextsoenl-match-score-body-team-2-position">
								<?php echo esc_html__( 'Position', 'soccer-engine-lite' ) . ': ' . intval( $team_2_position, 10 ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

		</div>

		<?php

		$data = ob_get_clean();
		$this->shared->set_transient_based_on_settings( $transient_name, $data );
		return $data;
	}

	/**
	 * Returns the HTML of the visual lineup of a team with the related substitutes.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function match_visual_lineup( $atts ) {

		// If a transient is available return the transient.
		$transient_name = 'daextsoenl_' . hash( 'sha512', json_encode( __FUNCTION__ . json_encode( $atts ) ) );
		$data           = get_transient( $transient_name );
		if ( false !== $data ) {
			return $data; }

		// Get the data.
		$atts      = shortcode_atts(
			array(
				'match-id'  => 0,
				'team-slot' => 1,
			),
			$atts
		);
		$match_id  = intval( $atts['match-id'], 10 );
		$team_slot = intval( $atts['team-slot'], 10 );

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d", $match_id );
		$match_obj  = $wpdb->get_row( $safe_sql );

		if ( null === $match_obj ) {
			return '<p class="daextsoenl-no-data-paragraph">' . esc_html__( 'There are no data associated with your selection.', 'soccer-engine-lite' ) . '</p>';
		}

		ob_start();

		$team_obj = $this->shared->get_team_obj( $match_obj->{'team_id_' . $team_slot} );

		?>

		<div class="daextsoenl-match-visual-lineup">

			<div class="daextsoenl-match-visual-lineup-left">

				<div class="daextsoenl-match-visual-lineup-left-header">

					<?php

					$string_part = '';
					if ( intval( $match_obj->{'team_' . $team_slot . '_formation_id'}, 10 ) > 0 ) {
						$string_part = ': ' . $this->shared->get_formation_name( $match_obj->{'team_' . $team_slot . '_formation_id'} );
					}
					echo esc_html( __( 'Starting Lineup', 'soccer-engine-lite' ) . esc_html( $string_part ) );

					?>

				</div>

				<div class="daextsoenl-match-visual-lineup-left-formation">

					<div class="daextsoenl-match-visual-lineup-left-formation-image">
						<?php echo $this->shared->get_field_svg(); ?>
					</div>

					<?php

					for ( $i = 1;$i <= 11;$i++ ) {

						$player_id  = $match_obj->{'team_' . $team_slot . '_lineup_player_id_' . $i};
						$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player';
						$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d", $player_id );
						$player_obj = $wpdb->get_row( $safe_sql );

						?>

						<?php if ( null !== $player_obj ) : ?>

							<?php

							// Get the x and y position of the player in the field
							$player_position = $this->shared->get_player_position( $i, $match_obj->{'team_' . $team_slot . '_formation_id'} );

							?>

							<div class="daextsoenl-match-visual-lineup-left-formation-player-container" style="left: <?php echo esc_attr( $player_position['x'] ); ?>%;top: <?php echo esc_attr( $player_position['y'] ); ?>%;" data-position-x="<?php echo esc_attr( $player_position['x'] ); ?>" data-position-y="<?php echo esc_attr( $player_position['y'] ); ?>">

								<div class="daextsoenl-match-visual-lineup-left-formation-player-jersey-number">

									<?php echo esc_html( $this->shared->get_player_jersey_number_in_match( $player_obj->player_id, $match_id, $team_slot ) ); ?>

								</div>

								<div class="daextsoenl-match-visual-lineup-left-formation-player-name">

									<?php echo esc_html( stripslashes( $player_obj->last_name ) ); ?>

								</div>

							</div>

							<?php echo $this->shared->get_player_events_icons( $player_obj->player_id, $match_id ); ?>

						<?php endif; ?>

						<?php

					}

					?>

				</div>

			</div>

			<div class="daextsoenl-match-visual-lineup-right">

				<div class="daextsoenl-match-visual-lineup-right-header">

					<?php esc_html_e( 'Substitutes', 'soccer-engine-lite' ); ?>

				</div>

				<table class="daextsoenl-match-visual-lineup-right-table">

					<tbody>
					<?php

					// Substitutes ------------------------------------------------------------------------------------.
					for ( $i = 1;$i <= 20;$i++ ) {

						$player_id  = $match_obj->{'team_' . $team_slot . '_substitute_player_id_' . $i};
						$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player';
						$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d", $player_id );
						$player_obj = $wpdb->get_row( $safe_sql );

						if ( null !== $player_obj ) {
							?>

							<tr>
								<td><?php echo esc_attr( $this->shared->get_player_jersey_number_in_match( $player_obj->player_id, $match_id, $team_slot ) ); ?></td>
								<td>
									<div class="daextsoenl-match-visual-lineup-right-table-player">
										<div class="daextsoenl-match-visual-lineup-right-table-player-name"><?php echo esc_html( $this->shared->get_player_name( $player_obj->player_id ) ); ?></div>
										<div class="daextsoenl-match-visual-lineup-right-table-events-container">
											<?php echo $this->shared->get_player_events_icons( $player_obj->player_id, $match_id ); ?>
										</div>
									</div>
								</td>
								<td><?php echo $this->shared->get_player_position_abbreviation( $this->shared->get_player_position_id( $player_obj->player_id ) ); ?></td>
							</tr>

							<?php
						}
					}

					// Staff ------------------------------------------------------------------------------------------.
					for ( $i = 1;$i <= 20;$i++ ) {

						$staff_id   = $match_obj->{'team_' . $team_slot . '_staff_id_' . $i};
						$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff';
						$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE staff_id = %d", $staff_id );
						$staff_obj  = $wpdb->get_row( $safe_sql );

						if ( $staff_obj !== null ) {
							?>

							<tr>
								<td colspan="3">
									<div class="daextsoenl-match-visual-lineup-right-table-staff">
										<div class="daextsoenl-match-visual-lineup-right-table-staff-type"><?php echo esc_html( $this->shared->get_staff_type_name( $staff_obj->staff_type_id ) ); ?>:&nbsp;</div>
										<div class="daextsoenl-match-visual-lineup-right-table-staff-name"><?php echo esc_html( $this->shared->get_staff_name( $staff_obj->staff_id ) ); ?></div>
										<div class="daextsoenl-match-visual-lineup-right-table-events-container"><?php echo $this->shared->get_staff_events_icons( $staff_obj->staff_id, $match_id ); ?></div>
									</div>
								</td>


								</div>
							</tr>

							<?php
						}
					}

					?>

					</tbody>

				</table>

			</div>

		</div>

		<?php

		$data = ob_get_clean();
		$this->shared->set_transient_based_on_settings( $transient_name, $data );
		return $data;
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Match Commentary" blocks and is also the
	 * callback of the [match-commentary] shortcode.
	 *
	 * Returns the HTML of the match commentary.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function match_commentary( $atts ) {

		// If a transient is available return the transient.
		$transient_name = 'daextsoenl_' . hash( 'sha512', json_encode( __FUNCTION__ . json_encode( $atts ) ) );
		$data           = get_transient( $transient_name );
		if ( false !== $data ) {
			return $data; }

		// Get the data.
		$atts     = shortcode_atts(
			array(
				'match-id' => 0,
			),
			$atts
		);
		$match_id = intval( $atts['match-id'], 10 );

		// Get event.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_event';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d AND data = 1 ORDER BY part DESC, time DESC, additional_time DESC, event_id DESC", $match_id );
		$event_a    = $wpdb->get_results( $safe_sql, ARRAY_A );

		if ( 0 === count( $event_a ) ) {
			return '<p class="daextsoenl-no-data-paragraph">' . esc_html__( 'There are no data associated with your selection.', 'soccer-engine-lite' ) . '</p>';
		}

		ob_start();

		?>

		<div class="daextsoenl-match-commentary">

			<div class="daextsoenl-match-commentary-title"><?php esc_html_e( 'Match Commentary', 'soccer-engine-lite' ); ?></div>

			<div class="daextsoenl-match-commentary-content">

			<?php

			foreach ( $event_a as $key => $event ) {

				// Init vars.
				$image  = null;
				$row_1  = null;
				$row_2  = null;
				$row_3  = null;
				$minute = $this->shared->get_time_format_120( $event['time'], $event['part'] );

				?>

				<div class="daextsoenl-match-commentary-row">

					<div class="daextsoenl-match-commentary-event-time">
						<div class="daextsoenl-match-commentary-event-time-container">
							<div class="daextsoenl-match-commentary-event-time-top">
								<?php echo intval( $minute, 10 ) . '′'; ?>
								<?php if ( intval( $event['additional_time'], 10 ) > 0 ) : ?>
									<?php echo '+&nbsp;' . intval( $event['additional_time'], 10 ) . '′'; ?>
								<?php endif; ?>
							</div>
							<div class="daextsoenl-match-commentary-event-time-bottom">
								<?php

								if ( $event['match_effect'] > 0 ) {
									echo $this->shared->get_event_icon_html( $event['match_effect'] );
								}

								?>
							</div>
						</div>
					</div>

					<div class="daextsoenl-match-commentary-event-data">

						<?php if ( intval( $event['match_effect'], 10 ) !== 0 ) : ?>

							<div class="daextsoenl-match-commentary-event-details daextsoenl-clearfix">

								<?php

								switch ( $event['match_effect'] ) {

									// Goal.
									case 1:
										$image = $this->shared->get_player_image( $event['player_id'] );
										$row_1 = $this->shared->get_match_result( $match_id, 'text', $event['time'] );
										$row_2 = __( 'Goal for', 'soccer-engine-lite' ) . ' ' . $this->shared->get_team_name( $this->shared->get_team_of_event( $event['event_id'] ) );
										$row_3 = $this->shared->get_player_name( $event['player_id'] );
										break;

									// Yellow Card.
									case 2:
										if ( intval( $event['player_id'], 10 ) !== 0 ) {
											$image = $this->shared->get_player_image( $event['player_id'] );
										} else {
											$image = $this->shared->get_staff_image( $event['staff_id'] );
										}
										$row_1 = __( 'Yellow Card', 'soccer-engine-lite' );
										$row_2 = __( 'Yellow Card for', 'soccer-engine-lite' ) . ' ' . $this->shared->get_team_name( $this->shared->get_team_of_event( $event['event_id'] ) );
										if ( intval( $event['player_id'], 10 ) !== 0 ) {
											$row_3 = $this->shared->get_player_name( $event['player_id'] );
										} else {
											$row_3 = $this->shared->get_staff_name( $event['staff_id'] );
										}
										break;

									// Red Card.
									case 3:
										if ( intval( $event['player_id'], 10 ) !== 0 ) {
											$image = $this->shared->get_player_image( $event['player_id'] );
										} else {
											$image = $this->shared->get_staff_image( $event['staff_id'] );
										}
										$row_1 = __( 'Red Card', 'soccer-engine-lite' );
										$row_2 = __( 'Red Card for', 'soccer-engine-lite' ) . ' ' . $this->shared->get_team_name( $this->shared->get_team_of_event( $event['event_id'] ) );
										if ( intval( $event['player_id'], 10 ) !== 0 ) {
											$row_3 = $this->shared->get_player_name( $event['player_id'] );
										} else {
											$row_3 = $this->shared->get_staff_name( $event['staff_id'] );
										}
										break;

									// Substitution.
									case 4:
										$image = $this->shared->get_player_image( $event['player_id_substitution_in'] );
										$row_1 = __( 'Substitution', 'soccer-engine-lite' );
										$row_2 = $this->shared->get_player_name( $event['player_id_substitution_in'] );
										$row_3 = __( 'For', 'soccer-engine-lite' ) . ' ' . $this->shared->get_player_name( $event['player_id_substitution_out'] );
										break;

								}

								?>

								<?php if ( null !== $image && null !== $row_1 && null !== $row_2 && null !== $row_3 ) : ?>
									<div class="daextsoenl-match-commentary-event-details-left"><?php echo $image; ?></div>
									<div class="daextsoenl-match-commentary-event-details-right">
										<div class="daextsoenl-match-commentary-event-details-row daextsoenl-match-commentary-event-details-row-1"><?php echo esc_html( $row_1 ); ?></div>
										<div class="daextsoenl-match-commentary-event-details-row daextsoenl-match-commentary-event-details-row-2"><?php echo esc_html( $row_2 ); ?></div>
										<div class="daextsoenl-match-commentary-event-details-row daextsoenl-match-commentary-event-details-row-3"><?php echo esc_html( $row_3 ); ?></div>
									</div>
								<?php endif; ?>

							</div>

						<?php endif; ?>

						<div class="daextsoenl-match-commentary-event-description"><?php echo esc_html( stripslashes( $event['description'] ) ); ?></div>

					</div>

				</div>

				<?php

			}

			?>

			</div> <!-- .daextsoenl-match-commentary-content -->

		</div> <!-- .daextsoenl-match-commentary -->

		<?php

		$data = ob_get_clean();
		$this->shared->set_transient_based_on_settings( $transient_name, $data );
		return $data;
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Squad Lineup" blocks and is also the
	 * callback of the [squad-lineup] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function squad_lineup( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'squad-id'                    => 1,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'squad_lineup';
		$table_data['filter']['squad_id']          = intval( $atts['squad-id'], 10 );
		$table_data['columns']                     = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Squad Substitutions" blocks and is also the
	 * callback of the [squad-substitutions] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function squad_substitutions( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'squad-id'                    => 1,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'squad_substitutions';
		$table_data['filter']['squad_id']          = intval( $atts['squad-id'], 10 );
		$table_data['columns']                     = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Squad Staff" blocks and is also the
	 * callback of the [squad-staff] shortcode.
	 *
	 * This function sanitizes the provided data and then returns (by making use of \Daextsoenl_Shared::paginated_table) the
	 * container and the JavaScript instantiation of the paginated table performed with the DaextsoenlPaginatedTable
	 * JavaScript class.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function squad_staff( $atts ) {

		// Set default values if needed.
		$atts = shortcode_atts(
			array(
				'squad-id'                    => 1,
				'columns'                     => array(),
				'hidden-columns-breakpoint-1' => array(),
				'hidden-columns-breakpoint-2' => array(),
				'pagination'                  => 0,
			),
			$atts
		);

		// Assign and sanitize data.
		$table_data                                = array();
		$table_data['table_name']                  = 'squad_staff';
		$table_data['filter']['squad_id']          = intval( $atts['squad-id'], 10 );
		$table_data['columns']                     = $this->shared->prepare_array( $atts['columns'] );
		$table_data['hidden_columns_breakpoint_1'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-1'] );
		$table_data['hidden_columns_breakpoint_2'] = $this->shared->prepare_array( $atts['hidden-columns-breakpoint-2'] );
		$table_data['pagination']                  = intval( $atts['pagination'], 10 );

		// Return the container and the JavaScript instantiation of the paginated table.
		return $this->shared->paginated_table( $table_data );
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Player Summary" blocks and is also the
	 * callback of the [player-summary] shortcode.
	 *
	 * Returns the HTML of the player summary.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 * @throws Exception
	 */
	public function player_summary( $atts ) {

		// If a transient is available return the transient.
		$transient_name = 'daextsoenl_' . hash( 'sha512', json_encode( __FUNCTION__ . json_encode( $atts ) ) );
		$data           = get_transient( $transient_name );
		if ( false !== $data ) {
			return $data; }

		// get the data
		$atts      = shortcode_atts(
			array(
				'player-id' => 1,
			),
			$atts
		);
		$player_id = intval( $atts['player-id'], 10 );

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d", $player_id );
		$player_obj = $wpdb->get_row( $safe_sql );

		if ( $player_obj === null ) {
			return '<p class="daextsoenl-no-data-paragraph">' . esc_html__( 'There are no data associated with your selection.', 'soccer-engine-lite' ) . '</p>';
		}

		$data = array(
			'title'         => __( 'Player Summary', 'soccer-engine-lite' ),
			'image_html'    => $this->shared->get_player_image( $player_obj->player_id ),
			'item_1_field'  => __( 'Name', 'soccer-engine-lite' ),
			'item_1_value'  => $this->shared->get_player_name( $player_obj->player_id ),
			'item_2_field'  => __( 'Date of Birth', 'soccer-engine-lite' ),
			'item_2_value'  => $this->shared->format_date_timestamp( $player_obj->date_of_birth ),
			'item_3_field'  => __( 'Age', 'soccer-engine-lite' ),
			'item_3_value'  => $this->shared->get_player_age( $player_obj->player_id ),
			'item_4_field'  => __( 'Height', 'soccer-engine-lite' ),
			'item_4_value'  => $this->shared->format_player_height( $player_obj->height ),
			'item_5_field'  => __( 'Citizenship', 'soccer-engine-lite' ),
			'item_5_value'  => $this->shared->get_country_name_from_alpha_2_code( $player_obj->citizenship ),
			'item_6_field'  => __( 'Position', 'soccer-engine-lite' ),
			'item_6_value'  => $this->shared->get_player_position_name( $player_obj->player_position_id ),
			'item_7_field'  => __( 'Foot', 'soccer-engine-lite' ),
			'item_7_value'  => $this->shared->format_foot( $player_obj->foot ),
			'item_8_field'  => __( 'Agency', 'soccer-engine-lite' ),
			'item_8_value'  => $this->shared->get_agency_of_player( $player_obj->player_id ),
			'item_9_field'  => __( 'Ownership', 'soccer-engine-lite' ),
			'item_9_value'  => $this->shared->get_team_name( $this->shared->get_player_owner( $player_obj->player_id ) ),
			'item_10_field' => __( 'Contract Expires', 'soccer-engine-lite' ),
			'item_10_value' => $this->shared->format_date_timestamp( $this->shared->get_team_contract_expiration( $player_obj->player_id ) ),
			'item_11_field' => __( 'Current Club', 'soccer-engine-lite' ),
			'item_11_value' => $this->shared->get_player_current_club( $player_obj->player_id ),
			'item_12_field' => __( 'Joined', 'soccer-engine-lite' ),
			'item_12_value' => $this->shared->get_player_current_club_joined_date( $player_obj->player_id ),
		);

		$data = $this->shared->person_summary( $data );
		$this->shared->set_transient_based_on_settings( $transient_name, $data );
		return $data;
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Staff Summary" blocks and is also the
	 * callback of the [staff-summary] shortcode.
	 *
	 * Returns the HTML of the staff summary.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 * @throws Exception
	 */
	public function staff_summary( $atts ) {

		// If a transient is available return the transient.
		$transient_name = 'daextsoenl_' . hash( 'sha512', json_encode( __FUNCTION__ . json_encode( $atts ) ) );
		$data           = get_transient( $transient_name );
		if ( $data !== false ) {
			return $data; }

		// Get the data.
		$atts     = shortcode_atts(
			array(
				'staff-id' => 1,
			),
			$atts
		);
		$staff_id = intval( $atts['staff-id'], 10 );

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE staff_id = %d", $staff_id );
		$staff_obj  = $wpdb->get_row( $safe_sql );

		if ( $staff_obj === null ) {
			return '<p class="daextsoenl-no-data-paragraph">' . esc_html__( 'There are no data associated with your selection.', 'soccer-engine-lite' ) . '</p>';
		}

		$data = array(
			'title'         => __( 'Staff Summary', 'soccer-engine-lite' ),
			'image_html'    => $this->shared->get_staff_image( $staff_obj->staff_id ),
			'item_1_field'  => __( 'Name', 'soccer-engine-lite' ),
			'item_1_value'  => $this->shared->get_staff_name( $staff_obj->staff_id ),
			'item_2_field'  => __( 'Date of Birth', 'soccer-engine-lite' ),
			'item_2_value'  => $this->shared->format_date_timestamp( $staff_obj->date_of_birth ),
			'item_3_field'  => __( 'Age', 'soccer-engine-lite' ),
			'item_3_value'  => $this->shared->get_staff_age( $staff_obj->staff_id ),
			'item_4_field'  => __( 'Citizenship', 'soccer-engine-lite' ),
			'item_4_value'  => $this->shared->get_country_name_from_alpha_2_code( $staff_obj->citizenship ),
			'item_5_field'  => __( 'Staff Type', 'soccer-engine-lite' ),
			'item_5_value'  => $this->shared->get_staff_type_name( $staff_obj->staff_type_id ),
			'item_6_field'  => __( 'Preferred Formation', 'soccer-engine-lite' ),
			'item_6_value'  => $this->shared->get_staff_favorite_formation( $staff_obj->staff_type_id ),
			'item_7_field'  => __( 'PPM', 'soccer-engine-lite' ),
			'item_7_value'  => $this->shared->get_staff_ppm( $staff_obj->staff_id ),
			'item_8_field'  => __( 'Goals', 'soccer-engine-lite' ),
			'item_8_value'  => $this->shared->get_staff_average_goal( $staff_obj->staff_id, 'scored' ) . ' : ' . $this->shared->get_staff_average_goal( $staff_obj->staff_id, 'conceded' ),
			'item_9_field'  => __( 'Matches', 'soccer-engine-lite' ),
			'item_9_value'  => $this->shared->get_staff_number_of_matches( $staff_obj->staff_id ),
			'item_10_field' => __( 'Won', 'soccer-engine-lite' ),
			'item_10_value' => $this->shared->get_staff_number_of_matches( $staff_obj->staff_id, 'won' ),
			'item_11_field' => __( 'Drawn', 'soccer-engine-lite' ),
			'item_11_value' => $this->shared->get_staff_number_of_matches( $staff_obj->staff_id, 'drawn' ),
			'item_12_field' => __( 'Lost', 'soccer-engine-lite' ),
			'item_12_value' => $this->shared->get_staff_number_of_matches( $staff_obj->staff_id, 'lost' ),
		);

		$data = $this->shared->person_summary( $data );
		$this->shared->set_transient_based_on_settings( $transient_name, $data );
		return $data;
	}

	/**
	 * This function is at the same time used to generate the dynamic output of the "Referee Summary" blocks and is also
	 * the callback of the [referee-summary] shortcode.
	 *
	 * Returns the HTML of the referee summary.
	 *
	 * @param $atts
	 *
	 * @return false|string
	 */
	public function referee_summary( $atts ) {

		// If a transient is available return the transient.
		$transient_name = 'daextsoenl_' . hash( 'sha512', json_encode( __FUNCTION__ . json_encode( $atts ) ) );
		$data           = get_transient( $transient_name );
		if ( $data !== false ) {
			return $data; }

		// Get the data.
		$atts       = shortcode_atts(
			array(
				'referee-id' => 1,
			),
			$atts
		);
		$referee_id = intval( $atts['referee-id'], 10 );

		global $wpdb;
		$table_name  = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee';
		$safe_sql    = $wpdb->prepare( "SELECT * FROM $table_name WHERE referee_id = %d", $referee_id );
		$referee_obj = $wpdb->get_row( $safe_sql );

		if ( null === $referee_obj ) {
			return '<p class="daextsoenl-no-data-paragraph">' . esc_html__( 'There are no data associated with your selection.', 'soccer-engine-lite' ) . '</p>';
		}

		$data = array(
			'title'         => __( 'Referee Summary', 'soccer-engine-lite' ),
			'image_html'    => $this->shared->get_referee_image( $referee_obj->referee_id ),
			'item_1_field'  => __( 'Name', 'soccer-engine-lite' ),
			'item_1_value'  => $this->shared->get_referee_name( $referee_obj->referee_id ),
			'item_2_field'  => __( 'Date of Birth', 'soccer-engine-lite' ),
			'item_2_value'  => $this->shared->format_date_timestamp( $referee_obj->date_of_birth ),
			'item_3_field'  => __( 'Age', 'soccer-engine-lite' ),
			'item_3_value'  => $this->shared->get_referee_age( $referee_obj->referee_id ),
			'item_4_field'  => __( 'Citizenship', 'soccer-engine-lite' ),
			'item_4_value'  => $this->shared->get_country_name_from_alpha_2_code( $referee_obj->citizenship ),
			'item_5_field'  => __( 'Place of Birth', 'soccer-engine-lite' ),
			'item_5_value'  => $referee_obj->place_of_birth,
			'item_6_field'  => __( 'Residence', 'soccer-engine-lite' ),
			'item_6_value'  => $referee_obj->residence,
			'item_7_field'  => __( 'Job', 'soccer-engine-lite' ),
			'item_7_value'  => $referee_obj->job,
			'item_8_field'  => __( 'Retired', 'soccer-engine-lite' ),
			'item_8_value'  => intval( $referee_obj->retired, 10 ) === 1 ? __( 'Yes', 'soccer-engine-lite' ) : __( 'No', 'soccer-engine-lite' ),
			'item_9_field'  => __( 'Badges', 'soccer-engine-lite' ),
			'item_9_value'  => $this->shared->get_referee_badges( $referee_obj->referee_id ),
			'item_10_field' => __( 'Appearances', 'soccer-engine-lite' ),
			'item_10_value' => $this->shared->get_referee_appearances( $referee_obj->referee_id ),
			'item_11_field' => __( 'Yellow Cards', 'soccer-engine-lite' ),
			'item_11_value' => $this->shared->get_referee_yellow_cards( $referee_obj->referee_id ),
			'item_12_field' => __( 'Red Cards', 'soccer-engine-lite' ),
			'item_12_value' => $this->shared->get_referee_red_cards( $referee_obj->referee_id ),
		);

		$data = $this->shared->person_summary( $data );
		$this->shared->set_transient_based_on_settings( $transient_name, $data );
		return $data;
	}
}