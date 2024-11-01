(function($) {

  'use strict';

  $(document).ready(function() {

    'use strict';

    //initialize chosen on all the select elements
    var chosenElements = [];

    //Ranking Transitions Menu -----------------------------------------------------------------------------------------
    addToChosen('ranking_type_id');
    addToChosen('team_id');

    //Staff ------------------------------------------------------------------------------------------------------------
    addToChosen('citizenship');
    addToChosen('second_citizenship');
    addToChosen('staff_type_id');
    addToChosen('agency_id');
    addToChosen('retired');

    //Player Awards ----------------------------------------------------------------------------------------------------
    addToChosen('player_award_type_id');
    addToChosen('player_id');

    //Player Awards ----------------------------------------------------------------------------------------------------
    addToChosen('staff_award_type_id');
    addToChosen('staff_id');

    //Referee ----------------------------------------------------------------------------------------------------
    addToChosen('citizenship');
    addToChosen('second_citizenship');
    addToChosen('status');
    addToChosen('gender');

    //Referee Badge ----------------------------------------------------------------------------------------------------
    addToChosen('referee_id');
    addToChosen('referee_badge_type_id');

    //Unavailable Players ----------------------------------------------------------------------------------------------
    addToChosen('unavailable_player_type_id');

    //Trophies ---------------------------------------------------------------------------------------------------------
    addToChosen('trophy_type_id');

    //Team Contracts --------------------------------------------------------------------------------------------------------
    addToChosen('team_contract_type_id');
    addToChosen('team_id');

    //Injuries ---------------------------------------------------------------------------------------------------------
    addToChosen('injury_type_id');
    addToChosen('player_id');

    //Transfers --------------------------------------------------------------------------------------------------------
    addToChosen('subject');
    addToChosen('team_id_left');
    addToChosen('team_id_joined');
    addToChosen('transfer_type_id');

    //Players ----------------------------------------------------------------------------------------------------------
    addToChosen('citizenship');
    addToChosen('second_citizenship');
    addToChosen('player_position_id');
    addToChosen('foot');

    //Transfer Windows -------------------------------------------------------------------------------------------------
    addToChosen('nation');
    addToChosen('gender');

    //Competitions -----------------------------------------------------------------------------------------------------
    addToChosen('teams');
    addToChosen('type');
    addToChosen('team_id_1');
    addToChosen('team_id_2');
    addToChosen('team_id_3');
    addToChosen('team_id_4');
    addToChosen('team_id_5');
    addToChosen('team_id_6');
    addToChosen('team_id_7');
    addToChosen('team_id_8');
    addToChosen('team_id_9');
    addToChosen('team_id_10');
    addToChosen('team_id_11');
    addToChosen('team_id_12');
    addToChosen('team_id_13');
    addToChosen('team_id_14');
    addToChosen('team_id_15');
    addToChosen('team_id_16');
    addToChosen('team_id_17');
    addToChosen('team_id_18');
    addToChosen('team_id_19');
    addToChosen('team_id_20');
    addToChosen('team_id_21');
    addToChosen('team_id_22');
    addToChosen('team_id_23');
    addToChosen('team_id_24');
    addToChosen('team_id_25');
    addToChosen('team_id_26');
    addToChosen('team_id_27');
    addToChosen('team_id_28');
    addToChosen('team_id_29');
    addToChosen('team_id_30');
    addToChosen('team_id_31');
    addToChosen('team_id_32');
    addToChosen('team_id_33');
    addToChosen('team_id_34');
    addToChosen('team_id_35');
    addToChosen('team_id_36');
    addToChosen('team_id_37');
    addToChosen('team_id_38');
    addToChosen('team_id_39');
    addToChosen('team_id_40');
    addToChosen('team_id_41');
    addToChosen('team_id_42');
    addToChosen('team_id_43');
    addToChosen('team_id_44');
    addToChosen('team_id_45');
    addToChosen('team_id_46');
    addToChosen('team_id_47');
    addToChosen('team_id_48');
    addToChosen('team_id_49');
    addToChosen('team_id_50');
    addToChosen('team_id_51');
    addToChosen('team_id_52');
    addToChosen('team_id_53');
    addToChosen('team_id_54');
    addToChosen('team_id_55');
    addToChosen('team_id_56');
    addToChosen('team_id_57');
    addToChosen('team_id_58');
    addToChosen('team_id_59');
    addToChosen('team_id_60');
    addToChosen('team_id_61');
    addToChosen('team_id_62');
    addToChosen('team_id_63');
    addToChosen('team_id_64');
    addToChosen('team_id_65');
    addToChosen('team_id_66');
    addToChosen('team_id_67');
    addToChosen('team_id_68');
    addToChosen('team_id_69');
    addToChosen('team_id_70');
    addToChosen('team_id_71');
    addToChosen('team_id_72');
    addToChosen('team_id_73');
    addToChosen('team_id_74');
    addToChosen('team_id_75');
    addToChosen('team_id_76');
    addToChosen('team_id_77');
    addToChosen('team_id_78');
    addToChosen('team_id_79');
    addToChosen('team_id_80');
    addToChosen('team_id_81');
    addToChosen('team_id_82');
    addToChosen('team_id_83');
    addToChosen('team_id_84');
    addToChosen('team_id_85');
    addToChosen('team_id_86');
    addToChosen('team_id_87');
    addToChosen('team_id_88');
    addToChosen('team_id_89');
    addToChosen('team_id_90');
    addToChosen('team_id_91');
    addToChosen('team_id_92');
    addToChosen('team_id_93');
    addToChosen('team_id_94');
    addToChosen('team_id_95');
    addToChosen('team_id_96');
    addToChosen('team_id_97');
    addToChosen('team_id_98');
    addToChosen('team_id_99');
    addToChosen('team_id_100');
    addToChosen('team_id_101');
    addToChosen('team_id_102');
    addToChosen('team_id_103');
    addToChosen('team_id_104');
    addToChosen('team_id_105');
    addToChosen('team_id_106');
    addToChosen('team_id_107');
    addToChosen('team_id_108');
    addToChosen('team_id_109');
    addToChosen('team_id_110');
    addToChosen('team_id_111');
    addToChosen('team_id_112');
    addToChosen('team_id_113');
    addToChosen('team_id_114');
    addToChosen('team_id_115');
    addToChosen('team_id_116');
    addToChosen('team_id_117');
    addToChosen('team_id_118');
    addToChosen('team_id_119');
    addToChosen('team_id_120');
    addToChosen('team_id_121');
    addToChosen('team_id_122');
    addToChosen('team_id_123');
    addToChosen('team_id_124');
    addToChosen('team_id_125');
    addToChosen('team_id_126');
    addToChosen('team_id_127');
    addToChosen('team_id_128');
    addToChosen('rr_autocolors_priority'),
    addToChosen('rr_sorting_order_1');
    addToChosen('rr_sorting_order_by_1');
    addToChosen('rr_sorting_order_2');
    addToChosen('rr_sorting_order_by_2');

    //Teams ------------------------------------------------------------------------------------------------------------
    addToChosen('coach_type');
    addToChosen('stadium_id');
    addToChosen('club_nation');
    addToChosen('national_team_confederation');

    //Squads -----------------------------------------------------------------------------------------------------------
    for(let i=0;i<=11;i++){addToChosen('lineup_player_id_' + i);}
    for(let i=0;i<=20;i++){addToChosen('substitute_player_id_' + i);}
    for(let i=0;i<=20;i++){addToChosen('staff_id_' + i);}
    addToChosen('formation_id');
    addToChosen('jersey_set_id');

    //Jersey Sets ------------------------------------------------------------------------------------------------------
    for(let i=0;i<=51;i++){addToChosen('player_id_' + i);}

    //Matches ----------------------------------------------------------------------------------------------------------
    addToChosen('competition_id');
    addToChosen('competition_slot_select');
    addToChosen('single_elimination_slot');
    addToChosen('squad_id_1');
    addToChosen('squad_id_2');
    addToChosen('round');
    addToChosen('team_1_formation_id');
    addToChosen('team_2_formation_id');
    addToChosen('team_1_jersey_set_id');
    addToChosen('team_2_jersey_set_id');
    for(let t=0;t<=11;t++){
      for(let i=0;i<=11;i++){addToChosen('team_' + t + '_lineup_player_id_' + i);}
      for(let i=0;i<=20;i++){addToChosen('team_' + t + '_substitute_player_id_' + i);}
      for(let i=0;i<=20;i++){addToChosen('team_' + t + '_staff_id_' + i);}
    }

    //Events -----------------------------------------------------------------------------------------------------------
    addToChosen('data');
    addToChosen('match_id');
    addToChosen('displayed');
    addToChosen('part');
    addToChosen('team_slot');
    addToChosen('match_effect');
    addToChosen('player_id_affected');
    addToChosen('player_id_substitution_out');
    addToChosen('player_id_substitution_in');

    //Events -----------------------------------------------------------------------------------------------------------
    addToChosen('match_id');

    //Event Types ------------------------------------------------------------------------------------------------------
    addToChosen('statistic_assist');
    addToChosen('statistic_goal');
    addToChosen('statistic_own_goal');
    addToChosen('statistic_penalty');
    addToChosen('statistic_penalty_scored');
    addToChosen('statistic_penalty_failed');
    addToChosen('statistic_free_kick');
    addToChosen('statistic_corner');
    addToChosen('statistic_shot');
    addToChosen('statistic_shot_on_target');
    addToChosen('statistic_shot_off_target');
    addToChosen('statistic_shot_saved');
    addToChosen('statistic_foul');
    addToChosen('statistic_offside');
    addToChosen('statistic_yellow_card');
    addToChosen('statistic_second_yellow_card');
    addToChosen('statistic_red_card');
    addToChosen('statistic_substitution_in');
    addToChosen('statistic_substitution_out');

    //Agency Contracts -----------------------------------------------------------------------------------------------------
    addToChosen('agency_contract_type_id');
    addToChosen('agency_id');

    //Agency Contracts -----------------------------------------------------------------------------------------------------
    addToChosen('task');

    //Options Menu -----------------------------------------------------------------------------------------------------

    //General

    //Style
    addToChosen('daextsoenl-table-header-font-weight');
    addToChosen('daextsoenl-table-header-font-style');
    addToChosen('daextsoenl-table-body-font-weight');
    addToChosen('daextsoenl-table-body-font-style');
    addToChosen('daextsoenl-table-pagination-font-weight');
    addToChosen('daextsoenl-table-pagination-font-style');
    addToChosen('daextsoenl-table-pagination-disabled-font-weight');
    addToChosen('daextsoenl-table-pagination-disabled-font-style');
    addToChosen('daextsoenl-formation-field-player-number-font-weight');
    addToChosen('daextsoenl-formation-field-player-number-font-style');
    addToChosen('daextsoenl-formation-field-player-name-font-weight');
    addToChosen('daextsoenl-formation-field-player-name-font-style');

    //Capabilities

    //Pagination

    //Advanced
    addToChosen('daextsoenl-money-format-simplify-million');
    addToChosen('daextsoenl-money-format-simplify-thousands');
    addToChosen('daextsoenl-money-format-currency-position');
    addToChosen('daextsoenl-height-measurement-unit');
    addToChosen('daextsoenl-set-max-execution-time');
    addToChosen('daextsoenl-set-memory-limit');
    addToChosen('daextsoenl-rest-api-authentication-read');
    addToChosen('daextsoenl-rest-api-authentication-create');

    $(chosenElements.join(',')).chosen();

    function addToChosen(elementId) {

      if ($('#' + elementId).length && chosenElements.indexOf($('#' + elementId)) === -1) {
        chosenElements.push('#' + elementId);
      }

    }

  });

})(window.jQuery);