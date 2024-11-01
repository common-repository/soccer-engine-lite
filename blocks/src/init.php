<?php
/**
 * Enqueue the Gutenberg block assets for the backend.
 *
 * @package: soccer-engine-lite
 */

// Prevent direct access to this file.
if ( ! defined( 'WPINC' ) ) {
	die();
}

/**
 * Enqueue the Gutenberg block assets for the backend.
 *
 * 'wp-blocks': includes block type registration and related functions.
 * 'wp-element': includes the WordPress Element abstraction for describing the structure of your blocks.
 */
function daextsoenl_editor_assets() {

	$shared = daextsoenl_Shared::get_instance();

	// Styles ---------------------------------------------------------------------------------------------------------.

	// Block.
	wp_enqueue_style(
		'daextsoenl-editor-css',
		plugins_url( 'dist/editor.css', __DIR__ ),
		array( 'wp-edit-blocks' )// Dependency to include the CSS after it.
	);

	// Scripts --------------------------------------------------------------------------------------------------------.

	// Block.
	wp_enqueue_script(
		'daextsoenl-editor-js', // Handle.
		plugins_url( '/dist/blocks.build.js', __DIR__ ), // We register the block here.
		array( 'wp-blocks', 'wp-element' ), // Dependencies.
		false,
		true // Enqueue the script in the footer.
	);
}
add_action( 'enqueue_block_editor_assets', 'daextsoenl_editor_assets' );

/**
 * Enqueue the Gutenberg block assets for both frontend and backend.
 */
function daextsoenl_style_assets() {

	// Not used with this block.
	return;

	// Styles ---------------------------------------------------------------------------------------------------------.
	wp_enqueue_style(
		'daextsoenl-style-css',
		plugins_url( 'dist/style.css', __DIR__ ),
		array( 'wp-blocks' )// Dependency to include the CSS after it.
	);
}
add_action( 'enqueue_block_assets', 'daextsoenl_style_assets' );

