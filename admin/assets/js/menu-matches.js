(function($) {

  'use strict';

  $(document).ready(function() {

    //jQuery UI Datepicker ---------------------------------------------------------------------------------------------

    /**
     * Initialize the date picker and set the format of the alternative field and the selector of the alternative field.
     *
     * Ref: http://api.jqueryui.com/datepicker/
     */
    let dpBaseConfig = {
      changeMonth: true,
      changeYear: true,
      yearRange: '1900:2100',
      altFormat: "yy-mm-dd",
    };
    $( "#date" ).datepicker({
      ...dpBaseConfig,
      ...{altField: "#date-alt-field", dateFormat: "M d, yy"}
    });

    /**
     * Do not allow to enter data in the input field associated with the date picker
     */
    $('.hasDatepicker').keypress(function(event){
      event.preventDefault();
    });

    /**
     * Set the date of the date picker based on the value available in the alternative field #date-alt-field.
     *
     * Note that before applying this change the format of the date available in teh alternative field #date-alt-field
     * should be changed.
     *
     */
    if($('#date').length){
      let date = $.datepicker.parseDate( "yy-mm-dd", $('#date-alt-field').val() );
      $( "#date" ).datepicker( "setDate", date );
    }

    /**
     * Update the Round field on the ready event
     */
    updateRoundField();

    /**
     * Update the Round field on the change event
     */
    $('#competition_id').on('change', function() {
      updateRoundField();
    });

    /**
     * Update the Lineup, Team and Staffs when the value of Squad 1 or Squad 2
     * changes.
     */
    $('#squad_id_1, #squad_id_2').on('change', function() {

      let selectorId;
      let squadId;

      if($(this).attr('id') === 'squad_id_1'){
        selectorId = 1;
      }else{
        selectorId = 2;
      }

      squadId = parseInt($(this).val(), 10);

      updateSquadFields(selectorId, squadId);

    });

  });

  function updateSquadFields(selectorId, squadId){

    //prepare ajax request
    var data = {
      'action': 'daextsoenl_get_squad_data',
      'security': window.DAEXTSOENL_PHPDATA.nonce,
      'squad_id': squadId
    };

    //send ajax request
    $.post(window.DAEXTSOENL_PHPDATA.ajaxUrl, data, function(jsonData) {

      let data = JSON.parse(jsonData);

      //Update the Lineup
      for(let i=1;i<=11;i++){

        //Select an option
        let fieldId = 'team_' + selectorId + '_lineup_player_id_' + i;
        $('#' + fieldId).val(data['lineup_player_id_' + i]);
        $('#' + fieldId).trigger("chosen:updated");

      }

      //Update the Substitutes
      for(let i=1;i<=20;i++){

        let fieldId = 'team_' + selectorId + '_substitute_player_id_' + i;
        $('#' + fieldId).val(data['substitute_player_id_' + i]);
        $('#' + fieldId).trigger("chosen:updated");

      }

      //Update the Staff
      for(let i=1;i<=20;i++){

        let fieldId = 'team_' + selectorId + '_staff_id_' + i;
        $('#' + fieldId).val(data['staff_id_' + i]);
        $('#' + fieldId).trigger("chosen:updated");

      }

      //Update the Formation
      let fieldId = 'team_' + selectorId + '_formation_id';
      if(data['formation_id'] === null){
        $('#' + fieldId).val(0);
      }else{
        $('#' + fieldId).val(data['formation_id']);
      }
      $('#' + fieldId).trigger("chosen:updated");

      //Update the Jersey Set
      fieldId = 'team_' + selectorId + '_jersey_set_id';
      if(data['jersey_set_id'] === null){
        $('#' + fieldId).val(0);
      }else{
        $('#' + fieldId).val(data['jersey_set_id']);
      }
      $('#' + fieldId).trigger("chosen:updated");

    });

  }

  function updateRoundField() {

    if($('.daext-form-table input[name="update_id"]').length){
      matchId = parseInt($('.daext-form-table input[name="update_id"]').val(), 10);
    }else{
      var matchId = 0;
    }

    const competitionId = parseInt($('#competition_id').val(), 10);

    if(competitionId === 0){
      $('.daext-form-table tr:nth-child(4), .daext-form-table tr:nth-child(5)').hide();
      return;
    }

    //prepare ajax request
    var data = {
      'action': 'daextsoenl_get_match_round_data',
      'security': window.DAEXTSOENL_PHPDATA.nonce,
      'match_id': matchId,
      'competition_id': competitionId
    };

    //send ajax request
    $.post(window.DAEXTSOENL_PHPDATA.ajaxUrl, data, function(jsonData) {

      let data = JSON.parse(jsonData);

      let selectOptions = '';

      if(parseInt(data.competition_type, 10) === 0){

        //Elimination
        let type_of_round = null;


        for(let i=1;i<=data.number_of_rounds;i++){

          let round_difference = data.number_of_rounds - i;
          switch(round_difference){

            case 0:
              type_of_round = 'Final';
              break;

            case 1:
              type_of_round = 'Semi-Finals';
              break;

            case 2:
              type_of_round = 'Quarter-Finals';
              break;

          }

          if(round_difference > 2){
            type_of_round = 'Last ' + Math.pow(2, (round_difference + 1));
          }

          selectOptions += '<option value="' + i + '">' + type_of_round + '</option>';

        }

      }else{

        //Round Robin
        for(let i=1;i<=data.number_of_rounds;i++){
          selectOptions += '<option value="' + i + '">Matchday' + ' ' + i + '</option>';
        }

      }

      let fieldSelector = $('#round');
      $(fieldSelector).empty();
      $(fieldSelector).append(selectOptions);

      let selected_round = 1;
      if(data.selected_round > 0){
        selected_round = data.selected_round;
      }
      $(fieldSelector).val(selected_round);
      $(fieldSelector).trigger("chosen:updated");

      if($(fieldSelector).val() === null){
        $(fieldSelector).val(1);
        $(fieldSelector).trigger("chosen:updated");
      }

      //Show the "Round" and "Type" field
      $('.daext-form-table tr:nth-child(4), .daext-form-table tr:nth-child(5)').show();

    });

  }

}(window.jQuery));