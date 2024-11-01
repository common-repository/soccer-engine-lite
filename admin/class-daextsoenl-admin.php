<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package soccer-engine-lite

 */

/*
 * This class should be used to work with the administrative side of WordPress.
 */
class Daextsoenl_Admin {


	protected static $instance = null;
	private $shared            = null;

	private $screen_id_matches                  = null;
	private $screen_id_events                   = null;
	private $screen_id_events_wizard            = null;
	private $screen_id_competitions             = null;
	private $screen_id_transfers                = null;
	private $screen_id_transfer_types           = null;
	private $screen_id_team_contracts           = null;
	private $screen_id_team_contract_types      = null;
	private $screen_id_agency                   = null;
	private $screen_id_agency_contracts         = null;
	private $screen_id_agency_contract_types    = null;
	private $screen_id_market_value_transitions = null;
	private $screen_id_players                  = null;
	private $screen_id_player_positions         = null;
	private $screen_id_player_awards            = null;
	private $screen_id_player_award_types       = null;
	private $screen_id_unavailable_players      = null;
	private $screen_id_unavailable_player_types = null;
	private $screen_id_injuries                 = null;
	private $screen_id_injury_types             = null;
	private $screen_id_staff                    = null;
	private $screen_id_staff_types              = null;
	private $screen_id_staff_awards             = null;
	private $screen_id_staff_award_types        = null;
	private $screen_id_referees                 = null;
	private $screen_id_referee_badges           = null;
	private $screen_id_referee_badge_types      = null;
	private $screen_id_squads                   = null;
	private $screen_id_teams                    = null;
	private $screen_id_formations               = null;
	private $screen_id_jersey_sets              = null;
	private $screen_id_stadiums                 = null;
	private $screen_id_trophies                 = null;
	private $screen_id_trophy_types             = null;
	private $screen_id_ranking_transitions      = null;
	private $screen_id_ranking_types            = null;
	private $screen_id_export_to_pro            = null;
	private $screen_id_maintenance              = null;
	private $screen_id_help                     = null;
	private $screen_id_pro_version              = null;
	private $screen_id_options                  = null;

	private function __construct() {

		// Assign an instance of Daextsoenl_Shared.
		$this->shared = Daextsoenl_Shared::get_instance();

		// Load admin stylesheets and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the admin menu.
		add_action( 'admin_menu', array( $this, 'me_add_admin_menu' ) );

		// Load the options API registrations and callbacks.
		add_action( 'admin_init', array( $this, 'op_register_options' ) );

		// This hook is triggered during the creation of a new blog.
		add_action( 'wpmu_new_blog', array( $this, 'new_blog_create_options_and_tables' ), 10, 6 );

		// This hook is triggered during the deletion of a blog.
		add_action( 'delete_blog', array( $this, 'delete_blog_delete_options_and_tables' ), 10, 1 );

		// Export XML controller.
		add_action( 'init', array( $this, 'export_xml_controller' ) );
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
	 * Enqueue admin specific styles.
	 */
	public function enqueue_admin_styles() {

		$screen = get_current_screen();

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-general',
			$this->shared->get( 'url' ) . 'admin/assets/css/general.css',
			array(),
			$this->shared->get( 'ver' )
		);

		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-fontello',
			$this->shared->get( 'url' ) . 'admin/assets/font/fontello/css/daextsoenl-fontello.css',
			array(),
			$this->shared->get( 'ver' )
		);

