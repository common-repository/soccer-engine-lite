(function($) {

  'use strict';

  $(document).ready(function() {

    showHideFields($('#data').val());

    $('#data').on('change', function() {

      showHideFields($(this).val());

    });

  });

  function showHideFields(data){

    data = parseInt(data, 10);
    let affectedFields = $('.tr_player_id, .tr_player_id_substitution_out, .tr_player_id_substitution_in, .tr_staff_id, .tr_part, .tr_time, .tr_additional_time, .tr_description');

    if(data === 0){

      affectedFields.hide();

    }else{

      affectedFields.show();

    }

    $('table.daext-form > tbody > tr:visible:last > th, table.daext-form > tbody > tr:visible:last > td').css('border-bottom', 'none');
    $('table.daext-form > tbody > tr:visible:not(:last) > th, table.daext-form > tbody > tr:visible:not(:last) > td').css('border-bottom', '1px solid #e3e3e3');

  }

}(window.jQuery));