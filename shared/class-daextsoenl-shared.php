<?php
/**
 * The Shared class is used to store properties and methods shared by the admin and public side of WordPress.
 *
 * @package real-voice-pro
 */

/*
 * This class should be used to stores properties and methods shared by the
 * admin and public side of WordPress.
 */
class Daextsoenl_Shared {


	// Private properties -----------------------------------------------------------------------------------------------
	private $non_deletable_occurrences = null;
	private $non_deletable_item_name   = null;
	private $non_deletable_field_name  = null;
	private $non_deletable_id          = null;
	private $paginated_table_counter   = 0;
	private $order_priority_1          = null;
	private $order_by_priority_1       = null;
	private $order_priority_2          = null;
	private $order_by_priority_2       = null;
	private $data                      = array();
	public $match_exists               = null;
	public $match_effect_exists        = null;
	public $player_exists_none_allowed = null;
	public $staff_exists_none_allowed  = null;

	// Public properties ------------------------------------------------------------------------------------------------

	// Match a number with maximum ten digits.
	public $regex_number_ten_digits = '/^\s*\d{1,10}\s*$/';

	// Match a capability.
	public $regex_capability = '/^\s*[A-Za-z0-9_]+\s*$/';

	// Match an URL.
	public $url_regex = '/^(http|https):\/\/[-A-Za-z0-9+&@#\/%?=~_|$!:,.;]+$/i';

	// Match a hex rgb color or a rgba color.
	public $regex_color = '/^((\#([0-9a-fA-F]{3}){1,2})|(rgba\(\d{1,3},\d{1,3},\d{1,3},(\d{1}|\d{1}\.\d{1,2})\)))$/';

	// Match a hex rgb color, a rgba color or a comma separated list of hex rgb colors and rgba colors.
	public $regex_color_or_colors = '/^((\#([0-9a-fA-F]{3}){1,2})|(rgba\(\d{1,3},\d{1,3},\d{1,3},(\d{1}|\d{1}\.\d{1,2})\)))(,\s*(\#([0-9a-fA-F]{3}){1,2}|rgba\(\d{1,3},\d{1,3},\d{1,3},(\d{1}|\d{1}\.\d{1,2})\)))*$/';

	// Match a font family or a comma separated list of font families.
	public $regex_font_family_or_font_families = "/^(('[^'\"]+'|[^,\"]+)(,('[^'\"]+'|[^,\"]+))*)$/";

	protected static $instance = null;

	private function __construct() {

		// Save commonly used data.
		$this->data['slug']        = 'daextsoenl';
		$this->data['ver']         = '1.13';
		$this->data['dir']         = substr( plugin_dir_path( __FILE__ ), 0, -7 );
		$this->data['url']         = substr( plugin_dir_url( __FILE__ ), 0, -7 );
		$this->data['text_domain'] = 'soccer-engine-lite';

		/**
		 * This array includes a list of countries:
		 *
		 * - All the ISO 3166-1 alpha-2 codes
		 * - Additional custom codes not included in ISO 3166-1 alpha-2 but required by the plugin
		 *
		 * This is a list of the additional flags:
		 *
		 * - England (01)
		 * - Northern Ireland (02)
		 * - Scotland (03)
		 * - Wales (04)
		 */
		$this->data['countries'] = array(

			// ISO 3166-1 alpha-2 flags.
			'Andorra'                                      => 'ad',
			'United Arab Emirates'                         => 'ae',
			'Afghanistan'                                  => 'af',
			'Antigua and Barbuda'                          => 'ag',
			'Anguilla'                                     => 'ai',
			'Albania'                                      => 'al',
			'Armenia'                                      => 'am',
			'Angola'                                       => 'ao',
			'Antartica'                                    => 'aq',
			'Argentina'                                    => 'ar',
			'American Samoa'                               => 'as',
			'Austria'                                      => 'at',
			'Australia'                                    => 'au',
			'Aruba'                                        => 'aw',
			'Åland Islands'                                => 'ax',
			'Azerbaijan'                                   => 'az',
			'Bosnia and Herzegovina'                       => 'ba',
			'Barbados'                                     => 'bb',
			'Bangladesh'                                   => 'bd',
			'Belgium'                                      => 'be',
			'Burkina Faso'                                 => 'bf',
			'Bulgaria'                                     => 'bg',
			'Bahrain'                                      => 'bh',
			'Burundi'                                      => 'bi',
			'Benin'                                        => 'bj',
			'Saint Barthélemy'                             => 'bl',
			'Bermuda'                                      => 'bm',
			'Brunei Darussalam'                            => 'bn',
			'Bolivia'                                      => 'bo',
			'Bonaire, Sint Eustatius and Saba'             => 'bq',
			'Brazil'                                       => 'br',
			'Bahamas'                                      => 'bs',
			'Bhutan'                                       => 'bt',
			'Bouvet Island'                                => 'bv',
			'Botswana'                                     => 'bw',
			'Belarus'                                      => 'by',
			'Belize'                                       => 'bz',
			'Canada'                                       => 'ca',
			'Cocos (Keeling) Islands'                      => 'cc',
			'Congo Democratic Republic'                    => 'cd',
			'Central African Republic'                     => 'cf',
			'Congo'                                        => 'cg',
			'Switzerland'                                  => 'ch',
			'Côte d\'Ivoire'                               => 'ci',
			'Cook Islands'                                 => 'ck',
			'Chile'                                        => 'cl',
			'Cameroon'                                     => 'cm',
			'China'                                        => 'cn',
			'Colombia'                                     => 'co',
			'Costa Rica'                                   => 'cr',
			'Cuba'                                         => 'cu',
			'Cape Verde'                                   => 'cv',
			'Curaçao'                                      => 'cw',
			'Christmas Island'                             => 'cx',
			'Cyprus'                                       => 'cy',
			'Czech Republic'                               => 'cz',
			'Germany'                                      => 'de',
			'Djibouti'                                     => 'dj',
			'Denmark'                                      => 'dk',
			'Dominica'                                     => 'dm',
			'Dominican Republic'                           => 'do',
			'Algeria'                                      => 'dz',
			'Ecuador'                                      => 'ec',
			'Estonia'                                      => 'ee',
			'Egypt'                                        => 'eg',
			'Western Sahara'                               => 'eh',
			'Eritrea'                                      => 'er',
			'Spain'                                        => 'es',
			'Ethiopia'                                     => 'et',
			'Finland'                                      => 'fi',
			'Fiji'                                         => 'fj',
			'Falkland Islands (Malvinas)'                  => 'fk',
			'Micronesia Federated States of'               => 'fm',
			'Faroe Islands'                                => 'fo',
			'France'                                       => 'fr',
			'Gabon'                                        => 'ga',
			'United Kingdom'                               => 'gb',
			'Grenada'                                      => 'gd',
			'Georgia'                                      => 'ge',
			'French Guiana'                                => 'gf',
			'Guernsey'                                     => 'gg',
			'Ghana'                                        => 'gh',
			'Gibraltar'                                    => 'gi',
			'Greenland'                                    => 'gl',
			'Gambia'                                       => 'gm',
			'Guinea'                                       => 'gn',
			'Guadeloupe'                                   => 'gp',
			'Equatorial Guinea'                            => 'gq',
			'Greece'                                       => 'gr',
			'South Georgia and the South Sandwich Islands' => 'gs',
			'Guatemala'                                    => 'gt',
			'Guam'                                         => 'gu',
			'Guinea-Bissau'                                => 'gw',
			'Guyana'                                       => 'gy',
			'Hong Kong'                                    => 'hk',
			'Heard Island and McDonald Islands'            => 'hm',
			'Honduras'                                     => 'hn',
			'Croatia'                                      => 'hr',
			'Haiti'                                        => 'ht',
			'Hungary'                                      => 'hu',
			'Indonesia'                                    => 'id',
			'Ireland'                                      => 'ie',
			'Israel'                                       => 'il',
			'Isle of Man'                                  => 'im',
			'India'                                        => 'in',
			'British Indian Ocean Territory'               => 'io',
			'Iraq'                                         => 'iq',
			'Iran, Islamic Republic of'                    => 'ir',
			'Iceland'                                      => 'is',
			'Italy'                                        => 'it',
			'Jersey'                                       => 'je',
			'Jamaica'                                      => 'jm',
			'Jordan'                                       => 'jo',
			'Japan'                                        => 'jp',
			'Kenya'                                        => 'ke',
			'Kyrgyzstan'                                   => 'kg',
			'Cambodia'                                     => 'kh',
			'Kiribati'                                     => 'ki',
			'Comoros'                                      => 'km',
			'Saint Kitts and Nevis'                        => 'kn',
			'Korea, Democratic People\'s Republic of'      => 'kp',
			'Korea, Republic of'                           => 'kr',
			'Kuwait'                                       => 'kw',
			'Cayman Islands'                               => 'ky',
			'Kazakhstan'                                   => 'kz',
			'Lao People\'s Democratic Republic'            => 'la',
			'Lebanon'                                      => 'la',
			'Saint Lucia'                                  => 'lc',
			'Liechtenstein'                                => 'li',
			'Sri Lanka'                                    => 'lk',
			'Liberia'                                      => 'lr',
			'Lesotho'                                      => 'ls',
			'Lithuania'                                    => 'lt',
			'Luxembourg'                                   => 'lu',
			'Latvia'                                       => 'lv',
			'Libya'                                        => 'ly',
			'Morocco'                                      => 'ma',
			'Monaco'                                       => 'mc',
			'Moldova, Republic of'                         => 'md',
			'Montenegro'                                   => 'me',
			'Saint Martin (French part)'                   => 'mf',
			'Madagascar'                                   => 'mg',
			'Marshall Islands'                             => 'mh',
			'Macedonia, the former Yugoslav Republic of'   => 'mk',
			'Mali'                                         => 'ml',
			'Myanmar'                                      => 'mm',
			'Mongolia'                                     => 'mn',
			'Macao'                                        => 'mo',
			'Northern Mariana Islands'                     => 'mp',
			'Martinique'                                   => 'mq',
			'Mauritania'                                   => 'mr',
			'Montserrat'                                   => 'ms',
			'Malta'                                        => 'mt',
			'Mauritius'                                    => 'mu',
			'Maldives'                                     => 'mv',
			'Malawi'                                       => 'mw',
			'Mexico'                                       => 'mx',
			'Malaysia'                                     => 'my',
			'Mozambique'                                   => 'mz',
			'Namibia'                                      => 'na',
			'New Caledonia'                                => 'nc',
			'Niger'                                        => 'ne',
			'Norfolk Island'                               => 'nf',
			'Nigeria'                                      => 'ng',
			'Nicaragua'                                    => 'ni',
			'Netherlands'                                  => 'nl',
			'Norway'                                       => 'no',
			'Nepal'                                        => 'np',
			'Nauru'                                        => 'nr',
			'Niue'                                         => 'nu',
			'New Zealand'                                  => 'nz',
			'Oman'                                         => 'om',
			'Panama'                                       => 'pa',
			'Peru'                                         => 'pe',
			'French Polynesia'                             => 'pf',
			'Papua New Guinea'                             => 'pg',
			'Philippines'                                  => 'ph',
			'Pakistan'                                     => 'pk',
			'Poland'                                       => 'pl',
			'Saint Pierre and Miquelon'                    => 'pm',
			'Pitcairn'                                     => 'pn',
			'Puerto Rico'                                  => 'pr',
			'Palestine, State of'                          => 'ps',
			'Portugal'                                     => 'pt',
			'Palau'                                        => 'pw',
			'Paraguay'                                     => 'py',
			'Qatar'                                        => 'qa',
			'Réunion'                                      => 're',
			'Romania'                                      => 'ro',
			'Serbia'                                       => 'rs',
			'Russian Federation'                           => 'ru',
			'Rwanda'                                       => 'rw',
			'Saudi Arabia'                                 => 'sa',
			'Solomon Islands'                              => 'sb',
			'Seychelles'                                   => 'sc',
			'Sudan'                                        => 'sd',
			'Sweden'                                       => 'se',
			'Singapore'                                    => 'sg',
			'Saint Helena, Ascension and Tristan da Cunha' => 'sh',
			'Slovenia'                                     => 'si',
			'Svalbard and Jan Mayen'                       => 'sj',
			'Slovakia'                                     => 'sk',
			'Sierra Leone'                                 => 'sl',
			'San Marino'                                   => 'sm',
			'Senegal'                                      => 'sn',
			'Somalia'                                      => 'so',
			'Suriname'                                     => 'sr',
			'South Sudan'                                  => 'ss',
			'Sao Tome and Principe'                        => 'st',
			'El Salvador'                                  => 'sv',
			'Sint Maarten (Dutch part)'                    => 'sx',
			'Syrian Arab Republic'                         => 'sy',
			'Swaziland'                                    => 'sz',
			'Turks and Caicos Islands'                     => 'tc',
			'Chad'                                         => 'td',
			'French Southern Territories'                  => 'tf',
			'Togo'                                         => 'tg',
			'Thailand'                                     => 'th',
			'Tajikistan'                                   => 'tj',
			'Tokelau'                                      => 'tk',
			'Timor-Leste'                                  => 'tl',
			'Turkmenistan'                                 => 'tm',
			'Tunisia'                                      => 'tn',
			'Tonga'                                        => 'to',
			'Turkey'                                       => 'tr',
			'Trinidad and Tobago'                          => 'tt',
			'Tuvalu'                                       => 'tv',
			'Taiwan, Province of China'                    => 'tw',
			'Tanzania, United Republic of'                 => 'tz',
			'Ukraine'                                      => 'ua',
			'Uganda'                                       => 'ug',
			'United States Minor Outlying Islands'         => 'um',
			'United States'                                => 'us',
			'Uruguay'                                      => 'uy',
			'Uzbekistan'                                   => 'uz',
			'Holy See (Vatican City State)'                => 'va',
			'Saint Vincent and the Grenadines'             => 'vc',
			'Venezuela, Bolivarian Republic of'            => 've',
			'Virgin Islands, British'                      => 'vg',
			'Virgin Islands, U.S.'                         => 'vi',
			'Viet Nam'                                     => 'vn',
			'Vanuatu'                                      => 'vu',
			'Wallis and Futuna'                            => 'wf',
			'Samoa'                                        => 'ws',
			'Yemen'                                        => 'ye',
			'Mayotte'                                      => 'yt',
			'South Africa'                                 => 'za',
			'Zambia'                                       => 'zm',
			'Zimbabwe'                                     => 'zw',

			// Additional Flags
			'England'                                      => '01',
			'Northern Ireland'                             => '02',
			'Scotland'                                     => '03',
			'Wales'                                        => '04',

		);

		// The x and y coordinates of the default formation.
		$this->data['default_formation'] = array(
			1  => array(
				'x' => 50,
				'y' => 82,
			),
			2  => array(
				'x' => 20,
				'y' => 54,
			),
			3  => array(
				'x' => 40,
				'y' => 60,
			),
			4  => array(
				'x' => 60,
				'y' => 60,
			),
			5  => array(
				'x' => 80,
				'y' => 54,
			),
			6  => array(
				'x' => 20,
				'y' => 32,
			),
			7  => array(
				'x' => 40,
				'y' => 38,
			),
			8  => array(
				'x' => 60,
				'y' => 38,
			),
			9  => array(
				'x' => 80,
				'y' => 32,
			),
			10 => array(
				'x' => 40,
				'y' => 16,
			),
			11 => array(
				'x' => 60,
				'y' => 16,
			),
		);

		// Here are stored the plugin option with the related default values.
		$this->data['options'] = array(

			// Database Version ---------------------------------------------------------------------------------------.
			$this->get( 'slug' ) . '_database_version'     => '0',

			// Style --------------------------------------------------------------------------------------------------.
			$this->get( 'slug' ) . '_table_header_background_color' => '#f2f2f2',
			$this->get( 'slug' ) . '_table_header_border_color' => '#e1e1e1',
			$this->get( 'slug' ) . '_table_header_font_color' => '#333333',
			$this->get( 'slug' ) . '_table_body_background_color' => '#ffffff',
			$this->get( 'slug' ) . '_table_body_border_color' => '#e1e1e1',
			$this->get( 'slug' ) . '_table_body_font_color' => '#666666',
			$this->get( 'slug' ) . '_table_pagination_background_color' => '#f2f2f2',
			$this->get( 'slug' ) . '_table_pagination_border_color' => '#e1e1e1',
			$this->get( 'slug' ) . '_table_pagination_font_color' => '#333333',
			$this->get( 'slug' ) . '_table_pagination_disabled_background_color' => '#eeeeee',
			$this->get( 'slug' ) . '_table_pagination_disabled_border_color' => '#eeeeee',
			$this->get( 'slug' ) . '_table_pagination_disabled_font_color' => '#ffffff',
			$this->get( 'slug' ) . '_formation_field_background_color' => '#5488db',
			$this->get( 'slug' ) . '_formation_field_line_color' => '#ffffff',
			$this->get( 'slug' ) . '_formation_field_line_stroke_width' => '2',
			$this->get( 'slug' ) . '_formation_field_player_number_background_color' => '#3266b9',
			$this->get( 'slug' ) . '_formation_field_player_number_border_color' => '#ffffff',
			$this->get( 'slug' ) . '_formation_field_player_number_font_color' => '#ffffff',
			$this->get( 'slug' ) . '_formation_field_player_name_font_color' => '#ffffff',
			$this->get( 'slug' ) . '_clock_background_color' => '#ffffff',
			$this->get( 'slug' ) . '_clock_secondary_ticks_color' => '#dfdfdf',
			$this->get( 'slug' ) . '_clock_primary_ticks_color' => '#585858',
			$this->get( 'slug' ) . '_clock_border_color'   => '#dfdfdf',
			$this->get( 'slug' ) . '_clock_overlay_color'  => '#dfdfdf',
			$this->get( 'slug' ) . '_clock_extra_time_overlay_color' => '#b80716',
			$this->get( 'slug' ) . '_event_icon_goal_color' => '#f23d3d',
			$this->get( 'slug' ) . '_event_icon_yellow_card_color' => '#f2b807',
			$this->get( 'slug' ) . '_event_icon_red_card_color' => '#f23d3d',
			$this->get( 'slug' ) . '_event_icon_substitution_left_arrow_color' => '#b80718',
			$this->get( 'slug' ) . '_event_icon_substitution_right_arrow_color' => '#749f18',
			$this->get( 'slug' ) . '_default_avatar_color' => '#939dad',
			$this->get( 'slug' ) . '_default_avatar_background_color' => '#e4e7ed',
			$this->get( 'slug' ) . '_default_team_logo_color' => '#939dad',
			$this->get( 'slug' ) . '_default_team_logo_background_color' => '#e4e7ed',
			$this->get( 'slug' ) . '_default_competition_logo_color' => '#939dad',
			$this->get( 'slug' ) . '_default_competition_logo_background_color' => '#e4e7ed',
			$this->get( 'slug' ) . '_default_trophy_type_logo_color' => '#939dad',
			$this->get( 'slug' ) . '_default_trophy_type_logo_background_color' => '#e4e7ed',

			// Advanced -----------------------------------------------------------------------------------------------.
			$this->get( 'slug' ) . '_money_format_decimal_separator' => '.',
			$this->get( 'slug' ) . '_money_format_thousands_separator' => ',',
			$this->get( 'slug' ) . '_money_format_decimals' => '0',
			$this->get( 'slug' ) . '_money_format_simplify_million' => '0',
			$this->get( 'slug' ) . '_money_format_simplify_million_decimals' => '0',
			$this->get( 'slug' ) . '_money_format_million_symbol' => 'm',
			$this->get( 'slug' ) . '_money_format_simplify_thousands' => '0',
			$this->get( 'slug' ) . '_money_format_simplify_thousands_decimals' => '0',
			$this->get( 'slug' ) . '_money_format_thousands_symbol' => '',
			$this->get( 'slug' ) . '_money_format_currency' => '$',
			$this->get( 'slug' ) . '_money_format_currency_position' => '0',
			$this->get( 'slug' ) . '_height_measurement_unit' => 'm',
			$this->get( 'slug' ) . '_set_max_execution_time' => '1',
			$this->get( 'slug' ) . '_max_execution_time_value' => '3600',
			$this->get( 'slug' ) . '_set_memory_limit'     => '1',
			$this->get( 'slug' ) . '_memory_limit_value'   => '512',
			$this->get( 'slug' ) . '_transient_expiration' => '0',
			$this->get( 'slug' ) . '_block_margin_top'     => '20',
			$this->get( 'slug' ) . '_block_margin_bottom'  => '20',
			$this->get( 'slug' ) . '_responsive_breakpoint_1' => '1024',
			$this->get( 'slug' ) . '_responsive_breakpoint_2' => '480',
			$this->get( 'slug' ) . '_font_family'          => "'Open Sans', sans-serif",
			$this->get( 'slug' ) . '_google_font_url'      => 'https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese',
		);

		/**
		 * The list of database tables used by the plugin with related primary key and hierarchical level.
		 *
		 * Note that the hierarchical level of a table has been determined based on the fact that has the necessity to
		 * make use of the primary key values stored in table assigned to lower hierarchical levels.
		 *
		 * The hierarchical level is used in the process used to import the XML file with the data of the tables.
		 * This process is actually used in the Settings -> Import menu of the plugin.
		 */
		$this->data['database_tables'] = array(
			array(
				'name'            => 'agency',
				'sort_by'         => 'agency_id',
				'hierarchy_level' => '1',
			),
			array(
				'name'            => 'agency_contract',
				'sort_by'         => 'agency_contract_id',
				'hierarchy_level' => '3',
			),
			array(
				'name'            => 'agency_contract_type',
				'sort_by'         => 'agency_contract_type_id',
				'hierarchy_level' => '1',
			),
			array(
				'name'            => 'competition',
				'sort_by'         => 'competition_id',
				'hierarchy_level' => '3',
			),
			array(
				'name'            => 'team_contract',
				'sort_by'         => 'team_contract_id',
				'hierarchy_level' => '3',
			),
			array(
				'name'            => 'team_contract_type',
				'sort_by'         => 'team_contract_type_id',
				'hierarchy_level' => '1',
			),
			array(
				'name'            => 'event',
				'sort_by'         => 'event_id',
				'hierarchy_level' => '5',
			),
			array(
				'name'            => 'formation',
				'sort_by'         => 'formation_id',
				'hierarchy_level' => '1',
			),
			array(
				'name'            => 'injury',
				'sort_by'         => 'injury_id',
				'hierarchy_level' => '3',
			),
			array(
				'name'            => 'injury_type',
				'sort_by'         => 'injury_type_id',
				'hierarchy_level' => '1',
			),
			array(
				'name'            => 'market_value_transition',
				'sort_by'         => 'market_value_transition_id',
				'hierarchy_level' => '3',
			),
			array(
				'name'            => 'match',
				'sort_by'         => 'match_id',
				'hierarchy_level' => '4',
			),
			array(
				'name'            => 'player',
				'sort_by'         => 'player_id',
				'hierarchy_level' => '2',
			),
			array(
				'name'            => 'player_award',
				'sort_by'         => 'player_award_id',
				'hierarchy_level' => '3',
			),
			array(
				'name'            => 'player_award_type',
				'sort_by'         => 'player_award_type_id',
				'hierarchy_level' => '1',
			),
			array(
				'name'            => 'player_position',
				'sort_by'         => 'player_position_id',
				'hierarchy_level' => '1',
			),
			array(
				'name'            => 'ranking_transition',
				'sort_by'         => 'ranking_transition_id',
				'hierarchy_level' => '3',
			),
			array(
				'name'            => 'ranking_type',
				'sort_by'         => 'ranking_type_id',
				'hierarchy_level' => '1',
			),
			array(
				'name'            => 'squad',
				'sort_by'         => 'squad_id',
				'hierarchy_level' => '4',
			),
			array(
				'name'            => 'stadium',
				'sort_by'         => 'stadium_id',
				'hierarchy_level' => '1',
			),
			array(
				'name'            => 'staff',
				'sort_by'         => 'staff_id',
				'hierarchy_level' => '2',
			),
			array(
				'name'            => 'staff_award',
				'sort_by'         => 'staff_award_id',
				'hierarchy_level' => '3',
			),
			array(
				'name'            => 'staff_award_type',
				'sort_by'         => 'staff_award_type_id',
				'hierarchy_level' => '1',
			),
			array(
				'name'            => 'staff_type',
				'sort_by'         => 'staff_type_id',
				'hierarchy_level' => '1',
			),
			array(
				'name'            => 'team',
				'sort_by'         => 'team_id',
				'hierarchy_level' => '2',
			),
			array(
				'name'            => 'transfer',
				'sort_by'         => 'transfer_id',
				'hierarchy_level' => '3',
			),
			array(
				'name'            => 'transfer_type',
				'sort_by'         => 'transfer_type_id',
				'hierarchy_level' => '1',
			),
			array(
				'name'            => 'jersey_set',
				'sort_by'         => 'jersey_set_id',
				'hierarchy_level' => '3',
			),
			array(
				'name'            => 'referee',
				'sort_by'         => 'referee_id',
				'hierarchy_level' => '1',
			),
			array(
				'name'            => 'referee_badge',
				'sort_by'         => 'referee_badge_id',
				'hierarchy_level' => '2',
			),
			array(
				'name'            => 'referee_badge_type',
				'sort_by'         => 'referee_badge_type_id',
				'hierarchy_level' => '1',
			),
			array(
				'name'            => 'unavailable_player',
				'sort_by'         => 'unavailable_player_id',
				'hierarchy_level' => '3',
			),
			array(
				'name'            => 'unavailable_player_type',
				'sort_by'         => 'unavailable_player_type_id',
				'hierarchy_level' => '1',
			),
			array(
				'name'            => 'trophy',
				'sort_by'         => 'trophy_id',
				'hierarchy_level' => '3',
			),
			array(
				'name'            => 'trophy_type',
				'sort_by'         => 'trophy_type_id',
				'hierarchy_level' => '1',
			),
		);

		// Event Types.
		$this->data['match_effects'] = array(
			0 => __( 'None', 'soccer-engine-lite' ),
			1 => __( 'Goal', 'soccer-engine-lite' ),
			2 => __( 'Yellow Card', 'soccer-engine-lite' ),
			3 => __( 'Red Card', 'soccer-engine-lite' ),
			4 => __( 'Substitution', 'soccer-engine-lite' ),
		);

		$this->match_exists = function ( $id ) {

			global $wpdb;
			$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
			$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE match_id = %d", $id );
			$count      = $wpdb->get_var( $sql );

			if ( intval( $count, 10 ) === 1 ) {
				return true;
			} else {
				return false;
			}
		};

		$this->match_effect_exists = function ( $id ) {

			if ( $id >= 0 && $id <= 4 ) {
				return true;
			} else {
				return false;
			}
		};

		$this->player_exists_none_allowed = function ( $id ) {

			if ( intval( $id, 10 ) === 0 ) {
				return true;
			}

			global $wpdb;
			$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_player';
			$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE player_id = %d", $id );
			$count      = $wpdb->get_var( $sql );

			if ( intval( $count, 10 ) === 1 ) {
				return true;
			} else {
				return false;
			}
		};

		$this->staff_exists_none_allowed = function ( $id ) {

			if ( intval( $id, 10 ) === 0 ) {
				return true;
			}

			global $wpdb;
			$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_staff';
			$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE staff_id = %d", $id );
			$count      = $wpdb->get_var( $sql );

			if ( intval( $count, 10 ) === 1 ) {
				return true;
			} else {
				return false;
			}
		};
	}

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Retrieve data.
	 *
	 * @param int $index The index.
	 *
	 * @return mixed
	 */
	public function get( $index ) {
		return $this->data[ $index ];
	}

	/**
	 * Returns a string with:
	 * - the HTML of the container of the paginated table
	 * - The JavaScript part used create an instance of the paginated table which will be then handled by the
	 * DaextsoenlPaginatedTable JavaScript class.
	 *
	 * @param $data
	 *
	 * @return false|string
	 */
	public function paginated_table( $data ) {

		++$this->paginated_table_counter;
		$table_id_attribute = 'daextsoenl-paginated-table-' . $this->paginated_table_counter;

		ob_start();

		?>

		<div class="daextsoenl-paginated-table-container" data-type="<?php echo esc_attr( str_replace( '_', '-', $data['table_name'] ) ); ?>">

			<?php

			// Paginated table.
			?>

			<div id="<?php echo esc_attr( $table_id_attribute ); ?>"></div>
			<script>

				document.addEventListener("DOMContentLoaded", function() {
				new DaextsoenlPaginatedTable({
					action: 'daextsoenl_get_paginated_table_data',
					tableId: <?php echo wp_json_encode( $data['table_name'] ); ?>,
					filter: <?php echo wp_json_encode( $data['filter'] ); ?>,
					columns: <?php echo wp_json_encode( $data['columns'] ); ?>,
					hiddenColumnsBreakpoint1: <?php echo wp_json_encode( $data['hidden_columns_breakpoint_1'] ); ?>,
					hiddenColumnsBreakpoint2: <?php echo wp_json_encode( $data['hidden_columns_breakpoint_2'] ); ?>,
					pagination: <?php echo wp_json_encode( $data['pagination'] ); ?>,
					tableIdAttribute: <?php echo wp_json_encode( $table_id_attribute ); ?>,
				});
				});

			</script>

			
		</div>

		<?php

		return ob_get_clean();
	}