// Add the Soccer Engine block category.
function daextsoenl_add_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'daextsoenl-soccer-engine',
				'title' => __( 'Soccer Engine', 'soccer-engine-lite' ),
			),
		)
	);
}
add_filter( 'block_categories_all', 'daextsoenl_add_block_category', 10, 2 );

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_player_summary_render( $attributes ) {

	if ( isset( $attributes['playerId'] ) ) {
		$public = daextsoenl_Public::get_instance();
		return $public->player_summary(
			array(
				'player-id' => $attributes['playerId'],
			)
		);
	}
}
register_block_type(
	'daextsoenl/player-summary',
	array(
		'render_callback' => 'daextsoenl_player_summary_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_transfers_render( $attributes ) {

	if ( isset( $attributes['playerId'] ) ) {
		$public = daextsoenl_Public::get_instance();
		return $public->transfers(
			array(
				'player-id'                   => $attributes['playerId'],
				'transfer-type-id'            => $attributes['transferTypeId'],
				'team-id-left'                => $attributes['teamIdLeft'],
				'team-id-joined'              => $attributes['teamIdJoined'],
				'start-date'                  => $attributes['startDate'],
				'end-date'                    => $attributes['endDate'],
				'fee-lower-limit'             => $attributes['feeLowerLimit'],
				'fee-higher-limit'            => $attributes['feeHigherLimit'],
				'columns'                     => $attributes['columns'],
				'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
				'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
				'pagination'                  => $attributes['pagination'],
			)
		);
	}
}
register_block_type(
	'daextsoenl/transfers',
	array(
		'render_callback' => 'daextsoenl_transfers_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_team_contracts_render( $attributes ) {

	if ( isset( $attributes['teamId'] ) &&
		isset( $attributes['teamContractTypeId'] ) ) {
		$public = daextsoenl_Public::get_instance();
		return $public->team_contracts(
			array(
				'team-id'                     => $attributes['teamId'],
				'team-contract-type-id'       => $attributes['teamContractTypeId'],
				'columns'                     => $attributes['columns'],
				'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
				'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
				'pagination'                  => $attributes['pagination'],
			)
		);
	}
}
register_block_type(
	'daextsoenl/team-contracts',
	array(
		'render_callback' => 'daextsoenl_team_contracts_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_agency_contracts_render( $attributes ) {

	if ( isset( $attributes['agencyId'] ) ) {
		$public = daextsoenl_Public::get_instance();
		return $public->agency_contracts(
			array(
				'agency-id'                   => $attributes['agencyId'],
				'agency-contract-type-id'     => $attributes['agencyContractTypeId'],
				'columns'                     => $attributes['columns'],
				'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
				'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
				'pagination'                  => $attributes['pagination'],
			)
		);
	}
}
register_block_type(
	'daextsoenl/agency-contracts',
	array(
		'render_callback' => 'daextsoenl_agency_contracts_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_players_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->players(
		array(
			'start-date-of-birth'         => $attributes['startDateOfBirth'],
			'end-date-of-birth'           => $attributes['endDateOfBirth'],
			'citizenship'                 => $attributes['citizenship'],
			'foot'                        => $attributes['foot'],
			'player-position-id'          => $attributes['playerPositionId'],
			'squad-id'                    => $attributes['squadId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/players',
	array(
		'render_callback' => 'daextsoenl_players_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_player_awards_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->player_awards(
		array(
			'player-award-type-id'        => $attributes['playerAwardTypeId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/player-awards',
	array(
		'render_callback' => 'daextsoenl_player_awards_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_unavailable_players_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->unavailable_players(
		array(
			'player-id'                   => $attributes['playerId'],
			'unavailable-player-type-id'  => $attributes['unavailablePlayerTypeId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/unavailable-players',
	array(
		'render_callback' => 'daextsoenl_unavailable_players_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_injuries_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->injuries(
		array(
			'player-id'                   => $attributes['playerId'],
			'injury-type-id'              => $attributes['injuryTypeId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/injuries',
	array(
		'render_callback' => 'daextsoenl_injuries_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_staff_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->staff(
		array(
			'retired'                     => $attributes['retired'],
			'gender'                      => $attributes['gender'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/staff',
	array(
		'render_callback' => 'daextsoenl_staff_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_staff_award_type_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->staff_awards(
		array(
			'staff-award-type-id'         => $attributes['staffAwardTypeId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/staff-awards',
	array(
		'render_callback' => 'daextsoenl_staff_award_type_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_trophies_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->trophies(
		array(
			'trophy-type-id'              => $attributes['trophyTypeId'],
			'team-id'                     => $attributes['teamId'],
			'start-assignment-date'       => $attributes['startAssignmentDate'],
			'end-assignment-date'         => $attributes['endAssignmentDate'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/trophies',
	array(
		'render_callback' => 'daextsoenl_trophies_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_matches_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->matches(
		array(
			'team-id-1'                   => $attributes['teamId1'],
			'team-id-2'                   => $attributes['teamId2'],
			'start-date'                  => $attributes['startDate'],
			'end-date'                    => $attributes['endDate'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/matches',
	array(
		'render_callback' => 'daextsoenl_matches_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_ranking_transitions_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->ranking_transitions(
		array(
			'team-id'                     => $attributes['teamId'],
			'ranking-type-id'             => $attributes['rankingTypeId'],
			'start-date'                  => $attributes['startDate'],
			'end-date'                    => $attributes['endDate'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/ranking-transitions',
	array(
		'render_callback' => 'daextsoenl_ranking_transitions_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_market_value_transitions_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->market_value_transitions(
		array(
			'player-id'                   => $attributes['playerId'],
			'start-date'                  => $attributes['startDate'],
			'end-date'                    => $attributes['endDate'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/market-value-transitions',
	array(
		'render_callback' => 'daextsoenl_market_value_transitions_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_match_commentary_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->match_commentary(
		array(
			'match-id' => $attributes['matchId'],
		)
	);
}
register_block_type(
	'daextsoenl/match-commentary',
	array(
		'render_callback' => 'daextsoenl_match_commentary_render',
	)
);

	/**
	 * Dynamic Block Server Component
	 *
	 * For more info:
	 *
	 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
	 */
function daextsoenl_match_lineup_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->match_lineup(
		array(
			'match-id'                    => $attributes['matchId'],
			'team-slot'                   => $attributes['teamSlot'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/match-lineup',
	array(
		'render_callback' => 'daextsoenl_match_lineup_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_match_visual_lineup_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->match_visual_lineup(
		array(
			'match-id'  => $attributes['matchId'],
			'team-slot' => $attributes['teamSlot'],
		)
	);
}
register_block_type(
	'daextsoenl/match-visual-lineup',
	array(
		'render_callback' => 'daextsoenl_match_visual_lineup_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_match_substitutions_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->match_substitutions(
		array(
			'match-id'                    => $attributes['matchId'],
			'team-slot'                   => $attributes['teamSlot'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/match-substitutions',
	array(
		'render_callback' => 'daextsoenl_match_substitutions_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_match_staff_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->match_staff(
		array(
			'match-id'                    => $attributes['matchId'],
			'team-slot'                   => $attributes['teamSlot'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/match-staff',
	array(
		'render_callback' => 'daextsoenl_match_staff_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_squad_lineup_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->squad_lineup(
		array(
			'squad-id'                    => $attributes['squadId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/squad-lineup',
	array(
		'render_callback' => 'daextsoenl_squad_lineup_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_squad_substitutions_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->squad_substitutions(
		array(
			'squad-id'                    => $attributes['squadId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/squad-substitutions',
	array(
		'render_callback' => 'daextsoenl_squad_substitutions_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_squad_staff_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->squad_staff(
		array(
			'squad-id'                    => $attributes['squadId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/squad-staff',
	array(
		'render_callback' => 'daextsoenl_squad_staff_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_competition_standings_table_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->competition_standings_table(
		array(
			'competition-id'              => $attributes['competitionId'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/competition-standings-table',
	array(
		'render_callback' => 'daextsoenl_competition_standings_table_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_competition_round_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->competition_round(
		array(
			'competition-id'              => $attributes['competitionId'],
			'round'                       => $attributes['round'],
			'type'                        => $attributes['type'],
			'columns'                     => $attributes['columns'],
			'hidden-columns-breakpoint-1' => $attributes['hiddenColumnsBreakpoint1'],
			'hidden-columns-breakpoint-2' => $attributes['hiddenColumnsBreakpoint2'],
			'pagination'                  => $attributes['pagination'],
		)
	);
}
register_block_type(
	'daextsoenl/competition-round',
	array(
		'render_callback' => 'daextsoenl_competition_round_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_match_score_render( $attributes ) {

	$public = daextsoenl_Public::get_instance();
	return $public->match_score(
		array(
			'match-id' => $attributes['matchId'],
		)
	);
}
register_block_type(
	'daextsoenl/match-score',
	array(
		'render_callback' => 'daextsoenl_match_score_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_staff_summary_render( $attributes ) {

	if ( isset( $attributes['staffId'] ) ) {
		$public = daextsoenl_Public::get_instance();
		return $public->staff_summary(
			array(
				'staff-id' => $attributes['staffId'],
			)
		);
	}
}
register_block_type(
	'daextsoenl/staff-summary',
	array(
		'render_callback' => 'daextsoenl_staff_summary_render',
	)
);

/**
 * Dynamic Block Server Component
 *
 * For more info:
 *
 * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
 */
function daextsoenl_referee_summary_render( $attributes ) {

	if ( isset( $attributes['refereeId'] ) ) {
		$public = daextsoenl_Public::get_instance();
		return $public->referee_summary(
			array(
				'referee-id' => $attributes['refereeId'],
			)
		);
	}
}
register_block_type(
	'daextsoenl/referee-summary',
	array(
		'render_callback' => 'daextsoenl_referee_summary_render',
	)
);
