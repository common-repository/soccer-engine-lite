(function($) {

  'use strict';

  $(document).ready(function() {

    'use strict';

    $(document.body).on('click', '#execute-task' , function(){
      event.preventDefault();
      $('#dialog-confirm').dialog('open');
    });

  });

  /**
   * Initialize the dialog.
   */
  $(function() {
    $('#dialog-confirm').dialog({
      autoOpen: false,
      resizable: false,
      height: 'auto',
      width: 340,
      modal: true,
      buttons: {
        [window.objectL10n.proceedText]: function() {
          $('#form-maintenance').submit();
        },
        [window.objectL10n.cancelText]: function() {
          $(this).dialog('close');
        },
      },
    });
  });

}(window.jQuery));