	// Menu requirements ----------------------------------------------------------------------------------------------.

	/**
	 * Verify the presence of the $delete_id in all the database tables where the specified database table name is
	 * present.
	 *
	 * @param $database_table_name
	 * @param $delete_id
	 *
	 * @return array
	 */
	public function check_deletable( $database_table_name, $delete_id ) {

		$result = array(
			'status' => true,
		);

		switch ( $database_table_name ) {

			case 'ranking_type':
				$this->non_deletable_item_name  = __( 'ranking type', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'ranking_type_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'ranking_transition', __( 'Ranking Transitions', 'soccer-engine-lite' ) );

				break;

			case 'staff':
				$this->non_deletable_item_name  = __( 'staff', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'staff_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'staff_award', __( 'Staff Awards', 'soccer-engine-lite' ) );

				for ( $team = 1;$team <= 2;$team++ ) {
					for ( $i = 1;$i <= 20;$i++ ) {
						$this->non_deletable_field_name = 'team_' . $team . '_staff_id_' . $i;
						$this->generate_non_deletable_occurrences( 'match', __( 'Matches', 'soccer-engine-lite' ) );
					}
				}

				break;

			case 'referee':
				$this->non_deletable_item_name  = __( 'referee', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'referee_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'match', __( 'Matches', 'soccer-engine-lite' ) );
				$this->generate_non_deletable_occurrences( 'referee_badge', __( 'Referee Badges', 'soccer-engine-lite' ) );

				break;

			case 'referee_badge_type':
				$this->non_deletable_item_name  = __( 'referee badge type', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'referee_badge_type_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'referee_badge', __( 'Referee Badges', 'soccer-engine-lite' ) );

				break;

			case 'staff_type':
				$this->non_deletable_item_name  = __( 'staff type', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'staff_type_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'staff', __( 'Staff', 'soccer-engine-lite' ) );

				break;

			case 'player_award_type':
				$this->non_deletable_item_name  = __( 'player award type', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'player_award_type_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'player_award', __( 'Player Awards', 'soccer-engine-lite' ) );

				break;

			case 'staff_award_type':
				$this->non_deletable_item_name  = __( 'staff award type', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'staff_award_type_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'staff_award', __( 'Staff Awards', 'soccer-engine-lite' ) );

				break;

			case 'unavailable_player_type':
				$this->non_deletable_item_name  = __( 'unavailable player type', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'unavailable_player_type_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'unavailable_player', __( 'Unavailable Players', 'soccer-engine-lite' ) );

				break;

			case 'trophy_type':
				$this->non_deletable_item_name  = __( 'trophy type', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'trophy_type_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'trophy', __( 'Trophies', 'soccer-engine-lite' ) );

				break;

			case 'agency':
				$this->non_deletable_item_name  = __( 'agency', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'agency_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'agency_contract', __( 'Agency Contracts', 'soccer-engine-lite' ) );

				break;

			case 'team_contract_type':
				$this->non_deletable_item_name  = __( 'team contract type', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'team_contract_type_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'team_contract', __( 'Team Contracts', 'soccer-engine-lite' ) );

				break;

			case 'agency_contract_type':
				$this->non_deletable_item_name  = __( 'agency contract type', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'agency_contract_type_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'agency_contract', __( 'Agency Contracts', 'soccer-engine-lite' ) );

				break;

			case 'injury_type':
				$this->non_deletable_item_name  = __( 'injury type', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'injury_type_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'injury', __( 'Injuries', 'soccer-engine-lite' ) );

				break;

			case 'transfer_type':
				$this->non_deletable_item_name  = __( 'transfer type', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'transfer_type_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'transfer', __( 'Transfers', 'soccer-engine-lite' ) );

				break;

			case 'player':
				$this->non_deletable_item_name  = __( 'player', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'player_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'player_award', __( 'Player Awards', 'soccer-engine-lite' ) );
				$this->generate_non_deletable_occurrences( 'unavailable_player', __( 'Unavailable Players', 'soccer-engine-lite' ) );
				$this->generate_non_deletable_occurrences( 'injury', __( 'Injuries', 'soccer-engine-lite' ) );
				$this->generate_non_deletable_occurrences( 'transfer', __( 'Transfers', 'soccer-engine-lite' ) );
				$this->generate_non_deletable_occurrences( 'team_contract', __( 'Team Contracts', 'soccer-engine-lite' ) );
				$this->generate_non_deletable_occurrences( 'agency_contract', __( 'Agency Contracts', 'soccer-engine-lite' ) );
				$this->generate_non_deletable_occurrences( 'market_value_transition', __( 'Market Value Transitions', 'soccer-engine-lite' ) );

				for ( $team = 1;$team <= 2;$team++ ) {

					for ( $i = 1;$i <= 11;$i++ ) {
						$this->non_deletable_field_name = 'team_' . $team . '_lineup_player_id_' . $i;
						$this->generate_non_deletable_occurrences( 'match', __( 'Matches', 'soccer-engine-lite' ) );
					}

					for ( $i = 1;$i <= 20;$i++ ) {
						$this->non_deletable_field_name = 'team_' . $team . '_substitute_player_id_' . $i;
						$this->generate_non_deletable_occurrences( 'match', __( 'Matches', 'soccer-engine-lite' ) );
					}
				}

				$this->non_deletable_field_name = 'player_id';
				$this->generate_non_deletable_occurrences( 'event', __( 'Events', 'soccer-engine-lite' ) );

				break;

			case 'player_position':
				$this->non_deletable_item_name  = __( 'player position', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'player_position_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'player', __( 'Players', 'soccer-engine-lite' ) );

				break;

			case 'stadium':
				$this->non_deletable_item_name  = __( 'stadium', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'stadium_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'team', __( 'Teams', 'soccer-engine-lite' ) );
				$this->generate_non_deletable_occurrences( 'match', __( 'Matches', 'soccer-engine-lite' ) );

				break;

			case 'single_elimination':
				$this->non_deletable_item_name  = __( 'single_elimination', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'single_elimination_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'competition', __( 'Competitions', 'soccer-engine-lite' ) );

				break;

			case 'competition':
				$this->non_deletable_item_name  = __( 'competition', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'competition_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'match', __( 'Matches', 'soccer-engine-lite' ) );

				break;

			case 'team':
				$this->non_deletable_item_name  = __( 'team', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'team_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'ranking_transition', __( 'Ranking Transitions', 'soccer-engine-lite' ) );
				$this->generate_non_deletable_occurrences( 'trophy', __( 'Trophies', 'soccer-engine-lite' ) );
				$this->generate_non_deletable_occurrences( 'team_contract', __( 'Team Contracts', 'soccer-engine-lite' ) );

				$this->non_deletable_field_name = 'team_id_left';
				$this->generate_non_deletable_occurrences( 'transfer', __( 'Transfers', 'soccer-engine-lite' ) );

				$this->non_deletable_field_name = 'team_id_joined';
				$this->generate_non_deletable_occurrences( 'transfer', __( 'Transfers', 'soccer-engine-lite' ) );

				$this->non_deletable_field_name = 'team_id_1';
				$this->generate_non_deletable_occurrences( 'match', __( 'Match', 'soccer-engine-lite' ) );

				$this->non_deletable_field_name = 'team_id_2';
				$this->generate_non_deletable_occurrences( 'match', __( 'Match', 'soccer-engine-lite' ) );

				for ( $i = 1;$i <= 128;$i++ ) {
					$this->non_deletable_field_name = 'team_id_' . $i;
					$this->generate_non_deletable_occurrences( 'competition', __( 'Competitions', 'soccer-engine-lite' ) );
				}

				break;

			case 'match':
				$this->non_deletable_item_name  = __( 'match', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'match_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'event', __( 'Events', 'soccer-engine-lite' ) );

				break;

			case 'formation':
				$this->non_deletable_item_name  = __( 'formation', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'formation_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'squad', __( 'Squads', 'soccer-engine-lite' ) );

				$this->non_deletable_field_name = 'team_1_formation_id';
				$this->generate_non_deletable_occurrences( 'match', __( 'Matches', 'soccer-engine-lite' ) );

				$this->non_deletable_field_name = 'team_2_formation_id';
				$this->generate_non_deletable_occurrences( 'match', __( 'Matches', 'soccer-engine-lite' ) );

				break;

			case 'round_robin':
				$this->non_deletable_item_name  = __( 'round_robin', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'round_robin_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'competition', __( 'Competitions', 'soccer-engine-lite' ) );

				break;

			case 'jersey_set':
				$this->non_deletable_item_name  = __( 'jersey set', 'soccer-engine-lite' );
				$this->non_deletable_field_name = 'jersey_set_id';
				$this->non_deletable_id         = $delete_id;
				$this->generate_non_deletable_occurrences( 'squad', __( 'Squads', 'soccer-engine-lite' ) );

				$this->non_deletable_field_name = 'team_1_jersey_set_id';
				$this->generate_non_deletable_occurrences( 'match', __( 'Matches', 'soccer-engine-lite' ) );

				$this->non_deletable_field_name = 'team_2_jersey_set_id';
				$this->generate_non_deletable_occurrences( 'match', __( 'Matches', 'soccer-engine-lite' ) );

				break;

		}

		if ( isset( $this->non_deletable_occurrences ) and count( $this->non_deletable_occurrences ) > 0 ) {
			$non_deletable_occurrences = implode( ', ', $this->non_deletable_occurrences );
			$result                    = array(
				'status'  => false,
				'message' => __( 'This', 'soccer-engine-lite' ) . ' ' . $this->non_deletable_item_name . ' ' . __( "is associated with one or more of the following items and can't be deleted:", 'soccer-engine-lite' ) . ' ' . $non_deletable_occurrences,
			);
		}

		return $result;
	}

	/**
	 * Adds the non deletable occurences to the non_deletable_occurrences class property.
	 *
	 * @param $database_table_name
	 * @param $menu_name
	 */
	public function generate_non_deletable_occurrences( $database_table_name, $menu_name ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_' . $database_table_name;
		$safe_sql   = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE $this->non_deletable_field_name = %d", $this->non_deletable_id );
		$count      = intval( $wpdb->get_var( $safe_sql ), 10 );
		if ( $count > 0 ) {
			$this->non_deletable_occurrences[] = $menu_name;}
	}

	/**
	 * Get the name of the team.
	 *
	 * @param $team_id
	 *
	 * @return string|void
	 */
	public function get_team_name( $team_id ) {

		if ( intval( $team_id, 10 ) === 0 ) {

			return __( 'None', 'soccer-engine-lite' );

		} else {

			global $wpdb;
			$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_team';
			$safe_sql   = $wpdb->prepare( "SELECT name FROM $table_name WHERE team_id = %d", $team_id );
			$team_obj   = $wpdb->get_row( $safe_sql );

			return stripslashes( $team_obj->name );

		}
	}

	/**
	 * Get the name of the agency.
	 *
	 * @param int $agency_id The agency ID.
	 *
	 * @return string
	 */
	public function get_agency_name( $agency_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_agency';
		$safe_sql   = $wpdb->prepare( "SELECT name FROM $table_name WHERE agency_id = %d", $agency_id );
		$team_obj   = $wpdb->get_row( $safe_sql );

		return stripslashes( $team_obj->name );
	}

	/**
	 * Get the name of the agency contract type.
	 *
	 * @param int $agency_contract_type_id The agency contract type ID.
	 *
	 * @return string
	 */
	public function get_agency_contract_type_name( $agency_contract_type_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_agency_contract_type';
		$safe_sql   = $wpdb->prepare( "SELECT name FROM $table_name WHERE agency_contract_type_id = %d", $agency_contract_type_id );
		$team_obj   = $wpdb->get_row( $safe_sql );

		return stripslashes( $team_obj->name );
	}

	/**
	 * Get the name of the ranking type.
	 *
	 * @param int $ranking_type_id The ranking type ID.
	 *
	 * @return string
	 */
	public function get_ranking_type_name( $ranking_type_id ) {

		global $wpdb;
		$table_name       = $wpdb->prefix . $this->get( 'slug' ) . '_ranking_type';
		$safe_sql         = $wpdb->prepare( "SELECT * FROM $table_name WHERE ranking_type_id = %d", $ranking_type_id );
		$ranking_type_obj = $wpdb->get_row( $safe_sql );

		return stripslashes( $ranking_type_obj->name );
	}

	/**
	 * Get the name of the transfer type.
	 *
	 * @param int $transfer_type_id The transfer type ID.
	 *
	 * @return string
	 */
	public function get_transfer_type_name( $transfer_type_id ) {

		global $wpdb;
		$table_name        = $wpdb->prefix . $this->get( 'slug' ) . '_transfer_type';
		$safe_sql          = $wpdb->prepare( "SELECT * FROM $table_name WHERE transfer_type_id = %d", $transfer_type_id );
		$transfer_type_obj = $wpdb->get_row( $safe_sql );

		return stripslashes( $transfer_type_obj->name );
	}

	/**
	 * Get the name of the trophy type.
	 *
	 * @param int $trophy_type_id The trophy type ID.
	 *
	 * @return string
	 */
	public function get_trophy_type_name( $trophy_type_id ) {

		global $wpdb;
		$table_name      = $wpdb->prefix . $this->get( 'slug' ) . '_trophy_type';
		$safe_sql        = $wpdb->prepare( "SELECT name FROM $table_name WHERE trophy_type_id = %d", $trophy_type_id );
		$trophy_type_obj = $wpdb->get_row( $safe_sql );

		return stripslashes( $trophy_type_obj->name );
	}

	/**
	 * Empty objects are replaced with empty strings.
	 * This prevents to generate notices with the methods of the wpdb class.
	 *
	 * @param $data An array which includes empty objects that should be converted to empty strings
	 * @return string An array where the empty objects have been replaced with empty strings
	 */
	public function replace_empty_objects_with_empty_strings( $data ) {

		foreach ( $data as $key => $value ) {
			if ( gettype( $value ) === 'object' ) {

				/**
				 * Verify if the $value object is empty by typecasting it into an array. In case it's empty replace its
				 * value with an empty string.
				 *
				 * Ref: https://stackoverflow.com/questions/9412126/how-to-check-that-an-object-is-empty-in-php
				 */
				$arr = (array) $value;
				if ( empty( $arr ) ) {
					$data[ $key ] = '';
				}
			}
		}

		return $data;
	}

	/**
	 * Get the object of the team.
	 *
	 * @param int $team_id The team ID.
	 *
	 * @return array|object|void|null
	 */
	function get_team_obj( $team_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_team';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE team_id = %d", $team_id );
		$team_obj   = $wpdb->get_row( $safe_sql );

		return $team_obj;
	}

	/**
	 * Get the object of the player.
	 *
	 * @param id $player_id The player ID.
	 *
	 * @return array|object|void|null
	 */
	public function get_player_object( $player_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_player';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d", $player_id );
		$player_obj = $wpdb->get_row( $safe_sql );

		return $player_obj;
	}

	/**
	 * Get the object of the staff.
	 *
	 * @param int $staff_id The staff ID.
	 *
	 * @return array|object|void|null
	 */
	public function get_staff_object( $staff_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_staff';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE staff_id = %d", $staff_id );
		$staff_obj  = $wpdb->get_row( $safe_sql );

		return $staff_obj;
	}

	/**
	 * Get the name of the player.
	 *
	 * @param int $player_id The player ID.
	 *
	 * @return string|void
	 */
	public function get_player_name( $player_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_player';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d", $player_id );
		$player_obj = $wpdb->get_row( $safe_sql );

		if ( $player_obj !== null ) {
			return stripslashes( $player_obj->first_name ) . ' ' . stripslashes( $player_obj->last_name );
		} else {
			return __( 'None', 'soccer-engine-lite' );
		}
	}

	/**
	 * Get the age of the player or the '†' symbol if the player is dead.
	 *
	 * @param $player_id
	 *
	 * @return int|string|void
	 * @throws Exception
	 */
	public function get_player_age( $player_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_player';
		$safe_sql   = $wpdb->prepare( "SELECT date_of_birth, date_of_death FROM $table_name WHERE player_id = %d", $player_id );
		$player_obj = $wpdb->get_row( $safe_sql );

		if ( $player_obj->date_of_birth === '0000-00-00' ) {
			return __( 'N/A', 'soccer-engine-lite' );
		}

		$date_of_birth = new DateTime( $player_obj->date_of_birth );
		$date_of_death = new DateTime( $player_obj->date_of_death );
		if ( '0000-00-00' === $player_obj->date_of_death ) {

			$current_time = current_time( 'mysql', 1 );
			$current_time = new DateTime( $current_time );
			$diff         = $date_of_birth->diff( $current_time );
			return $diff->y;

		} else {

			$diff = $date_of_birth->diff( $date_of_death );
			return '†' . $diff->y;

		}
	}

	/**
	 * Get the age of the staff member or the '†' symbol if the staff member is dead.
	 *
	 * @param int $staff_id The staff ID.
	 *
	 * @return int|string|void
	 * @throws Exception
	 */
	public function get_staff_age( $staff_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_staff';
		$safe_sql   = $wpdb->prepare( "SELECT date_of_birth, date_of_death FROM $table_name WHERE staff_id = %d", $staff_id );
		$staff_obj  = $wpdb->get_row( $safe_sql );

		if ( '0000-00-00' === $staff_obj->date_of_birth ) {
			return __( 'N/A', 'soccer-engine-lite' );
		}

		$date_of_birth = new DateTime( $staff_obj->date_of_birth );
		$date_of_death = new DateTime( $staff_obj->date_of_death );
		if ( $staff_obj->date_of_death === '0000-00-00' ) {

			$current_time = current_time( 'mysql', 1 );
			$current_time = new DateTime( $current_time );
			$diff         = $date_of_birth->diff( $current_time );
			return $diff->y;

		} else {

			$diff = $date_of_birth->diff( $date_of_death );
			return '†' . $diff->y;

		}
	}

	/**
	 * Get the age of the referee or the '†' symbol if the referee is dead.
	 *
	 * @param int $referee_id The referee ID.
	 *
	 * @return int|string|void
	 */
	public function get_referee_age( $referee_id ) {

		global $wpdb;
		$table_name  = $wpdb->prefix . $this->get( 'slug' ) . '_referee';
		$safe_sql    = $wpdb->prepare( "SELECT date_of_birth, date_of_death FROM $table_name WHERE referee_id = %d", $referee_id );
		$referee_obj = $wpdb->get_row( $safe_sql );

		if ( '0000-00-00' === $referee_obj->date_of_birth ) {
			return __( 'N/A', 'soccer-engine-lite' );
		}

		$date_of_birth = new DateTime( $referee_obj->date_of_birth );
		$date_of_death = new DateTime( $referee_obj->date_of_death );
		if ( '0000-00-00' === $referee_obj->date_of_death ) {

			$current_time = current_time( 'mysql', 1 );
			$current_time = new DateTime( $current_time );
			$diff         = $date_of_birth->diff( $current_time );
			return $diff->y;

		} else {

			$diff = $date_of_birth->diff( $date_of_death );
			return '†' . $diff->y;

		}
	}

	/**
	 * Get the name of the rerefee badge type.
	 *
	 * @param $referee_badge_type_id
	 *
	 * @return string|void
	 */
	public function get_referee_badge_type_name( $referee_badge_type_id ) {

		global $wpdb;
		$table_name             = $wpdb->prefix . $this->get( 'slug' ) . '_referee_badge_type';
		$safe_sql               = $wpdb->prepare( "SELECT * FROM $table_name WHERE referee_badge_type_id = %d", $referee_badge_type_id );
		$referee_badge_type_obj = $wpdb->get_row( $safe_sql );

		if ( null !== $referee_badge_type_obj ) {
			return stripslashes( $referee_badge_type_obj->name );
		} else {
			return __( 'None', 'soccer-engine-lite' );
		}
	}

	/**
	 * Get the name of the referee.
	 *
	 * @param int $referee_id The referee ID.
	 *
	 * @return bool|string
	 */
	public function get_referee_name( $referee_id ) {

		global $wpdb;
		$table_name  = $wpdb->prefix . $this->get( 'slug' ) . '_referee';
		$safe_sql    = $wpdb->prepare( "SELECT * FROM $table_name WHERE referee_id = %d", $referee_id );
		$referee_obj = $wpdb->get_row( $safe_sql );

		if ( $referee_obj !== null ) {
			return stripslashes( $referee_obj->first_name ) . ' ' . stripslashes( $referee_obj->last_name );
		} else {
			return false;
		}
	}

	/**
	 * Get the name of the stadium.
	 *
	 * @param int $stadium_id The stadium ID.
	 *
	 * @return bool|string
	 */
	public function get_stadium_name( $stadium_id ) {

		global $wpdb;
		$table_name  = $wpdb->prefix . $this->get( 'slug' ) . '_stadium';
		$safe_sql    = $wpdb->prepare( "SELECT name FROM $table_name WHERE stadium_id = %d", $stadium_id );
		$stadium_obj = $wpdb->get_row( $safe_sql );

		if ( null === $stadium_obj ) {
			return false;
		} else {
			return stripslashes( $stadium_obj->name );
		}
	}

	/**
	 * Get the name of the team type based on the provided code.
	 *
	 * @param int $type The team type code.
	 *
	 * @return string|void
	 */
	public function get_team_type_name( $type ) {

		switch ( intval( $type, 10 ) ) {

			case 0:
				return __( 'Club', 'soccer-engine-lite' );

			case 1:
				return __( 'National Team', 'soccer-engine-lite' );

		}
	}

	/**
	 * Get the name of the staff type.
	 *
	 * @param int $staff_type_id The staff type ID.
	 *
	 * @return string
	 */
	public function get_staff_type_name( $staff_type_id ) {

		global $wpdb;
		$table_name     = $wpdb->prefix . $this->get( 'slug' ) . '_staff_type';
		$safe_sql       = $wpdb->prepare( "SELECT * FROM $table_name WHERE staff_type_id = %d", $staff_type_id );
		$staff_type_obj = $wpdb->get_row( $safe_sql );

		return stripslashes( $staff_type_obj->name );
	}

	/**
	 * Get the name of the player award type.
	 *
	 * @param int $player_award_type_id The player award type ID.
	 *
	 * @return string
	 */
	public function get_player_award_type_name( $player_award_type_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_player_award_type';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_award_type_id = %d", $player_award_type_id );
		$player_obj = $wpdb->get_row( $safe_sql );

		return stripslashes( $player_obj->name );
	}

	/**
	 * Get the name of the unavailable player type.
	 *
	 * @param int $unavailable_player_type_id The unavailable player type ID.
	 *
	 * @return string
	 */
	public function get_unavailable_player_type_name( $unavailable_player_type_id ) {

		global $wpdb;
		$table_name                  = $wpdb->prefix . $this->get( 'slug' ) . '_unavailable_player_type';
		$safe_sql                    = $wpdb->prepare( "SELECT * FROM $table_name WHERE unavailable_player_type_id = %d", $unavailable_player_type_id );
		$unavailable_player_type_obj = $wpdb->get_row( $safe_sql );

		return stripslashes( $unavailable_player_type_obj->name );
	}

	/**
	 * Get the name of the injury type.
	 *
	 * @param int $injury_type_id The injury type ID.
	 *
	 * @return string
	 */
	public function get_injury_type_name( $injury_type_id ) {

		global $wpdb;
		$table_name      = $wpdb->prefix . $this->get( 'slug' ) . '_injury_type';
		$safe_sql        = $wpdb->prepare( "SELECT * FROM $table_name WHERE injury_type_id = %d", $injury_type_id );
		$injury_type_obj = $wpdb->get_row( $safe_sql );

		return stripslashes( $injury_type_obj->name );
	}

	/**
	 * Converts a date provided in the format used by MySql to store the Date format (E.g.: 'YYYY-DD-MM') to the
	 * 'M j, Y' format. (Date formats: https://www.php.net/manual/en/datetime.formats.date.php)
	 *
	 * @param string $timestamp The timestamp to format.
	 *
	 * @return string|void
	 */
	public function format_date_timestamp( $timestamp ) {

		if ( preg_match( '/^\d{4}-\d{2}-\d{2}$/u', $timestamp ) and $timestamp !== '0000-00-00' ) {
			return date_i18n( 'M j, Y', strtotime( $timestamp ) );
		} else {
			return __( 'N/A', 'soccer-engine-lite' );
		}
	}

	/**
	 * Converts a date provided in the format used by MySql to store the Time format (E.g.: '20:30:00') to the
	 * 'hh:mm' format (E.g.: '20:40') with the first digit removed if not needed. (E.g.: '8:30')
	 *
	 * @param string $time The time to format.
	 *
	 * @return false|string
	 */
	public function format_time( $time ) {

		$time = substr( $time, 0, 5 );

		// Remove the starting 0 if present
		if ( substr( $time, 0, 1 ) === '0' ) {
			$time = substr( $time, 1, 5 );
		}

		return $time;
	}

	/**
	 * Format the player height based the "Height Measurement Unit" option value.
	 *
	 * @param int $height The height of the player.
	 *
	 * @return string
	 */
	public function format_player_height( $height ) {

		$measurement_unit = intval( get_option( $this->get( 'slug' ) . '_height_measurement_unit' ), 10 );

		if ( 0 === $measurement_unit ) {

			// Centimenters.
			$formatted_height = round( $height / 100, 2 ) . ' m';

		} else {

			// Inches.
			if ( $height < 12 ) {

				$formatted_height = $height . "''";

			} else {

				$number_of_feet   = intval( $height / 12, 10 );
				$number_of_inches = $height - ( $number_of_feet * 12 );

				$formatted_height = $number_of_feet . '′ ' . $number_of_inches . '″';

			}
		}

		return $formatted_height;
	}

	/**
	 * Get the name of the player position name based on the provided player position id.
	 *
	 * @param int $player_position_id The player position ID.
	 *
	 * @return string|void
	 */
	public function get_player_position_name( $player_position_id ) {

		if ( intval( $player_position_id, 10 ) === 0 ) {
			return __( 'N/A', 'soccer-engine-lite' );
		}

		global $wpdb;
		$table_name          = $wpdb->prefix . $this->get( 'slug' ) . '_player_position';
		$safe_sql            = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_position_id = %d", $player_position_id );
		$player_position_obj = $wpdb->get_row( $safe_sql );

		return stripslashes( $player_position_obj->name );
	}

	/**
	 * Get the player position abbreviation based on the provided player position id.
	 *
	 * @param int $player_position_id The player position ID.
	 *
	 * @return mixed
	 */
	public function get_player_position_abbreviation( $player_position_id ) {

		if ( $player_position_id === 0 ) {
			return __( 'N/A', 'soccer-engine-lite' );
		}

		global $wpdb;
		$table_name          = $wpdb->prefix . $this->get( 'slug' ) . '_player_position';
		$safe_sql            = $wpdb->prepare( "SELECT abbreviation FROM $table_name WHERE player_position_id = %d", $player_position_id );
		$player_position_obj = $wpdb->get_row( $safe_sql );

		return stripslashes( $player_position_obj->abbreviation );
	}

	/**
	 * Get the player position id based on the provided player id.
	 *
	 * @param int $player_id The player ID.
	 *
	 * @return mixed
	 */
	public function get_player_position_id( $player_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_player';
		$safe_sql   = $wpdb->prepare( "SELECT player_position_id FROM $table_name WHERE player_id = %d", $player_id );
		$player_obj = $wpdb->get_row( $safe_sql );

		return intval( $player_obj->player_position_id, 10 );
	}

	/**
	 * Get the staff name based on the provided staff id.
	 *
	 * @param int $staff_id The staff ID.
	 *
	 * @return string
	 */
	public function get_staff_name( $staff_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_staff';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE staff_id = %d", $staff_id );
		$staff_obj  = $wpdb->get_row( $safe_sql );

		return stripslashes( $staff_obj->first_name . ' ' . $staff_obj->last_name );
	}

	/**
	 * Get the stasff award type name based on the provided staff award id.
	 *
	 * @param int $staff_award_type_id The staff award type ID.
	 *
	 * @return string
	 */
	public function get_staff_award_type_name( $staff_award_type_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_staff_award_type';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE staff_award_type_id = %d", $staff_award_type_id );
		$staff_obj  = $wpdb->get_row( $safe_sql );

		return stripslashes( $staff_obj->name );
	}

	/**
	 * Get the team contract type name based on the provided team contract type id.
	 *
	 * @param int $team_contract_type_id The team contract type ID.
	 *
	 * @return string
	 */
	public function get_team_contract_type_name( $team_contract_type_id ) {

		global $wpdb;
		$table_name             = $wpdb->prefix . $this->get( 'slug' ) . '_team_contract_type';
		$safe_sql               = $wpdb->prepare( "SELECT * FROM $table_name WHERE team_contract_type_id = %d", $team_contract_type_id );
		$team_contract_type_obj = $wpdb->get_row( $safe_sql );

		return stripslashes( $team_contract_type_obj->name );
	}

	/**
	 * Get the name of the match effect based on the provided code.
	 *
	 * @param int $match_effect The match effect code.
	 *
	 * @return mixed
	 */
	public function get_match_effect_name( $match_effect ) {

		$match_effect_a = $this->get( 'match_effects' );

		return $match_effect_a[ $match_effect ];
	}

	/**
	 * Get the name of the match based on the provided match id.
	 *
	 * @param int $match_id The match ID.
	 *
	 * @return string
	 */
	public function get_match_name( $match_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d", $match_id );
		$match_obj  = $wpdb->get_row( $safe_sql );

		return stripslashes( $match_obj->name );
	}

	/**
	 * Get the name of the data type associated with the event based on the provided code.
	 *
	 * @param $data
	 *
	 * @return string|void
	 */
	public function get_data_name( $data ) {

		return ! intval( $data, 10 ) ? __( 'Basic', 'soccer-engine-lite' ) : __( 'Complete', 'soccer-engine-lite' );
	}

	/**
	 * Get the name of the team present in the specified team slot of the provided match.
	 *
	 * @param int $team_slot The team slot.
	 * @param $record
	 *
	 * @return string|void
	 */
	public function get_team_slot_name( $team_slot, $record ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d", $record['match_id'] );
		$match_obj  = $wpdb->get_row( $safe_sql );

		$team_id   = $match_obj->{'team_id_' . ( $team_slot + 1 )};
		$team_name = $this->get_team_name( $team_id );

		return $team_name;
	}

	/**
	 * Get the data of the paginated table displayed with the "Players" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function get_paginated_table_data_players( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'player':
					$table_module['head'][] = array(
						'column_name'         => 'player',
						'column_title'        => __( 'Player', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'player', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'player', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'age':
					$table_module['head'][] = array(
						'column_name'         => 'age',
						'column_title'        => __( 'Age', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'age', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'age', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'citizenship':
					$table_module['head'][] = array(
						'column_name'         => 'citizenship',
						'column_title'        => __( 'Citizenship', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'foot':
					$table_module['head'][] = array(
						'column_name'         => 'foot',
						'column_title'        => __( 'Foot', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'foot', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'foot', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'height':
					$table_module['head'][] = array(
						'column_name'         => 'height',
						'column_title'        => __( 'Height', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'height', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'height', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'current_club':
					$table_module['head'][] = array(
						'column_name'         => 'current_club',
						'column_title'        => __( 'Current Club', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'current_club', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'current_club', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'ownership':
					$table_module['head'][] = array(
						'column_name'         => 'ownership',
						'column_title'        => __( 'Ownership', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'ownership', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'ownership', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'contract_expires':
					$table_module['head'][] = array(
						'column_name'         => 'contract_expires',
						'column_title'        => __( 'Contract Expires', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'contract_expires', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'contract_expires', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'market_value':
					$table_module['head'][] = array(
						'column_name'         => 'market_value',
						'column_title'        => __( 'Market Value', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'market_value', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'market_value', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		// Generate the query parts used to filter the results.
		$where_string = '';
		global $wpdb;

		// Player Position ID.
		if ( $filter->player_position_id > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'player_position_id = %d', $filter->player_position_id );
		}

		// Date of birth start.
		$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( "date_of_birth >= '%s'", $filter->start_date_of_birth );

		// Date of birth end.
		$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( "date_of_birth <= '%s'", $filter->end_date_of_birth );

		// Foot.
		if ( intval( $filter->foot, 10 ) > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'foot = %d', intval( $filter->foot, 10 ) - 1 );
		}

		// Citizenship.
		if ( strlen( $filter->citizenship ) > 1 ) {
			$where_string .= $this->add_query_part( $where_string ) . '(' . $wpdb->prepare( "citizenship = '%s' OR second_citizenship = '%s'", $filter->citizenship, $filter->citizenship ) . ')';
		}

		if ( $filter->squad_id > 0 ) {
			$selected_squad_id = $filter->squad_id;
		}

		// Pagination -------------------------------------------------------------------------------------------------.

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_player';
		$sql        = "SELECT * FROM $table_name $where_string";
		$player_a   = $wpdb->get_results( $sql );

		// Get the values associated with the foreign keys.
		$player_output_a = array();
		foreach ( $player_a as $key => $player ) {

			$citizenship_html = '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->citizenship ) ) . '.png' ) . '">';
			if ( strlen( $player->second_citizenship ) > 0 ) {
				$citizenship_html .= '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->second_citizenship ) ) . '.png' ) . '">';
			}

			$player_output_a[] = array(
				'player'           => $player->player_id,
				'age'              => $this->get_player_age( $player->player_id ),
				'citizenship'      => $citizenship_html,
				'foot'             => $player->foot,
				'height'           => $player->height,
				'owner'            => $this->get_player_owner( $player->player_id ),
				'contract_expires' => $this->get_team_contract_expiration( $player->player_id ),
				'market_value'     => $this->get_market_value( $player->player_id ),
			);

		}

		// Sort the table by 'first_name' and then by 'last_name'.
		$c0 = array_column( $player_output_a, 'player' );
		array_multisort( $c0, SORT_ASC, $player_output_a );

		/**
		 * Remove the players that do not belong to the specified squad
		 *
		 * - Find in the squad the id of the players included and save the result in an array of player IDs
		 * - The array will be used to remove the players from the result of the first query that includes all the
		 */

		if ( isset( $selected_squad_id ) ) {

			// Find the players in squad.
			global $wpdb;
			$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_squad';
			$sql        = "SELECT * FROM $table_name WHERE squad_id = $selected_squad_id";
			$squad      = $wpdb->get_row( $sql );

			$player_id_in_squad_a = array();

			for ( $i = 1;$i <= 11;$i++ ) {
				if ( $squad->{'lineup_player_id_' . $i} > 0 ) {
					$player_id_in_squad_a[] = $squad->{'lineup_player_id_' . $i};
				}
			}

			for ( $i = 1;$i <= 20;$i++ ) {
				if ( $squad->{'substitute_player_id_' . $i} > 0 ) {
					$player_id_in_squad_a[] = $squad->{'substitute_player_id_' . $i};
				}
			}

			// Remove the list of players from the list of results that comes from the main query.
			$player_output_a_of_squad = array();
			foreach ( $player_output_a as $key => $player_output ) {

				// Add the player in the squad in a new array.
				if ( in_array( $player_output['player'], $player_id_in_squad_a ) ) {
					$player_output_a_of_squad[] = $player_output_a[ $key ];
				}
			}

			// Move the player in the squad in the original array.
			$player_output_a = $player_output_a_of_squad;

		}

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $player_output_a ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $player_output_a as $key => $player_output ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $player_output_a[ $key ] );
			}
		}

		foreach ( $player_output_a as $key => $player_output ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'player':
						$cells[] = $this->get_player_name( $player_output['player'] );
						break;

					case 'age':
						$cells[] = $player_output['age'];
						break;

					case 'citizenship':
						$cells[] = $player_output['citizenship'];
						break;

					case 'foot':
						$cells[] = $this->format_foot( $player_output['foot'] );
						break;

					case 'height':
						$cells[] = $this->format_player_height( $player_output['height'] );
						break;

					case 'current_club':
						$cells[] = $this->get_team_logo_html( $this->get_player_current_club( $player_output['player'], false, 1 ) ) .
									$this->get_player_current_club( $player_output['player'] );
						break;

					case 'ownership':
						$cells[] = $this->get_team_logo_html( $player_output['owner'] ) . $this->get_team_name( $player_output['owner'] );
						break;

					case 'contract_expires':
						$cells[] = $this->format_date_timestamp( $player_output['contract_expires'] );
						break;

					case 'market_value':
						$cells[] = $player_output['market_value'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Transfers" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 * @throws Exception
	 */
	function get_paginated_table_data_transfers( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		// Head -------------------------------------------------------------------------------------------------------.
		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'player':
					$table_module['head'][] = array(
						'column_name'         => 'player',
						'column_title'        => __( 'Player', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'player', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'player', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'transfer_type':
					$table_module['head'][] = array(
						'column_name'         => 'transfer_type',
						'column_title'        => __( 'Transfer Type', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'transfer_type', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'transfer_type', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'team_left':
					$table_module['head'][] = array(
						'column_name'         => 'team_left',
						'column_title'        => __( 'Team Left', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'team_left', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'team_left', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'team_joined':
					$table_module['head'][] = array(
						'column_name'         => 'team_joined',
						'column_title'        => __( 'Team Joined', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'team_joined', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'team_joined', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'date':
					$table_module['head'][] = array(
						'column_name'         => 'date',
						'column_title'        => __( 'Date', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'date', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'date', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'fee':
					$table_module['head'][] = array(
						'column_name'         => 'fee',
						'column_title'        => __( 'Fee', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'fee', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'fee', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'age':
					$table_module['head'][] = array(
						'column_name'         => 'age',
						'column_title'        => __( 'Age', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'age', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'age', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'citizenship':
					$table_module['head'][] = array(
						'column_name'         => 'citizenship',
						'column_title'        => __( 'Citizenship', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'market_value':
					$table_module['head'][] = array(
						'column_name'         => 'market_value',
						'column_title'        => __( 'Market Value', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'market_value', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'market_value', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		// Generate the query parts used to filter the results.
		$where_string = '';
		global $wpdb;

		// Player ID.
		if ( $filter->player_id > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'player_id = %d', $filter->player_id );
		}

		// Transfer Type ID.
		if ( $filter->transfer_type_id > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'transfer_type_id = %d', $filter->transfer_type_id );
		}

		// Team ID Left.
		if ( $filter->team_id_left > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'team_id_left = %d', $filter->team_id_left );
		}

		// Team ID Joined.
		if ( $filter->team_id_joined > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'team_id_joined = %d', $filter->team_id_joined );
		}

		// Start Date.
		$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( "date >= '%s'", $filter->start_date );

		// End Date.
		$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( "date <= '%s'", $filter->end_date );

		// Fee Lower Limit.
		$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'fee >= %f', $filter->fee_lower_limit );

		// Fee Higher Limit.
		$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'fee <= %f', $filter->fee_higher_limit );

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_transfer';
		$sql        = "SELECT * FROM $table_name $where_string";
		$transfer_a = $wpdb->get_results( $sql );

		// Get the values associated with the foreign keys.
		$transfer_output_a = array();
		foreach ( $transfer_a as $key => $transfer ) {

			$player           = $this->get_player_object( $transfer->player_id );
			$citizenship_html = '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->citizenship ) ) . '.png' ) . '">';
			if ( strlen( $player->second_citizenship ) > 0 ) {
				$citizenship_html .= '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->second_citizenship ) ) . '.png' ) . '">';
			}

			$market_value = $this->get_market_value( $transfer->player_id );
			if ( is_numeric( $market_value ) ) {
				$market_value = $this->money_format( $market_value );
			}

			$transfer_output_a[] = array(
				'player'         => $this->get_player_name( $transfer->player_id ),
				'transfer_type'  => $this->get_transfer_type_name( $transfer->transfer_type_id ),
				'team_id_left'   => intval( $transfer->team_id_left, 10 ),
				'team_left'      => $this->get_team_name( $transfer->team_id_left ),
				'team_id_joined' => intval( $transfer->team_id_joined, 10 ),
				'team_joined'    => $this->get_team_name( $transfer->team_id_joined ),
				'date'           => strtotime( $transfer->date ),
				'fee'            => $transfer->fee,
				'age'            => $this->get_player_age( $transfer->player_id ),
				'citizenship'    => $citizenship_html,
				'market_value'   => $market_value,
			);
		}

		/**
		 * Sort the table by 'date'
		 */
		$c0 = array_column( $transfer_output_a, 'date' );
		array_multisort( $c0, SORT_DESC, SORT_NUMERIC, $transfer_output_a );

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $transfer_output_a ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $transfer_output_a as $key => $transfer_output ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $transfer_output_a[ $key ] );
			}
		}

		foreach ( $transfer_output_a as $key => $transfer_output ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'player':
						$cells[] = $transfer_output['player'];
						break;

					case 'transfer_type':
						$cells[] = $transfer_output['transfer_type'];
						break;

					case 'team_left':
						$cells[] = $this->get_team_logo_html( $transfer_output['team_id_left'] ) . $transfer_output['team_left'];
						break;

					case 'team_joined':
						$cells[] = $this->get_team_logo_html( $transfer_output['team_id_joined'] ) . $transfer_output['team_joined'];
						break;

					case 'date':
						$cells[] = date_i18n( 'M j, Y', $transfer_output['date'] );
						break;

					case 'fee':
						$cells[] = $this->money_format( $transfer_output['fee'] );
						break;

					case 'age':
						$cells[] = $transfer_output['age'];
						break;

					case 'citizenship':
						$cells[] = $transfer_output['citizenship'];
						break;

					case 'market_value':
						$cells[] = $transfer_output['market_value'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Player Awards" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function get_paginated_table_data_player_awards( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		// Head ---------------------------------------------------------------------------------------------------------
		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'player':
					$table_module['head'][] = array(
						'column_name'         => 'player',
						'column_title'        => __( 'Player', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'player', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'player', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'age':
					$table_module['head'][] = array(
						'column_name'         => 'age',
						'column_title'        => __( 'Age', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'age', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'age', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'citizenship':
					$table_module['head'][] = array(
						'column_name'         => 'citizenship',
						'column_title'        => __( 'Citizenship', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'assignment_date':
					$table_module['head'][] = array(
						'column_name'         => 'assignment_date',
						'column_title'        => __( 'Assignment Date', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'date', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'date', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'player_award_type':
					$table_module['head'][] = array(
						'column_name'         => 'player_award_type',
						'column_title'        => __( 'Player Award Type', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'player_award_type', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'player_award_type', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		// Generate the query parts used to filter the results.
		$where_string = '';
		global $wpdb;

		if ( $filter->player_award_type_id > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'player_award_type_id = %d', $filter->player_award_type_id );
		}

		global $wpdb;
		$table_name     = $wpdb->prefix . $this->get( 'slug' ) . '_player_award';
		$sql            = "SELECT * FROM $table_name $where_string";
		$player_award_a = $wpdb->get_results( $sql );

		// Get the values associated with the foreign keys.
		$player_award_output_a = array();
		foreach ( $player_award_a as $key => $player_award ) {

			$player           = $this->get_player_object( $player_award->player_id );
			$citizenship_html = '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->citizenship ) ) . '.png' ) . '">';
			if ( strlen( $player->second_citizenship ) > 0 ) {
				$citizenship_html .= '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->second_citizenship ) ) . '.png' ) . '">';
			}

			$player_award_output_a[] = array(
				'player'            => $this->get_player_name( $player_award->player_id ),
				'age'               => $this->get_player_age( $player_award->player_id ),
				'citizenship'       => $citizenship_html,
				'assignment_date'   => strtotime( $player_award->assignment_date ),
				'player_award_type' => stripslashes( $this->get_player_award_type_name( $player_award->player_award_type_id ) ),
			);

		}

		/**
		 * Sort the table by 'assignment_date' and then by 'player_name'
		 */
		$c0 = array_column( $player_award_output_a, 'assignment_date' );
		$c1 = array_column( $player_award_output_a, 'player' );
		array_multisort( $c0, SORT_ASC, SORT_NUMERIC, $c1, SORT_DESC, $player_award_output_a );

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $player_award_output_a ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $player_award_output_a as $key => $player_award_output ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $player_award_output_a[ $key ] );
			}
		}

		foreach ( $player_award_output_a as $key => $player_award_output ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'player':
						$cells[] = $player_award_output['player'];
						break;

					case 'age':
						$cells[] = $player_award_output['age'];
						break;

					case 'citizenship':
						$cells[] = $player_award_output['citizenship'];
						break;

					case 'assignment_date':
						$cells[] = date_i18n( 'M j, Y', $player_award_output['assignment_date'] );
						break;

					case 'player_award_type':
						$cells[] = $player_award_output['player_award_type'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Unavailable Players" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function get_paginated_table_data_unavailable_player( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'player':
					$table_module['head'][] = array(
						'column_name'         => 'player',
						'column_title'        => __( 'Player', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'player', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'player', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'unavailable_player_type':
					$table_module['head'][] = array(
						'column_name'         => 'unavailable_player_type',
						'column_title'        => __( 'Unavailable Player Type', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'unavailable_player_type', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'unavailable_player_type', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'start_date':
					$table_module['head'][] = array(
						'column_name'         => 'start_date',
						'column_title'        => __( 'Start Date', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'start_date', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'start_date', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'end_date':
					$table_module['head'][] = array(
						'column_name'         => 'end_date',
						'column_title'        => __( 'End Date', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'end_date', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'end_date', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'age':
					$table_module['head'][] = array(
						'column_name'         => 'age',
						'column_title'        => __( 'Age', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'age', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'age', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'citizenship':
					$table_module['head'][] = array(
						'column_name'         => 'citizenship',
						'column_title'        => __( 'Citizenship', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'nat', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'nat', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		// Generate the query parts used to filter the results.
		$where_string = '';
		global $wpdb;

		if ( $filter->player_id > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'player_id = %d', $filter->player_id );
		}

		if ( $filter->unavailable_player_type_id > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'unavailable_player_type_id = %d', $filter->unavailable_player_type_id );
		}

		global $wpdb;
		$table_name           = $wpdb->prefix . $this->get( 'slug' ) . '_unavailable_player';
		$sql                  = "SELECT * FROM $table_name $where_string";
		$unavailable_player_a = $wpdb->get_results( $sql );

		// Get the values associated with the foreign keys.
		$unavailable_player_output_a = array();
		foreach ( $unavailable_player_a as $key => $unavailable_player ) {

			$player           = $this->get_player_object( $unavailable_player->player_id );
			$citizenship_html = '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->citizenship ) ) . '.png' ) . '">';
			if ( strlen( $player->second_citizenship ) > 0 ) {
				$citizenship_html .= '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->second_citizenship ) ) . '.png' ) . '">';
			}

			$unavailable_player_output_a[] = array(
				'player'                  => $this->get_player_name( $unavailable_player->player_id ),
				'unavailable_player_type' => $this->get_unavailable_player_type_name( $unavailable_player->unavailable_player_type_id ),
				'start_date'              => strtotime( $unavailable_player->start_date ),
				'end_date'                => strtotime( $unavailable_player->end_date ),
				'age'                     => $this->get_player_age( $unavailable_player->player_id ),
				'citizenship'             => $citizenship_html,
			);

		}

		/**
		 * Sort the table by 'assignment_date' and then by 'player_name'
		 */
		$c0 = array_column( $unavailable_player_output_a, 'start_date' );
		$c1 = array_column( $unavailable_player_output_a, 'end_date' );
		array_multisort( $c0, SORT_DESC, SORT_NUMERIC, $c1, SORT_DESC, SORT_NUMERIC, $unavailable_player_output_a );

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $unavailable_player_output_a ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $unavailable_player_output_a as $key => $unavailable_player_output ) {
			if ( $key < $query_limit_values['list_start'] ||
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $unavailable_player_output_a[ $key ] );
			}
		}

		foreach ( $unavailable_player_output_a as $key => $unavailable_player_output ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'player':
						$cells[] = $unavailable_player_output['player'];
						break;

					case 'unavailable_player_type':
						$cells[] = $unavailable_player_output['unavailable_player_type'];
						break;

					case 'start_date':
						$cells[] = date( 'M j, Y', $unavailable_player_output['start_date'] );
						break;

					case 'end_date':
						$cells[] = date( 'M j, Y', $unavailable_player_output['end_date'] );
						break;

					case 'age':
						$cells[] = $unavailable_player_output['age'];
						break;

					case 'citizenship':
						$cells[] = $unavailable_player_output['citizenship'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Injuries" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function get_paginated_table_data_injuries( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'player':
					$table_module['head'][] = array(
						'column_name'         => 'player',
						'column_title'        => __( 'Player', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'player', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'player', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'injury_type':
					$table_module['head'][] = array(
						'column_name'         => 'injury_type',
						'column_title'        => __( 'Injury Type', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'injury_type', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'injury_type', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'start_date':
					$table_module['head'][] = array(
						'column_name'         => 'start_date',
						'column_title'        => __( 'Start Date', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'start_date', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'start_date', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'end_date':
					$table_module['head'][] = array(
						'column_name'         => 'end_date',
						'column_title'        => __( 'End Date', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'end_date', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'end_date', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'age':
					$table_module['head'][] = array(
						'column_name'         => 'age',
						'column_title'        => __( 'Age', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'age', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'age', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'citizenship':
					$table_module['head'][] = array(
						'column_name'         => 'citizenship',
						'column_title'        => __( 'Citizenship', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		// Generate the query parts used to filter the results.
		$where_string = '';
		global $wpdb;

		if ( $filter->player_id > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'player_id = %d', $filter->player_id );
		}

		if ( $filter->injury_type_id > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'injury_type_id = %d', $filter->injury_type_id );
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_injury';
		$sql        = "SELECT * FROM $table_name $where_string";
		$injury_a   = $wpdb->get_results( $sql );

		// Get the values associated with the foreign keys.
		$injury_output_a = array();
		foreach ( $injury_a as $key => $injury ) {

			$player           = $this->get_player_object( $injury->player_id );
			$citizenship_html = '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->citizenship ) ) . '.png' ) . '">';
			if ( strlen( $player->second_citizenship ) > 0 ) {
				$citizenship_html .= '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->second_citizenship ) ) . '.png' ) . '">';
			}

			$injury_output_a[] = array(
				'player'      => $this->get_player_name( $injury->player_id ),
				'injury_type' => $this->get_injury_type_name( $injury->injury_type_id ),
				'start_date'  => strtotime( $injury->start_date ),
				'end_date'    => strtotime( $injury->end_date ),
				'age'         => $this->get_player_age( $injury->player_id ),
				'citizenship' => $citizenship_html,
			);

		}

		/**
		 * Sort the table by 'assignment_date' and then by 'player_name'
		 */
		$c0 = array_column( $injury_output_a, 'start_date' );
		$c1 = array_column( $injury_output_a, 'end_date' );
		array_multisort( $c0, SORT_DESC, SORT_NUMERIC, $c1, SORT_DESC, SORT_NUMERIC, $injury_output_a );

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $injury_output_a ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $injury_output_a as $key => $injury_output ) {
			if ( $key < $query_limit_values['list_start'] ||
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $injury_output_a[ $key ] );
			}
		}

		foreach ( $injury_output_a as $key => $injury_output ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'player':
						$cells[] = $injury_output['player'];
						break;

					case 'injury_type':
						$cells[] = $injury_output['injury_type'];
						break;

					case 'start_date':
						$cells[] = date( 'M j, Y', $injury_output['start_date'] );
						break;

					case 'end_date':
						$cells[] = date( 'M j, Y', $injury_output['end_date'] );
						break;

					case 'age':
						$cells[] = $injury_output['age'];
						break;

					case 'citizenship':
						$cells[] = $injury_output['citizenship'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Staff" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function get_paginated_table_data_staff( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'staff':
					$table_module['head'][] = array(
						'column_name'         => 'staff',
						'column_title'        => __( 'Staff', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'staff', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'staff', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'age':
					$table_module['head'][] = array(
						'column_name'         => 'age',
						'column_title'        => __( 'Age', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'age', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'age', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'citizenship':
					$table_module['head'][] = array(
						'column_name'         => 'citizenship',
						'column_title'        => __( 'Citizenship', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'staff_type':
					$table_module['head'][] = array(
						'column_name'         => 'staff_type',
						'column_title'        => __( 'Staff Type', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'staff_type', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'staff_type', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		// Generate the query parts used to filter the results.
		$where_string = '';
		global $wpdb;

		if ( intval( $filter->retired, 10 ) > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'retired = %d', intval( $filter->retired, 10 ) - 1 );
		}

		if ( intval( $filter->gender, 10 ) > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'gender = %d', intval( $filter->gender, 10 ) - 1 );
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_staff';
		$sql        = "SELECT * FROM $table_name $where_string";
		$staff_a    = $wpdb->get_results( $sql );

		// Get the values associated with the foreign keys.
		$staff_output_a = array();
		foreach ( $staff_a as $key => $staff ) {

			$staff_obj        = $this->get_staff_object( $staff->staff_id );
			$citizenship_html = '<img class="daextsoenl-paginated-table-flag" src="' . esc( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $staff_obj->citizenship ) ) . '.png' ) . '">';
			if ( strlen( $staff_obj->second_citizenship ) > 0 ) {
				$citizenship_html .= '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $staff_obj->second_citizenship ) ) . '.png' ) . '">';
			}

			$staff_output_a[] = array(
				'staff_id'    => $staff->staff_id,
				'staff'       => $this->get_staff_name( $staff->staff_id ),
				'age'         => $this->get_staff_age( $staff->staff_id ),
				'citizenship' => $citizenship_html,
				'staff_type'  => $this->get_staff_type_name( $staff->staff_type_id ),
			);

		}

		/**
		 * Sort the table by 'staff_type' and then by 'staff'
		 */
		$c0 = array_column( $staff_output_a, 'staff_type' );
		$c1 = array_column( $staff_output_a, 'staff' );
		array_multisort( $c0, SORT_DESC, SORT_STRING, $c1, SORT_DESC, SORT_STRING, $staff_output_a );

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $staff_output_a ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $staff_output_a as $key => $staff_output ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $staff_output_a[ $key ] );
			}
		}

		foreach ( $staff_output_a as $key => $staff_output ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'staff':
						$cells[] = $staff_output['staff'];
						break;

					case 'age':
						$cells[] = $staff_output['age'];
						break;

					case 'citizenship':
						$cells[] = $staff_output['citizenship'];
						break;

					case 'staff_type':
						$cells[] = $staff_output['staff_type'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Staff Awards" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function get_paginated_table_data_staff_award( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'staff':
					$table_module['head'][] = array(
						'column_name'         => 'staff',
						'column_title'        => __( 'Staff', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'player', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'player', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'staff_award_type':
					$table_module['head'][] = array(
						'column_name'         => 'staff_award_type',
						'column_title'        => __( 'Staff Award Type', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'staff_award_type', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'staff_award_type', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'assignment_date':
					$table_module['head'][] = array(
						'column_name'         => 'assignment_date',
						'column_title'        => __( 'Assignment Date', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'assignment_date', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'assignment_date', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'age':
					$table_module['head'][] = array(
						'column_name'         => 'age',
						'column_title'        => __( 'Age', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'age', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'age', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'citizenship':
					$table_module['head'][] = array(
						'column_name'         => 'citizenship',
						'column_title'        => __( 'Citizenship', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		// Generate the query parts used to filter the results.
		$where_string = '';
		global $wpdb;

		// Staff Award Type ID.
		if ( $filter->staff_award_type_id > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'staff_award_type_id = %d', $filter->staff_award_type_id );
		}

		global $wpdb;
		$table_name    = $wpdb->prefix . $this->get( 'slug' ) . '_staff_award';
		$sql           = "SELECT * FROM $table_name $where_string";
		$staff_award_a = $wpdb->get_results( $sql );

		// Get the values associated with the foreign keys.
		$staff_award_output_a = array();
		foreach ( $staff_award_a as $key => $staff_award ) {

			$staff_obj        = $this->get_staff_object( $staff_award->staff_id );
			$citizenship_html = '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $staff_obj->citizenship ) ) . '.png' ) . '">';
			if ( strlen( $staff_obj->second_citizenship ) > 0 ) {
				$citizenship_html .= '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $staff_obj->second_citizenship ) ) . '.png' ) . '">';
			}

			$staff_award_output_a[] = array(
				'staff'            => $this->get_staff_name( $staff_award->staff_id ),
				'staff_award_type' => $this->get_staff_award_type_name( $staff_award->staff_award_type_id ),
				'assignment_date'  => strtotime( $staff_award->assignment_date ),
				'age'              => $this->get_staff_age( $staff_award->staff_id ),
				'citizenship'      => $citizenship_html,
			);

		}

		/**
		 * Sort the table by 'assignment_date' and then by 'staff_award_type'
		 */
		$c0 = array_column( $staff_award_output_a, 'assignment_date' );
		$c1 = array_column( $staff_award_output_a, 'staff_award_type' );
		array_multisort( $c0, SORT_DESC, SORT_NUMERIC, $c1, SORT_DESC, SORT_STRING, $staff_award_output_a );

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $staff_award_output_a ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $staff_award_output_a as $key => $staff_award_output ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $staff_award_output_a[ $key ] );
			}
		}

		foreach ( $staff_award_output_a as $key => $staff_award_output ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'staff':
						$cells[] = $staff_award_output['staff'];
						break;

					case 'age':
						$cells[] = $staff_award_output['age'];
						break;

					case 'citizenship':
						$cells[] = $staff_award_output['citizenship'];
						break;

					case 'staff_award_type':
						$cells[] = $staff_award_output['staff_award_type'];
						break;

					case 'assignment_date':
						$cells[] = date( 'M j, Y', $staff_award_output['assignment_date'] );
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Trophies" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 */
	public function get_paginated_table_data_trophy( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'trophy_type':
					$table_module['head'][] = array(
						'column_name'         => 'trophy_type',
						'column_title'        => __( 'Trophy Type', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'trophy_type', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'trophy_type', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'team':
					$table_module['head'][] = array(
						'column_name'         => 'team',
						'column_title'        => __( 'Team', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'team', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'team', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'assignment_date':
					$table_module['head'][] = array(
						'column_name'         => 'assignment_date',
						'column_title'        => __( 'Assignment Date', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'assignment_date', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'assignment_date', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		// Generate the query parts used to filter the results.
		$where_string = '';
		global $wpdb;

		if ( intval( $filter->trophy_type_id, 10 ) > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'trophy_type_id = %d', $filter->trophy_type_id );
		}

		if ( intval( $filter->team_id, 10 ) > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'team_id = %d', $filter->team_id );
		}

		if ( intval( $filter->start_assignment_date, 10 ) > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'assignment_date >= "%s"', $filter->start_assignment_date );
		}

		if ( intval( $filter->end_assignment_date, 10 ) > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'assignment_date <= "%s"', $filter->end_assignment_date );
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_trophy';
		$sql        = "SELECT * FROM $table_name $where_string";
		$trophy_a   = $wpdb->get_results( $sql );

		// Get the values associated with the foreign keys.
		$trophy_output_a = array();
		foreach ( $trophy_a as $key => $trophy ) {
			$trophy_output_a[] = array(
				'trophy_type'     => $this->get_trophy_type_logo_html( $trophy->trophy_type_id ) . $this->get_trophy_type_name( $trophy->trophy_type_id ),
				'team_id'         => intval( $trophy->team_id, 10 ),
				'team'            => $this->get_team_name( $trophy->team_id ),
				'assignment_date' => strtotime( $trophy->assignment_date ),
			);
		}

		/**
		 * Sort the table by 'assignment_date' and then by 'team'
		 */
		$c0 = array_column( $trophy_output_a, 'assignment_date' );
		$c1 = array_column( $trophy_output_a, 'team' );
		array_multisort( $c0, SORT_DESC, SORT_NUMERIC, $c1, SORT_DESC, SORT_STRING, $trophy_output_a );

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $trophy_output_a ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $trophy_output_a as $key => $trophy_output ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $trophy_output_a[ $key ] );
			}
		}

		foreach ( $trophy_output_a as $key => $trophy_output ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'trophy_type':
						$cells[] = $trophy_output['trophy_type'];
						break;

					case 'team':
						$cells[] = $this->get_team_logo_html( $trophy_output['team_id'] ) . $trophy_output['team'];
						break;

					case 'assignment_date':
						$cells[] = date( 'M j, Y', $trophy_output['assignment_date'] );
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Team Contracts" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function get_paginated_table_data_team_contract( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		// Head -------------------------------------------------------------------------------------------------------.
		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'player':
					$table_module['head'][] = array(
						'column_name'         => 'player',
						'column_title'        => __( 'Player', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'player', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'player', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);

					break;

				case 'team':
					$table_module['head'][] = array(
						'column_name'         => 'team',
						'column_title'        => __( 'Team', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'team', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'team', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);

					break;

				case 'team_contract_type':
					$table_module['head'][] = array(
						'column_name'         => 'team_contract_type',
						'column_title'        => __( 'Team Contract Type', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'team_contract_type', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'team_contract_type', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);

					break;

				case 'start_date':
					$table_module['head'][] = array(
						'column_name'         => 'start_date',
						'column_title'        => __( 'Start Date', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'start_date', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'start_date', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);

					break;

				case 'end_date':
					$table_module['head'][] = array(
						'column_name'         => 'end_date',
						'column_title'        => __( 'End Date', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'end_date', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'end_date', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);

					break;

				case 'salary':
					$table_module['head'][] = array(
						'column_name'         => 'salary',
						'column_title'        => __( 'Salary', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'salary', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'salary', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);

					break;

				case 'age':
					$table_module['head'][] = array(
						'column_name'         => 'age',
						'column_title'        => __( 'Age', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'age', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'age', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);

					break;

				case 'citizenship':
					$table_module['head'][] = array(
						'column_name'         => 'citizenship',
						'column_title'        => __( 'Citizenship', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);

					break;

				case 'market_value':
					$table_module['head'][] = array(
						'column_name'         => 'market_value',
						'column_title'        => __( 'Market Value', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'market_value', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'market_value', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);

					break;

				case 'agency':
					$table_module['head'][] = array(
						'column_name'         => 'agency',
						'column_title'        => __( 'Agency', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'agency', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'agency', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);

					break;

			}
		}

		// Generate the query parts used to filter the results.
		$where_string = '';
		global $wpdb;

		if ( $filter->team_id > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'team_id = %d', $filter->team_id );
		}

		if ( intval( $filter->team_contract_type_id, 10 ) > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'team_contract_type_id = %d', $filter->team_contract_type_id );
		}

		global $wpdb;
		$table_name      = $wpdb->prefix . $this->get( 'slug' ) . '_team_contract';
		$sql             = "SELECT * FROM $table_name $where_string";
		$team_contract_a = $wpdb->get_results( $sql );

		// Get the values associated with the foreign keys.
		$team_contract_output_a = array();
		foreach ( $team_contract_a as $key => $team_contract ) {

			$player           = $this->get_player_object( $team_contract->player_id );
			$citizenship_html = '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->citizenship ) ) . '.png' ) . '">';
			if ( strlen( $player->second_citizenship ) > 0 ) {
				$citizenship_html .= '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->second_citizenship ) ) . '.png' ) . '">';
			}

			$team_contract_output_a[] = array(
				'player'             => $this->get_player_name( $team_contract->player_id ),
				'team_id'            => intval( $team_contract->team_id, 10 ),
				'team'               => $this->get_team_name( $team_contract->team_id ),
				'team_contract_type' => $this->get_team_contract_type_name( $team_contract->team_contract_type_id ),
				'start_date'         => strtotime( $team_contract->start_date ),
				'end_date'           => strtotime( $team_contract->end_date ),
				'salary'             => $team_contract->salary,
				'age'                => $this->get_player_age( $team_contract->player_id ),
				'citizenship'        => $citizenship_html,
				'market_value'       => $this->get_market_value( $team_contract->player_id ),
				'agency'             => $this->get_agency_of_player( $team_contract->player_id ),
			);

		}

		/**
		 * Sort the table by 'start_date' and then by 'end_date'.
		 */
		$c0 = array_column( $team_contract_output_a, 'start_date' );
		$c1 = array_column( $team_contract_output_a, 'end_date' );
		array_multisort( $c0, SORT_DESC, SORT_NUMERIC, $c1, SORT_DESC, SORT_NUMERIC, $team_contract_output_a );

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $team_contract_output_a ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $team_contract_output_a as $key => $team_contract_output ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $team_contract_output_a[ $key ] );
			}
		}

		foreach ( $team_contract_output_a as $key => $team_contract_output ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'player':
						$cells[] = $team_contract_output['player'];
						break;

					case 'team':
						$cells[] = $this->get_team_logo_html( $team_contract_output['team_id'] ) . $team_contract_output['team'];
						break;

					case 'team_contract_type':
						$cells[] = $team_contract_output['team_contract_type'];
						break;

					case 'start_date':
						$cells[] = date( 'M j, Y', $team_contract_output['start_date'] );
						break;

					case 'end_date':
						$cells[] = date( 'M j, Y', $team_contract_output['end_date'] );
						break;

					case 'salary':
						$cells[] = $this->money_format( $team_contract_output['salary'] );
						break;

					case 'age':
						$cells[] = $team_contract_output['age'];
						break;

					case 'citizenship':
						$cells[] = $team_contract_output['citizenship'];
						break;

					case 'market_value':
						$cells[] = $team_contract_output['market_value'];
						break;

					case 'agency':
						$cells[] = $team_contract_output['agency'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Agency Contracts" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function get_paginated_table_data_agency_contract( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		// Head -------------------------------------------------------------------------------------------------------.
		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'player':
					$table_module['head'][] = array(
						'column_name'         => 'player',
						'column_title'        => __( 'Player', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'player', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'player', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'agency':
					$table_module['head'][] = array(
						'column_name'         => 'agency',
						'column_title'        => __( 'Agency', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'agency', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'agency', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'agency_contract_type':
					$table_module['head'][] = array(
						'column_name'         => 'agency_contract_type',
						'column_title'        => __( 'Agency Contract Type', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'agency_contract_type', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'agency_contract_type', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'start_date':
					$table_module['head'][] = array(
						'column_name'         => 'start_date',
						'column_title'        => __( 'Start Date', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'start_date', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'start_date', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'end_date':
					$table_module['head'][] = array(
						'column_name'         => 'end_date',
						'column_title'        => __( 'End Date', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'end_date', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'end_date', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'age':
					$table_module['head'][] = array(
						'column_name'         => 'age',
						'column_title'        => __( 'Age', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'age', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'age', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'citizenship':
					$table_module['head'][] = array(
						'column_name'         => 'citizenship',
						'column_title'        => __( 'Citizenship', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		// Generate the query parts used to filter the results.
		$where_string = '';
		global $wpdb;

		if ( $filter->agency_id > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'agency_id = %d', $filter->agency_id );
		}

		if ( $filter->agency_contract_type_id > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'agency_contract_type_id = %d', $filter->agency_contract_type_id );
		}

		global $wpdb;
		$table_name        = $wpdb->prefix . $this->get( 'slug' ) . '_agency_contract';
		$sql               = "SELECT * FROM $table_name $where_string";
		$agency_contract_a = $wpdb->get_results( $sql );

		// Get the values associated with the foreign keys.
		$agency_contract_output_a = array();
		foreach ( $agency_contract_a as $key => $agency_contract ) {

			$player           = $this->get_player_object( $agency_contract->player_id );
			$citizenship_html = '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->citizenship ) ) . '.png' ) . '">';
			if ( strlen( $player->second_citizenship ) > 0 ) {
				$citizenship_html .= '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->second_citizenship ) ) . '.png' ) . '">';
			}

			$agency_contract_output_a[] = array(
				'player'               => $this->get_player_name( $agency_contract->player_id ),
				'agency'               => $this->get_agency_name( $agency_contract->agency_id ),
				'agency_contract_type' => $this->get_agency_contract_type_name( $agency_contract->agency_contract_type_id ),
				'start_date'           => strtotime( $agency_contract->start_date ),
				'end_date'             => strtotime( $agency_contract->end_date ),
				'age'                  => $this->get_player_age( $agency_contract->player_id ),
				'citizenship'          => $citizenship_html,
			);
		}

		/**
		 * Sort the table by 'start_date' and then by 'end_date'
		 */
		$c0 = array_column( $agency_contract_output_a, 'start_date' );
		$c1 = array_column( $agency_contract_output_a, 'end_date' );
		array_multisort( $c0, SORT_DESC, SORT_NUMERIC, $c1, SORT_DESC, SORT_NUMERIC, $agency_contract_output_a );

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $agency_contract_output_a ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $agency_contract_output_a as $key => $agency_contract_output ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $agency_contract_output_a[ $key ] );
			}
		}

		foreach ( $agency_contract_output_a as $key => $agency_contract_output ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'player':
						$cells[] = $agency_contract_output['player'];
						break;

					case 'agency':
						$cells[] = $agency_contract_output['agency'];
						break;

					case 'agency_contract_type':
						$cells[] = $agency_contract_output['agency_contract_type'];
						break;

					case 'start_date':
						$cells[] = date( 'M j, Y', $agency_contract_output['start_date'] );
						break;

					case 'end_date':
						$cells[] = date( 'M j, Y', $agency_contract_output['end_date'] );
						break;

					case 'age':
						$cells[] = $agency_contract_output['age'];
						break;

					case 'citizenship':
						$cells[] = $agency_contract_output['citizenship'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Market Value Transitions" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function get_paginated_table_data_market_value_transition( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'player':
					$table_module['head'][] = array(
						'column_name'         => 'player',
						'column_title'        => __( 'Player', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'player', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'player', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'date':
					$table_module['head'][] = array(
						'column_name'         => 'date',
						'column_title'        => __( 'Date', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'date', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'date', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'value':
					$table_module['head'][] = array(
						'column_name'         => 'value',
						'column_title'        => __( 'Value', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'value', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'value', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'age':
					$table_module['head'][] = array(
						'column_name'         => 'age',
						'column_title'        => __( 'Age', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'age', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'age', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'citizenship':
					$table_module['head'][] = array(
						'column_name'         => 'citizenship',
						'column_title'        => __( 'Citizenship', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		// Generate the query parts used to filter the results.
		$where_string = '';
		global $wpdb;

		if ( intval( $filter->player_id, 10 ) > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'player_id = %d', $filter->player_id );
		}

		$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( "date >= '%s'", $filter->start_date );
		$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( "date <= '%s'", $filter->end_date );

		global $wpdb;
		$table_name                = $wpdb->prefix . $this->get( 'slug' ) . '_market_value_transition';
		$sql                       = "SELECT * FROM $table_name $where_string";
		$market_value_transition_a = $wpdb->get_results( $sql );

		// Get the values associated with the foreign keys.
		$market_value_transition_output_a = array();
		foreach ( $market_value_transition_a as $key => $market_value_transition ) {

			$player           = $this->get_player_object( $market_value_transition->player_id );
			$citizenship_html = '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->citizenship ) ) . '.png' ) . '">';
			if ( strlen( $player->second_citizenship ) > 0 ) {
				$citizenship_html .= '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->second_citizenship ) ) . '.png' ) . '">';
			}

			$market_value_transition_output_a[] = array(
				'player'      => $this->get_player_name( $market_value_transition->player_id ),
				'date'        => strtotime( $market_value_transition->date ),
				'value'       => $market_value_transition->value,
				'age'         => $this->get_player_age( $market_value_transition->player_id ),
				'citizenship' => $citizenship_html,
			);

		}

		/**
		 * Sort the table by 'assignment_date' and then by 'player'
		 */
		$c0 = array_column( $market_value_transition_output_a, 'date' );
		$c1 = array_column( $market_value_transition_output_a, 'player' );
		array_multisort( $c0, SORT_DESC, SORT_NUMERIC, $c1, SORT_DESC, SORT_STRING, $market_value_transition_output_a );

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $market_value_transition_output_a ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $market_value_transition_output_a as $key => $market_value_transition_output ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $market_value_transition_output_a[ $key ] );
			}
		}

		foreach ( $market_value_transition_output_a as $key => $market_value_transition_output ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'player':
						$cells[] = $market_value_transition_output['player'];
						break;

					case 'date':
						$cells[] = date( 'M j, Y', $market_value_transition_output['date'] );
						break;

					case 'value':
						$cells[] = $this->money_format( $market_value_transition_output['value'] );
						break;

					case 'age':
						$cells[] = $market_value_transition_output['age'];
						break;

					case 'citizenship':
						$cells[] = $market_value_transition_output['citizenship'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Ranking Transitions" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 */
	public function get_paginated_table_data_ranking_transition( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'team':
					$table_module['head'][] = array(
						'column_name'         => 'team',
						'column_title'        => __( 'Team', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'team', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'team', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'ranking_type':
					$table_module['head'][] = array(
						'column_name'         => 'ranking_type',
						'column_title'        => __( 'Ranking Type', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'age', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'age', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'date':
					$table_module['head'][] = array(
						'column_name'         => 'date',
						'column_title'        => __( 'Date', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'date', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'date', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'value':
					$table_module['head'][] = array(
						'column_name'         => 'value',
						'column_title'        => __( 'Value', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'value', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'value', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		// Generate the query parts used to filter the results.
		$where_string = '';
		global $wpdb;

		if ( intval( $filter->team_id, 10 ) > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'team_id = %d', $filter->team_id );
		}

		if ( intval( $filter->ranking_type_id, 10 ) > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'ranking_type_id = %d', $filter->ranking_type_id );
		}

		if ( intval( $filter->start_date, 10 ) > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'date >= "%s"', $filter->start_date );
		}

		if ( intval( $filter->end_date, 10 ) > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'date <= "%s"', $filter->end_date );
		}

		global $wpdb;
		$table_name           = $wpdb->prefix . $this->get( 'slug' ) . '_ranking_transition';
		$sql                  = "SELECT * FROM $table_name $where_string";
		$ranking_transition_a = $wpdb->get_results( $sql );

		// Get the values associated with the foreign keys.
		$ranking_transition_output_a = array();
		foreach ( $ranking_transition_a as $key => $ranking_transition ) {
			$ranking_transition_output_a[] = array(
				'team_id'      => intval( $ranking_transition->team_id, 10 ),
				'team'         => $this->get_team_name( $ranking_transition->team_id ),
				'ranking_type' => $this->get_ranking_type_name( $ranking_transition->ranking_type_id ),
				'date'         => strtotime( $ranking_transition->date ),
				'value'        => $ranking_transition->value,
			);
		}

		/**
		 * Sort the table by 'assignment_date' and then by 'player'
		 */
		$c0 = array_column( $ranking_transition_output_a, 'date' );
		$c1 = array_column( $ranking_transition_output_a, 'team' );
		array_multisort( $c0, SORT_DESC, SORT_NUMERIC, $c1, SORT_DESC, SORT_STRING, $ranking_transition_output_a );

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $ranking_transition_output_a ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $ranking_transition_output_a as $key => $ranking_transition_output ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $ranking_transition_output_a[ $key ] );
			}
		}

		foreach ( $ranking_transition_output_a as $key => $ranking_transition_output ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'team':
						$cells[] = $this->get_team_logo_html( $ranking_transition_output['team_id'] ) . $ranking_transition_output['team'];
						break;

					case 'ranking_type':
						$cells[] = $ranking_transition_output['ranking_type'];
						break;

					case 'date':
						$cells[] = date( 'M j, Y', $ranking_transition_output['date'] );
						break;

					case 'value':
						$cells[] = $ranking_transition_output['value'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Matches" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 */
	public function get_paginated_table_data_match( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'date':
					$table_module['head'][] = array(
						'column_name'         => 'date',
						'column_title'        => __( 'Date', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'date', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'date', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'time':
					$table_module['head'][] = array(
						'column_name'         => 'time',
						'column_title'        => __( 'Time', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'time', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'time', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'team_1':
					$table_module['head'][] = array(
						'column_name'         => 'team_1',
						'column_title'        => __( 'Team 1', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'team_1', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'team_1', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'team_2':
					$table_module['head'][] = array(
						'column_name'         => 'team_2',
						'column_title'        => __( 'Team 2', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'team_2', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'team_2', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'result':
					$table_module['head'][] = array(
						'column_name'         => 'result',
						'column_title'        => __( 'Result', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'result', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'result', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		// Generate the query parts used to filter the results.
		$where_string = '';
		global $wpdb;

		if ( intval( $filter->team_id_1, 10 ) > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'team_id_1 = %d', $filter->team_id_1 );
		}

		if ( intval( $filter->team_id_2, 10 ) > 0 ) {
			$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( 'team_id_2 = %d', $filter->team_id_2 );
		}

		$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( "date >= '%s'", $filter->start_date );
		$where_string .= $this->add_query_part( $where_string ) . $wpdb->prepare( "date <= '%s'", $filter->end_date );

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$sql        = "SELECT * FROM $table_name $where_string";
		$match_a    = $wpdb->get_results( $sql );

		// Get the values associated with the foreign keys.
		$match_output_a = array();
		foreach ( $match_a as $key => $match ) {
			$match_output_a[] = array(
				'date'      => strtotime( $match->date ),
				'time'      => $match->time,
				'datetime'  => strtotime( $match->date . '' . $match->time ),
				'team_id_1' => intval( $match->team_id_1, 10 ),
				'team_1'    => $this->get_team_name( $match->team_id_1 ),
				'team_id_2' => intval( $match->team_id_2, 10 ),
				'team_2'    => $this->get_team_name( $match->team_id_2 ),
				'result'    => $this->get_match_result( $match->match_id, 'text' ),
			);
		}

		/**
		 * Sort the table by 'datetime'. A timestamp created with the values of 'date' and 'time'.
		 */
		$c0 = array_column( $match_output_a, 'datetime' );
		array_multisort( $c0, SORT_DESC, SORT_NUMERIC, $match_output_a );

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $match_output_a ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $match_output_a as $key => $match_output ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $match_output_a[ $key ] );
			}
		}

		foreach ( $match_output_a as $key => $match_output ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'date':
						$cells[] = date( 'M j, Y', $match_output['date'] );
						break;

					case 'time':
						$cells[] = $this->format_time( $match_output['time'] );
						break;

					case 'team_1':
						$cells[] = $this->get_team_logo_html( $match_output['team_id_1'] ) . $match_output['team_1'];
						break;

					case 'team_2':
						$cells[] = $this->get_team_logo_html( $match_output['team_id_2'] ) . $match_output['team_2'];
						break;

					case 'result':
						$cells[] = $match_output['result'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Competition Round" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 */
	public function get_paginated_table_data_competition_round( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'date':
					$table_module['head'][] = array(
						'column_name'         => 'date',
						'column_title'        => __( 'Date', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'date', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'date', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'time':
					$table_module['head'][] = array(
						'column_name'         => 'time',
						'column_title'        => __( 'Time', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'time', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'time', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'team_1':
					$table_module['head'][] = array(
						'column_name'         => 'team_1',
						'column_title'        => __( 'Team 1', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'home_team', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'home_team', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'result':
					$table_module['head'][] = array(
						'column_name'         => 'result',
						'column_title'        => __( 'Result', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'result', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'result', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'team_2':
					$table_module['head'][] = array(
						'column_name'         => 'team_2',
						'column_title'        => __( 'Team 2', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'team_2', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'team_2', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		$competition_id = intval( $filter->competition_id, 10 );
		$round          = intval( $filter->round );
		$type           = intval( $filter->type );

		// Get the matches associated with the competition in order by round and then in order by date.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare(
			"SELECT * FROM $table_name WHERE competition_id = %d AND round = %d AND type = %d ORDER BY date DESC",
			$competition_id,
			$round,
			$type
		);
		$match_a    = $wpdb->get_results( $safe_sql, ARRAY_A );

		$match_a_output = array();
		foreach ( $match_a as $key => $match ) {

			// calculate the result of the match.
			$match_result = $this->get_match_result( $match['match_id'], 'array' );

			$match_a_output[] = array(
				'date'         => strtotime( $match['date'] ),
				'time'         => $match['time'],
				'datetime'     => strtotime( $match['date'] . '' . $match['time'] ),
				'team_id_1'    => intval( $match['team_id_1'], 10 ),
				'team_1_name'  => $this->get_team_name( $match['team_id_1'] ),
				'team_1_score' => $match_result[0],
				'team_id_2'    => intval( $match['team_id_2'], 10 ),
				'team_2_name'  => $this->get_team_name( $match['team_id_2'] ),
				'team_2_score' => $match_result[1],
			);

		}

		/**
		 * Sort the table by 'datetime'. A timestamp created with the values of 'date' and 'time'.
		 */
		$c0 = array_column( $match_a_output, 'datetime' );
		array_multisort( $c0, SORT_DESC, SORT_NUMERIC, $match_a_output );

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $match_a_output ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $match_a_output as $key => $match_output ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $match_a_output[ $key ] );
			}
		}

		foreach ( $match_a_output as $key => $match_output ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'date':
						$cells[] = date( 'M j, Y', $match_output['date'] );
						break;

					case 'time':
						$cells[] = $this->format_time( $match_output['time'] );
						break;

					case 'team_1':
						$cells[] = $this->get_team_logo_html( $match_output['team_id_1'] ) . $match_output['team_1_name'];
						break;

					case 'result':
						$cells[] = $match_output['team_1_score'] . ':' . $match_output['team_2_score'];
						break;

					case 'team_2':
						$cells[] = $this->get_team_logo_html( $match_output['team_id_2'] ) . $match_output['team_2_name'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Match Lineup" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 */
	public function get_paginated_table_data_match_lineup( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'player':
					$table_module['head'][] = array(
						'column_name'         => 'player',
						'column_title'        => __( 'Player', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'player', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'player', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'citizenship':
					$table_module['head'][] = array(
						'column_name'         => 'citizenship',
						'column_title'        => __( 'Citizenship', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'jersey_number':
					$table_module['head'][] = array(
						'column_name'         => 'jersey_number',
						'column_title'        => __( 'Jersey Number', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'jersey_number', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'jersey_number', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		// --------

		$match_id  = intval( $filter->match_id, 10 );
		$team_slot = intval( $filter->team_slot, 10 );
		$data_a    = array();

		// Generate the data of the table -----------------------------------------------------------------------------.

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d", $match_id );
		$match_obj  = $wpdb->get_row( $safe_sql );
		if ( $match_obj === null ) {
			return false;
			die();
		}

		$player_listing_data = array();
		for ( $i = 1;$i <= 11;$i++ ) {

			$player_id  = $match_obj->{'team_' . $team_slot . '_lineup_player_id_' . $i};
			$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_player';
			$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d", $player_id );
			$player_obj = $wpdb->get_row( $safe_sql );

			if ( null !== $player_obj ) {
				$player_listing_data[] = $player_obj;
			}
		}

		foreach ( $player_listing_data as $key => $player ) {

			$citizenship_html = '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->citizenship ) ) . '.png' ) . '">';
			if ( strlen( $player->second_citizenship ) > 0 ) {
				$citizenship_html .= '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->second_citizenship ) ) . '.png' ) . '">';
			}

			// Update the data at that index.
			$data_a[] = array(
				'player_jersey_number' => $this->get_player_jersey_number_in_match(
					$player->player_id,
					$match_id,
					$team_slot
				),
				'player_name'          => $this->get_player_name( $player->player_id ),
				'events'               => $this->get_player_events_icons( $player->player_id, $match_id ),
				'citizenship'          => $citizenship_html,
			);

		}

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $player_listing_data ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $data_a as $key => $data ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $data_a[ $key ] );
			}
		}

		foreach ( $data_a as $key => $data ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'player':
						$cells[] = '<div class="daextsoenl-paginated-table-player-name">' . esc_html( $data['player_name'] ) . '</div>' . '<div class="daextsoenl-paginated-table-events-container">' . $data['events'] . '</div>';
						break;

					case 'citizenship':
						$cells[] = $data['citizenship'];
						break;

					case 'jersey_number':
						$cells[] = $data['player_jersey_number'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Match Staff" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 */
	public function get_paginated_table_data_match_staff( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'staff':
					$table_module['head'][] = array(
						'column_name'         => 'staff',
						'column_title'        => __( 'Staff', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'staff', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'staff', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'citizenship':
					$table_module['head'][] = array(
						'column_name'         => 'citizenship',
						'column_title'        => __( 'Citizenship', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		// --------

		$match_id  = intval( $filter->match_id, 10 );
		$team_slot = intval( $filter->team_slot, 10 );
		$data_a    = array();

		// Generate the data of the table -----------------------------------------------------------------------------.

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d", $match_id );
		$match_obj  = $wpdb->get_row( $safe_sql );
		if ( $match_obj === null ) {
			return false;
			die();
		}

		$staff_listing_data = array();
		for ( $i = 1;$i <= 20;$i++ ) {

			$staff_id   = $match_obj->{'team_' . $team_slot . '_staff_id_' . $i};
			$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_staff';
			$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE staff_id = %d", $staff_id );
			$staff_obj  = $wpdb->get_row( $safe_sql );

			if ( $staff_obj !== null ) {
				$staff_listing_data[] = $staff_obj;
			}
		}

		foreach ( $staff_listing_data as $key => $staff ) {

			$citizenship_html = '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $staff->citizenship ) ) . '.png' ) . '">';
			if ( strlen( $staff->second_citizenship ) > 0 ) {
				$citizenship_html .= '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $staff->second_citizenship ) ) . '.png' ) . '">';
			}

			// Update the data at that index.
			$data_a[] = array(
				'staff_name'  => $this->get_staff_name( $staff->staff_id ),
				'citizenship' => $citizenship_html,
			);

		}

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $staff_listing_data ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $data_a as $key => $data ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $data_a[ $key ] );
			}
		}

		foreach ( $data_a as $key => $data ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'staff':
						$cells[] = $data['staff_name'];
						break;

					case 'citizenship':
						$cells[] = $data['citizenship'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Match Substitutions" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 */
	public function get_paginated_table_data_match_substitutions( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'player':
					$table_module['head'][] = array(
						'column_name'         => 'player',
						'column_title'        => __( 'Player', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'player', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'player', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'citizenship':
					$table_module['head'][] = array(
						'column_name'         => 'citizenship',
						'column_title'        => __( 'Citizenship', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'jersey_number':
					$table_module['head'][] = array(
						'column_name'         => 'jersey_number',
						'column_title'        => __( 'Jersey Number', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'jersey_number', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'jersey_number', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		$match_id  = intval( $filter->match_id, 10 );
		$team_slot = intval( $filter->team_slot, 10 );
		$data_a    = array();

		// Generate the data of the table -----------------------------------------------------------------------------.

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d", $match_id );
		$match_obj  = $wpdb->get_row( $safe_sql );
		if ( $match_obj === null ) {
			return false;
			die();
		}

		$player_listing_data = array();
		for ( $i = 1;$i <= 20;$i++ ) {

			$player_id  = $match_obj->{'team_' . $team_slot . '_substitute_player_id_' . $i};
			$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_player';
			$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d", $player_id );
			$player_obj = $wpdb->get_row( $safe_sql );

			if ( null !== $player_obj ) {
				$player_listing_data[] = $player_obj;
			}
		}

		foreach ( $player_listing_data as $key => $player ) {

			$citizenship_html = '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->citizenship ) ) . '.png' ) . '">';
			if ( strlen( $player->second_citizenship ) > 0 ) {
				$citizenship_html .= '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->second_citizenship ) ) . '.png' ) . '">';
			}

			// Update the data at that index.
			$data_a[] = array(
				'player_jersey_number' => $this->get_player_jersey_number_in_match(
					$player->player_id,
					$match_id,
					$team_slot
				),
				'player_name'          => $this->get_player_name( $player->player_id ),
				'events'               => $this->get_player_events_icons( $player->player_id, $match_id ),
				'citizenship'          => $citizenship_html,
			);

		}

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $player_listing_data ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $data_a as $key => $data ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $data_a[ $key ] );
			}
		}

		foreach ( $data_a as $key => $data ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'player':
						$cells[] = '<div class="daextsoenl-paginated-table-player-name">' . esc_html( $data['player_name'] ) . '</div>' . '<div class="daextsoenl-paginated-table-events-container">' . $data['events'] . '</div>';
						break;

					case 'citizenship':
						$cells[] = $data['citizenship'];
						break;

					case 'jersey_number':
						$cells[] = $data['player_jersey_number'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Squad Lineup" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 */
	public function get_paginated_table_data_squad_lineup( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'player':
					$table_module['head'][] = array(
						'column_name'         => 'player',
						'column_title'        => __( 'Player', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'player', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'player', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'date_of_birth':
					$table_module['head'][] = array(
						'column_name'         => 'date_of_birth',
						'column_title'        => __( 'Date of Birth', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'date_of_birth', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'date_of_birth', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'citizenship':
					$table_module['head'][] = array(
						'column_name'         => 'citizenship',
						'column_title'        => __( 'Citizenship', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'jersey_number':
					$table_module['head'][] = array(
						'column_name'         => 'jersey_number',
						'column_title'        => __( 'Jersey Number', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'jersey_number', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'jersey_number', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		$squad_id = intval( $filter->squad_id, 10 );
		$data_a   = array();

		// Generate the data of the table -----------------------------------------------------------------------------.

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_squad';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE squad_id = %d", $squad_id );
		$squad_obj  = $wpdb->get_row( $safe_sql );
		if ( $squad_obj === null ) {
			return false;
			die();
		}

		$player_listing_data = array();
		for ( $i = 1;$i <= 11;$i++ ) {

			$player_id  = $squad_obj->{'lineup_player_id_' . $i};
			$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_player';
			$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d", $player_id );
			$player_obj = $wpdb->get_row( $safe_sql );

			if ( null !== $player_obj ) {
				$player_listing_data[] = $player_obj;
			}
		}

		foreach ( $player_listing_data as $key => $player ) {

			$citizenship_html = '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->citizenship ) ) . '.png' ) . '">';
			if ( strlen( $player->second_citizenship ) > 0 ) {
				$citizenship_html .= '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->second_citizenship ) ) . '.png' ) . '">';
			}

			// Update the data at that index.
			$data_a[] = array(
				'jersey_number' => $this->get_player_jersey_number_in_squad( $squad_id, $player->player_id ),
				'player_name'   => $this->get_player_name( $player->player_id ),
				'date_of_birth' => $this->format_date_timestamp( $player->date_of_birth ),
				'citizenship'   => $citizenship_html,
			);

		}

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $player_listing_data ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $data_a as $key => $data ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $data_a[ $key ] );
			}
		}

		foreach ( $data_a as $key => $data ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'player':
						$cells[] = '<div class="daextsoenl-paginated-table-player-name">' . esc_html( $data['player_name'] ) . '</div>';
						break;

					case 'date_of_birth':
						$cells[] = $data['date_of_birth'];
						break;

					case 'citizenship':
						$cells[] = $data['citizenship'];
						break;

					case 'jersey_number':
						$cells[] = $data['jersey_number'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Squad Staff" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 */
	public function get_paginated_table_data_squad_staff( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'staff':
					$table_module['head'][] = array(
						'column_name'         => 'staff',
						'column_title'        => __( 'Staff', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'staff', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'staff', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'date_of_birth':
					$table_module['head'][] = array(
						'column_name'         => 'date_of_birth',
						'column_title'        => __( 'Date of Birth', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'date_of_birth', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'date_of_birth', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'citizenship':
					$table_module['head'][] = array(
						'column_name'         => 'citizenship',
						'column_title'        => __( 'Nat.', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		$squad_id = intval( $filter->squad_id, 10 );
		$data_a   = array();

		// Generate the data of the table -----------------------------------------------------------------------------.

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_squad';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE squad_id = %d", $squad_id );
		$squad_obj  = $wpdb->get_row( $safe_sql );
		if ( $squad_obj === null ) {
			return false;
			die();
		}

		$staff_listing_data = array();
		for ( $i = 1;$i <= 11;$i++ ) {

			$staff_id   = $squad_obj->{'staff_id_' . $i};
			$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_staff';
			$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE staff_id = %d", $staff_id );
			$staff_obj  = $wpdb->get_row( $safe_sql );

			if ( null !== $staff_obj ) {
				$staff_listing_data[] = $staff_obj;
			}
		}

		foreach ( $staff_listing_data as $key => $staff ) {

			$citizenship_html = '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $staff->citizenship ) ) . '.png' ) . '">';
			if ( strlen( $staff->second_citizenship ) > 0 ) {
				$citizenship_html .= '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $staff->second_citizenship ) ) . '.png' ) . '">';
			}

			// Update the data at that index.
			$data_a[] = array(
				'staff_name'    => $this->get_staff_name( $staff->staff_id ),
				'date_of_birth' => $this->format_date_timestamp( $staff->date_of_birth ),
				'citizenship'   => $citizenship_html,
			);

		}

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $staff_listing_data ) );// Set the total number of items
		$pag->set_record_per_page( $pagination ); // Set records per page
		$pag->set_current_page( $current_page );// set the current page number from $_GET
		$query_limit_values = $pag->query_limit_values();

		foreach ( $data_a as $key => $data ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $data_a[ $key ] );
			}
		}

		foreach ( $data_a as $key => $data ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'staff':
						$cells[] = $data['staff_name'];
						break;

					case 'date_of_birth':
						$cells[] = $data['date_of_birth'];
						break;

					case 'citizenship':
						$cells[] = $data['citizenship'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Squad Substitutions" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return mixed
	 */
	public function get_paginated_table_data_squad_substitutions( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'player':
					$table_module['head'][] = array(
						'column_name'         => 'player',
						'column_title'        => __( 'Player', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'player', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'player', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'date_of_birth':
					$table_module['head'][] = array(
						'column_name'         => 'date_of_birth',
						'column_title'        => __( 'Date of Birth', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'date_of_birth', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'date_of_birth', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'citizenship':
					$table_module['head'][] = array(
						'column_name'         => 'citizenship',
						'column_title'        => __( 'Citizenship', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'citizenship', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'jersey_number':
					$table_module['head'][] = array(
						'column_name'         => 'jersey_number',
						'column_title'        => __( 'Jersey Number', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'jersey_number', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'jersey_number', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		$squad_id = intval( $filter->squad_id, 10 );
		$data_a   = array();

		// Generate the data of the table -----------------------------------------------------------------------------.

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_squad';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE squad_id = %d", $squad_id );
		$squad_obj  = $wpdb->get_row( $safe_sql );
		if ( $squad_obj === null ) {
			return false;
			die();
		}

		$player_listing_data = array();
		for ( $i = 1;$i <= 20;$i++ ) {

			$player_id  = $squad_obj->{'substitute_player_id_' . $i};
			$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_player';
			$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d", $player_id );
			$player_obj = $wpdb->get_row( $safe_sql );

			if ( null !== $player_obj ) {
				$player_listing_data[] = $player_obj;
			}
		}

		foreach ( $player_listing_data as $key => $player ) {

			$citizenship_html = '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->citizenship ) ) . '.png' ) . '">';
			if ( strlen( $player->second_citizenship ) > 0 ) {
				$citizenship_html .= '<img class="daextsoenl-paginated-table-flag" src="' . esc_url( $this->get( 'url' ) . 'public/assets/img/flags/flat/16/' . strtoupper( esc_attr( $player->second_citizenship ) ) . '.png' ) . '">';
			}

			// Update the data at that index.
			$data_a[] = array(
				'jersey_number' => $this->get_player_jersey_number_in_squad( $squad_id, $player->player_id ),
				'player_name'   => $this->get_player_name( $player->player_id ),
				'date_of_birth' => $this->format_date_timestamp( $player->date_of_birth ),
				'citizenship'   => $citizenship_html,
			);

		}

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $player_listing_data ) );// Set the total number of items.
		$pag->set_record_per_page( $pagination ); // Set records per page.
		$pag->set_current_page( $current_page );// set the current page number from $_GET.
		$query_limit_values = $pag->query_limit_values();

		foreach ( $data_a as $key => $data ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $data_a[ $key ] );
			}
		}

		foreach ( $data_a as $key => $data ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'player':
						$cells[] = $data['player_name'];
						break;

					case 'date_of_birth':
						$cells[] = $data['date_of_birth'];
						break;

					case 'citizenship':
						$cells[] = $data['citizenship'];
						break;

					case 'jersey_number':
						$cells[] = $data['jersey_number'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the data of the paginated table displayed with the "Competition Standings Table" block.
	 *
	 * @param $current_page
	 * @param $filter
	 * @param $column_a
	 * @param $hidden_columns_breakpoint_1
	 * @param $hidden_columns_breakpoint_2
	 * @param $pagination
	 *
	 * @return string
	 */
	public function get_paginated_table_data_competition_standings_table( $current_page, $filter, $column_a, $hidden_columns_breakpoint_1, $hidden_columns_breakpoint_2, $pagination ) {

		// --------
		$table_module['head'] = array();
		foreach ( $column_a as $key => $column ) {

			switch ( $column ) {

				case 'position':
					$table_module['head'][] = array(
						'column_name'         => 'position',
						'column_title'        => __( '#', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'position', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'position', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'team':
					$table_module['head'][] = array(
						'column_name'         => 'team',
						'column_title'        => __( 'Team', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'team', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'team', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'played':
					$table_module['head'][] = array(
						'column_name'         => 'played',
						'column_title'        => __( 'MP', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'played', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'played', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'won':
					$table_module['head'][] = array(
						'column_name'         => 'won',
						'column_title'        => __( 'W', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'won', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'won', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'drawn':
					$table_module['head'][] = array(
						'column_name'         => 'drawn',
						'column_title'        => __( 'D', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'drawn', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'drawn', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'lost':
					$table_module['head'][] = array(
						'column_name'         => 'lost',
						'column_title'        => __( 'L', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'lost', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'lost', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'goals_for':
					$table_module['head'][] = array(
						'column_name'         => 'goals_for',
						'column_title'        => __( 'GF', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'goals', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'goals', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'goals_against':
					$table_module['head'][] = array(
						'column_name'         => 'goals_against',
						'column_title'        => __( 'GA', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'goals_against', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'goals_against', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'goal_difference':
					$table_module['head'][] = array(
						'column_name'         => 'goal_difference',
						'column_title'        => __( 'GD', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'goal_difference', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'goal_difference', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

				case 'points':
					$table_module['head'][] = array(
						'column_name'         => 'points',
						'column_title'        => __( 'PTS', 'soccer-engine-lite' ),
						'breakpoint_1_hidden' => in_array( 'points', $hidden_columns_breakpoint_1 ) ? '1' : '0',
						'breakpoint_2_hidden' => in_array( 'points', $hidden_columns_breakpoint_2 ) ? '1' : '0',
					);
					break;

			}
		}

		$competition_id = intval( $filter->competition_id, 10 );

		if ( 0 === $competition_id ) {
			return '<p>' . __( 'Please select a valid competition.', 'soccer-engine-lite' ) . '</p>';
		}

		// Do not generate the standings table if the competition if an elimination.
		if ( intval( $this->get_competition_type( $competition_id ), 10 ) === 0 ) {
			return '<p>' . esc_html__( "You can't create a standing table for a competition of type \"Elimination\".", 'soccer-engine-lite' ) . '</p>';
		}

		// Get the matches associated with the competition in order by round and then in order by date.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare(
			"SELECT * FROM $table_name WHERE competition_id = %d ORDER BY round ASC, date DESC",
			$competition_id
		);
		$match_a    = $wpdb->get_results( $safe_sql, ARRAY_A );

		$match_a_output = $this->get_standings_table_of_matches( $match_a );

		$position = 1;
		foreach ( $match_a_output as $key => $match_output ) {

			$match_a_output[ $key ]['position'] = $position;
			++$position;

		}

		// Initialize pagination class.
		require_once $this->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination-ajax.php';
		$pag = new Daextsoenl_Pagination_Ajax();
		$pag->set_total_items( count( $match_a_output ) );// Set the total number of items.
		$pag->set_record_per_page( $pagination ); // Set records per page.
		$pag->set_current_page( $current_page );// set the current page number from $_GET.
		$query_limit_values = $pag->query_limit_values();

		foreach ( $match_a_output as $key => $match_output ) {
			if ( $key < $query_limit_values['list_start'] or
				$key >= $query_limit_values['list_start'] + $query_limit_values['record_per_page'] ) {
				unset( $match_a_output[ $key ] );
			}
		}

		foreach ( $match_a_output as $key => $match_output ) {

			$cells = array();
			foreach ( $column_a as $key => $column ) {

				switch ( $column ) {

					case 'position':
						$cells[] = $match_output['position'];
						break;

					case 'team':
						$cells[] = $this->get_team_logo_html( $match_output['team_id'] ) . $match_output['team'];
						break;

					case 'played':
						$cells[] = $match_output['played'];
						break;

					case 'won':
						$cells[] = $match_output['won'];
						break;

					case 'drawn':
						$cells[] = $match_output['drawn'];
						break;

					case 'lost':
						$cells[] = $match_output['lost'];
						break;

					case 'goals_for':
						$cells[] = $match_output['goal'];
						break;

					case 'goals_against':
						$cells[] = $match_output['goals_against'];
						break;

					case 'goal_difference':
						$cells[] = $match_output['goal_difference'];
						break;

					case 'points':
						$cells[] = $match_output['points'];
						break;

				}
			}

			$table_module['body'][] = $cells;

		}

		// Generate the pagination html.
		$table_module['pagination']['items'] = $pag->getData();

		// Save the total number of items.
		$table_module['pagination']['total_items'] = $pag->total_items;

		return $table_module;
	}

	/**
	 * Get the match result based on the provided match and time of the match.
	 *
	 * Note that the match result is return as a text (E.g.: "2 - 1") or as an array (E.g.: [2, 1]) based on the
	 * provided $type parameter value.
	 *
	 * @param $match_id
	 * @param string   $type
	 * @param int      $time
	 *
	 * @return array|string
	 */
	public function get_match_result( $match_id, $type = 'text', $time = 90 ) {

		$match_result = array(
			'team_1' => 0,
			'team_2' => 0,
		);

		/**
		 * Parse through the events of the match and use the following event types and the related squad to determine the
		 * match_result:
		 *
		 * - Goal
		 * - Own Goal
		 */

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_event';
		$safe_sql   = $wpdb->prepare(
			"SELECT match_effect, team_slot FROM $table_name WHERE match_id = %d AND time <= %d",
			$match_id,
			$time
		);
		$event_a    = $wpdb->get_results( $safe_sql, ARRAY_A );

		foreach ( $event_a as $key => $event ) {

			// Update the result with the "Goal" event.
			if ( intval( $event['match_effect'], 10 ) === 1 ) {

				if ( intval( $event['team_slot'], 10 ) === 0 ) {
					++$match_result['team_1'];
				} else {
					++$match_result['team_2'];
				}
			}
		}

		if ( 'text' === $type ) {
			$result = $match_result['team_1'] . ':' . $match_result['team_2'];
		}

		if ( 'array' === $type ) {
			$result = array( $match_result['team_1'], $match_result['team_2'] );
		}

		return $result;
	}

	/**
	 * Return the URL of the logo of the team or false if the team logo is not defined.
	 *
	 * @param int $team_id The id of the team.
	 *
	 * @return bool
	 */
	public function get_team_logo_url( $team_id ) {

		if ( intval( $team_id, 10 ) === 0 ) {
			return false;}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_team';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE team_id = %d", $team_id );
		$team_obj   = $wpdb->get_row( $safe_sql );

		if ( strlen( $team_obj->logo ) > 0 ) {
			return $team_obj->logo;
		} else {
			return false;
		}
	}

	/**
	 * Return the URL of the logo of the competition or false if the competition logo is not defined.
	 *
	 * @param int $team_id The id of the team.
	 *
	 * @return bool
	 */
	public function get_competition_logo_url( $team_id ) {

		global $wpdb;
		$table_name      = $wpdb->prefix . $this->get( 'slug' ) . '_competition';
		$safe_sql        = $wpdb->prepare( "SELECT * FROM $table_name WHERE competition_id = %d", $team_id );
		$competition_obj = $wpdb->get_row( $safe_sql );

		if ( strlen( $competition_obj->logo ) > 0 ) {
			return $competition_obj->logo;
		} else {
			return false;
		}
	}

	/**
	 * Return the URL of the logo of the trophy or false if the trophy logo is not defined.
	 *
	 * @param int $team_id The id of the team.
	 *
	 * @return bool
	 */
	public function get_trophy_type_logo_url( $trophy_type_id ) {

		global $wpdb;
		$table_name      = $wpdb->prefix . $this->get( 'slug' ) . '_trophy_type';
		$safe_sql        = $wpdb->prepare( "SELECT * FROM $table_name WHERE trophy_type_id = %d", $trophy_type_id );
		$trophy_type_obj = $wpdb->get_row( $safe_sql );

		if ( strlen( $trophy_type_obj->logo ) > 0 ) {
			return $trophy_type_obj->logo;
		} else {
			return false;
		}
	}

	/**
	 * Returns the team logo HTML from the provided team id.
	 *
	 * @param int $team_id The id of the team.
	 *
	 * @return false|string
	 */
	public function get_team_logo_html( $team_id ) {

		$team_logo_url = $this->get_team_logo_url( $team_id );
		if ( strlen( $team_logo_url ) > 0 ) {
			return '<img src="' . esc_url( $team_logo_url ) . '">';
		} else {
			return $this->get_default_team_logo_svg();
		}
	}

	/**
	 * Returns the trophy type logo HTML from the provided trophy type id.
	 *
	 * @param int $team_id The id of the team.
	 *
	 * @return false|string
	 */
	public function get_trophy_type_logo_html( $trophy_type_id ) {

		$trophy_type_logo_url = $this->get_trophy_type_logo_url( $trophy_type_id );
		if ( strlen( $trophy_type_logo_url ) > 0 ) {
			return '<img src="' . esc_url( $trophy_type_logo_url ) . '">';
		} else {
			return $this->get_default_trophy_type_logo_svg();
		}
	}

	/**
	 * Returns the HTML of the events associated with the specified player in the specified match.
	 *
	 * @param int $player_id The id of the player.
	 * @param $match_id The id of the match.
	 *
	 * @return string
	 */
	public function get_player_events_icons( $player_id, $match_id ) {

		$output = '';

		// All the events except the substitution.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_event';
		$safe_sql   = $wpdb->prepare(
			"SELECT * FROM $table_name WHERE match_effect != 4 AND player_id = %d AND match_id = %d ORDER BY time ASC",
			$player_id,
			$match_id
		);
		$event_a    = $wpdb->get_results( $safe_sql );

		foreach ( $event_a as $key => $event ) {

			if ( intval( $event->data, 10 ) === 1 and
				intval( $event->match_effect, 10 ) > 0 ) {

				$output .= $this->get_event_icon_html( $event->match_effect );
				$output .= $this->get_event_tooltip_html( $event );

			}
		}

		// The substitution.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_event';
		$safe_sql   = $wpdb->prepare(
			"SELECT * FROM $table_name WHERE match_effect = 4 AND (player_id_substitution_in = %d OR player_id_substitution_out = %d) AND match_id = %d ORDER BY time ASC",
			$player_id,
			$player_id,
			$match_id
		);
		$event_a    = $wpdb->get_results( $safe_sql );

		foreach ( $event_a as $key => $event ) {

			if ( intval( $event->data, 10 ) === 1 and
				intval( $event->match_effect, 10 ) > 0 ) {

				$output .= $this->get_event_icon_html( $event->match_effect );
				$output .= $this->get_event_tooltip_html( $event );

			}
		}

		return $output;
	}

	/**
	 * Returns the HTML of the events associated with the specified staff in the specified match.
	 *
	 * @param $staff_id
	 * @param $match_id
	 *
	 * @return string
	 */
	public function get_staff_events_icons( $staff_id, $match_id ) {

		$output = '';

		// All the events except the substitution.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_event';
		$safe_sql   = $wpdb->prepare(
			"SELECT * FROM $table_name WHERE (match_effect = 2 OR match_effect = 3) AND staff_id = %d AND match_id = %d ORDER BY time ASC",
			$staff_id,
			$match_id
		);
		$event_a    = $wpdb->get_results( $safe_sql );

		foreach ( $event_a as $key => $event ) {

			if ( intval( $event->data, 10 ) === 1 ) {

				$output .= $this->get_event_icon_html( $event->match_effect );
				$output .= $this->get_event_tooltip_html( $event );

			}
		}

		return $output;
	}

	/**
	 * Returns the HTML of the icon associated with the specified match effect.
	 *
	 * Note that the actual colors are based on the plugin options.
	 *
	 * @param int $match_effect The id of the match effect.
	 * @param bool         $event_tooltip_trigger If the icon when hovered should display the tooltip.
	 *
	 * @return false|string
	 */
	public function get_event_icon_html( $match_effect, $event_tooltip_trigger = true ) {

		ob_start();

		if ( $event_tooltip_trigger ) {
			$event_tooltip_trigger_class = ' daextsoenl-event-tooltip-trigger';
		} else {
			$event_tooltip_trigger_class = '';
		}
		echo '<div class="daextsoenl-event-icon' . esc_attr( $event_tooltip_trigger_class ) . '">';

		switch ( $match_effect ) {

			// Goal.
			case 1:
				$url = $this->get( 'url' ) . 'public/assets/img/event-icon-goal.svg';
				break;

			// Yellow Card.
			case 2:
				$url = $this->get( 'url' ) . 'public/assets/img/event-icon-yellow-card.svg';
				break;

			// Red Card.
			case 3:
				$url = $this->get( 'url' ) . 'public/assets/img/event-icon-red-card.svg';
				break;

			// Substitution.
			case 4:
				$url = $this->get( 'url' ) . 'public/assets/img/event-icon-substitution.svg';
				break;

		}

		// Get the SVG content.
		$svg = file_get_contents( $url );

		// Configure the allowed tags and attributes of the svg.
		$allowed_html = array(
			'svg'     => array(),
			'path'    => array(
				'class' => array(),
				'd'     => array(),
			),
			'rect'    => array(
				'x'         => array(),
				'y'         => array(),
				'transform' => array(),
				'class'     => array(),
				'width'     => array(),
				'height'    => array(),
			),
			'polygon' => array(
				'class'  => array(),
				'points' => array(),
			),
		);

		// Sanitize the SVG.
		$sanitized_svg = wp_kses( $svg, $allowed_html );

		// Echo the SVG.
		echo $sanitized_svg;

		echo '</div>';

		return ob_get_clean();
	}

	/**
	 * Returns the event tooltip HTML of the specified event.
	 *
	 * @param object $event The event object.
	 *
	 * @return false|string
	 */
	public function get_event_tooltip_html( $event ) {

		ob_start();

		?>

		<div class="daextsoenl-event-tooltip daextsoenl-event-tooltip-event-type-id-<?php echo $event->match_effect; ?>">
		<div class="daextsoenl-event-tooltip-section-1">
			<div class="daextsoenl-event-tooltip-clock">
				<?php echo $this->generate_clock( $event->time, $event->additional_time, $event->part ); ?>
			</div>
			<div class="daextsoenl-event-tooltip-team-logo">
				<?php
				$team_id       = $this->get_team_of_event( $event->event_id );
				$team_logo_url = $this->get_team_logo_url( $team_id );
				if ( strlen( $team_logo_url ) > 0 ) {
					echo '<img src="' . esc_url( $team_logo_url ) . '">';
				} else {
					echo $this->get_default_team_logo_svg();
				}
				?>

			</div>
		</div>
		<div class="daextsoenl-event-tooltip-section-2">
			<div class="daextsoenl-event-tooltip-event-icon">
				<?php
				echo $this->get_event_icon_html( $event->match_effect, false );
				?>
			</div>
			<div class="daextsoenl-event-tooltip-event-type">
				<?php echo esc_html( $this->get_match_effect_name( $event->match_effect ) ); ?>
			</div>
		</div>
		<div class="daextsoenl-event-tooltip-section-3">
			<?php if ( intval( $event->match_effect, 10 ) === 1 ) : ?>

				<!-- Non-Substitution Event Type -->
				<div class="daextsoenl-event-tooltip-player-image">
					<?php echo $this->get_player_image( $event->player_id ); ?>
				</div>
				<div class="daextsoenl-event-tooltip-player-name">
					<?php echo esc_html( $this->get_player_name( $event->player_id ) ); ?>
				</div>

				<?php
			elseif ( intval( $event->match_effect, 10 ) === 2 or
						intval( $event->match_effect, 10 ) === 3 ) :
				?>

				<?php if ( $event->player_id > 0 ) : ?>

					<div class="daextsoenl-event-tooltip-player-image">
						<?php echo $this->get_player_image( $event->player_id ); ?>
					</div>
					<div class="daextsoenl-event-tooltip-player-name">
						<?php echo esc_html( $this->get_player_name( $event->player_id ) ); ?>
					</div>

				<?php elseif ( $event->staff_id > 0 ) : ?>

					<div class="daextsoenl-event-tooltip-staff-image">
						<?php echo $this->get_staff_image( $event->staff_id ); ?>
					</div>
					<div class="daextsoenl-event-tooltip-staff-name">
						<?php echo esc_html( $this->get_staff_name( $event->staff_id ) ); ?>
					</div>

				<?php endif; ?>

			<?php else : ?>

				<!-- Substitution Event Type -->
				<div class="daextsoenl-event-tooltip-substitution-out">
					<div class="daextsoenl-event-tooltip-player-image">
						<?php echo $this->get_player_image( $event->player_id_substitution_out ); ?>
					</div>
					<div class="daextsoenl-event-tooltip-player-name">
						<?php echo esc_html( $this->get_player_name( $event->player_id_substitution_out ) ); ?>
					</div>
				</div>
				<div class="daextsoenl-event-tooltip-substitution-in">
					<div class="daextsoenl-event-tooltip-player-image">
						<?php echo $this->get_player_image( $event->player_id_substitution_in ); ?>
					</div>
					<div class="daextsoenl-event-tooltip-player-name">
						<?php echo esc_html( $this->get_player_name( $event->player_id_substitution_in ) ); ?>
					</div>
				</div>

			<?php endif; ?>
		</div>
		</div>

		<?php

		return ob_get_clean();
	}

	/**
	 * Returns the team id of the specified event.
	 *
	 * @param $event_id
	 *
	 * @return mixed
	 */
	public function get_team_of_event( $event_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_event';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE event_id = %d", $event_id );
		$event_obj  = $wpdb->get_row( $safe_sql );

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d", $event_obj->match_id );
		$team_obj   = $wpdb->get_row( $safe_sql );

		if ( intval( $event_obj->team_slot, 10 ) === 0 ) {
			$team = $team_obj->team_id_1;
		} else {
			$team = $team_obj->team_id_2;
		}

		return $team;
	}

	/**
	 * Get the image HTML of the provided player id.
	 *
	 * @param int $player_id The id of the player.
	 *
	 * @return false|string
	 */
	public function get_player_image( $player_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_player';
		$safe_sql   = $wpdb->prepare( "SELECT image, gender FROM $table_name WHERE player_id = %d", $player_id );
		$player_obj = $wpdb->get_row( $safe_sql );

		if ( strlen( trim( $player_obj->image ) ) === 0 ) {
			return $this->get_default_avatar_svg( $player_obj->gender );
		} else {
			return '<img src="' . esc_attr( $player_obj->image ) . '">';
		}
	}

	/**
	 * Returns the HTML of the default avatar based on the provided gender.
	 *
	 * Please note that the avatar color and transparency is based on the plugin options.
	 *
	 * @param string $gender The gender.
	 *
	 * @return false|string
	 */
	public function get_default_avatar_svg( $gender ) {

		ob_start();

		if ( intval( $gender, 10 ) === 0 ) {

			// Store the default avatar male svg in a string.
			$url = $this->get( 'url' ) . 'public/assets/img/default-avatar-male.svg';

		} else {

			// Store the default avatar female svg in a string.
			$url = $this->get( 'url' ) . 'public/assets/img/default-avatar-female.svg';

		}

		// Get the SVG content.
		$svg = file_get_contents( $url );

		// Configure the allowed tags and attributes of the svg.
		$allowed_html = array(
			'svg'  => array(
				'version'     => array(),
				'id'          => array(),
				'xmlns'       => array(),
				'xmlns:xlink' => array(),
				'x'           => array(),
				'y'           => array(),
				'viewbox'     => array(),
				'style'       => array(),
				'xml:space'   => array(),
			),
			'path' => array(
				'class' => array(),
				'd'     => array(),
			),
			'rect' => array(
				'class'  => array(),
				'width'  => array(),
				'height' => array(),
			),
		);

		// Sanitize the SVG.
		$sanitized_svg = wp_kses( $svg, $allowed_html );

		// Echo the SVG.
		echo $sanitized_svg;

		return ob_get_clean();
	}

	/**
	 * Returns the default team logo.
	 *
	 * Please note that the colors are based on the plugin options.
	 *
	 * @return false|string
	 */
	public function get_default_team_logo_svg() {

		ob_start();

		// Store the default team logo svg in a string.
		$url = $this->get( 'url' ) . 'public/assets/img/default-team-logo.svg';

		// Get the SVG content.
		$svg = file_get_contents( $url );

		// Configure the allowed tags and attributes of the svg.
		$allowed_html = array(
			'svg'  => array(
				'xmlns'   => array(),
				'viewbox' => array(),
			),
			'path' => array(
				'class' => array(),
				'd'     => array(),
			),
			'rect' => array(
				'class'  => array(),
				'width'  => array(),
				'height' => array(),
			),
		);

		// Sanitize the SVG.
		$sanitized_svg = wp_kses( $svg, $allowed_html );

		// Echo the SVG.
		echo $sanitized_svg;

		return ob_get_clean();
	}

	/**
	 * Returns the sanitized SVG of the field.
	 *
	 * Please note that the colors are based on the plugin options.
	 *
	 * @return false|string
	 */
	public function get_field_svg() {

		ob_start();

		// Store the default team logo svg in a string.
		$url = $this->get( 'url' ) . 'public/assets/img/field.svg';

		// Get the SVG content.
		$svg = file_get_contents( $url );

		// Configure the allowed tags and attributes of the svg.
		$allowed_html = array(
			'svg'      => array(
				'xmlns'   => array(),
				'viewbox' => array(),
			),
			'path'     => array(
				'class' => array(),
				'd'     => array(),
			),
			'polygon'  => array(
				'id'     => array(),
				'class'  => array(),
				'points' => array(),
			),
			'polyline' => array(
				'class'  => array(),
				'points' => array(),
			),
			'line'     => array(
				'id'    => array(),
				'class' => array(),
				'x1'    => array(),
				'y1'    => array(),
				'x2'    => array(),
				'y2'    => array(),
			),
		);

		// Sanitize the SVG.
		$sanitized_svg = wp_kses( $svg, $allowed_html );

		// Echo the SVG.
		echo $sanitized_svg;

		return ob_get_clean();
	}

	/**
	 * Returns the default trophy type logo.
	 *
	 * Please note that the colors are based on the plugin options.
	 *
	 * @return false|string
	 */
	public function get_default_trophy_type_logo_svg() {

		ob_start();

		// Store the default team logo svg in a string.
		$url = $this->get( 'url' ) . 'public/assets/img/default-trophy-type-logo.svg';

		// Get the SVG content.
		$svg = file_get_contents( $url );

		// Configure the allowed tags and attributes of the svg.
		$allowed_html = array(
			'svg'  => array(
				'xmlns'   => array(),
				'viewbox' => array(),
			),
			'path' => array(
				'class' => array(),
				'd'     => array(),
			),
			'rect' => array(
				'class'  => array(),
				'width'  => array(),
				'height' => array(),
			),
		);

		// Sanitize the SVG.
		$sanitized_svg = wp_kses( $svg, $allowed_html );

		// Echo the SVG.
		echo $sanitized_svg;

		return ob_get_clean();
	}

	/**
	 * Returns the HTML of the staff image.
	 *
	 * @param int $staff_id The id of the staff.
	 *
	 * @return false|string
	 */
	public function get_staff_image( $staff_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_staff';
		$safe_sql   = $wpdb->prepare( "SELECT image, gender FROM $table_name WHERE staff_id = %d", $staff_id );
		$staff_obj  = $wpdb->get_row( $safe_sql );

		if ( strlen( trim( $staff_obj->image ) ) === 0 ) {
			return $this->get_default_avatar_svg( $staff_obj->gender );
		} else {
			return '<img src="' . esc_attr( $staff_obj->image ) . '">';
		}
	}

	/**
	 * Get the name of the competition type.
	 *
	 * @param string $type The type of the competition.
	 *
	 * @return string|void
	 */
	public function get_competition_type_name( $type ) {

		if ( intval( $type, 10 ) === 0 ) {
			return __( 'Elimination', 'soccer-engine-lite' );
		} else {
			return __( 'Round Robin', 'soccer-engine-lite' );
		}
	}

	/**
	 * Returns the HTML of the referee image.
	 *
	 * @param int $referee_id The id of the referee.
	 *
	 * @return false|string
	 */
	public function get_referee_image( $referee_id ) {

		global $wpdb;
		$table_name  = $wpdb->prefix . $this->get( 'slug' ) . '_referee';
		$safe_sql    = $wpdb->prepare( "SELECT image, gender FROM $table_name WHERE referee_id = %d", $referee_id );
		$referee_obj = $wpdb->get_row( $safe_sql );

		if ( strlen( trim( $referee_obj->image ) ) === 0 ) {
			return $this->get_default_avatar_svg( $referee_obj->gender );
		} else {
			return '<img src="' . esc_attr( $referee_obj->image ) . '">';
		}
	}

	/**
	 * Get the jersey number of the provided player, in the provided match, for the provided team.
	 *
	 * @param int $player_id The id of the player.
	 * @param int $match_id The id of the match.
	 * @param int $squad The id of the team.
	 *
	 * @return string|void
	 */
	public function get_player_jersey_number_in_match( $player_id, $match_id, $team ) {

		// Get the match.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare(
			"SELECT * FROM $table_name WHERE match_id = %d",
			$match_id
		);
		$match_obj  = $wpdb->get_row( $safe_sql );

		// Get the jersey set.
		global $wpdb;
		$table_name     = $wpdb->prefix . $this->get( 'slug' ) . '_jersey_set';
		$safe_sql       = $wpdb->prepare(
			"SELECT * FROM $table_name WHERE jersey_set_id = %d",
			$match_obj->{'team_' . $team . '_jersey_set_id'}
		);
		$jersey_set_obj = $wpdb->get_row( $safe_sql );

		if ( null !== $jersey_set_obj ) {

			for ( $i = 1;$i <= 50;$i++ ) {
				if ( $jersey_set_obj->{'player_id_' . $i} === $player_id ) {
					$jersey_number = $jersey_set_obj->{'jersey_number_player_id_' . $i};
				}
			}
		}

		if ( isset( $jersey_number ) ) {
			return $jersey_number;
		} else {
			return __( 'NA', 'soccer-engine-lite' );
		}
	}

	/**
	 * Returns the name of the provided competition.
	 *
	 * @param int $competition_id The id of the competition.
	 *
	 * @return string
	 */
	public function get_competition_name( $competition_id ) {

		global $wpdb;
		$table_name      = $wpdb->prefix . $this->get( 'slug' ) . '_competition';
		$safe_sql        = $wpdb->prepare( "SELECT name FROM $table_name WHERE competition_id = %d", $competition_id );
		$competition_obj = $wpdb->get_row( $safe_sql );

		return stripslashes( $competition_obj->name );
	}

	/**
	 * Returns the type of the provided competition
	 *
	 * @param int $competition_id The id of the competition.
	 *
	 * @return int
	 */
	public function get_competition_type( $competition_id ) {

		global $wpdb;
		$table_name      = $wpdb->prefix . $this->get( 'slug' ) . '_competition';
		$safe_sql        = $wpdb->prepare( "SELECT type FROM $table_name WHERE competition_id = %d", $competition_id );
		$competition_obj = $wpdb->get_row( $safe_sql );
		if ( $competition_obj === null ) {
			return null;}

		return intval( $competition_obj->type, 10 );
	}

	/**
	 * Returns the object of the provided competition.
	 *
	 * @param int $competition_id The id of the competition.
	 *
	 * @return array|object|void|null
	 */
	public function get_competition_obj( $competition_id ) {

		global $wpdb;
		$table_name      = $wpdb->prefix . $this->get( 'slug' ) . '_competition';
		$safe_sql        = $wpdb->prepare( "SELECT * FROM $table_name WHERE competition_id = %d", $competition_id );
		$competition_obj = $wpdb->get_row( $safe_sql );

		return $competition_obj;
	}

	/**
	 * Returns the standings table data of the provided match.
	 *
	 * @param $match_a
	 *
	 * @return array
	 */
	public function get_standings_table_of_matches( $match_a ) {

		$standings_table_a = array();
		foreach ( $match_a as $key => $match ) {

			/**
			 * Initialize the array used to store the data to avoid the "PHP Notice:  Undefined offset: etc." PHP
			 * notices when the values of the indexes of the multidimensional array are not assigned.
			 */
			for ( $i = 1;$i <= 2;$i++ ) {
				if ( ! isset( $standings_table_a[ $match[ 'team_id_' . $i ] ] ) ) {
					$standings_table_a[ $match[ 'team_id_' . $i ] ] = array();
				}
				foreach ( array( 'played', 'goals_for', 'goals_against', 'goal_difference', 'drawn', 'points', 'team_id', 'team', 'won', 'lost', 'goal' ) as $index ) {
					if ( ! isset( $standings_table_a[ $match[ 'team_id_' . $i ] ][ $index ] ) ) {
						$standings_table_a[ $match[ 'team_id_' . $i ] ][ $index ] = 0;
					}
				}
			}

			// Calculate the points received by the teams involved in the match ---------------------------------------.

			// Calculate the result of the match.
			$match_result = $this->get_match_result( $match['match_id'], 'array' );

			// Get the competition object.
			global $wpdb;
			$table_name      = $wpdb->prefix . $this->get( 'slug' ) . '_competition';
			$safe_sql        = $wpdb->prepare( "SELECT * FROM $table_name WHERE competition_id = %d", $match['competition_id'] );
			$competition_obj = $wpdb->get_row( $safe_sql );

			$standings_table_a[ $match['team_id_1'] ]['played']          = $standings_table_a[ $match['team_id_1'] ]['played'] + 1;
			$standings_table_a[ $match['team_id_2'] ]['played']          = $standings_table_a[ $match['team_id_2'] ]['played'] + 1;
			$standings_table_a[ $match['team_id_1'] ]['goals_for']       = $standings_table_a[ $match['team_id_1'] ]['goals_for'] + $match_result[0];
			$standings_table_a[ $match['team_id_2'] ]['goals_for']       = $standings_table_a[ $match['team_id_2'] ]['goals_for'] + $match_result[1];
			$standings_table_a[ $match['team_id_1'] ]['goals_against']   = $standings_table_a[ $match['team_id_1'] ]['goals_against'] + $match_result[1];
			$standings_table_a[ $match['team_id_2'] ]['goals_against']   = $standings_table_a[ $match['team_id_2'] ]['goals_against'] + $match_result[0];
			$standings_table_a[ $match['team_id_1'] ]['goal_difference'] = $standings_table_a[ $match['team_id_1'] ]['goal_difference'] + $match_result[0] - $match_result[1];
			$standings_table_a[ $match['team_id_2'] ]['goal_difference'] = $standings_table_a[ $match['team_id_2'] ]['goal_difference'] - $match_result[0] + $match_result[1];

			// Assign the statistics based on status Won/Drawn/Lost of the match.
			if ( $match_result[0] > $match_result[1] ) {

				// Team 1 Won - Team 2 Lost.
				$standings_table_a[ $match['team_id_1'] ]['won']    = $standings_table_a[ $match['team_id_1'] ]['won'] + 1;
				$standings_table_a[ $match['team_id_2'] ]['lost']   = $standings_table_a[ $match['team_id_2'] ]['lost'] + 1;
				$standings_table_a[ $match['team_id_1'] ]['points'] = $standings_table_a[ $match['team_id_1'] ]['points'] + $competition_obj->rr_victory_points;
				$standings_table_a[ $match['team_id_2'] ]['points'] = $standings_table_a[ $match['team_id_2'] ]['points'] + $competition_obj->rr_defeat_points;

			} elseif ( $match_result[0] < $match_result[1] ) {

				// Team 2 Won - Team 1 Lost.
				$standings_table_a[ $match['team_id_1'] ]['lost']   = $standings_table_a[ $match['team_id_1'] ]['lost'] + 1;
				$standings_table_a[ $match['team_id_2'] ]['won']    = $standings_table_a[ $match['team_id_2'] ]['won'] + 1;
				$standings_table_a[ $match['team_id_1'] ]['points'] = $standings_table_a[ $match['team_id_1'] ]['points'] + $competition_obj->rr_defeat_points;
				$standings_table_a[ $match['team_id_2'] ]['points'] = $standings_table_a[ $match['team_id_2'] ]['points'] + $competition_obj->rr_victory_points;

			} else {

				// Drawn.
				$standings_table_a[ $match['team_id_1'] ]['drawn']  = $standings_table_a[ $match['team_id_1'] ]['drawn'] + 1;
				$standings_table_a[ $match['team_id_2'] ]['drawn']  = $standings_table_a[ $match['team_id_2'] ]['drawn'] + 1;
				$standings_table_a[ $match['team_id_1'] ]['points'] = $standings_table_a[ $match['team_id_1'] ]['points'] + $competition_obj->rr_draw_points;
				$standings_table_a[ $match['team_id_2'] ]['points'] = $standings_table_a[ $match['team_id_2'] ]['points'] + $competition_obj->rr_draw_points;

			}

			// Team ID.
			$standings_table_a[ $match['team_id_1'] ]['team_id'] = $match['team_id_1'];
			$standings_table_a[ $match['team_id_2'] ]['team_id'] = $match['team_id_2'];

			// Team Name.
			$standings_table_a[ $match['team_id_1'] ]['team'] = $this->get_team_name( $match['team_id_1'] );
			$standings_table_a[ $match['team_id_2'] ]['team'] = $this->get_team_name( $match['team_id_2'] );

		}

		/**
		 * Sort the table by using the criteria defined in the competition
		 */
		$this->order_priority_1    = $competition_obj->rr_sorting_order_1;
		$this->order_priority_2    = $competition_obj->rr_sorting_order_2;
		$this->order_by_priority_1 = $this->get_competition_standings_table_column_from_code( $competition_obj->rr_sorting_order_by_1 );
		$this->order_by_priority_2 = $this->get_competition_standings_table_column_from_code( $competition_obj->rr_sorting_order_by_2 );
		usort( $standings_table_a, array( $this, 'sort_standings_table' ) );

		return $standings_table_a;
	}

	/*
	 * Returns the position of a team in the provided competition.
	 *
	 * Please note that this method should work only on competitions of type round-robin.
	 */
	public function get_team_position_in_competition( $team_id, $competition_id ) {

		if ( intval( $this->get_competition_type( $competition_id ), 10 ) !== 1 ) {
			return false;}

		// Get the matches associated with the competition in order by round and then in order by date.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare(
			"SELECT * FROM $table_name WHERE competition_id = %d ORDER BY round ASC, date DESC",
			$competition_id
		);
		$match_a    = $wpdb->get_results( $safe_sql, ARRAY_A );

		// Get the array with the standings table.
		$standings_table_a = $this->get_standings_table_of_matches( $match_a );

		// Get the position of the specified team by looking at the team_id index available in the retuned array.
		$position = null;
		foreach ( $standings_table_a as $key => $standings_table_row ) {
			if ( $standings_table_row['team_id'] === $team_id ) {
				$position = $key + 1;
			}
		}

		return $position;
	}

	/**
	 * Returns the name of the competition turn of the provided match.
	 *
	 * @param int $match_id The id of the match.
	 *
	 * @return string
	 */
	public function get_competition_turn( $match_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d ", $match_id );
		$match_obj  = $wpdb->get_row( $safe_sql );

		$competition_obj = $this->get_competition_obj( $match_obj->competition_id );

		if ( intval( $competition_obj->type, 10 ) === 0 ) {

			// Elimination.
			$round_difference = $competition_obj->rounds - $match_obj->round;

			switch ( $round_difference ) {

				case 0:
					$type_of_round = __( 'Final', 'soccer-engine-lite' );
					break;

				case 1:
					$type_of_round = __( 'Semi-Finals', 'soccer-engine-lite' );
					break;

				case 2:
					$type_of_round = __( 'Quarter-Finals', 'soccer-engine-lite' );
					break;

			}

			if ( $round_difference > 2 ) {
				$type_of_round = __( 'last', 'soccer-engine-lite' ) . ' ' . pow( 2, ( $round_difference + 1 ) );
			}
		} else {

			// Round Robin.
			$type_of_round = __( 'Matchday', 'soccer-engine-lite' );

		}

		return $type_of_round;
	}

	/**
	 * Returns the type of turn of a competition match.
	 *
	 * @param $match_id
	 *
	 * @return bool|string
	 */
	public function get_competition_turn_type( $match_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d", $match_id );
		$match_obj  = $wpdb->get_row( $safe_sql );

		if ( intval( $match_obj->type, 10 ) === 1 ) {
			$turn_type = __( '1st Leg', 'soccer-engine-lite' );
		} elseif ( intval( $match_obj->type, 10 ) === 2 ) {
			$turn_type = __( '2nd Leg', 'soccer-engine-lite' );
		} else {
			$turn_type = false;
		}

		return $turn_type;
	}

	/**
	 * Returns the x and y position of the player in the field.
	 *
	 * @param $player_index
	 * @param $formation_id
	 *
	 * @return string
	 */
	public function get_player_position( $player_index, $formation_id ) {

		if ( intval( $formation_id, 10 ) === 0 ) {

			/**
			 * Returns the player position taken from a default formation not saved in the database with generic
			 * positions.
			 */
			$default_formation = $this->get( 'default_formation' );
			$x                 = intval( $default_formation[ $player_index ]['x'], 10 );
			$y                 = intval( $default_formation[ $player_index ]['y'], 10 );

		} else {

			global $wpdb;
			$table_name    = $wpdb->prefix . $this->get( 'slug' ) . '_formation';
			$safe_sql      = $wpdb->prepare( "SELECT * FROM $table_name WHERE formation_id = %d", $formation_id );
			$formation_obj = $wpdb->get_row( $safe_sql );

			$x = intval( $formation_obj->{'x_position_' . $player_index}, 10 );
			$y = intval( $formation_obj->{'y_position_' . $player_index}, 10 );

		}

		return array(
			'x' => $x,
			'y' => $y,
		);
	}

	/**
	 * Get the jersey number of the specified player of the specified squad.
	 *
	 * @param int $squad_id The id of the squad.
	 * @param int $player_id The id of the player.
	 *
	 * @return string|void
	 */
	public function get_player_jersey_number_in_squad( $squad_id, $player_id ) {

		// Get the match.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_squad';
		$safe_sql   = $wpdb->prepare(
			"SELECT * FROM $table_name WHERE squad_id = %d",
			$squad_id
		);
		$squad_obj  = $wpdb->get_row( $safe_sql );

		// Get the jersey set.
		global $wpdb;
		$table_name     = $wpdb->prefix . $this->get( 'slug' ) . '_jersey_set';
		$safe_sql       = $wpdb->prepare(
			"SELECT * FROM $table_name WHERE jersey_set_id = %d",
			$squad_obj->jersey_set_id
		);
		$jersey_set_obj = $wpdb->get_row( $safe_sql );

		if ( $jersey_set_obj !== null ) {
			for ( $i = 1;$i <= 50;$i++ ) {
				if ( $jersey_set_obj->{'player_id_' . $i} === $player_id ) {
					$jersey_number = $jersey_set_obj->{'jersey_number_player_id_' . $i};
				}
			}
		}

		if ( isset( $jersey_number ) ) {
			return $jersey_number;
		} else {
			return __( 'N/A', 'soccer-engine-lite' );
		}
	}

	/**
	 * Returns the HTML of a person summary.
	 *
	 * Note that the persona summary template is used for the following blocks:
	 *
	 * - Player Summary
	 * - Staff Summary
	 * - Referee Summary
	 *
	 * @param $data
	 *
	 * @return false|string
	 */
	public function person_summary( $data ) {

		ob_start();

		?>

		<div class="daextsoenl-person-summary">
			<div class="daextsoenl-person-summary-content">
				<div class="daextsoenl-person-summary-content-title"><?php echo esc_html( $data['title'] ); ?></div>
				<div class="daextsoenl-person-summary-content-wrapper">
					<div class="daextsoenl-person-summary-image">
						<?php echo $data['image_html']; ?>
					</div>
					<div class="daextsoenl-person-summary-information">
						<div class="daextsoenl-person-summary-information-section-1">
							<?php for ( $i = 1;$i <= 4;$i++ ) : ?>
								<div class="daextsoenl-person-summary-information-item">
									<div class="daextsoenl-person-summary-information-item-field"><?php echo esc_html( $data[ 'item_' . $i . '_field' ] ); ?>:</div>
									<div class="daextsoenl-person-summary-information-item-value"><?php echo esc_html( $data[ 'item_' . $i . '_value' ] ); ?></div>
								</div>
							<?php endfor; ?>
						</div>
						<div class="daextsoenl-person-summary-information-section-2">
							<?php for ( $i = 5;$i <= 8;$i++ ) : ?>
								<div class="daextsoenl-person-summary-information-item">
									<div class="daextsoenl-person-summary-information-item-field"><?php echo esc_html( $data[ 'item_' . $i . '_field' ] ); ?>:</div>
									<div class="daextsoenl-person-summary-information-item-value"><?php echo esc_html( $data[ 'item_' . $i . '_value' ] ); ?></div>
								</div>
							<?php endfor; ?>
						</div>
						<div class="daextsoenl-person-summary-information-section-3">
							<?php for ( $i = 9;$i <= 12;$i++ ) : ?>
								<div class="daextsoenl-person-summary-information-item">
									<div class="daextsoenl-person-summary-information-item-field"><?php echo esc_html( $data[ 'item_' . $i . '_field' ] ); ?>:</div>
									<div class="daextsoenl-person-summary-information-item-value"><?php echo esc_html( $data[ 'item_' . $i . '_value' ] ); ?></div>
								</div>
							<?php endfor; ?>
						</div>
					</div>
				</div>
			</div>

		</div>

		<?php

		return ob_get_clean();
	}


	public function generate_clock( $time, $additional_time, $part ) {

		ob_start();

		$minute = $this->get_time_format_120( $time, $part );

		switch ( $minute ) {

			case 1:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M21.3,1L20,20V1C20.4,1,20.9,1,21.3,1z"/>';
				break;

			case 2:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M22.6,1.2L20,20V1C20.9,1,21.8,1.1,22.6,1.2z"/>';
				break;

			case 3:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M24,1.4L20,20V1C21.3,1,22.7,1.1,24,1.4z"/>';
				break;

			case 4:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M25.2,1.7L20,20V1C21.8,1,23.6,1.3,25.2,1.7z"/>';
				break;

			case 5:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M26.5,2.1L20,20V1C22.3,1,24.5,1.4,26.5,2.1z"/>';
				break;

			case 6:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M27.7,2.6L20,20V1C22.8,1,25.4,1.6,27.7,2.6z"/>';
				break;

			case 7:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M28.9,3.2L20,20V1C23.2,1,26.3,1.8,28.9,3.2z"/>';
				break;

			case 8:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M30.1,3.9L20,20V1C23.7,1,27.2,2.1,30.1,3.9z"/>';
				break;

			case 9:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M31.2,4.6L20,20V1C24.2,1,28,2.3,31.2,4.6z"/>';
				break;

			case 10:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M32.2,5.5L20,20V1C24.6,1,28.9,2.7,32.2,5.5z"/>';
				break;

			case 11:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M33.2,6.3L20,20V1C25.1,1,29.8,3,33.2,6.3z"/>';
				break;

			case 12:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M34.1,7.3L20,20V1C25.6,1,30.6,3.4,34.1,7.3z"/>';
				break;

			case 13:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M35,8.3L20,20V1C26.1,1,31.5,3.9,35,8.3z"/>';
				break;

			case 14:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M35.8,9.4L20,20V1C26.6,1,32.3,4.3,35.8,9.4z"/>';
				break;

			case 15:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M36.5,10.5L20,20V1C27,1,33.2,4.8,36.5,10.5z"/>';
				break;

			case 16:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M37.1,11.7L20,20V1C27.5,1,34,5.3,37.1,11.7z"/>';
				break;

			case 17:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M37.6,12.9L20,20V1C28,1,34.8,5.9,37.6,12.9z"/>';
				break;

			case 18:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M38.1,14.1L20,20V1C28.4,1,35.6,6.5,38.1,14.1z"/>';
				break;

			case 19:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M38.4,15.4L20,20V1C28.9,1,36.4,7.1,38.4,15.4z"/>';
				break;

			case 20:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M38.7,16.7L20,20V1C29.4,1,37.2,7.8,38.7,16.7z"/>';
				break;

			case 21:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M38.9,18L20,20V1C29.8,1,37.9,8.5,38.9,18z"/>';
				break;

			case 22:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,19.3L20,20V1C30.3,1,38.6,9.2,39,19.3z"/>';
				break;

			case 23:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,0.2,0,0.4,0,0.7L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 24:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,0.7,0,1.3-0.1,2L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 25:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,1.1-0.1,2.2-0.3,3.3L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 26:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,1.6-0.2,3.1-0.6,4.6L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 27:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,2-0.3,4-0.9,5.9L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 28:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,2.5-0.5,4.9-1.4,7.1L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 29:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,3-0.7,5.8-1.9,8.3L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 30:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,3.5-0.9,6.7-2.5,9.5L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 31:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,3.9-1.2,7.6-3.3,10.6L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 32:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,4.4-1.5,8.5-4,11.7L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 33:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,4.9-1.8,9.3-4.9,12.7L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 34:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,5.4-2.2,10.2-5.8,13.7L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 35:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,5.8-2.6,11.1-6.8,14.5L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 36:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,6.3-3.1,11.9-7.8,15.4L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 37:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,6.8-3.6,12.8-8.9,16.1L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 38:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,7.3-4.1,13.6-10.1,16.8L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 39:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,7.7-4.6,14.4-11.3,17.3L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 40:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,8.2-5.2,15.2-12.5,17.9L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 41:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,8.7-5.8,16-13.8,18.3L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 42:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,9.1-6.5,16.8-15,18.6L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 43:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,9.6-7.1,17.5-16.4,18.8L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 44:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10-7.8,18.3-17.7,19L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 45:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 46:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-0.4,0-0.9,0-1.3,0L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 47:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-0.9,0-1.8-0.1-2.6-0.2L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 48:
				$overlay_path = '<path id="_x34_8" class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-1.3,0-2.7-0.1-4-0.4L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 49:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-1.8,0-3.6-0.3-5.2-0.7L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 50:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-2.3,0-4.5-0.4-6.5-1.1L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 51:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-2.8,0-5.4-0.6-7.7-1.7L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 52:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-3.2,0-6.3-0.8-8.9-2.2L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 53:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-3.7,0-7.2-1.1-10.1-2.9L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 54:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-4.2,0-8-1.4-11.2-3.6L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 55:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-4.6,0-8.9-1.7-12.2-4.5L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 56:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-5.1,0-9.8-2-13.2-5.3L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 57:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-5.6,0-10.6-2.4-14.1-6.3L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 58:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-6.1,0-11.5-2.9-15-7.3L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 59:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-6.6,0-12.3-3.3-15.8-8.4L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 60:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-7,0-13.2-3.8-16.5-9.5L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 61:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-7.5,0-14-4.4-17.1-10.7L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 62:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-8,0-14.8-4.9-17.6-11.9L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 63:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-8.4,0-15.6-5.5-18.1-13.1L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 64:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-8.9,0-16.4-6.1-18.4-14.4L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 65:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-9.4,0-17.2-6.8-18.7-15.7L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 66:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19c-9.8,0-17.9-7.5-18.9-17L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 67:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19C9.7,39,1.4,30.8,1,20.7L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 68:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20c0-0.2,0-0.4,0-0.7L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 69:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20c0-0.7,0-1.3,0.1-2L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 70:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20c0-1.1,0.1-2.2,0.3-3.3L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 71:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20c0-1.6,0.2-3.1,0.6-4.6L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 72:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20c0-2,0.3-4,0.9-5.9L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 73:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20c0-2.5,0.5-4.9,1.4-7.1L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 74:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20c0-3,0.7-5.8,1.9-8.3L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 75:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20c0-3.5,0.9-6.7,2.5-9.5L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 76:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20c0-3.9,1.2-7.6,3.3-10.6L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 77:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20c0-4.4,1.5-8.5,4-11.7L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 78:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20c0-4.9,1.8-9.4,4.9-12.7L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 79:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20C1,14.6,3.2,9.8,6.8,6.3L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 80:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20C1,14.2,3.6,8.9,7.8,5.5L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 81:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20C1,13.7,4.1,8.1,8.8,4.6L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 82:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20C1,13.2,4.6,7.3,9.9,3.9L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 83:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20C1,12.7,5.1,6.4,11.1,3.2L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 84:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20C1,12.3,5.6,5.6,12.3,2.6L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 85:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20C1,11.8,6.2,4.8,13.5,2.1L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 86:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20C1,11.3,6.8,4,14.8,1.7L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 87:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20C1,10.9,7.5,3.2,16,1.4L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 88:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20C1,10.4,8.1,2.5,17.4,1.2L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 89:
				$overlay_path = '<path class="daextsoenl-clock-4" d="M39,20c0,10.5-8.5,19-19,19S1,30.5,1,20C1,10,8.8,1.7,18.7,1L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 90:
				$overlay_path = '<circle class="daextsoenl-clock-4" cx="20" cy="20" r="19"/>';
				break;

			case 91:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M21.3,1L20,20V1C20.4,1,20.9,1,21.3,1z"/>';
				break;

			case 92:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M22.6,1.2L20,20V1C20.9,1,21.8,1.1,22.6,1.2z"/>';
				break;

			case 93:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M24,1.4L20,20V1C21.3,1,22.7,1.1,24,1.4z"/>';
				break;

			case 94:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M25.2,1.7L20,20V1C21.8,1,23.6,1.3,25.2,1.7z"/>';
				break;

			case 95:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M26.5,2.1L20,20V1C22.3,1,24.5,1.4,26.5,2.1z"/>';
				break;

			case 96:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M27.7,2.6L20,20V1C22.8,1,25.4,1.6,27.7,2.6z"/>';
				break;

			case 97:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M28.9,3.2L20,20V1C23.2,1,26.3,1.8,28.9,3.2z"/>';
				break;

			case 98:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M30.1,3.9L20,20V1C23.7,1,27.2,2.1,30.1,3.9z"/>';
				break;

			case 99:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M31.2,4.6L20,20V1C24.2,1,28,2.3,31.2,4.6z"/>';
				break;

			case 100:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M32.2,5.5L20,20V1C24.6,1,28.9,2.7,32.2,5.5z"/>';
				break;

			case 101:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M33.2,6.3L20,20V1C25.1,1,29.8,3,33.2,6.3z"/>';
				break;

			case 102:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M34.1,7.3L20,20V1C25.6,1,30.6,3.4,34.1,7.3z"/>';
				break;

			case 103:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M35,8.3L20,20V1C26.1,1,31.5,3.9,35,8.3z"/>';
				break;

			case 104:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M35.8,9.4L20,20V1C26.6,1,32.3,4.3,35.8,9.4z"/>';
				break;

			case 105:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M36.5,10.5L20,20V1C27,1,33.2,4.8,36.5,10.5z"/>';
				break;

			case 106:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M37.1,11.7L20,20V1C27.5,1,34,5.3,37.1,11.7z"/>';
				break;

			case 107:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M37.6,12.9L20,20V1C28,1,34.8,5.9,37.6,12.9z"/>';
				break;

			case 108:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M38.1,14.1L20,20V1C28.4,1,35.6,6.5,38.1,14.1z"/>';
				break;

			case 109:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M38.4,15.4L20,20V1C28.9,1,36.4,7.1,38.4,15.4z"/>';
				break;

			case 110:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M38.7,16.7L20,20V1C29.4,1,37.2,7.8,38.7,16.7z"/>';
				break;

			case 111:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M38.9,18L20,20V1C29.8,1,37.9,8.5,38.9,18z"/>';
				break;

			case 112:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M39,19.3L20,20V1C30.3,1,38.6,9.2,39,19.3z"/>';
				break;

			case 113:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M39,20c0,0.2,0,0.4,0,0.7L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 114:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M39,20c0,0.7,0,1.3-0.1,2L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 115:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M39,20c0,1.1-0.1,2.2-0.3,3.3L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 116:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M39,20c0,1.6-0.2,3.1-0.6,4.6L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 117:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M39,20c0,2-0.3,4-0.9,5.9L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 118:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M39,20c0,2.5-0.5,4.9-1.4,7.1L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 119:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M39,20c0,3-0.7,5.8-1.9,8.3L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

			case 120:
				$overlay_path = '<path class="daextsoenl-clock-5" d="M39,20c0,3.5-0.9,6.7-2.5,9.5L20,20V1C30.5,1,39,9.5,39,20z"/>';
				break;

		}

		?>

		<div class="daextsoenl-clock">

			<?php

			ob_start();

			?>

			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				viewBox="0 0 40 40" style="enable-background:new 0 0 40 40;" xml:space="preserve">
				<g id="background">
					<circle class="daextsoenl-clock-6" cx="20" cy="20" r="20"/>
					<circle class="daextsoenl-clock-2" cx="20" cy="20" r="19"/>
				</g>
				<g id="ticks">
					<g id="secondary">
						<g>
							<path class="daextsoenl-clock-1" d="M25.3,3.5L24.4,6c0.4,0.1,0.8,0.3,1.3,0.5L26.5,4C26.1,3.8,25.7,3.6,25.3,3.5z"/>
						</g>
						<g>
							<path class="daextsoenl-clock-1" d="M13.5,36c0.4,0.2,0.8,0.3,1.3,0.5l0.9-2.5c-0.4-0.1-0.8-0.3-1.3-0.5L13.5,36z"/>
						</g>
						<g>
							<path class="daextsoenl-clock-1" d="M8.4,32.8c0.3,0.3,0.7,0.6,1,0.9l1.7-2c-0.4-0.3-0.7-0.6-1-0.9L8.4,32.8z"/>
						</g>
						<g>
							<path class="daextsoenl-clock-1" d="M30.6,6.3l-1.7,2c0.4,0.3,0.7,0.6,1,0.9l1.7-2C31.3,6.9,31,6.6,30.6,6.3z"/>
						</g>
						<g>
							<path class="daextsoenl-clock-1" d="M34.7,10.8l-2.3,1.3c0.2,0.4,0.5,0.8,0.7,1.2l2.3-1.3C35.1,11.5,34.9,11.1,34.7,10.8z"/>
						</g>
						<g>
							<path class="daextsoenl-clock-1" d="M4.7,28.1c0.2,0.4,0.4,0.8,0.7,1.1l2.3-1.3c-0.2-0.4-0.5-0.8-0.7-1.2L4.7,28.1z"/>
						</g>
						<g>
							<path class="daextsoenl-clock-1" d="M2.8,22.3c0.1,0.4,0.1,0.9,0.2,1.3l2.6-0.5c-0.1-0.4-0.2-0.9-0.2-1.3L2.8,22.3z"/>
						</g>
						<g>
							<path class="daextsoenl-clock-1" d="M36.9,16.3l-2.6,0.5c0.1,0.4,0.2,0.9,0.2,1.3l2.6-0.5C37.1,17.2,37,16.8,36.9,16.3z"/>
						</g>
						<g>
							<path class="daextsoenl-clock-1" d="M5.5,18.1c0.1-0.4,0.1-0.9,0.2-1.3l-2.6-0.5c-0.1,0.4-0.2,0.9-0.2,1.3L5.5,18.1z"/>
						</g>
						<g>
							<path class="daextsoenl-clock-1" d="M34.5,21.9c-0.1,0.4-0.1,0.9-0.2,1.3l2.6,0.5c0.1-0.4,0.2-0.9,0.2-1.3L34.5,21.9z"/>
						</g>
						<g>
							<path class="daextsoenl-clock-1" d="M33,26.7c-0.2,0.4-0.4,0.8-0.7,1.2l2.3,1.3c0.2-0.4,0.5-0.8,0.7-1.1L33,26.7z"/>
						</g>
						<g>
							<path class="daextsoenl-clock-1" d="M7,13.3c0.2-0.4,0.4-0.8,0.7-1.2l-2.3-1.3c-0.2,0.4-0.5,0.8-0.7,1.1L7,13.3z"/>
						</g>
						<g>
							<path class="daextsoenl-clock-1" d="M10.1,9.2c0.3-0.3,0.7-0.6,1-0.9l-1.7-2C9,6.6,8.7,6.9,8.4,7.2L10.1,9.2z"/>
						</g>
						<g>
							<path class="daextsoenl-clock-1" d="M29.9,30.8c-0.3,0.3-0.7,0.6-1,0.9l1.7,2c0.4-0.3,0.7-0.6,1-0.9L29.9,30.8z"/>
						</g>
						<g>
							<path class="daextsoenl-clock-1" d="M14.4,6.5c0.4-0.2,0.8-0.3,1.3-0.5l-0.9-2.5c-0.4,0.1-0.8,0.3-1.3,0.5L14.4,6.5z"/>
						</g>
						<g>
							<path class="daextsoenl-clock-1" d="M25.6,33.5c-0.4,0.2-0.8,0.3-1.3,0.5l0.9,2.5c0.4-0.1,0.8-0.3,1.3-0.5L25.6,33.5z"/>
						</g>
					</g>
					<g id="main">
						<g>
							<path class="daextsoenl-clock-3" d="M19.3,33.3v4c0.2,0,0.4,0,0.7,0s0.4,0,0.7,0v-4c-0.2,0-0.4,0-0.7,0S19.6,33.3,19.3,33.3z"/>
						</g>
						<g>
							<path class="daextsoenl-clock-3" d="M20,2.7c-0.2,0-0.4,0-0.7,0v4c0.2,0,0.4,0,0.7,0s0.4,0,0.7,0v-4C20.4,2.7,20.2,2.7,20,2.7z"/>
						</g>
					</g>
				</g>
				<g id="overlay">
					<?php echo $overlay_path; ?>
				</g>
			</svg>

			<?php

			$svg = ob_get_clean();

			// Configure the allowed tags and attributes of the svg.
			$allowed_html = array(
				'svg'    => array(
					'version'     => array(),
					'xmlns'       => array(),
					'xmlns:xlink' => array(),
					'x'           => array(),
					'y'           => array(),
					'viewbox'     => array(),
					'style'       => array(),
				),
				'circle' => array(
					'class' => array(),
					'cx'    => array(),
					'cy'    => array(),
					'r'     => array(),
				),
				'path'   => array(
					'class' => array(),
					'd'     => array(),
				),
			);

			// Sanitize the SVG.
			$sanitized_svg = wp_kses( $svg, $allowed_html );

			// Echo the SVG.
			echo $sanitized_svg;

			?>

			<div class="daextsoenl-clock-time">
				<div class="daextsoenl-clock-time-time"><?php echo intval( $minute, 10 ); ?></div>
				<?php if ( $additional_time > 0 ) : ?>
					<div class="daextsoenl-clock-time-additional-time">+<?php echo intval( $additional_time, 10 ); ?></div>
				<?php endif; ?>
			</div>
		</div>

		<?php

		return ob_get_clean();
	}

	/**
	 * Returns the name of the country based on the provided apha 2 code.
	 *
	 * @param string $alpha_2_code The alpha 2 code of the country.
	 *
	 * @return int|string
	 */
	function get_country_name_from_alpha_2_code( $alpha_2_code ) {

		$country_a = $this->get( 'countries' );

		foreach ( $country_a as $country_name => $parsed_alpha_2_code ) {

			if ( $alpha_2_code === $parsed_alpha_2_code ) {
				return $country_name;
			}
		}
	}

	/**
	 * This method is used during the import process available in the Settings -> Import menu.
	 *
	 * This method is used to return the correct comparable field name for all the foreign key fields that have a field
	 * name different from the actual name of the primary key.
	 *
	 * E.g. In the [prefix]_daextsoenl_match database table the team_id_1 and team_id_2 foreign key fields should be compared
	 * with the 'team_id' primary key.
	 *
	 * Note that this method is used when during the import process the values of the old foreign keys (stored in the
	 * XML file) are replaced with the new keys (retrieved after the actual creation of the record in the database
	 * table). A step necessary to preserve the referential integrity of the imported data.
	 *
	 * Please note that for performance reasons regular expressions are used instead of comparisons with a for cycle.
	 * Loose regular expressions are preferred over strict regular expression to avoid complexity in the regex
	 * definition.
	 *
	 * @param $database_table
	 * @param $field_name
	 *
	 * @return string
	 */
	function get_comparable_field_name( $database_table, $field_name ) {

		switch ( $database_table ) {

			case 'competition':
				// From team_id_1 to team_id_128.
				if ( preg_match( '/^team_id_\d{1,3}$/', $field_name ) === 1 ) {
					return 'team_id';
				}

				break;

			case 'event':
				switch ( $field_name ) {

					case 'player_id_substitution_in':
					case 'player_id_substitution_out':
						return 'player_id';

				}

				break;

			case 'jersey_set':
				// From player_id_1 to player_id_50.
				if ( preg_match( '/^player_id_\d{1,2}$/', $field_name ) === 1 ) {
					return 'player_id';
				}

				break;

			case 'match':
				// From team_1_lineup_player_id_1 to team_1_lineup_player_id_50.
				if ( preg_match( '/^team_1_lineup_player_id_\d{1,2}$/', $field_name ) === 1 ) {
					return 'player_id';
				}

				// From team_1_substitute_player_id_1 to team_1_substitute_player_id_50.
				if ( preg_match( '/^team_1_substitute_player_id_\d{1,2}$/', $field_name ) === 1 ) {
					return 'player_id';
				}

				// From team_1_staff_id_1 to team_1_staff_id_50.
				if ( preg_match( '/^team_1_staff_id_\d{1,2}$/', $field_name ) === 1 ) {
					return 'staff_id';
				}

				// From team_2_lineup_player_id_1 to team_2_lineup_player_id_50.
				if ( preg_match( '/^team_2_lineup_player_id_\d{1,2}$/', $field_name ) === 1 ) {
					return 'player_id';
				}

				// From team_2_substitute_player_id_1 to team_2_substitute_player_id_50.
				if ( preg_match( '/^team_2_substitute_player_id_\d{1,2}$/', $field_name ) === 1 ) {
					return 'player_id';
				}

				// From team_2_staff_id_1 to team_2_staff_id_50.
				if ( preg_match( '/^team_2_staff_id_\d{1,2}$/', $field_name ) === 1 ) {
					return 'staff_id';
				}

				switch ( $field_name ) {

					case 'team_1_formation_id':
					case 'team_2_formation_id':
						return 'formation_id';

				}

				switch ( $field_name ) {

					case 'team_1_formation_id':
					case 'team_2_formation_id':
						return 'formation_id';

				}

				switch ( $field_name ) {

					case 'player_id_injured':
					case 'player_id_unavailable':
						return 'player_id';

				}

				switch ( $field_name ) {

					case 'team_1_jersey_set_id':
					case 'team_2_jersey_set_id':
						return 'jersey_set_id';

				}

				switch ( $field_name ) {

					case 'team_id_1':
					case 'team_id_2':
						return 'team_id';

				}

				break;

			case 'squad':
				// From lineup_player_id_1 to lineup_player_id_11.
				if ( preg_match( '/^lineup_player_id_\d{1,2}$/', $field_name ) === 1 ) {
					return 'player_id';
				}

				// From substitute_player_id_1 to substitute_player_id_50.
				if ( preg_match( '/^substitute_player_id_\d{1,2}$/', $field_name ) === 1 ) {
					return 'player_id';
				}

				// From staff_id_1 to staff_id_50.
				if ( preg_match( '/^staff_id_\d{1,2}$/', $field_name ) === 1 ) {
					return 'staff_id';
				}

				break;

			case 'transfer':
				switch ( $field_name ) {

					case 'team_id_left':
					case 'team_id_joined':
						return 'team_id';

				}

				break;

		}

		return $field_name;
	}

	/**
	 * Returns True if the database field name is a foreign key, otherwise return False.
	 *
	 * Please note that for performance reasons regular expressions are used instead of comparisons with a for cycle.
	 * Loose regular expressions are preferred over strict regular expression to avoid complexity in the regex
	 * definition.
	 *
	 * @param string $table_name The name of the database table.
	 * @param string $field_name The name of the database field.
	 *
	 * @return bool
	 */
	function is_foreign_key( $table_name, $field_name ) {

		switch ( $table_name ) {

			case 'agency_contract':
				switch ( $field_name ) {

					case 'agency_contract_type_id':
					case 'player_id':
					case 'agency_id':
						return true;

				}

				break;

			case 'event':
				switch ( $field_name ) {

					case 'match_id':
					case 'player_id':
					case 'player_id_substitution_in':
					case 'player_id_substitution_out':
						return true;

				}

				break;

			case 'injury':
				switch ( $field_name ) {

					case 'injury_type_id':
					case 'player_id':
						return true;

				}

				break;

			case 'competition':
				// From team_id_1 to team_id_128.
				if ( preg_match( '/^team_id_\d{1,3}$/', $field_name ) === 1 ) {
					return true;
				}

				break;

			case 'jersey_set':
				// From player_id_1 to player_id_50.
				if ( preg_match( '/^player_id_\d{1,2}$/', $field_name ) === 1 ) {
					return true;
				}

				switch ( $field_name ) {

					case 'team_id':
						return true;

				}

				break;

			case 'market_value_transition':
				switch ( $field_name ) {

					case 'player_id':
						return true;

				}

				break;

			case 'match':
				switch ( $field_name ) {

					case 'competition_id':
					case 'team_id_1':
					case 'team_id_2':
					case 'team_1_jersey_set_id':
					case 'team_2_jersey_set_id':
						return true;

				}

				// From team_1_lineup_player_id_1 to team_1_lineup_player_id_11.
				if ( preg_match( '/^team_1_lineup_player_id_\d{1,2}$/', $field_name ) === 1 ) {
					return true;
				}

				// From team_1_substitute_player_id_1 to team_1_substitute_player_id_50.
				if ( preg_match( '/^team_1_substitute_player_id_\d{1,2}$/', $field_name ) === 1 ) {
					return true;
				}

				// From team_1_staff_id_1 to team_1_staff_id_50.
				if ( preg_match( '/^team_1_staff_id_\d{1,2}$/', $field_name ) === 1 ) {
					return true;
				}

				// From team_2_lineup_player_id_1 to team_2_lineup_player_id_11
				if ( preg_match( '/^team_2_lineup_player_id_\d{1,2}$/', $field_name ) === 1 ) {
					return true;
				}

				// From team_2_substitute_player_id_1 to team_2_substitute_player_id_50.
				if ( preg_match( '/^team_2_substitute_player_id_\d{1,2}$/', $field_name ) === 1 ) {
					return true;
				}

				// From team_2_staff_id_1 to team_2_staff_id_50.
				if ( preg_match( '/^team_2_staff_id_\d{1,2}$/', $field_name ) === 1 ) {
					return true;
				}

				switch ( $field_name ) {

					case 'stadium_id':
					case 'team_1_formation_id':
					case 'team_2_formation_id':
					case 'referee_id':
						return true;

				}

				break;

			case 'player':
				switch ( $field_name ) {

					case 'player_position_id':
						return true;

				}

				break;

			case 'player_award':
				switch ( $field_name ) {

					case 'player_award_type_id':
					case 'player_id':
						return true;

				}

				break;

			case 'ranking_transition':
				switch ( $field_name ) {

					case 'ranking_type_id':
					case 'team_id':
						return true;

				}

				break;

			case 'referee_badge':
				switch ( $field_name ) {

					case 'referee_id':
					case 'referee_badge_type_id':
						return true;

				}

				break;

			case 'squad':
				// From lineup_player_id_1 to lineup_player_id_11.
				if ( preg_match( '/^lineup_player_id_\d{1,2}$/', $field_name ) === 1 ) {
					return true;
				}

				// From substitute_player_id_1 to substitute_player_id_50.
				if ( preg_match( '/^substitute_player_id_\d{1,2}$/', $field_name ) === 1 ) {
					return true;
				}

				// From staff_id_1 to staff_id_50
				if ( preg_match( '/^staff_id_\d{1,2}$/', $field_name ) === 1 ) {
					return true;
				}

				switch ( $field_name ) {

					case 'jersey_set_id':
					case 'formation_id':
						return true;

				}

				break;

			case 'staff':
				switch ( $field_name ) {

					case 'staff_type_id':
						return true;

				}

				break;

			case 'staff_award':
				switch ( $field_name ) {

					case 'staff_award_type_id':
					case 'staff_id':
						return true;

				}

				break;

			case 'team':
				switch ( $field_name ) {

					case 'stadium_id':
						return true;

				}

				break;

			case 'team_contract':
				switch ( $field_name ) {

					case 'team_contract_type_id':
					case 'player_id':
					case 'team_id':
						return true;

				}

				break;

			case 'transfer':
				switch ( $field_name ) {

					case 'transfer_id':
					case 'player_id':
					case 'team_id_left':
					case 'team_id_joined':
					case 'transfer_type_id':
						return true;

				}

				break;

			case 'trophy':
				switch ( $field_name ) {

					case 'trophy_type_id':
					case 'team_id':
						return true;

				}

				break;

			case 'unavailable_player':
				switch ( $field_name ) {

					case 'player_id':
					case 'unavailable_player_type_id':
						return true;

				}

				break;

		}

		return false;
	}

	/**
	 * This method is used for performance reasons in the import procedure to avoid useless cycles in the foreach used
	 * to replace the value of the old foreign keys with the new keys retrieved after the actual creation of the
	 * database table.
	 *
	 * @param string $table_name The name of the database table.
	 *
	 * @return bool
	 */
	function table_has_foreign_keys( $table_name ) {

		switch ( $table_name ) {

			case 'agency_contract':
			case 'competition':
			case 'event':
			case 'injury':
			case 'jersey_set':
			case 'market_value_transition':
			case 'match':
			case 'player':
			case 'player_award':
			case 'ranking_transition':
			case 'referee_badge':
			case 'squad':
			case 'staff':
			case 'staff_award':
			case 'team':
			case 'team_contract':
			case 'transfer':
			case 'trophy':
			case 'unavailable_player':
				return true;

		}

		return false;
	}

	/**
	 * Returns an array of colors from the colors provided in comma separated list stored in a string.
	 *
	 * @param $string_of_colors
	 *
	 * @return array
	 */
	function get_array_of_colors( $string_of_colors ) {

		$pattern = '/((\#([0-9a-fA-F]{3}){1,2})|(rgba\(\d{1,3},\d{1,3},\d{1,3},(\d{1}|\d{1}\.\d{1,2})\)))/';

		$subject = $string_of_colors;
		preg_match_all( $pattern, $subject, $matches );
		$line_color_a = $matches[0];
		$fill         = array();

		if ( count( $line_color_a ) < 4 ) {
			$fill = array_fill(
				count( $line_color_a ),
				4 - count( $line_color_a ),
				$line_color_a[0]
			);
		}

		return array_merge( $line_color_a, $fill );
	}

	/**
	 * Returns the provided numeric in value in the money format.
	 *
	 * Note that the money format is based on the plugin options.
	 *
	 * @param $num
	 *
	 * @return string
	 */
	public function money_format( $num ) {

		// Init.
		$round_symbol = '';

		// Get from the plugin options.
		$decimal_separator           = get_option( $this->get( 'slug' ) . '_money_format_decimal_separator' );
		$thousands_separator         = get_option( $this->get( 'slug' ) . '_money_format_thousands_separator' );
		$decimals                    = intval( get_option( $this->get( 'slug' ) . '_money_format_decimals' ), 10 );
		$simplify_million            = intval( get_option( $this->get( 'slug' ) . '_money_format_simplify_million' ), 10 ) ? true : false;
		$simplify_million_decimals   = intval( get_option( $this->get( 'slug' ) . '_money_format_simplify_million_decimals' ), 10 );
		$million_symbol              = get_option( $this->get( 'slug' ) . '_money_format_million_symbol' );
		$simplify_thousands          = intval( get_option( $this->get( 'slug' ) . '_money_format_simplify_thousands' ), 10 ) ? true : false;
		$simplify_thousands_decimals = intval( get_option( $this->get( 'slug' ) . '_money_format_simplify_thousands_decimals' ), 10 );
		$thousands_symbol            = get_option( $this->get( 'slug' ) . '_money_format_thousands_symbol' );
		$currency                    = get_option( $this->get( 'slug' ) . '_money_format_currency' );
		$currency_position           = intval( get_option( $this->get( 'slug' ) . '_money_format_currency_position' ), 10 );

		if ( $num > 1000000 and $simplify_million === true ) {

			// Simplify Million.
			$num          = $num / 1000000;
			$round_symbol = $million_symbol;
			$num          = number_format( $num, $simplify_million_decimals, $decimal_separator, $thousands_separator );

		} elseif ( $num > 1000 and $simplify_thousands === true ) {

			// Simplify Thousands.
			$num          = $num / 1000;
			$round_symbol = $thousands_symbol;
			$num          = number_format( $num, $simplify_thousands_decimals, $decimal_separator, $thousands_separator );

		} else {

			// Not Simplified.
			$num = number_format( $num, $decimals, $decimal_separator, $thousands_separator );

		}

		// Add the round symbol.
		$num = $num . $round_symbol;

		// Add currency -----------------------------------------------------------------------------------------------.
		if ( $currency_position === 0 ) {
			return $currency . $num;
		} else {
			return $num . $currency;
		}
	}

	/**
	 * Get the time in the 120 time format (1 to 120) based on the provide time (of the match part) and part.
	 *
	 * @param $time
	 * @param $part
	 *
	 * @return int
	 */
	function get_time_format_120( $time, $part ) {

		switch ( $part ) {

			case 0:
				$minute = $time;
				break;

			case 1:
				$minute = $time + 45;
				break;

			case 2:
				$minute = $time + 90;
				break;

			case 3:
				$minute = $time + 105;
				break;

			case 4:
				$minute = 120;
				break;

		}

		return intval( $minute, 10 );
	}

	/**
	 * Get the market value of the player from the latest market value transition.
	 *
	 * @param int $player_id The id of the player.
	 *
	 * @return string|void
	 * @throws Exception
	 */
	function get_market_value( $player_id ) {

		global $wpdb;
		$table_name                = $wpdb->prefix . $this->get( 'slug' ) . '_market_value_transition';
		$safe_sql                  = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d ORDER BY date DESC", $player_id );
		$market_value_transition_a = $wpdb->get_results( $safe_sql, ARRAY_A );

		$current_time = current_time( 'mysql', 1 );
		$current_time = new DateTime( $current_time );

		foreach ( $market_value_transition_a as $key => $market_value_transition ) {

			$mvt_time = new DateTime( $market_value_transition['date'] );

			if ( $mvt_time < $current_time ) {
				return $market_value_transition['value'];
			}
		}

		return __( 'N/A', 'soccer-engine-lite' );
	}

	/**
	 * Returns the agency name of the player on the specified date. If a date is not specified the name of the agency at
	 * the current date is returned.
	 *
	 * @param int $player_id The id of the player.
	 * @param bool $date
	 *
	 * @return string
	 */
	public function get_agency_of_player( $player_id, $date = false ) {

		if ( ! $date ) {
			$date = current_time( 'mysql', 1 );
		}

		global $wpdb;
		$table_name      = $wpdb->prefix . $this->get( 'slug' ) . '_agency_contract';
		$safe_sql        = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d AND start_date <= %s AND end_date >= %s", $player_id, $date, $date );
		$agency_contract = $wpdb->get_row( $safe_sql );

		if ( null !== $agency_contract ) {
			return $this->get_agency_name( $agency_contract->agency_id );
		} else {
			return __( 'None', 'soccer-engine-lite' );
		}
	}

	/**
	 * Returns the foot based on the provided code.
	 *
	 * @param int $foot The code of the foot.
	 *
	 * @return string|void
	 */
	public function format_foot( $foot ) {

		switch ( $foot ) {

			case 0:
				$result = __( 'N/A', 'soccer-engine-lite' );
				break;

			case 1:
				$result = __( 'Left', 'soccer-engine-lite' );
				break;

			case 2:
				$result = __( 'Right', 'soccer-engine-lite' );
				break;

			case 3:
				$result = __( 'Both', 'soccer-engine-lite' );
				break;

		}

		return $result;
	}

	/**
	 * Returns the team_id of the team that owns the player based on the provided player_id and date.
	 *
	 * Note that if a date is not provided the current date is used.
	 *
	 * @param int $player_id The id of the player.
	 * @param bool $date
	 *
	 * @return bool
	 */
	public function get_player_owner( $player_id, $date = false ) {

		if ( ! $date ) {
			$date = current_time( 'mysql', 1 );
		}

		global $wpdb;
		$table_name    = $wpdb->prefix . $this->get( 'slug' ) . '_team_contract';
		$safe_sql      = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d AND start_date <= %s AND end_date >= %s", $player_id, $date, $date );
		$team_contract = $wpdb->get_row( $safe_sql );

		if ( null !== $team_contract ) {
			return $team_contract->team_id;
		} else {
			return __( 'None', 'soccer-engine-lite' );
		}
	}

	/**
	 * Returns the team_id of the current team of the player based on the provided player_id and date.
	 *
	 * Note that if a date is not provided the current date is used.
	 *
	 * @param $player_id
	 * @param bool                         $date
	 * @param int The type of return value. With 0 the team name is returned. With 1 the team id is returned.
	 *
	 * @return string|void
	 */
	public function get_player_current_club( $player_id, $date = false, $result = 0 ) {

		$team_id = null;

		if ( ! $date ) {
			$date = current_time( 'mysql', 1 );
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_transfer';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d AND date <= %s ORDER BY DATE LIMIT 1", $player_id, $date );
		$transfer   = $wpdb->get_row( $safe_sql );

		if ( $transfer !== null ) {

			// Returns the team name if the team_joined is different from none.
			if ( $transfer->team_id_joined !== 0 ) {
				$team_id = $transfer->team_id_joined;
			} else {
				$team_id = 0;
			}
		} else {
			$team_id = 0;
		}

		if ( 0 === $result ) {

			// Return the team name.
			if ( $team_id !== 0 ) {
				return $this->get_team_name( $team_id );
			} else {
				return __( 'None', 'soccer-engine-lite' );
			}

			return $this->get_team_name( $team_id );

		} else {

			// Return the team id.
			return $team_id;

		}
	}

	/**
	 * Returns the date on which the player has joined its current team based on the provided player_id and date.
	 *
	 * Note that if a date is not provided the current date is used.
	 *
	 * @param $player_id
	 * @param bool      $date
	 *
	 * @return string|void
	 */
	public function get_player_current_club_joined_date( $player_id, $date = false ) {

		if ( ! $date ) {
			$date = current_time( 'mysql', 1 );
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_transfer';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d AND date <= %s ORDER BY DATE LIMIT 1", $player_id, $date );
		$transfer   = $wpdb->get_row( $safe_sql );

		if ( $transfer !== null ) {

			// Returns the date if the team_joined is different from none
			if ( $transfer->team_id_joined !== 0 ) {
				return $this->format_date_timestamp( $transfer->date );
			} else {
				return __( 'None', 'soccer-engine-lite' );
			}
		} else {
			return __( 'None', 'soccer-engine-lite' );
		}
	}

	/**
	 * Returns the expiration date of the team contract of the player based on the provided player_id and date.
	 *
	 * Note that if a date is not provided the current date is used.
	 *
	 * @param int $player_id The id of the player.
	 * @param bool $date
	 *
	 * @return bool
	 */
	public function get_team_contract_expiration( $player_id, $date = false ) {

		if ( ! $date ) {
			$date = current_time( 'mysql', 1 );
		}

		global $wpdb;
		$table_name    = $wpdb->prefix . $this->get( 'slug' ) . '_team_contract';
		$safe_sql      = $wpdb->prepare( "SELECT * FROM $table_name WHERE player_id = %d AND start_date <= %s AND end_date >= %s", $player_id, $date, $date );
		$team_contract = $wpdb->get_row( $safe_sql );

		if ( $team_contract !== null ) {
			return $team_contract->end_date;
		} else {
			return __( 'N/A', 'soccer-engine-lite' );
		}
	}

	/**
	 * Utility function used to concatenate the elements of the string of a query.
	 *
	 * @param $where_string
	 *
	 * @return string
	 */
	public function add_query_part( $where_string ) {

		return strlen( $where_string ) === 0 ? 'WHERE ' : ' AND ';
	}

	/**
	 * Returns the name of the favorite formation of the provided staff.
	 *
	 * @param int $staff_id The id of the staff.
	 *
	 * @return string|void
	 */
	public function get_staff_favorite_formation( $staff_id ) {

		$staff_id    = intval( $staff_id, 10 );
		$formation_a = array();

		for ( $i = 1;$i <= 2;$i++ ) {

			$where_part = '';

			for ( $t = 1;$t <= 20;$t++ ) {
				$where_part .= 'team_' . $i . '_staff_id_' . $t . ' = ' . $staff_id;
				if ( $t < 20 ) {
					$where_part .= ' OR ';
				}
			}

			/**
			 * Iterate through all the matches. Save the formations in an array and associate a counter with each formation.
			 */
			global $wpdb;
			$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
			$sql        = 'SELECT team_' . $i . "_formation_id FROM $table_name WHERE $where_part ORDER BY match_id DESC";
			$match_a    = $wpdb->get_results( $sql, ARRAY_A );

			// Iterate through all the matches
			foreach ( $match_a as $key => $match ) {
				if ( $match[ 'team_' . $i . '_formation_id' ] > 0 ) {
					if ( isset( $formation_a[ $match[ 'team_' . $i . '_formation_id' ] ] ) ) {
						++$formation_a[ $match[ 'team_' . $i . '_formation_id' ] ];
					} else {
						$formation_a[ $match[ 'team_' . $i . '_formation_id' ] ] = 1;
					}
				}
			}
		}

		// Return the formation with the higher value of the counter
		if ( count( $formation_a ) > 0 ) {
			$max            = array_keys( $formation_a, max( $formation_a ) );
			$formation_name = $this->get_formation_name( $max[0] );
		} else {
			$formation_name = __( 'N/A', 'soccer-engine-lite' );
		}

		return $formation_name;
	}

	/**
	 * Get the "PPM" (the average points per match) of the provided staff.
	 *
	 * @param int $staff_id The id of the staff.
	 *
	 * @return false|float|string|void
	 */
	public function get_staff_ppm( $staff_id ) {

		$total    = array(
			'points'            => 0,
			'number_of_matches' => 0,
		);
		$staff_id = intval( $staff_id, 10 );

		for ( $i = 1;$i <= 2;$i++ ) {

			$where_part = '';

			for ( $t = 1;$t <= 20;$t++ ) {
				$where_part .= 'team_' . $i . '_staff_id_' . $t . ' = ' . $staff_id;
				if ( $t < 20 ) {
					$where_part .= ' OR ';
				}
			}

			/**
			 * Iterate through all the matches. Save the formations in an array and associate a counter with each formation.
			 */
			global $wpdb;
			$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
			$sql        = "SELECT match_id, competition_id FROM $table_name WHERE $where_part ORDER BY match_id DESC";
			$match_a    = $wpdb->get_results( $sql, ARRAY_A );

			// Iterate through all the matches.
			foreach ( $match_a as $key => $match ) {

				/**
				 * If the match is part of a competition of type round-robin:
				 *
				 * - sum the achieved points to the total points
				 * - sum the variable used to store the total number of considered matches
				 */
				if ( $match['competition_id'] > 0 ) {
					$competition_obj = $this->get_competition_obj( $match['competition_id'] );
					if ( intval( $competition_obj->type, 10 ) === 1 ) {
						$match_result = $this->get_match_result( $match['match_id'], 'array' );
						if ( 1 === $i ) {
							if ( $match_result[0] > $match_result[1] ) {
								$total['points'] += $competition_obj->rr_victory_points;
							} elseif ( $match_result[0] === $match_result[1] ) {
								$total['points'] += $competition_obj->rr_draw_points;
							} elseif ( $match_result[0] < $match_result[1] ) {
								$total['points'] += $competition_obj->rr_defeat_points;
							}
						} elseif ( 2 === $i ) {
							if ( $match_result[0] < $match_result[1] ) {
								$total['points'] += $competition_obj->rr_victory_points;
							} elseif ( $match_result[0] === $match_result[1] ) {
								$total['points'] += $competition_obj->rr_draw_points;
							} elseif ( $match_result[0] > $match_result[1] ) {
								$total['points'] += $competition_obj->rr_defeat_points;
							}
						}
						++$total['number_of_matches'];
					}
				}
			}
		}

		if ( $total['number_of_matches'] > 0 ) {
			return round( $total['points'] / $total['number_of_matches'], 2 );
		} else {
			return __( 'N/A', 'soccer-engine-lite' );
		}
	}

	/**
	 * Get the name of the provided formation.
	 *
	 * @param int $formation_id The id of the formation.
	 *
	 * @return string
	 */
	public function get_formation_name( $formation_id ) {

		global $wpdb;
		$table_name    = $wpdb->prefix . $this->get( 'slug' ) . '_formation';
		$safe_sql      = $wpdb->prepare( "SELECT name FROM $table_name WHERE formation_id = %d", $formation_id );
		$formation_obj = $wpdb->get_row( $safe_sql );

		return stripslashes( $formation_obj->name );
	}

	/**
	 * Returns the average goals of the provided staff.
	 *
	 * @param int $staff_id The id of the staff.
	 * @param string $type
	 *
	 * @return false|float|string|void
	 */
	public function get_staff_average_goal( $staff_id, $type = 'scored' ) {

		$total    = array(
			'goals'             => 0,
			'number_of_matches' => 0,
		);
		$staff_id = intval( $staff_id, 10 );

		for ( $i = 1;$i <= 2;$i++ ) {

			$where_part = '';

			for ( $t = 1;$t <= 20;$t++ ) {
				$where_part .= 'team_' . $i . '_staff_id_' . $t . ' = ' . $staff_id;
				if ( $t < 20 ) {
					$where_part .= ' OR ';
				}
			}

			/**
			 * Iterate through all the matches. Save the formations in an array and associate a counter with each formation.
			 */
			global $wpdb;
			$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
			$sql        = "SELECT match_id, competition_id FROM $table_name WHERE $where_part ORDER BY match_id DESC";
			$match_a    = $wpdb->get_results( $sql, ARRAY_A );

			// Iterate through all the matches.
			foreach ( $match_a as $key => $match ) {

				/**
				 * - sum the achieved goals to the total goals
				 * - sum the variable used to store the total number of considered matches
				 */
				$match_result = $this->get_match_result( $match['match_id'], 'array' );

				if ( 'scored' === $type ) {
					$total['goals'] += $match_result[ $i - 1 ];
				} elseif ( 'conceded' === $type ) {
					if ( 0 === $i - 1 ) {
						$index = 1;
					} elseif ( 1 === $i - 1  ) {
						$index = 0;
					}
					$total['goals'] += $match_result[ $index ];
				}

				++$total['number_of_matches'];

			}
		}

		if ( $total['number_of_matches'] > 0 ) {
			return round( $total['goals'] / $total['number_of_matches'], 2 );
		} else {
			return __( 'N/A', 'soccer-engine-lite' );
		}
	}

	/**
	 * Returns the number of matches of the provided staff.
	 *
	 * @param int $staff_id The id of the staff.
	 * @param string $type
	 *
	 * @return int
	 */
	public function get_staff_number_of_matches( $staff_id, $type = 'all' ) {

		$number_of_matches = 0;
		$staff_id          = intval( $staff_id, 10 );

		for ( $i = 1; $i <= 2; $i++ ) {

			$where_part = '';

			for ( $t = 1; $t <= 20; $t++ ) {
				$where_part .= 'team_' . $i . '_staff_id_' . $t . ' = ' . $staff_id;
				if ( $t < 20 ) {
					$where_part .= ' OR ';
				}
			}

			/**
			 * Iterate through all the matches. Save the formations in an array and associate a counter with each formation.
			 */
			global $wpdb;
			$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
			$sql        = "SELECT match_id, competition_id FROM $table_name WHERE $where_part ORDER BY match_id DESC";
			$match_a    = $wpdb->get_results( $sql, ARRAY_A );

			// Iterate through all the matches.
			foreach ( $match_a as $key => $match ) {

				switch ( $type ) {

					case 'all':
						++$number_of_matches;
						break;

					case 'won':
						$match_result = $this->get_match_result( $match['match_id'], 'array' );

						if ( 1 === $i ) {
							if ( $match_result[0] > $match_result[1] ) {
								++$number_of_matches;
							}
						} elseif ( 2 === $i ) {
							if ( $match_result[0] < $match_result[1] ) {
								++$number_of_matches;
							}
						}

						break;

					case 'drawn':
						$match_result = $this->get_match_result( $match['match_id'], 'array' );

						if ( $match_result[0] === $match_result[1] ) {
							++$number_of_matches;
						}

						break;

					case 'lost':
						$match_result = $this->get_match_result( $match['match_id'], 'array' );

						if ( 1 === $i ) {
							if ( $match_result[0] < $match_result[1] ) {
								++$number_of_matches;
							}
						} elseif ( 2 === $i ) {
							if ( $match_result[0] > $match_result[1] ) {
								++$number_of_matches;
							}
						}

						break;

				}
			}
		}

		return $number_of_matches;
	}

	/**
	 * Returns the number of appearances of the provided referee.
	 *
	 * @param int $referee_id The id of the referee.
	 *
	 * @return int
	 */
	public function get_referee_appearances( $referee_id ) {

		global $wpdb;
		$table_name        = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql          = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE referee_id = %d", $referee_id );
		$number_of_matches = $wpdb->get_var( $safe_sql );

		return intval( $number_of_matches, 10 );
	}

	/**
	 * Returns the number of yellow cards assigned by the provided referee.
	 *
	 * @param int $referee_id The id of the referee.
	 *
	 * @return int
	 */
	public function get_referee_yellow_cards( $referee_id ) {

		$yellow_cards = 0;

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT match_id FROM $table_name WHERE referee_id = %d", $referee_id );
		$match_a    = $wpdb->get_results( $safe_sql, 'ARRAY_A' );

		foreach ( $match_a as $key => $match ) {

			$table_name    = $wpdb->prefix . $this->get( 'slug' ) . '_event';
			$safe_sql      = $wpdb->prepare(
				"SELECT COUNT(*) FROM $table_name WHERE match_id = %d AND match_effect = 2",
				$match['match_id']
			);
			$yellow_cards += intval( $wpdb->get_var( $safe_sql ), 10 );

		}

		return $yellow_cards;
	}

	/**
	 * Returns the number of red cards assigned by the provided referee.
	 *
	 * @param int $referee_id The id of the referee.
	 *
	 * @return int
	 */
	public function get_referee_red_cards( $referee_id ) {

		$yellow_cards = 0;

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT match_id FROM $table_name WHERE referee_id = %d", $referee_id );
		$match_a    = $wpdb->get_results( $safe_sql, 'ARRAY_A' );

		foreach ( $match_a as $key => $match ) {

			$table_name    = $wpdb->prefix . $this->get( 'slug' ) . '_event';
			$safe_sql      = $wpdb->prepare(
				"SELECT COUNT(*) FROM $table_name WHERE match_id = %d AND match_effect = 3",
				$match['match_id']
			);
			$yellow_cards += intval( $wpdb->get_var( $safe_sql ), 10 );

		}

		return $yellow_cards;
	}

	/**
	 * Returns a string with the referee badges of a referee based on the provide referee and date.
	 *
	 * @param int $referee_id The id of the referee.
	 * @param bool $date
	 *
	 * @return string
	 */
	public function get_referee_badges( $referee_id, $date = false ) {

		$referee_badges = '';
		$badges_counter = 0;

		if ( ! $date ) {
			$date = current_time( 'mysql', 1 );
		}

		global $wpdb;
		$table_name      = $wpdb->prefix . $this->get( 'slug' ) . '_referee_badge';
		$safe_sql        = $wpdb->prepare( "SELECT * FROM $table_name WHERE referee_id = %d AND start_date <= %s AND end_date >= %s ORDER BY referee_badge_id ASC", $referee_id, $date, $date );
		$referee_badge_a = $wpdb->get_results( $safe_sql, 'ARRAY_A' );

		if ( count( $referee_badge_a ) > 0 ) {
			foreach ( $referee_badge_a as $key => $referee_badge ) {
				++$badges_counter;
				if ( $badges_counter < 3 ) {
					$referee_badges .= $this->get_referee_badge_type_name( $referee_badge['referee_badge_type_id'] );
					if ( $key + 1 < count( $referee_badge_a ) && $badges_counter < 2 ) {
						$referee_badges .= ', ';
					}
				}
			}
			if ( $badges_counter > 2 ) {
				$referee_badges .= ' (' . ( $badges_counter - 2 ) . ' ' . 'more' . ')';
			}
		} else {
			$referee_badges = __( 'N/A', 'soccer-engine-lite' );
		}

		return $referee_badges;
	}

	/**
	 * Set the PHP "Max Execution Time" and "Memory Limit" based on the values defined in the options.
	 */
	public function set_met_and_ml() {

		/*
		 * Set the custom "Max Execution Time Value" defined in the options if the "Set Max Execution Time" option is
		 * set to "Yes".
		 */
		if ( intval( get_option( $this->get( 'slug' ) . '_set_max_execution_time' ), 10 ) === 1 ) {
			ini_set(
				'max_execution_time',
				intval( get_option( $this->get( 'slug' ) . '_max_execution_time_value' ), 10 )
			);
		}

		/*
		 * Set the custom "Memory Limit Value" ( in megabytes ) defined in the options if the "Set Memory Limit" option
		 * is set to "Yes".
		 */
		if ( 1 === intval( get_option( $this->get( 'slug' ) . '_set_memory_limit' ), 10 ) ) {
			ini_set(
				'memory_limit',
				intval( get_option( $this->get( 'slug' ) . '_memory_limit_value' ), 10 ) . 'M'
			);
		}
	}

	/**
	 * Returns the standings table column name based on the provided standings table column code.
	 *
	 * @param int $code The code of the standings table column.
	 *
	 * @return string
	 */
	public function get_competition_standings_table_column_from_code( $code ) {

		switch ( $code ) {

			case 1:
				return 'won';

			case 2:
				return 'drawn';

			case 2:
				return 'lost';

			case 3:
				return 'goals';

			case 4:
				return 'goal_difference';

			case 5:
				return 'points';

		}
	}

	/**
	 * Returns the team of the player in a match or false if the player is not present in the team.
	 *
	 * @param int $match_id The id of the match.
	 * @param int $player_id The id of the player.
	 *
	 * @return bool|int
	 */
	public function get_team_of_player_in_match( $match_id, $player_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d", $match_id );
		$match_obj  = $wpdb->get_row( $safe_sql );

		// Search the player in team 1 and team 2 (in lineup and substitutions) of the specified match
		for ( $t = 1;$t <= 2;$t++ ) {
			for ( $i = 1;$i <= 11;$i++ ) {
				if ( intval( $match_obj->{'team_' . $t . '_lineup_player_id_' . $i}, 10 ) === intval( $player_id, 10 ) ) {
					return $t;
				}
			}

			for ( $i = 1;$i <= 20;$i++ ) {
				if ( intval( $match_obj->{'team_' . $t . '_substitute_player_id_' . $i}, 10 ) === intval( $player_id, 10 ) ) {
					return $t;
				}
			}
		}

		return false;
	}

	/**
	 * Returns the team of the staff in a match or false if the staff is not present in the team.
	 *
	 * @param int $match_id The id of the match.
	 * @param int $player_id The id of the staff.
	 *
	 * @return bool|int
	 */
	public function get_team_of_staff_in_match( $match_id, $staff_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$safe_sql   = $wpdb->prepare( "SELECT * FROM $table_name WHERE match_id = %d", $match_id );
		$match_obj  = $wpdb->get_row( $safe_sql );

		// Search the staff in team 1 and team 2 of the specified match.
		for ( $t = 1;$t <= 2;$t++ ) {
			for ( $i = 1;$i <= 20;$i++ ) {
				if ( intval( $match_obj->{'team_' . $t . '_staff_id_' . $i}, 10 ) === intval( $staff_id, 10 ) ) {
					return $t;
				}
			}
		}

		return false;
	}

	/**
	 * Callback of usort used to sort the data of a standings table based on the options defined in the competition.
	 *
	 * @param $a
	 * @param $b
	 *
	 * @return int
	 */
	private function sort_standings_table( $a, $b ) {

		if ( $a[ $this->order_by_priority_1 ] == $b[ $this->order_by_priority_1 ] ) {

			// If the primary sorting by criteria is the same, sort by the second order by criteria.
			if ( $this->order_priority_2 == 0 ) {

				// Descending.
				return $a[ $this->order_by_priority_2 ] < $b[ $this->order_by_priority_2 ] ? 1 : 0;

			} else {

				// Ascending.
				return $a[ $this->order_by_priority_2 ] > $b[ $this->order_by_priority_2 ] ? 1 : 0;

			}
		}

		// Sort by the primary sort by criteria.
		if ( $this->order_priority_1 == 0 ) {

			// Descending.
			return $a[ $this->order_by_priority_1 ] < $b[ $this->order_by_priority_1 ] ? 1 : - 1;

		} else {

			// Ascending.
			return $a[ $this->order_by_priority_1 ] > $b[ $this->order_by_priority_1 ] ? 1 : - 1;

		}
	}

	/**
	 * Returns the number of matches.
	 */
	public function get_number_of_matches() {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_match';
		$count      = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name" );

		return intval( $count, 10 );
	}

	/*
	 * Given a string this method returns and escaped version suitable to be used in javascript strings that make use
	 * of a single quote as the delimiter of the string.
	 *
	 * All the HTML are also removed.
	 *
	 * @param string
	 * @return string The escaped version
	 */
	public function prepare_javascript_string( $string ) {

		$all = array(

			'\\' => '\\\\',
			"'"  => "\\'",

		);

		$string = str_replace( array_keys( $all ), $all, $string );

		$string = wp_strip_all_tags( $string );

		return $string;
	}

	/*
	 * If an array is provided this function returns an array. If a comma separated list of values is provided an array
	 * with these values is returned.
	 *
	 * Note that if the user adds a layout element with a block the provided $data are an array, if instead the user
	 * add the layout element with a shortcode the provided $data is a string with a comma separated list of values.
	 * (E.g. "player, age")
	 *
	 * This method does what follows:
	 *
	 * 1 - If a comma separated list of values is provided an array with these values is returned.
	 * 2 - The items in the array are sanitized.
	 * 3 - The array is returned.
	 *
	 * @param string The array or the string with comma separated values
	 * @return array The array with the values
	 */
	public function prepare_array( $data ) {

		// If $value is a string with comma separated values generate an array.
		if ( ! is_array( $data ) ) {
			$data = str_replace( ' ', '', $data );
			$data = explode( ',', $data );
		}

		// Sanitize the array values.
		$sanitized_array = array();
		foreach ( $data as $single_value ) {
			$sanitized_array[] = sanitize_key( $single_value );
		}

		return $sanitized_array;
	}

	/**
	 * Set a transient based on the provided parameters and the "Transient Expiration" plugin option. Do not set a transient
	 * if the "Transient Expiration" plugin option is equal to 0.
	 *
	 * @param $transient_name The name of the transient
	 * @param $data The data of the transient
	 */
	public function set_transient_based_on_settings( $transient_name, $data ) {

		// Set the transient.
		$transient_expiration = intval( get_option( $this->get( 'slug' ) . '_transient_expiration' ), 10 );
		if ( $transient_expiration > 0 ) {
			set_transient( $transient_name, $data, $transient_expiration );
		}
	}

	/**
	 * Delete the transients with the 'daextsoenl' prefix.
	 *
	 * @return bool True if the transients have been deleted, otherwise returns false.
	 */
	public function delete_plugin_transients() {

		global $wpdb;
		$prefix     = '_transient_daextsoenl_';
		$safe_sql   = $wpdb->prepare( "SELECT option_name FROM $wpdb->options WHERE option_name LIKE %s", $prefix . '%' );
		$transients = $wpdb->get_results( $safe_sql, ARRAY_A );

		if ( count( $transients ) > 0 ) {
			foreach ( $transients as $transient ) {
				delete_transient( str_replace( '_transient_', '', $transient['option_name'] ) );
			}
			return true;
		}

		return false;
	}

	/**
	 * Add the demo data in the plugin by using the data available in the demo-data.xml file located in the main plugin
	 * folder.
	 *
	 * @return int The number of records added in the plugin database.
	 */
	public function add_demo_data() {

		$this->set_met_and_ml();

		$counter = 0;

		global $wpdb;
		$primary_key_change_a = array();

		// Read xml file.
		$xml = simplexml_load_file( $this->get( 'dir' ) . 'demo-data.xml' );

		// Sort the database tables based on their hierarchical level from the lowest to the higher.
		$database_table_a = $this->get( 'database_tables' );
		usort(
			$database_table_a,
			function ( $a, $b ) {
				return $a['hierarchy_level'] - $b['hierarchy_level'];
			}
		);

		foreach ( $database_table_a as $key => $database_table ) {

			$table_a = $xml->{$database_table['name']};

			if ( count( $table_a ) > 0 ) {

				foreach ( $table_a->record as $single_record ) {

					// Convert object to array.
					$single_table_a = get_object_vars( $single_record );

					// Replace empty objects with empty strings to prevent notices on the next insert() method.
					$single_table_a = $this->replace_empty_objects_with_empty_strings( $single_table_a );

					// Save the id key.
					$original_key = $single_table_a[ $database_table['sort_by'] ];

					// Remove the id key.
					unset( $single_table_a[ $database_table['sort_by'] ] );

					if ( $this->table_has_foreign_keys( $database_table['name'] ) ) {

						/**
						 * Replace the values of old foreign keys (stored in the XML file) with the new keys
						 * (retrieved after the actual creation of the record in the database table).
						 *
						 * Note that this step is necessary to preserve the referential integrity of the
						 * imported data.
						 */
						foreach ( $single_table_a as $field_name => $field_value ) {

							/**
							 * For performance reasons perform the next foreach (used to replace the value of the
							 * old foreign keys with the new keys retrieved after the actual creation of the
							 * database table) only if the database table field is a foreign key.
							 */
							if ( $this->is_foreign_key( $database_table['name'], $field_name ) ) {
								foreach ( $primary_key_change_a as $primary_key_change ) {
									if ( $primary_key_change['key_name'] === $this->get_comparable_field_name( $database_table['name'], $field_name ) ) {
										if ( intval( $field_value, 10 ) === $primary_key_change['old_key_value'] ) {
											$single_table_a[ $field_name ] = $primary_key_change['new_key_value'];
										}
									}
								}
							}
						}
					}

					// Add in the database table.
					$table_name = $wpdb->prefix . $this->get( 'slug' ) . '_' . $database_table['name'];
					$wpdb->insert(
						$table_name,
						$single_table_a
					);
					$inserted_table_id = $wpdb->insert_id;

					if ( $inserted_table_id !== 0 ) {

						/**
						 * Save in a hash table the old foreign key value (stored in the XML file) with the
						 * related new foreign key value (retrieved after the actual creation of the record in
						 * the database table).
						 *
						 * Note that this step is necessary to preserve the referential integrity of the
						 * imported data.
						 */
						$primary_key_change_a[] = array(
							'key_name'      => $database_table['sort_by'],
							'old_key_value' => intval( $original_key, 10 ),
							'new_key_value' => intval( $inserted_table_id, 10 ),
						);

						++$counter;

					}
				}
			}
		}

		return $counter;
	}

	/**
	 * Sanitize the data provided in an escaped json string and generate an object.
	 *
	 * @param $table_data
	 *
	 * @return array|bool
	 */
	public function json_to_sanitized_object( $data ) {

		// Unescape and decode the data provided in json format.
		$data = json_decode( stripslashes( $data ) );

		// Verify if data property of the returned object is an array.
		if ( ! is_object( $data ) ) {
			return false;
		}

		// Sanitize all the values in the $data object.
		foreach ( $data as $key => $single_data ) {
			$data->$key = sanitize_text_field( $single_data );
		}

		return $data;
	}

	/**
	 * Sanitize the data provided in an escaped json string and generate an array.
	 *
	 * @param $table_data
	 *
	 * @return array|bool
	 */
	public function json_to_sanitized_array( $data ) {

		// Unescape and decode the data provided in json format.
		$data = json_decode( stripslashes( $data ) );

		// Verify if data property of the returned object is an array.
		if ( ! is_array( $data ) ) {
			return false;
		}

		// Sanitize all the items in the $data array.
		$data = array_map( 'sanitize_text_field', $data );

		return $data;
	}
}