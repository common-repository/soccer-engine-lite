(function($) {

  'use strict';

  $(document).ready(function() {

    'use strict';

    removeBorderLastTableTr();

    $(document.body).on('click', '.group-trigger' , function(){

      //open and close the various sections of the tables area
      var target = $(this).attr('data-trigger-target');
      $('.' + target).toggle();

      $(this).find('.expand-icon').toggleClass('arrow-down');

      removeBorderLastTableTr();

    });

  });

  /**
   * Remove the bottom border on the last visible tr included in the form.
   */
  function removeBorderLastTableTr() {
    $('table.daext-form-table tr > *').css('border-bottom-width', '1px');
    $('table.daext-form-table tr:visible:last > *').css('border-bottom-width', '0');
  }

}(window.jQuery));