		// Framework Menu.
		if ( $screen->id == $this->screen_id_ranking_types ||
			$screen->id == $this->screen_id_ranking_transitions ||
			$screen->id == $this->screen_id_staff ||
			$screen->id == $this->screen_id_staff_types ||
			$screen->id == $this->screen_id_player_awards ||
			$screen->id == $this->screen_id_player_award_types ||
			$screen->id == $this->screen_id_staff_awards ||
			$screen->id == $this->screen_id_staff_award_types ||
			$screen->id == $this->screen_id_referees ||
			$screen->id == $this->screen_id_referee_badges ||
			$screen->id == $this->screen_id_referee_badge_types ||
			$screen->id == $this->screen_id_unavailable_players ||
			$screen->id == $this->screen_id_unavailable_player_types ||
			$screen->id == $this->screen_id_trophies ||
			$screen->id == $this->screen_id_trophy_types ||
			$screen->id == $this->screen_id_team_contracts ||
			$screen->id == $this->screen_id_team_contract_types ||
			$screen->id == $this->screen_id_agency_contracts ||
			$screen->id == $this->screen_id_agency_contract_types ||
			$screen->id == $this->screen_id_injuries ||
			$screen->id == $this->screen_id_injury_types ||
			$screen->id == $this->screen_id_transfers ||
			$screen->id == $this->screen_id_transfer_types ||
			$screen->id == $this->screen_id_players ||
			$screen->id == $this->screen_id_player_positions ||
			$screen->id == $this->screen_id_market_value_transitions ||
			$screen->id == $this->screen_id_stadiums ||
			$screen->id == $this->screen_id_competitions ||
			$screen->id == $this->screen_id_teams ||
			$screen->id == $this->screen_id_squads ||
			$screen->id == $this->screen_id_matches ||
			$screen->id == $this->screen_id_events ||
			$screen->id == $this->screen_id_events_wizard ||
			$screen->id == $this->screen_id_formations ||
			$screen->id == $this->screen_id_jersey_sets ||
			$screen->id == $this->screen_id_agency ||
			$screen->id == $this->screen_id_maintenance ) {

			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-framework-menu',
				$this->shared->get( 'url' ) . 'admin/assets/css/framework/menu.css',
				array(),
				$this->shared->get( 'ver' )
			);

		}

		// jQuery UI Tooltip.
		if ( $screen->id === $this->screen_id_ranking_types ||
			$screen->id === $this->screen_id_ranking_transitions ||
			$screen->id === $this->screen_id_staff ||
			$screen->id === $this->screen_id_staff_types ||
			$screen->id === $this->screen_id_player_awards ||
			$screen->id === $this->screen_id_player_award_types ||
			$screen->id === $this->screen_id_staff_awards ||
			$screen->id === $this->screen_id_staff_award_types ||
			$screen->id === $this->screen_id_referees ||
			$screen->id === $this->screen_id_referee_badges ||
			$screen->id === $this->screen_id_referee_badge_types ||
			$screen->id === $this->screen_id_unavailable_players ||
			$screen->id === $this->screen_id_unavailable_player_types ||
			$screen->id === $this->screen_id_trophies ||
			$screen->id === $this->screen_id_trophy_types ||
			$screen->id === $this->screen_id_team_contracts ||
			$screen->id === $this->screen_id_team_contract_types ||
			$screen->id === $this->screen_id_agency_contracts ||
			$screen->id === $this->screen_id_agency_contract_types ||
			$screen->id === $this->screen_id_injuries ||
			$screen->id === $this->screen_id_injury_types ||
			$screen->id === $this->screen_id_transfers ||
			$screen->id === $this->screen_id_transfer_types ||
			$screen->id === $this->screen_id_players ||
			$screen->id === $this->screen_id_player_positions ||
			$screen->id === $this->screen_id_market_value_transitions ||
			$screen->id === $this->screen_id_stadiums ||
			$screen->id === $this->screen_id_competitions ||
			$screen->id === $this->screen_id_teams ||
			$screen->id === $this->screen_id_squads ||
			$screen->id === $this->screen_id_matches ||
			$screen->id === $this->screen_id_events ||
			$screen->id === $this->screen_id_events_wizard ||
			$screen->id === $this->screen_id_formations ||
			$screen->id === $this->screen_id_jersey_sets ||
			$screen->id === $this->screen_id_agency ) {

			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-jquery-ui-tooltip',
				$this->shared->get( 'url' ) . 'admin/assets/css/jquery-ui-tooltip.css',
				array(),
				$this->shared->get( 'ver' )
			);

		}

		// Chosen
		if ( $screen->id === $this->screen_id_ranking_types ||
			$screen->id === $this->screen_id_ranking_transitions ||
			$screen->id === $this->screen_id_staff ||
			$screen->id === $this->screen_id_staff_types ||
			$screen->id === $this->screen_id_player_awards ||
			$screen->id === $this->screen_id_player_award_types ||
			$screen->id === $this->screen_id_staff_awards ||
			$screen->id === $this->screen_id_staff_award_types ||
			$screen->id === $this->screen_id_referees ||
			$screen->id === $this->screen_id_referee_badges ||
			$screen->id === $this->screen_id_referee_badge_types ||
			$screen->id === $this->screen_id_unavailable_players ||
			$screen->id === $this->screen_id_unavailable_player_types ||
			$screen->id === $this->screen_id_trophies ||
			$screen->id === $this->screen_id_trophy_types ||
			$screen->id === $this->screen_id_team_contracts ||
			$screen->id === $this->screen_id_agency_contracts ||
			$screen->id === $this->screen_id_injuries ||
			$screen->id === $this->screen_id_transfers ||
			$screen->id === $this->screen_id_players ||
			$screen->id === $this->screen_id_market_value_transitions ||
			$screen->id === $this->screen_id_competitions ||
			$screen->id === $this->screen_id_teams ||
			$screen->id === $this->screen_id_squads ||
			$screen->id === $this->screen_id_jersey_sets ||
			$screen->id === $this->screen_id_matches ||
			$screen->id === $this->screen_id_events ||
			$screen->id === $this->screen_id_events_wizard ||
			$screen->id === $this->screen_id_agency ||
			$screen->id === $this->screen_id_maintenance ) {

			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-chosen',
				$this->shared->get( 'url' ) . 'admin/assets/inc/chosen/chosen-min.css',
				array(),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-chosen-custom',
				$this->shared->get( 'url' ) . 'admin/assets/css/chosen-custom.css',
				array(),
				$this->shared->get( 'ver' )
			);

		}

		// jQuery UI Datepicker.
		if ( $screen->id === $this->screen_id_ranking_transitions || 
			$screen->id === $this->screen_id_staff || 
			$screen->id === $this->screen_id_player_awards || 
			$screen->id === $this->screen_id_staff_awards || 
			$screen->id === $this->screen_id_referees || 
			$screen->id === $this->screen_id_referee_badges || 
			$screen->id === $this->screen_id_referee_badge_types || 
			$screen->id === $this->screen_id_unavailable_players || 
			$screen->id === $this->screen_id_trophies || 
			$screen->id === $this->screen_id_team_contracts || 
			$screen->id === $this->screen_id_agency_contracts || 
			$screen->id === $this->screen_id_injuries || 
			$screen->id === $this->screen_id_transfers || 
			$screen->id === $this->screen_id_market_value_transitions || 
			$screen->id === $this->screen_id_teams || 
			$screen->id === $this->screen_id_matches || 
			$screen->id === $this->screen_id_players ) {

			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-jquery-ui',
				$this->shared->get( 'url' ) . 'admin/assets/inc/jquery-ui-datepicker/jquery-ui.css',
				array(),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-jquery-ui-custom',
				$this->shared->get( 'url' ) . 'admin/assets/css/jquery-ui-datepicker-custom.css',
				array(),
				$this->shared->get( 'ver' )
			);

		}

		// Framework Menu.
		if ( $screen->id === $this->screen_id_matches ) {

			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-menu-matches',
				$this->shared->get( 'url' ) . 'admin/assets/css/menu-matches.css',
				array(),
				$this->shared->get( 'ver' )
			);

		}

		// Menu Maintenance.
		if ( $screen->id === $this->screen_id_maintenance ) {

			// jQuery UI Dialog.
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-jquery-ui-dialog',
				$this->shared->get( 'url' ) . 'admin/assets/css/jquery-ui-dialog.css',
				array(),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-jquery-ui-dialog-custom',
				$this->shared->get( 'url' ) . 'admin/assets/css/jquery-ui-dialog-custom.css',
				array(),
				$this->shared->get( 'ver' )
			);

		}

		// Menu Help.
		if ( $screen->id === $this->screen_id_help ) {

			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-menu-help',
				$this->shared->get( 'url' ) . 'admin/assets/css/menu-help.css',
				array(),
				$this->shared->get( 'ver' )
			);

		}

		// Menu Pro Version.
		if ( $screen->id === $this->screen_id_pro_version ) {

			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-menu-pro-version',
				$this->shared->get( 'url' ) . 'admin/assets/css/menu-pro-version.css',
				array(),
				$this->shared->get( 'ver' )
			);

		}

		// Menu options.
		if ( $screen->id === $this->screen_id_options ) {
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-menu-options',
				$this->shared->get( 'url' ) . 'admin/assets/css/menu-options.css',
				array(),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-framework-options',
				$this->shared->get( 'url' ) . 'admin/assets/css/framework/options.css',
				array(),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-jquery-ui-tooltip',
				$this->shared->get( 'url' ) . 'admin/assets/css/jquery-ui-tooltip.css',
				array(),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-chosen',
				$this->shared->get( 'url' ) . 'admin/assets/inc/chosen/chosen-min.css',
				array(),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-chosen-custom',
				$this->shared->get( 'url' ) . 'admin/assets/css/chosen-custom.css',
				array(),
				$this->shared->get( 'ver' )
			);
		}
	}

	/*
	 * Enqueue admin-specific JavaScript.
	 */
	public function enqueue_admin_scripts() {

		$wp_localize_script_data = array(
			'locale'      => esc_attr( get_locale() ),
			'proceedText' => esc_attr__( 'Proceed', 'soccer-engine-lite' ),
			'cancelText'  => esc_attr__( 'Cancel', 'soccer-engine-lite' ),
			'chooseText'  => esc_attr__( 'Add Color', 'soccer-engine-lite' ),
		);

		$screen = get_current_screen();

		// Framework Menu.
		if ( $screen->id === $this->screen_id_ranking_types ||
			$screen->id === $this->screen_id_ranking_transitions ||
			$screen->id === $this->screen_id_staff ||
			$screen->id === $this->screen_id_staff_types ||
			$screen->id === $this->screen_id_player_awards ||
			$screen->id === $this->screen_id_player_award_types ||
			$screen->id === $this->screen_id_staff_awards ||
			$screen->id === $this->screen_id_staff_award_types ||
			$screen->id === $this->screen_id_referees ||
			$screen->id === $this->screen_id_referee_badges ||
			$screen->id === $this->screen_id_referee_badge_types ||
			$screen->id === $this->screen_id_unavailable_players ||
			$screen->id === $this->screen_id_unavailable_player_types ||
			$screen->id === $this->screen_id_trophies ||
			$screen->id === $this->screen_id_trophy_types ||
			$screen->id === $this->screen_id_team_contracts ||
			$screen->id === $this->screen_id_team_contract_types ||
			$screen->id === $this->screen_id_agency_contracts ||
			$screen->id === $this->screen_id_agency_contract_types ||
			$screen->id === $this->screen_id_injuries ||
			$screen->id === $this->screen_id_injury_types ||
			$screen->id === $this->screen_id_transfers ||
			$screen->id === $this->screen_id_transfer_types ||
			$screen->id === $this->screen_id_players ||
			$screen->id === $this->screen_id_player_positions ||
			$screen->id === $this->screen_id_market_value_transitions ||
			$screen->id === $this->screen_id_stadiums ||
			$screen->id === $this->screen_id_competitions ||
			$screen->id === $this->screen_id_teams ||
			$screen->id === $this->screen_id_squads ||
			$screen->id === $this->screen_id_matches ||
			$screen->id === $this->screen_id_events ||
			$screen->id === $this->screen_id_events_wizard ||
			$screen->id === $this->screen_id_formations ||
			$screen->id === $this->screen_id_jersey_sets ||
			$screen->id === $this->screen_id_agency ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-daext-menu',
				$this->shared->get( 'url' ) . 'admin/assets/js/framework/menu.js',
				'jquery',
				$this->shared->get( 'ver' )
			);

		}

		// jQuery UI Tooltip.
		if ( $screen->id === $this->screen_id_ranking_types ||
			$screen->id === $this->screen_id_ranking_transitions ||
			$screen->id === $this->screen_id_staff ||
			$screen->id === $this->screen_id_staff_types ||
			$screen->id === $this->screen_id_player_awards ||
			$screen->id === $this->screen_id_player_award_types ||
			$screen->id === $this->screen_id_staff_awards ||
			$screen->id === $this->screen_id_staff_award_types ||
			$screen->id === $this->screen_id_referees ||
			$screen->id === $this->screen_id_referee_badges ||
			$screen->id === $this->screen_id_referee_badge_types ||
			$screen->id === $this->screen_id_unavailable_players ||
			$screen->id === $this->screen_id_unavailable_player_types ||
			$screen->id === $this->screen_id_trophies ||
			$screen->id === $this->screen_id_trophy_types ||
			$screen->id === $this->screen_id_team_contracts ||
			$screen->id === $this->screen_id_team_contract_types ||
			$screen->id === $this->screen_id_agency_contracts ||
			$screen->id === $this->screen_id_agency_contract_types ||
			$screen->id === $this->screen_id_injuries ||
			$screen->id === $this->screen_id_injury_types ||
			$screen->id === $this->screen_id_transfers ||
			$screen->id === $this->screen_id_transfer_types ||
			$screen->id === $this->screen_id_players ||
			$screen->id === $this->screen_id_player_positions ||
			$screen->id === $this->screen_id_market_value_transitions ||
			$screen->id === $this->screen_id_stadiums ||
			$screen->id === $this->screen_id_competitions ||
			$screen->id === $this->screen_id_teams ||
			$screen->id === $this->screen_id_squads ||
			$screen->id === $this->screen_id_matches ||
			$screen->id === $this->screen_id_events ||
			$screen->id === $this->screen_id_events_wizard ||
			$screen->id === $this->screen_id_formations ||
			$screen->id === $this->screen_id_jersey_sets ||
			$screen->id === $this->screen_id_agency ) {

			wp_enqueue_script( 'jquery-ui-tooltip' );
			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-jquery-ui-tooltip-init',
				$this->shared->get( 'url' ) . 'admin/assets/js/jquery-ui-tooltip-init.js',
				'jquery',
				$this->shared->get( 'ver' )
			);

		}

		// Chosen.
		if ( $screen->id === $this->screen_id_ranking_types ||
			$screen->id === $this->screen_id_ranking_transitions ||
			$screen->id === $this->screen_id_staff ||
			$screen->id === $this->screen_id_staff_types ||
			$screen->id === $this->screen_id_player_awards ||
			$screen->id === $this->screen_id_player_award_types ||
			$screen->id === $this->screen_id_staff_awards ||
			$screen->id === $this->screen_id_staff_award_types ||
			$screen->id === $this->screen_id_referees ||
			$screen->id === $this->screen_id_referee_badges ||
			$screen->id === $this->screen_id_referee_badge_types ||
			$screen->id === $this->screen_id_unavailable_players ||
			$screen->id === $this->screen_id_unavailable_player_types ||
			$screen->id === $this->screen_id_trophies ||
			$screen->id === $this->screen_id_trophy_types ||
			$screen->id === $this->screen_id_team_contracts ||
			$screen->id === $this->screen_id_agency_contracts ||
			$screen->id === $this->screen_id_injuries ||
			$screen->id === $this->screen_id_transfers ||
			$screen->id === $this->screen_id_players ||
			$screen->id === $this->screen_id_market_value_transitions ||
			$screen->id === $this->screen_id_competitions ||
			$screen->id === $this->screen_id_teams ||
			$screen->id === $this->screen_id_squads ||
			$screen->id === $this->screen_id_jersey_sets ||
			$screen->id === $this->screen_id_matches ||
			$screen->id === $this->screen_id_events ||
			$screen->id === $this->screen_id_events_wizard ||
			$screen->id === $this->screen_id_agency ||
			$screen->id === $this->screen_id_maintenance ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-chosen',
				$this->shared->get( 'url' ) . 'admin/assets/inc/chosen/chosen-min.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-chosen-init',
				$this->shared->get( 'url' ) . 'admin/assets/js/chosen-init.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

		}

		// Media Uploader.
		if ( $screen->id === $this->screen_id_staff ||
			$screen->id === $this->screen_id_trophy_types ||
			$screen->id === $this->screen_id_players ||
			$screen->id === $this->screen_id_referees ||
			$screen->id === $this->screen_id_referee_badges ||
			$screen->id === $this->screen_id_referee_badge_types ||
			$screen->id === $this->screen_id_stadiums ||
			$screen->id === $this->screen_id_competitions ||
			$screen->id === $this->screen_id_teams ) {

			wp_enqueue_media();
			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-media-uploader',
				$this->shared->get( 'url' ) . 'admin/assets/js/media-uploader.js',
				'jquery',
				$this->shared->get( 'ver' )
			);

		}

		// Group Trigger.
		if ( $screen->id === $this->screen_id_squads ||
			$screen->id === $this->screen_id_matches ||
			$screen->id === $this->screen_id_teams ||
			$screen->id === $this->screen_id_jersey_sets ||
			$screen->id === $this->screen_id_competitions ||
			$screen->id === $this->screen_id_events_wizard ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-group-trigger',
				$this->shared->get( 'url' ) . 'admin/assets/js/framework/group-trigger.js',
				'jquery',
				$this->shared->get( 'ver' )
			);

		}

		// Menu Staff.
		if ( $screen->id === $this->screen_id_staff ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-staff',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-staff.js',
				array( 'jquery', 'jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-staff', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Events.
		if ( $screen->id === $this->screen_id_events ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-events',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-events.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

		}

		// Menu Ranking Transitions.
		if ( $screen->id === $this->screen_id_ranking_transitions ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-ranking-transitions',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-ranking-transitions.js',
				array( 'jquery', 'jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-ranking-transitions', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Player Awards.
		if ( $screen->id === $this->screen_id_player_awards ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-player-awards',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-player-awards.js',
				array( 'jquery', 'jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-player-awards', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Player Awards.
		if ( $screen->id === $this->screen_id_staff_awards ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-staff-awards',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-staff-awards.js',
				array( 'jquery', 'jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-staff-awards', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Unavailable Players.
		if ( $screen->id === $this->screen_id_unavailable_players ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-unavailable-players',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-unavailable-players.js',
				array( 'jquery', 'jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-unavailable-players', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Trophies.
		if ( $screen->id === $this->screen_id_trophies ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-trophies',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-trophies.js',
				array( 'jquery', 'jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-trophies', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Team Contracts.
		if ( $screen->id === $this->screen_id_team_contracts ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-team-contracts',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-team-contracts.js',
				array( 'jquery', 'jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-team-contracts', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Agency Contracts.
		if ( $screen->id === $this->screen_id_agency_contracts ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-agency-contracts',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-agency-contracts.js',
				array( 'jquery', 'jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-agency-contracts', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Injuries.
		if ( $screen->id === $this->screen_id_injuries ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-injuries',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-injuries.js',
				array( 'jquery', 'jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-injuries', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Transfers.
		if ( $screen->id === $this->screen_id_transfers ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-transfers',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-transfers.js',
				array( 'jquery', 'jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-transfers', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Players.
		if ( $screen->id === $this->screen_id_players ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-players',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-players.js',
				array( 'jquery', 'jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-players', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Market Value Transition.
		if ( $screen->id === $this->screen_id_market_value_transitions ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-market-value-transitions',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-market-value-transitions.js',
				array( 'jquery', 'jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-market-value-transitions', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Teams.
		if ( $screen->id === $this->screen_id_teams ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-teams',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-teams.js',
				array( 'jquery', 'jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-teams', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Matches.
		if ( $screen->id === $this->screen_id_matches ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-matches',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-matches.js',
				array( 'jquery', 'jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-matches', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Referees.
		if ( $screen->id === $this->screen_id_referees ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-referees',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-referees.js',
				array( 'jquery', 'jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-referees', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Referee Badges.
		if ( $screen->id === $this->screen_id_referee_badges ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-referee-badges',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-referee-badges.js',
				array( 'jquery', 'jquery-ui-datepicker' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-referee-badges', 'objectL10n', $wp_localize_script_data );

		}

		// Menu Maintenance.
		if ( $screen->id === $this->screen_id_maintenance ) {

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-maintenance',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-maintenance.js',
				array( 'jquery', 'jquery-ui-dialog' ),
				$this->shared->get( 'ver' )
			);

			wp_localize_script( $this->shared->get( 'slug' ) . '-menu-maintenance', 'objectL10n', $wp_localize_script_data );

		}

		// Menu options.
		if ( $screen->id === $this->screen_id_options ) {

			// Color Picker Initialization.
			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-wp-color-picker-init',
				$this->shared->get( 'url' ) . 'admin/assets/js/wp-color-picker-init.js',
				array( 'jquery', 'wp-color-picker' ),
				false,
				true
			);
			wp_enqueue_script( 'jquery-ui-tooltip' );
			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-jquery-ui-tooltip-init',
				$this->shared->get( 'url' ) . 'admin/assets/js/jquery-ui-tooltip-init.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-chosen',
				$this->shared->get( 'url' ) . 'admin/assets/inc/chosen/chosen-min.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);
			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-jquery-ui-chosen-init',
				$this->shared->get( 'url' ) . 'admin/assets/js/chosen-init.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' )
			);

		}

		// Store the JavaScript parameters in the window.DAEXTULMA_PARAMETERS object.
		$initialization_script  = 'window.DAEXTSOENL_PHPDATA = {';
		$initialization_script .= 'ajaxUrl: "' . admin_url( 'admin-ajax.php' ) . '",';
		$initialization_script .= 'nonce: "' . wp_create_nonce( 'daextsoenl' ) . '",';
		$initialization_script .= '};';

		// Add the inline script with the PHP data in the "Matches" menu.
		if ( $screen->id === $this->screen_id_matches ) {
			wp_add_inline_script( $this->shared->get( 'slug' ) . '-menu-matches', $initialization_script, 'before' );
		}

		// Add the inline script with thePHP data before the script used to register the blocks of Soccer Engine.
		wp_add_inline_script( $this->shared->get( 'slug' ) . '-editor-js', $initialization_script, 'before' );
	}

	/*
	 * plugin activation.
	 */
	static public function ac_activate( $networkwide ) {

		/*
		 * delete options and tables for all the sites in the network.
		 */
		if ( function_exists( 'is_multisite' ) and is_multisite() ) {

			/*
			 * if this is a "Network Activation" create the options and tables
			 * for each blog.
			 */
			if ( $networkwide ) {

				// Get the current blog id.
				global $wpdb;
				$current_blog = $wpdb->blogid;

				// Create an array with all the blog ids.
				$blogids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );

				// Iterate through all the blogs.
				foreach ( $blogids as $blog_id ) {

					// Switch to the iterated blog.
					switch_to_blog( $blog_id );

					// Create options and tables for the iterated blog.
					self::ac_initialize_options();
					self::ac_create_database_tables();
					self::ac_initialize_custom_css();

				}

				// Switch to the current blog.
				switch_to_blog( $current_blog );

			} else {

				/**
				 * If this is not a "Network Activation" create options and
				 * tables only for the current blog
				 */
				self::ac_initialize_options();
				self::ac_create_database_tables();
				self::ac_initialize_custom_css();

			}
		} else {

			/**
			 * If this is not a multisite installation create options and
			 * tables only for the current blog.
			 */
			self::ac_initialize_options();
			self::ac_create_database_tables();
			self::ac_initialize_custom_css();

		}
	}

	// Create the options and tables for the newly created blog.
	public function new_blog_create_options_and_tables( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {

		global $wpdb;

		/**
		 * If the plugin is "Network Active" create the options and tables for
		 * this new blog.
		 */
		if ( is_plugin_active_for_network( 'daext-soccer-engine/init.php' ) ) {

			// Get the id of the current blog.
			$current_blog = $wpdb->blogid;

			// Switch to the blog that is being activated.
			switch_to_blog( $blog_id );

			// Create options and database tables for the new blog.
			$this->ac_initialize_options();
			$this->ac_create_database_tables();
			$this->ac_initialize_custom_css();

			// Switch to the current blog.
			switch_to_blog( $current_blog );

		}
	}

	// Delete options and tables for the deleted blog.
	public function delete_blog_delete_options_and_tables( $blog_id ) {

		global $wpdb;

		// Get the id of the current blog.
		$current_blog = $wpdb->blogid;

		// Switch to the blog that is being activated.
		switch_to_blog( $blog_id );

		// Create options and database tables for the new blog.
		$this->un_delete_options();
		$this->un_delete_database_tables();

		// Switch to the current blog.
		switch_to_blog( $current_blog );
	}

	/*
	 * Initialize plugin options.
	 */
	static private function ac_initialize_options() {

		// Assign an instance of Daextsoenl_Shared.
		$shared = Daextsoenl_Shared::get_instance();

		foreach ( $shared->get( 'options' ) as $key => $value ) {
			add_option( $key, $value );
		}
	}

	/*
	 * Create the plugin database tables.
	 */
	static private function ac_create_database_tables() {

		global $wpdb;

		// Get the database character collate that will be appended at the end of each query.
		$charset_collate = $wpdb->get_charset_collate();

		// Check database version and create the database.
		if ( intval( 'database_version', 10 ) < 1 ) {

			require_once ABSPATH . 'wp-admin/includes/upgrade.php';

			$table_name = $wpdb->prefix . 'daextsoenl_ranking_type';
			$sql        = "CREATE TABLE $table_name (
                ranking_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (ranking_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_ranking_transition';
			$sql        = "CREATE TABLE $table_name (
                ranking_transition_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                ranking_type_id BIGINT(20) UNSIGNED DEFAULT NULL,
                value INT DEFAULT NULL,
                team_id BIGINT(20) UNSIGNED DEFAULT NULL,
                date DATE DEFAULT NULL,
                PRIMARY KEY (ranking_transition_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_staff';
			$sql        = "CREATE TABLE $table_name (
                staff_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                first_name TEXT DEFAULT NULL,
                last_name TEXT DEFAULT NULL,
                image TEXT DEFAULT NULL,
                citizenship TEXT DEFAULT NULL,
                second_citizenship TEXT DEFAULT NULL,
                staff_type_id BIGINT DEFAULT NULL,
                retired TINYINT(1) DEFAULT NULL,
                gender TINYINT(1) DEFAULT NULL,
                date_of_birth DATE DEFAULT NULL,
                date_of_death DATE DEFAULT NULL,
                PRIMARY KEY (staff_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_staff_type';
			$sql        = "CREATE TABLE $table_name (
                staff_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (staff_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_player_award';
			$sql        = "CREATE TABLE $table_name (
                player_award_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                player_award_type_id BIGINT(20) UNSIGNED DEFAULT NULL,
                assignment_date DATE DEFAULT NULL,
                player_id BIGINT(20) UNSIGNED DEFAULT NULL,
                PRIMARY KEY (player_award_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_player_award_type';
			$sql        = "CREATE TABLE $table_name (
                player_award_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (player_award_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_staff_award';
			$sql        = "CREATE TABLE $table_name (
                staff_award_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                staff_award_type_id BIGINT(20) UNSIGNED DEFAULT NULL,
                assignment_date DATE DEFAULT NULL,
                staff_id BIGINT(20) UNSIGNED DEFAULT NULL,
                PRIMARY KEY (staff_award_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_staff_award_type';
			$sql        = "CREATE TABLE $table_name (
                staff_award_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (staff_award_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_unavailable_player';
			$sql        = "CREATE TABLE $table_name (
                unavailable_player_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                player_id BIGINT UNSIGNED DEFAULT NULL,
                unavailable_player_type_id BIGINT(20) UNSIGNED DEFAULT NULL,
                start_date DATE DEFAULT NULL,
                end_date DATE DEFAULT NULL,
                PRIMARY KEY (unavailable_player_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_unavailable_player_type';
			$sql        = "CREATE TABLE $table_name (
                unavailable_player_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (unavailable_player_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_trophy';
			$sql        = "CREATE TABLE $table_name (
                trophy_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                trophy_type_id BIGINT(20) UNSIGNED DEFAULT NULL,
                team_id BIGINT(20) UNSIGNED DEFAULT NULL,
                assignment_date DATE DEFAULT NULL,
                PRIMARY KEY (trophy_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_trophy_type';
			$sql        = "CREATE TABLE $table_name (
                trophy_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                logo TEXT DEFAULT NULL,
                PRIMARY KEY (trophy_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_agency';
			$sql        = "CREATE TABLE $table_name (
                agency_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                full_name TEXT DEFAULT NULL,
                address TEXT DEFAULT NULL,
                tel TEXT DEFAULT NULL,
                fax TEXT DEFAULT NULL,
                website TEXT DEFAULT NULL,
                PRIMARY KEY (agency_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_team_contract';
			$sql        = "CREATE TABLE $table_name (
                team_contract_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                team_contract_type_id BIGINT(20) UNSIGNED NOT NULL,
                player_id BIGINT(20) UNSIGNED DEFAULT NULL,
                start_date DATE DEFAULT NULL,
                end_date DATE DEFAULT NULL,
                salary DECIMAL(15, 2) NULL,
                team_id BIGINT(20) UNSIGNED NOT NULL,
                PRIMARY KEY (team_contract_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_team_contract_type';
			$sql        = "CREATE TABLE $table_name (
                team_contract_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (team_contract_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_agency_contract';
			$sql        = "CREATE TABLE $table_name (
                agency_contract_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                agency_contract_type_id BIGINT(20) UNSIGNED NOT NULL,
                player_id BIGINT(20) UNSIGNED DEFAULT NULL,
                start_date DATE DEFAULT NULL,
                end_date DATE DEFAULT NULL,
                agency_id BIGINT(20) UNSIGNED NOT NULL,
                PRIMARY KEY (agency_contract_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_agency_contract_type';
			$sql        = "CREATE TABLE $table_name (
                agency_contract_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (agency_contract_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_injury';
			$sql        = "CREATE TABLE $table_name (
                injury_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                injury_type_id BIGINT(20) UNSIGNED NOT NULL,
                start_date DATE DEFAULT NULL,
                end_date DATE DEFAULT NULL,
                player_id BIGINT(20) UNSIGNED NULL,
                PRIMARY KEY (injury_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_injury_type';
			$sql        = "CREATE TABLE $table_name (
                injury_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (injury_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_transfer';
			$sql        = "CREATE TABLE $table_name (
                transfer_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                player_id BIGINT(20) UNSIGNED DEFAULT NULL,
                date DATE DEFAULT NULL,
                team_id_left BIGINT(20) UNSIGNED DEFAULT NULL,
                team_id_joined BIGINT(20) UNSIGNED DEFAULT NULL,
                fee DECIMAL(15, 2) NULL,
                transfer_type_id BIGINT(20) UNSIGNED DEFAULT NULL,
                PRIMARY KEY (transfer_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_transfer_type';
			$sql        = "CREATE TABLE $table_name (
                transfer_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (transfer_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_player';
			$sql        = "CREATE TABLE $table_name (
                player_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                first_name TEXT DEFAULT NULL,
                last_name TEXT DEFAULT NULL,
                image TEXT,
                citizenship TEXT DEFAULT NULL,
                second_citizenship TEXT DEFAULT NULL,
                player_position_id BIGINT(20) UNSIGNED DEFAULT NULL,
                URL TEXT DEFAULT NULL,
                date_of_birth DATE DEFAULT NULL,
                date_of_death DATE DEFAULT NULL,
                gender TINYINT(1) DEFAULT NULL,
                height SMALLINT(5) UNSIGNED DEFAULT NULL,
                foot TINYINT DEFAULT NULL,
                retired TINYINT(1) DEFAULT NULL,
                PRIMARY KEY (player_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_player_position';
			$sql        = "CREATE TABLE $table_name (
                player_position_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                abbreviation TEXT DEFAULT NULL,
                PRIMARY KEY (player_position_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_market_value_transition';
			$sql        = "CREATE TABLE $table_name (
                market_value_transition_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                date DATE DEFAULT NULL,
                value DECIMAL(15,2) NULL,
                player_id BIGINT(20) UNSIGNED DEFAULT NULL,	
                PRIMARY KEY (market_value_transition_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_stadium';
			$sql        = "CREATE TABLE $table_name (
                stadium_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                image TEXT DEFAULT NULL,
                PRIMARY KEY (stadium_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_competition';
			$sql        = "CREATE TABLE $table_name (
                competition_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                logo TEXT DEFAULT NULL,
                type TINYINT(1) DEFAULT NULL,
                rounds SMALLINT DEFAULT NULL,\n";
			for ( $i = 1;$i <= 128;$i++ ) {
				$sql .= "team_id_$i BIGINT DEFAULT NULL,\n";}
				$sql .= "rr_victory_points TINYINT(1) DEFAULT NULL,
				rr_draw_points TINYINT(1) DEFAULT NULL,
				rr_defeat_points TINYINT(1) DEFAULT NULL,
				rr_sorting_order_1 TINYINT(1) DEFAULT NULL,
				rr_sorting_order_by_1 TINYINT(1) DEFAULT NULL,
				rr_sorting_order_2 TINYINT(1) DEFAULT NULL,
				rr_sorting_order_by_2 TINYINT(1) DEFAULT NULL,
                PRIMARY KEY (competition_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_team';
			$sql        = "CREATE TABLE $table_name (
                team_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                logo TEXT DEFAULT NULL,
                type TINYINT(1) DEFAULT NULL,
                foundation_date DATE DEFAULT NULL,
                stadium_id BIGINT DEFAULT NULL,
                full_name TEXT DEFAULT NULL,
                address TEXT DEFAULT NULL,
                tel TEXT DEFAULT NULL,
                fax TEXT DEFAULT NULL,
                website_url TEXT DEFAULT NULL,
                club_nation TEXT DEFAULT NULL,
                national_team_confederation TINYINT(1) DEFAULT NULL,
                PRIMARY KEY (team_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_squad';
			$sql        = "CREATE TABLE $table_name (
                squad_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,\n";
			for ( $i = 1;$i <= 11;$i++ ) {
				$sql .= "lineup_player_id_$i BIGINT DEFAULT NULL,\n";}
			for ( $i = 1;$i <= 20;$i++ ) {
				$sql .= "substitute_player_id_$i BIGINT DEFAULT NULL,\n";}
			for ( $i = 1;$i <= 20;$i++ ) {
				$sql .= "staff_id_$i BIGINT DEFAULT NULL,\n";}
				$sql .= "jersey_set_id BIGINT DEFAULT NULL,
                formation_id BIGINT DEFAULT NULL,
                PRIMARY KEY (squad_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_match';
			$sql        = "CREATE TABLE $table_name (
                match_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                competition_id BIGINT DEFAULT NULL,
                round SMALLINT DEFAULT NULL,
                type TINYINT(1) DEFAULT NULL,
                team_id_1 BIGINT DEFAULT NULL,
                team_id_2 BIGINT DEFAULT NULL,
                date DATE DEFAULT NULL,
                time TIME DEFAULT NULL,
                fh_additional_time TINYINT(1) DEFAULT NULL,
                sh_additional_time TINYINT(1) DEFAULT NULL,
                fh_extra_time_additional_time TINYINT(1) DEFAULT NULL,
                sh_extra_time_additional_time TINYINT(1) DEFAULT NULL,\n";
			for ( $t = 1;$t <= 2;$t++ ) {
				for ( $i = 1;$i <= 11;$i++ ) {
					$sql .= 'team_' . $t . "_lineup_player_id_$i BIGINT DEFAULT NULL,\n";}
				for ( $i = 1;$i <= 20;$i++ ) {
					$sql .= 'team_' . $t . "_substitute_player_id_$i BIGINT DEFAULT NULL,\n";}
				for ( $i = 1;$i <= 20;$i++ ) {
					$sql .= 'team_' . $t . "_staff_id_$i BIGINT DEFAULT NULL,\n";}
			}
				$sql .= "stadium_id BIGINT DEFAULT NULL,
				team_1_formation_id BIGINT DEFAULT NULL,
				team_2_formation_id BIGINT DEFAULT NULL,
				attendance INT DEFAULT NULL,
				referee_id BIGINT DEFAULT NULL,
				player_id_injured TEXT DEFAULT NULL,
				player_id_unavailable TEXT DEFAULT NULL,
				team_1_jersey_set_id BIGINT DEFAULT NULL,
				team_2_jersey_set_id BIGINT DEFAULT NULL,
                PRIMARY KEY (match_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_event';
			$sql        = "CREATE TABLE $table_name (
                event_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                data TINYINT(1) DEFAULT NULL,
                match_id BIGINT(20) DEFAULT NULL,
                part TINYINT(1) DEFAULT NULL,
                team_slot TINYINT(1) DEFAULT NULL,
                time TINYINT(1) UNSIGNED DEFAULT NULL,
                additional_time TINYINT(1) UNSIGNED DEFAULT NULL,
                description TEXT DEFAULT NULL,
                match_effect TINYINT(1) DEFAULT NULL,
                player_id BIGINT DEFAULT NULL,
                player_id_substitution_out BIGINT DEFAULT NULL,
                player_id_substitution_in BIGINT DEFAULT NULL,
                staff_id BIGINT DEFAULT NULL,
                PRIMARY KEY (event_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_formation';
			$sql        = "CREATE TABLE $table_name (
                formation_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                x_position_1 SMALLINT DEFAULT NULL,
                y_position_1 SMALLINT DEFAULT NULL,
                x_position_2 SMALLINT DEFAULT NULL,
                y_position_2 SMALLINT DEFAULT NULL,
                x_position_3 SMALLINT DEFAULT NULL,
                y_position_3 SMALLINT DEFAULT NULL,
                x_position_4 SMALLINT DEFAULT NULL,
                y_position_4 SMALLINT DEFAULT NULL,
                x_position_5 SMALLINT DEFAULT NULL,
                y_position_5 SMALLINT DEFAULT NULL,
                x_position_6 SMALLINT DEFAULT NULL,
                y_position_6 SMALLINT DEFAULT NULL,
                x_position_7 SMALLINT DEFAULT NULL,
                y_position_7 SMALLINT DEFAULT NULL,
                x_position_8 SMALLINT DEFAULT NULL,
                y_position_8 SMALLINT DEFAULT NULL,
                x_position_9 SMALLINT DEFAULT NULL,
                y_position_9 SMALLINT DEFAULT NULL,
                x_position_10 SMALLINT DEFAULT NULL,
                y_position_10 SMALLINT DEFAULT NULL,
                x_position_11 SMALLINT DEFAULT NULL,
                y_position_11 SMALLINT DEFAULT NULL,
                PRIMARY KEY (formation_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_jersey_set';
			$sql        = "CREATE TABLE $table_name (
                jersey_set_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	        	name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,\n";
			for ( $i = 1;$i <= 50;$i++ ) {
				$sql .= "player_id_$i BIGINT DEFAULT NULL,\n";}
			for ( $i = 1;$i <= 50;$i++ ) {
				$sql .= "jersey_number_player_id_$i BIGINT DEFAULT NULL,\n";}
				$sql .= "PRIMARY KEY (jersey_set_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_referee';
			$sql        = "CREATE TABLE $table_name (
                referee_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                first_name TEXT DEFAULT NULL,
                last_name TEXT DEFAULT NULL,
                image TEXT DEFAULT NULL,
                citizenship TEXT DEFAULT NULL,
                second_citizenship TEXT DEFAULT NULL,
                place_of_birth TEXT DEFAULT NULL,
                residence TEXT DEFAULT NULL,
                retired TINYINT(1) DEFAULT NULL,
                gender TINYINT(1) DEFAULT NULL,
                job TEXT DEFAULT NULL,
                date_of_birth DATE DEFAULT NULL,
                date_of_death DATE DEFAULT NULL,
                PRIMARY KEY (referee_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_referee_badge';
			$sql        = "CREATE TABLE $table_name (
                referee_badge_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                referee_id BIGINT(20) DEFAULT NULL,
                referee_badge_type_id BIGINT(20) DEFAULT NULL,
                start_date DATE DEFAULT NULL,
                end_date DATE DEFAULT NULL,
                PRIMARY KEY (referee_badge_id)
            ) $charset_collate";
			dbDelta( $sql );

			$table_name = $wpdb->prefix . 'daextsoenl_referee_badge_type';
			$sql        = "CREATE TABLE $table_name (
                referee_badge_type_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name TEXT DEFAULT NULL,
                description TEXT DEFAULT NULL,
                PRIMARY KEY (referee_badge_type_id)
            ) $charset_collate";
			dbDelta( $sql );

			// Update database version
			update_option( 'daextsoenl_database_version', '1' );

		}
	}

	/**
	 * Initialize the custom-[blog_id].css file.
	 */
	static public function ac_initialize_custom_css() {

		/**
		 * Write the custom-[blog_id].css file or die if the file can't be
		 * created or modified.
		 */
		if ( self::write_custom_css() === false ) {
			die( "The plugin can't write files in the upload directory." );
		}
	}

	/**
	 * Plugin delete.
	 */
	public static function un_delete() {

		/**
		 * Delete options and tables for all the sites in the network.
		 */
		if ( function_exists( 'is_multisite' ) and is_multisite() ) {

			// Get the current blog id.
			global $wpdb;
			$current_blog = $wpdb->blogid;

			// Create an array with all the blog ids.
			$blogids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );

			// Iterate through all the blogs.
			foreach ( $blogids as $blog_id ) {

				// Switch to the iterated blog.
				switch_to_blog( $blog_id );

				// Create options and tables for the iterated blog.
				self::un_delete_options();
				self::un_delete_database_tables();

			}

			// Switch to the current blog.
			switch_to_blog( $current_blog );

		} else {

			/**
			 * If this is not a multisite installation delete options and tables only for the current blog.
			 */
			self::un_delete_options();
			self::un_delete_database_tables();

		}
	}

	/**
	 * Delete plugin options.
	 */
	public static function un_delete_options() {

		// Assign an instance of Daextsoenl_Shared.
		$shared = Daextsoenl_Shared::get_instance();

		foreach ( $shared->get( 'options' ) as $key => $value ) {
			delete_option( $key );
		}
	}

	/**
	 * Delete plugin database tables.
	 */
	public static function un_delete_database_tables() {

		// Assign an instance of Daextsoenl_Shared.
		$shared = Daextsoenl_Shared::get_instance();

		global $wpdb;
		$database_table_a = $shared->get( 'database_tables' );
		foreach ( $database_table_a as $key => $database_table ) {

			$table_name = $wpdb->prefix . $shared->get( 'slug' ) . '_' . $database_table['name'];
			$sql        = "DROP TABLE $table_name";
			$wpdb->query( $sql );

		}
	}

	/**
	 * Register the admin menu.
	 */
	public function me_add_admin_menu() {

		// Matches ----------------------------------------------------------------------------------------------------.
		add_menu_page(
			esc_attr__( 'SE', 'soccer-engine-lite' ),
			esc_attr__( 'SE Matches', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-matches',
			function () {
				include_once 'view/matches.php';},
			'none'
		);

		$this->screen_id_matches = add_submenu_page(
			$this->shared->get( 'slug' ) . '-matches',
			esc_attr__( 'SE - Matches', 'soccer-engine-lite' ),
			esc_attr__( 'Matches', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-matches',
			function () {
				include_once 'view/matches.php';}
		);

		$this->screen_id_events = add_submenu_page(
			$this->shared->get( 'slug' ) . '-matches',
			esc_attr__( 'SE - Events', 'soccer-engine-lite' ),
			esc_attr__( 'Events', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-events',
			function () {
				include_once 'view/events.php';}
		);

		$this->screen_id_events_wizard = add_submenu_page(
			$this->shared->get( 'slug' ) . '-matches',
			esc_attr__( 'SE - Events Wizard', 'soccer-engine-lite' ),
			esc_attr__( 'Events Wizard', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-events-wizard',
			function () {
				include_once 'view/events_wizard.php';}
		);

		$this->screen_id_competitions = add_submenu_page(
			$this->shared->get( 'slug' ) . '-matches',
			esc_attr__( 'SE - Competitions', 'soccer-engine-lite' ),
			esc_attr__( 'Competitions', 'soccer-engine-lite' ),
			'manage_options',
			$this->shared->get( 'slug' ) . '-competitions',
			function () {
				include_once 'view/competitions.php';}
		);

		// Transfers --------------------------------------------------------------------------------------------------.
		add_menu_page(
			esc_attr__( 'SE', 'soccer-engine-lite' ),
			esc_attr__( 'SE Transfers', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-transfers',
			function () {
				include_once 'view/transfers.php';},
			'none'
		);

		$this->screen_id_transfers = add_submenu_page(
			$this->shared->get( 'slug' ) . '-transfers',
			esc_attr__( 'SE - Transfers', 'soccer-engine-lite' ),
			esc_attr__( 'Transfers', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-transfers',
			function () {
				include_once 'view/transfers.php';}
		);

		$this->screen_id_transfer_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-transfers',
			esc_attr__( 'SE - Transfer Types', 'soccer-engine-lite' ),
			esc_attr__( 'Transfer Types', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-transfer-types',
			function () {
				include_once 'view/transfer_types.php';}
		);

		$this->screen_id_team_contracts = add_submenu_page(
			$this->shared->get( 'slug' ) . '-transfers',
			esc_attr__( 'SE - Team Contracts', 'soccer-engine-lite' ),
			esc_attr__( 'Team Contracts', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-team-contracts',
			function () {
				include_once 'view/team_contracts.php';}
		);

		$this->screen_id_team_contract_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-transfers',
			esc_attr__( 'SE - Team Contract Types', 'soccer-engine-lite' ),
			esc_attr__( 'Team Contract Types', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-team-contract-types',
			function () {
				include_once 'view/team_contract_types.php';}
		);

		$this->screen_id_agency = add_submenu_page(
			$this->shared->get( 'slug' ) . '-transfers',
			esc_attr__( 'SE - Agencies', 'soccer-engine-lite' ),
			esc_attr__( 'Agencies', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-agencies',
			function () {
				include_once 'view/agencies.php';}
		);

		$this->screen_id_agency_contracts = add_submenu_page(
			$this->shared->get( 'slug' ) . '-transfers',
			esc_attr__( 'SE - Agency Contracts', 'soccer-engine-lite' ),
			esc_attr__( 'Agency Contracts', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-agency-contracts',
			function () {
				include_once 'view/agency_contracts.php';}
		);

		$this->screen_id_agency_contract_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-transfers',
			esc_attr__( 'SE - Agency Contract Types', 'soccer-engine-lite' ),
			esc_attr__( 'Agency Contract Types', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-agency-contract-types',
			function () {
				include_once 'view/agency_contract_types.php';}
		);

		$this->screen_id_market_value_transitions = add_submenu_page(
			$this->shared->get( 'slug' ) . '-transfers',
			esc_attr__( 'SE - Market Value Transitions', 'soccer-engine-lite' ),
			esc_attr__( 'Market Value Transitions', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-market-value-transitions',
			function () {
				include_once 'view/market_value_transitions.php';}
		);

		// Players ----------------------------------------------------------------------------------------------------.
		add_menu_page(
			esc_attr__( 'SE', 'soccer-engine-lite' ),
			esc_attr__( 'SE Players', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-players',
			function () {
				include_once 'view/players.php';},
			'none'
		);

		$this->screen_id_players = add_submenu_page(
			$this->shared->get( 'slug' ) . '-players',
			esc_attr__( 'SE - Players', 'soccer-engine-lite' ),
			esc_attr__( 'Players', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-players',
			function () {
				include_once 'view/players.php';}
		);

		$this->screen_id_player_positions = add_submenu_page(
			$this->shared->get( 'slug' ) . '-players',
			esc_attr__( 'SE - Player Positions', 'soccer-engine-lite' ),
			esc_attr__( 'Player Positions', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-player-positions',
			function () {
				include_once 'view/player_positions.php';}
		);

		$this->screen_id_player_awards = add_submenu_page(
			$this->shared->get( 'slug' ) . '-players',
			esc_attr__( 'SE - Player Awards', 'soccer-engine-lite' ),
			esc_attr__( 'Player Awards', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-player-awards',
			function () {
				include_once 'view/player_awards.php';}
		);

		$this->screen_id_player_award_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-players',
			esc_attr__( 'SE - Player Award Types', 'soccer-engine-lite' ),
			esc_attr__( 'Player Award Types', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-player-award-types',
			function () {
				include_once 'view/player_award_types.php';}
		);

		$this->screen_id_unavailable_players = add_submenu_page(
			$this->shared->get( 'slug' ) . '-players',
			esc_attr__( 'SE - Unavailable Players', 'soccer-engine-lite' ),
			esc_attr__( 'Unavailable Players', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-unavailable-players',
			function () {
				include_once 'view/unavailable_players.php';}
		);

		$this->screen_id_unavailable_player_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-players',
			esc_attr__( 'SE - Unavailable Player Types', 'soccer-engine-lite' ),
			esc_attr__( 'Unavailable Player Types', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-unavailable-player-types',
			function () {
				include_once 'view/unavailable_player_types.php';}
		);

		$this->screen_id_injuries = add_submenu_page(
			$this->shared->get( 'slug' ) . '-players',
			esc_attr__( 'SE - Injuries', 'soccer-engine-lite' ),
			esc_attr__( 'Injuries', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-injuries',
			function () {
				include_once 'view/injuries.php';}
		);

		$this->screen_id_injury_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-players',
			esc_attr__( 'SE - Injury Types', 'soccer-engine-lite' ),
			esc_attr__( 'Injury Types', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-injury-types',
			function () {
				include_once 'view/injury_types.php';}
		);

		// Staff ------------------------------------------------------------------------------------------------------.
		add_menu_page(
			esc_attr__( 'SE', 'soccer-engine-lite' ),
			esc_attr__( 'SE Staff', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-staff',
			function () {
				include_once 'view/staff.php';},
			'none'
		);

		$this->screen_id_staff = add_submenu_page(
			$this->shared->get( 'slug' ) . '-staff',
			esc_attr__( 'SE - Staff', 'soccer-engine-lite' ),
			esc_attr__( 'Staff', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-staff',
			function () {
				include_once 'view/staff.php';}
		);

		$this->screen_id_staff_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-staff',
			esc_attr__( 'SE - Staff Types', 'soccer-engine-lite' ),
			esc_attr__( 'Staff Types', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-staff-types',
			function () {
				include_once 'view/staff_types.php';}
		);

		$this->screen_id_staff_awards = add_submenu_page(
			$this->shared->get( 'slug' ) . '-staff',
			esc_attr__( 'SE - Staff Awards', 'soccer-engine-lite' ),
			esc_attr__( 'Staff Awards', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-staff-awards',
			function () {
				include_once 'view/staff_awards.php';}
		);

		$this->screen_id_staff_award_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-staff',
			esc_attr__( 'SE - Staff Award Types', 'soccer-engine-lite' ),
			esc_attr__( 'Staff Award Types', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-staff-award-types',
			function () {
				include_once 'view/staff_award_types.php';}
		);

		// Staff --------------------------------------------------------------------------------------------------------
		add_menu_page(
			esc_attr__( 'SE', 'soccer-engine-lite' ),
			esc_attr__( 'SE Referees', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-referees',
			function () {
				include_once 'view/referees.php';},
			'none'
		);

		$this->screen_id_referees = add_submenu_page(
			$this->shared->get( 'slug' ) . '-referees',
			esc_attr__( 'SE - Referees', 'soccer-engine-lite' ),
			esc_attr__( 'Referees', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-referees',
			function () {
				include_once 'view/referees.php';}
		);

		$this->screen_id_referee_badges = add_submenu_page(
			$this->shared->get( 'slug' ) . '-referees',
			esc_attr__( 'SE - Referee Badges', 'soccer-engine-lite' ),
			esc_attr__( 'Referee Badges', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-referee-badges',
			function () {
				include_once 'view/referee_badges.php';}
		);

		$this->screen_id_referee_badge_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-referees',
			esc_attr__( 'SE - Referee Badge Types', 'soccer-engine-lite' ),
			esc_attr__( 'Referee Badge Types', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-referee-badge-types',
			function () {
				include_once 'view/referee_badge_types.php';}
		);

		// Teams ------------------------------------------------------------------------------------------------------.
		add_menu_page(
			esc_attr__( 'SE', 'soccer-engine-lite' ),
			esc_attr__( 'SE Teams', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-teams',
			function () {
				include_once 'view/teams.php';},
			'none'
		);

		$this->screen_id_teams = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Teams', 'soccer-engine-lite' ),
			esc_attr__( 'Teams', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-teams',
			function () {
				include_once 'view/teams.php';}
		);

		$this->screen_id_squads = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Squads', 'soccer-engine-lite' ),
			esc_attr__( 'Squads', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-squads',
			function () {
				include_once 'view/squads.php';}
		);

		$this->screen_id_formations = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Formations', 'soccer-engine-lite' ),
			esc_attr__( 'Formations', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-formations',
			function () {
				include_once 'view/formations.php';}
		);

		$this->screen_id_jersey_sets = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Jersey Sets', 'soccer-engine-lite' ),
			esc_attr__( 'Jersey Sets', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-jersey-sets',
			function () {
				include_once 'view/jersey_sets.php';}
		);

		$this->screen_id_stadiums = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Stadiums', 'soccer-engine-lite' ),
			esc_attr__( 'Stadiums', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-stadiums',
			function () {
				include_once 'view/stadiums.php';}
		);

		$this->screen_id_trophies = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Trophies', 'soccer-engine-lite' ),
			esc_attr__( 'Trophies', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-trophies',
			function () {
				include_once 'view/trophies.php';}
		);

		$this->screen_id_trophy_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Trophy Types', 'soccer-engine-lite' ),
			esc_attr__( 'Trophy Types', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-trophy-types',
			function () {
				include_once 'view/trophy_types.php';}
		);

		$this->screen_id_ranking_transitions = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Ranking Transitions', 'soccer-engine-lite' ),
			esc_attr__( 'Ranking Transitions', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-ranking-transitions',
			function () {
				include_once 'view/ranking_transitions.php';}
		);

		$this->screen_id_ranking_types = add_submenu_page(
			$this->shared->get( 'slug' ) . '-teams',
			esc_attr__( 'SE - Ranking Types', 'soccer-engine-lite' ),
			esc_attr__( 'Ranking Types', 'soccer-engine-lite' ),
			'edit_others_posts',
			$this->shared->get( 'slug' ) . '-ranking-types',
			function () {
				include_once 'view/ranking_types.php';}
		);

		// Options ----------------------------------------------------------------------------------------------------.
		add_menu_page(
			esc_attr__( 'SE', 'soccer-engine-lite' ),
			esc_attr__( 'SE Settings', 'soccer-engine-lite' ),
			'manage_options',
			$this->shared->get( 'slug' ) . '-export-to-pro',
			function () {
				include_once 'view/export_to_pro.php';},
			'none'
		);

		$this->screen_id_export_to_pro = add_submenu_page(
			$this->shared->get( 'slug' ) . '-export-to-pro',
			esc_attr__( 'SE - Export to Pro', 'soccer-engine-lite' ),
			esc_attr__( 'Export to Pro', 'soccer-engine-lite' ),
			'manage_options',
			$this->shared->get( 'slug' ) . '-export-to-pro',
			function () {
				include_once 'view/export_to_pro.php';}
		);

		$this->screen_id_maintenance = add_submenu_page(
			$this->shared->get( 'slug' ) . '-export-to-pro',
			esc_attr__( 'SE - Maintenance', 'soccer-engine-lite' ),
			esc_attr__( 'Maintenance', 'soccer-engine-lite' ),
			'manage_options',
			$this->shared->get( 'slug' ) . '-maintenance',
			function () {
				include_once 'view/maintenance.php';}
		);

		$this->screen_id_help = add_submenu_page(
			$this->shared->get( 'slug' ) . '-export-to-pro',
			esc_attr__( 'SE - Help', 'soccer-engine-lite' ),
			esc_attr__( 'Help', 'soccer-engine-lite' ),
			'manage_options',
			$this->shared->get( 'slug' ) . '-help',
			function () {
				include_once 'view/help.php';}
		);

		$this->screen_id_pro_version = add_submenu_page(
			$this->shared->get( 'slug' ) . '-export-to-pro',
			esc_attr__( 'SE - Pro Version', 'soccer-engine-lite' ),
			esc_attr__( 'Pro Version', 'soccer-engine-lite' ),
			'manage_options',
			$this->shared->get( 'slug' ) . '-pro-version',
			function () {
				include_once 'view/pro_version.php';}
		);

		$this->screen_id_options = add_submenu_page(
			$this->shared->get( 'slug' ) . '-export-to-pro',
			esc_attr__( 'SE - Options', 'soccer-engine-lite' ),
			esc_attr__( 'Options', 'soccer-engine-lite' ),
			'manage_options',
			$this->shared->get( 'slug' ) . '-options',
			function () {
				include_once 'view/options.php';}
		);
	}

	/*
	 * Register options.
	 */
	public function op_register_options() {

		require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-menu-options.php';
		new Daextsoenl_Menu_Options( $this->shared );
	}

	/*
	 * Generate the custom-[blog_id].css file based on the plugin options.
	 */
	static public function write_custom_css() {

		// Assign an instance of Daextsoenl_Shared.
		$shared = Daextsoenl_Shared::get_instance();

		// Turn on output buffering.
		ob_start();

		?>

		/* Table Header Background Color */
		<?php $table_header_background_color = get_option( $shared->get( 'slug' ) . '_table_header_background_color' ); ?>
		.daextsoenl-paginated-table-container table thead th,
		.daextsoenl-match-commentary-title,
		.daextsoenl-match-visual-lineup-left-header,
		.daextsoenl-match-visual-lineup-right-header,
		.daextsoenl-match-score-header,
		.daextsoenl-person-summary-content-title
		{background: <?php echo esc_attr( $table_header_background_color ); ?> !important;}

		/* Table Header Border Color */
		<?php $table_header_border_color = get_option( $shared->get( 'slug' ) . '_table_header_border_color' ); ?>
		.daextsoenl-paginated-table-container table thead th,
		.daextsoenl-match-commentary-title,
		.daextsoenl-match-visual-lineup-left-header,
		.daextsoenl-match-visual-lineup-right-header,
		.daextsoenl-match-score-header,
		.daextsoenl-person-summary-content-title
		{border-color: <?php echo esc_attr( $table_header_border_color ); ?> !important;}

		/* Table Header Font Color */
		<?php $table_header_font_color = get_option( $shared->get( 'slug' ) . '_table_header_font_color' ); ?>
		.daextsoenl-paginated-table-container table thead th,
		.daextsoenl-match-commentary-title,
		.daextsoenl-match-visual-lineup-left-header,
		.daextsoenl-match-visual-lineup-right-header,
		.daextsoenl-match-score-header,
		.daextsoenl-person-summary-content-title
		{color: <?php echo esc_attr( $table_header_font_color ); ?> !important;}

		/* Table Body Background Color */
		<?php $table_body_background_color = get_option( $shared->get( 'slug' ) . '_table_body_background_color' ); ?>
		.daextsoenl-paginated-table-container table tbody td,
		.daextsoenl-match-commentary-content,
		.daextsoenl-match-visual-lineup-right table td,
		.daextsoenl-match-score-body,
		.daextsoenl-person-summary-content-wrapper
		{background: <?php echo esc_attr( $table_body_background_color ); ?> !important;}

		/* Table Body Border Color */
		<?php $table_body_border_color = get_option( $shared->get( 'slug' ) . '_table_body_border_color' ); ?>
		.daextsoenl-paginated-table-container table tbody td,
		.daextsoenl-match-commentary-content,
		.daextsoenl-match-commentary-event-data,
		.daextsoenl-match-commentary-row,
		.daextsoenl-match-visual-lineup-right table td,
		.daextsoenl-match-score-body
		{border-color: <?php echo esc_attr( $table_body_border_color ); ?> !important;}

		/* Table Body Font Color */
		<?php $table_body_font_color = get_option( $shared->get( 'slug' ) . '_table_body_font_color' ); ?>
		.daextsoenl-paginated-table-container table tbody td,
		.daextsoenl-match-visual-lineup-right table td,
		.daextsoenl-match-score-body,
		.daextsoenl-match-commentary-event-time-top,
		.daextsoenl-match-commentary-event-description,
		.daextsoenl-match-commentary-event-details-row,
		.daextsoenl-match-score-body-team-1-name,
		.daextsoenl-match-score-body-team-1-position,
		.daextsoenl-match-score-body-match-result,
		.daextsoenl-match-score-body-team-2-name,
		.daextsoenl-match-score-body-team-2-position,
		.daextsoenl-person-summary-information-item-field,
		.daextsoenl-person-summary-information-item-value
		{color: <?php echo esc_attr( $table_body_font_color ); ?> !important;}

		/* Table Pagination Background Color */
		<?php $table_pagination_background_color = get_option( $shared->get( 'slug' ) . '_table_pagination_background_color' ); ?>
		.daextsoenl-paginated-table-pagination .daextsoenl-paginated-table-pagination-inner > a
		{background: <?php echo esc_attr( $table_pagination_background_color ); ?> !important;}

		/* Table Pagination Border Color */
		<?php $table_pagination_border_color = get_option( $shared->get( 'slug' ) . '_table_pagination_border_color' ); ?>
		.daextsoenl-paginated-table-pagination .daextsoenl-paginated-table-pagination-inner > a
		{border-color: <?php echo esc_attr( $table_pagination_border_color ); ?> !important;}

		/* Table Pagination Font Color */
		<?php $table_pagination_font_color = get_option( $shared->get( 'slug' ) . '_table_pagination_font_color' ); ?>
		.daextsoenl-paginated-table-pagination .daextsoenl-paginated-table-pagination-inner > a,
		.daextsoenl-paginated-table-pagination .daextsoenl-paginated-table-pagination-inner > span
		{color: <?php echo esc_attr( $table_pagination_font_color ); ?> !important;}



		/* Table Pagination Disabled Background Color */
		<?php $table_pagination_disabled_background_color = get_option( $shared->get( 'slug' ) . '_table_pagination_disabled_background_color' ); ?>
		.daextsoenl-paginated-table-pagination .daextsoenl-paginated-table-pagination-inner > a.disabled
		{background: <?php echo esc_attr( $table_pagination_disabled_background_color ); ?> !important;}

		/* Table Pagination Disabled Border Color */
		<?php $table_pagination_disabled_border_color = get_option( $shared->get( 'slug' ) . '_table_pagination_disabled_border_color' ); ?>
		.daextsoenl-paginated-table-pagination .daextsoenl-paginated-table-pagination-inner > a.disabled
		{border-color: <?php echo esc_attr( $table_pagination_disabled_border_color ); ?> !important;}

		/* Table Pagination Disabled Font Color */
		<?php $table_pagination_disabled_font_color = get_option( $shared->get( 'slug' ) . '_table_pagination_disabled_font_color' ); ?>
		.daextsoenl-paginated-table-pagination .daextsoenl-paginated-table-pagination-inner > a.disabled
		{color: <?php echo esc_attr( $table_pagination_disabled_font_color ); ?> !important;}

		/* Formation Field Background */
		<?php $formation_field_background_color = get_option( $shared->get( 'slug' ) . '_formation_field_background_color' ); ?>
		.daextsoenl-field-background{fill:<?php echo esc_attr( $formation_field_background_color ); ?>;}

		/* Formation Field Line Color */
		<?php $formation_field_line_color = get_option( $shared->get( 'slug' ) . '_formation_field_line_color' ); ?>
		.daextsoenl-field-line-1, .daextsoenl-field-line-2{fill:none;stroke:<?php echo esc_attr( $formation_field_line_color ); ?>;}

		/* Formation Field Line Stroke Width */
		<?php $formation_field_line_stroke_width = get_option( $shared->get( 'slug' ) . '_formation_field_line_stroke_width' ); ?>
		.daextsoenl-field-line-1, .daextsoenl-field-line-2{stroke-width:<?php echo esc_attr( $formation_field_line_stroke_width ); ?>}
		.daextsoenl-field-line-2{stroke-miterlimit:10;}

		/* Formation Field Player Number Background Color */
		<?php $formation_field_player_number_background_color = get_option( $shared->get( 'slug' ) . '_formation_field_player_number_background_color' ); ?>
		.daextsoenl-match-visual-lineup-left-formation-player-jersey-number
		{background: <?php echo esc_attr( $formation_field_player_number_background_color ); ?> !important;}

		/* Formation Field Player Number Border Color */
		<?php $formation_field_player_number_border_color = get_option( $shared->get( 'slug' ) . '_formation_field_player_number_border_color' ); ?>
		.daextsoenl-match-visual-lineup-left-formation-player-jersey-number
		{border-color: <?php echo esc_attr( $formation_field_player_number_border_color ); ?> !important;}

		/* Formation Field Player Number Font Color */
		<?php $formation_field_player_number_font_color = get_option( $shared->get( 'slug' ) . '_formation_field_player_number_font_color' ); ?>
		.daextsoenl-match-visual-lineup-left-formation-player-jersey-number
		{color: <?php echo esc_attr( $formation_field_player_number_font_color ); ?> !important;}

		/* Formation Field Player Name Font Color */
		<?php $formation_field_player_name_font_color = get_option( $shared->get( 'slug' ) . '_formation_field_player_name_font_color' ); ?>
		.daextsoenl-match-visual-lineup-left-formation-player-name
		{color: <?php echo esc_attr( $formation_field_player_name_font_color ); ?> !important;}

		/* Block Margin Top */

		.daextsoenl-paginated-table-container,
		.daextsoenl-match-commentary,
		.daextsoenl-match-score,
		.daextsoenl-person-summary,
		.daextsoenl-match-visual-lineup{
		<?php $block_margin_top = get_option( $shared->get( 'slug' ) . '_block_margin_top' ); ?>
		margin-top: <?php echo intval( $block_margin_top, 10 ); ?>px !important;
		<?php $block_margin_bottom = get_option( $shared->get( 'slug' ) . '_block_margin_bottom' ); ?>
		margin-bottom: <?php echo intval( $block_margin_bottom, 10 ); ?>px !important;
		}

		<?php

		$responsive_breakpoint_1 = get_option( $shared->get( 'slug' ) . '_responsive_breakpoint_1' );
		$responsive_breakpoint_2 = get_option( $shared->get( 'slug' ) . '_responsive_breakpoint_2' );

		?>

		/* Breakpoint 1 */
		@media screen and (min-width: <?php echo intval( $responsive_breakpoint_2, 10 ) + 1; ?>px) and (max-width: <?php echo intval( $responsive_breakpoint_1, 10 ); ?>px){

			/* Paginated Table -------------------------------------------------------------------------------------- */
			.daextsoenl-paginated-table-container [data-breakpoint-1-hidden="1"]{
				display: none !important;
			}

			/* Match Score ------------------------------------------------------------------------------------------ */
			.daextsoenl-match-score-body-info,
			.daextsoenl-match-score-body-additional-info-stadium-attendance,
			.daextsoenl-match-score-body-additional-info-referee{
				display: none !important;
			}

			.daextsoenl-match-score-body-match-result{
				line-height: 96px !important;
				height: 96px !important;
			}

			.daextsoenl-match-score-body-result{
				margin: 0 !important;
			}

			/* Person Summary --------------------------------------------------------------------------------------- */
			.daextsoenl-person-summary-image{
				display: none !important;
			}

			.daextsoenl-person-summary-information {
				flex-basis: 100% !important;
				display: flex !important;
				flex-direction: column !important;
			}

			/* Match Visual Lineup ---------------------------------------------------------------------------------- */
			.daextsoenl-match-visual-lineup{
				flex-direction: column !important;
			}

			.daextsoenl-match-visual-lineup-left,
			.daextsoenl-match-visual-lineup-right{
				flex-basis: 100% !important;
			}

		}

		/* Breakpoint 2 */
		@media screen and (max-width: <?php echo intval( $responsive_breakpoint_2, 10 ); ?>px) {

			/* Paginated Table -------------------------------------------------------------------------------------- */
			.daextsoenl-paginated-table-container [data-breakpoint-2-hidden="1"]{
				display: none !important;
			}

			/* Match Commentary ------------------------------------------------------------------------------------- */
			.daextsoenl-match-commentary-event-details-left{
			display: none !important;
			}

			.daextsoenl-match-commentary-event-details-right {
			width: 100% !important;
			}

			/* Match Score ------------------------------------------------------------------------------------------ */
			.daextsoenl-match-score-body-info,
			.daextsoenl-match-score-body-additional-info-stadium-attendance,
			.daextsoenl-match-score-body-additional-info-referee{
			display: none !important;
			}

			.daextsoenl-match-score-body-match-result{
			line-height: 96px !important;
			height: 96px !important;
			}

			.daextsoenl-match-score-body-result{
			margin: 0 !important;
			}

			.daextsoenl-match-score-body-team-1-logo,
			.daextsoenl-match-score-body-team-2-logo{
			display: none !important;
			}

			.daextsoenl-match-score-body-team-1-details,
			.daextsoenl-match-score-body-team-2-details{
			flex-basis: calc(100%) !important;
			padding: 0 !important;
			}

			/* Person Summary --------------------------------------------------------------------------------------- */
			.daextsoenl-person-summary-image{
			display: none !important;
			}

			.daextsoenl-person-summary-information {
			flex-basis: 100% !important;
			display: flex !important;
			flex-direction: column !important;
			}

			/* Match Visual Lineup ---------------------------------------------------------------------------------- */
			.daextsoenl-match-visual-lineup{
				flex-direction: column !important;
			}

			.daextsoenl-match-visual-lineup-left,
			.daextsoenl-match-visual-lineup-right{
				flex-basis: 100% !important;
			}

		}
		/* Font Family */
		<?php $font_family = get_option( $shared->get( 'slug' ) . '_font_family' ); ?>
		.daextsoenl-paginated-table-container *,
		.daextsoenl-no-data-paragraph *,
		.daextsoenl-match-commentary *,
		.daextsoenl-match-visual-lineup *,
		.daextsoenl-match-score *,
		.daextsoenl-person-summary *
		{font-family: <?php echo htmlspecialchars( $font_family, ENT_COMPAT ); ?> !important;}

		/* Event Icon Goal Color */
		<?php

		$event_icon_goal_color = get_option( $shared->get( 'slug' ) . '_event_icon_goal_color' );

		?>

		.daextsoenl-event-icon-svg-goal{fill:<?php echo esc_attr( $event_icon_goal_color ); ?>}

		/* Event Icon Yellow Card Color*/

		<?php

		$event_icon_yellow_card_color = get_option( $shared->get( 'slug' ) . '_event_icon_yellow_card_color' );

		?>

		.daextsoenl-event-icon-svg-yellow-card{fill:<?php echo esc_attr( $event_icon_yellow_card_color ); ?>}

		/* Event Icon Red Card Color */

		<?php

		$event_icon_red_card_color = get_option( $shared->get( 'slug' ) . '_event_icon_red_card_color' );

		?>

		.daextsoenl-event-icon-svg-red-card{fill:<?php echo esc_attr( $event_icon_red_card_color ); ?>}

		/* Event Icon Substitution Left Arrow Color */

		<?php

		$event_icon_substitution_left_arrow_color = get_option( $shared->get( 'slug' ) . '_event_icon_substitution_left_arrow_color' );

		?>

		.daextsoenl-event-icon-svg-substitution-in{fill:<?php echo esc_attr( $event_icon_substitution_left_arrow_color ); ?>}

		/* Event Icon Substitution Right Arrow Color */

		<?php

		$event_icon_substitution_right_arrow_color = get_option( $shared->get( 'slug' ) . '_event_icon_substitution_left_arrow_color' );

		?>

		.daextsoenl-event-icon-svg-substitution-out{fill:<?php echo esc_attr( $event_icon_substitution_right_arrow_color ); ?>}

		/* Default Avatar Color */

		<?php

		$default_avatar_color = get_option( $shared->get( 'slug' ) . '_default_avatar_color' );

		?>

		.daextsoenl-default-avatar-subject{fill:<?php echo esc_attr( $default_avatar_color ); ?>}

		/* Default Avatar Background Color */

		<?php

		$default_avatar_background_color = get_option( $shared->get( 'slug' ) . '_default_avatar_background_color' );

		?>

		.daextsoenl-default-avatar-background{fill:<?php echo esc_attr( $default_avatar_background_color ); ?>}

		/* Default Team Logo Color */

		<?php

		$default_team_logo_color = get_option( $shared->get( 'slug' ) . '_default_team_logo_color' );

		?>

		.daextsoenl-default-team-logo{fill:<?php echo esc_attr( $default_team_logo_color ); ?>}

		/* Default Team Logo Background Color */

		<?php

		$default_team_logo_background_color = get_option( $shared->get( 'slug' ) . '_default_team_logo_background_color' );

		?>

		.daextsoenl-default-team-logo-background{fill:<?php echo esc_attr( $default_team_logo_background_color ); ?>}

		/* Default Trophy Type Logo Color */

		<?php

		$default_trophy_type_logo_color = get_option( $shared->get( 'slug' ) . '_default_trophy_type_logo_color' );

		?>

		.daextsoenl-default-trophy-type-logo{fill:<?php echo esc_attr( $default_trophy_type_logo_color ); ?>}

		/* Default Trophy Type Logo Background Color */

		<?php

		$default_trophy_type_logo_background_color = get_option( $shared->get( 'slug' ) . '_default_trophy_type_logo_background_color' );

		?>

		.daextsoenl-default-trophy-type-logo-background{fill:<?php echo esc_attr( $default_trophy_type_logo_background_color ); ?>}

		/* Clock Background Color */

		<?php

		$clock_background_color = get_option( $shared->get( 'slug' ) . '_clock_background_color' );

		?>

		.daextsoenl-clock-2{fill:<?php echo esc_attr( $clock_background_color ); ?>;}

		/* Clock Primary Ticks Color */

		<?php

		$clock_primary_ticks_color = get_option( $shared->get( 'slug' ) . '_clock_background_color' );

		?>

		.daextsoenl-clock-3{fill:<?php echo esc_attr( $clock_primary_ticks_color ); ?>;}

		/* Clock Secondary Ticks Color */

		<?php

		$clock_secondary_ticks_color = get_option( $shared->get( 'slug' ) . '_clock_secondary_ticks_color' );

		?>

		.daextsoenl-clock-1{fill:<?php echo esc_attr( $clock_secondary_ticks_color ); ?>;}

		/* Clock Border Color */

		<?php

		$clock_border_color = get_option( $shared->get( 'slug' ) . '_clock_border_color' );

		?>

		.daextsoenl-clock-6{fill:<?php echo esc_attr( $clock_border_color ); ?>;}

		/* Clock Overlay Color */

		<?php

		$clock_overlay_color = get_option( $shared->get( 'slug' ) . '_clock_overlay_color' );

		?>

		.daextsoenl-clock-4{opacity: 0.5;fill:<?php echo esc_attr( $clock_overlay_color ); ?>;}

		/* Clock Extra Time Overlay Color */

		<?php

		$clock_extra_time_overlay_color = get_option( $shared->get( 'slug' ) . '_clock_extra_time_overlay_color' );

		?>

		.daextsoenl-clock-5{opacity: 0.5;fill:<?php echo esc_attr( $clock_extra_time_overlay_color ); ?>;}

		<?php

		$custom_css_string = ob_get_clean();

		// Get the upload directory path and the file path.
		$upload_dir_path  = self::get_plugin_upload_path();
		$upload_file_path = self::get_plugin_upload_path() . 'custom-' . get_current_blog_id() . '.css';

		// If the plugin upload directory doesn't exist create it.
		if ( ! is_dir( $upload_dir_path ) ) {
			mkdir( $upload_dir_path );
		}

		// Write the custom css file.
		return @file_put_contents(
			$upload_file_path,
			$custom_css_string,
			LOCK_EX
		);
	}

	/**
	 * Get the plugin upload path.
	 *
	 * @return string The plugin upload path
	 */
	static public function get_plugin_upload_path() {

		$upload_path = WP_CONTENT_DIR . '/uploads/daextsoenl_uploads/';

		return $upload_path;
	}

	/**
	 * Generates the XML file with included all the plugin data.
	 *
	 * Note that the XML file is served when the "Export" button available in the "Export to Pro" menu is clicked.
	 */
	public function export_xml_controller() {

		/**
		 * Intercept requests that come from the "Export" button of the
		 * "Soccer Engine -> Export" menu and generate the downloadable XML file
		 */
		if ( isset( $_POST['daextsoenl_export'] ) ) {

			// Nonce verification.
			check_admin_referer( 'daim_tools_export', 'daim_tools_export' );

			// Verify capability.
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_attr__( 'You do not have sufficient permissions to access this page.' ) );
			}

			// Generate the header of the XML file.
			header( 'Content-Encoding: UTF-8' );
			header( 'Content-type: text/xml; charset=UTF-8' );
			header( 'Content-Disposition: attachment; filename=soccer-engine-' . time() . '.xml' );
			header( 'Pragma: no-cache' );
			header( 'Expires: 0' );

			// Generate initial part of the XML file.
			$out  = '<?xml version="1.0" encoding="UTF-8" ?>';
			$out .= '<root>';

			global $wpdb;
			foreach ( $this->shared->get( 'database_tables' ) as $key => $database_table ) {

				// Get the data from the db.
				$record_a = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $database_table['name'] . ' ORDER BY ' . $database_table['sort_by'] . ' ASC', ARRAY_A );

				// If there are data generate the csv header and the content.
				if ( count( $record_a ) > 0 ) {

					$out .= '<' . $database_table['name'] . '>';

					// Set column content.
					foreach ( $record_a as $record ) {

						$out .= '<record>';

						// Get all the indexes of the $table array.
						$index_keys = array_keys( $record );

						// Cycle through all the indexes of $table and create all the tags related to this record.
						foreach ( $index_keys as $index ) {

							$out .= '<' . $index . '>' . esc_attr( $record[ $index ] ) . '</' . $index . '>';

						}

						$out .= '</record>';

					}

					$out .= '</' . $database_table['name'] . '>';

				}
			}

			// Generate the final part of the XML file.
			$out .= '</root>';

			echo $out;
			die();

		}
	}

	/**
	 * Echo all the dismissible notices based on the values of the $notices array.
	 *
	 * @param array $notices The array of notices to be displayed.
	 */
	public function dismissible_notice( $notices ) {

		foreach ( $notices as $notice ) {
			echo '<div class="' . esc_attr( $notice['class'] ) . ' settings-error notice is-dismissible below-h2"><p>' . esc_html( $notice['message'] ) . '</p></div>';
		}
	}
}