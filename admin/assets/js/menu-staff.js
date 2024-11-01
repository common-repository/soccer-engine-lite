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
    $( "#date-of-birth" ).datepicker({
      ...dpBaseConfig,
      ...{altField: "#date-of-birth-alt-field", dateFormat: "M d, yy"}
    });
    $( "#date-of-death" ).datepicker({
      ...dpBaseConfig,
      ...{altField: "#date-of-death-alt-field", dateFormat: "M d, yy"}
    });

    /**
     * Do not allow to enter data in the input field associated with the date picker
     */
    $('.hasDatepicker').keypress(function(event){
      event.preventDefault();
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
    if($('#date-of-birth').length){
      if($('#date-of-birth-alt-field').val() !== '0000-00-00'){
        let dateOfBirth = $.datepicker.parseDate( "yy-mm-dd", $('#date-of-birth-alt-field').val() );
        $( "#date-of-birth" ).datepicker( "setDate", dateOfBirth );
      }
    }
    if($('#date-of-death').length){
      if($('#date-of-death-alt-field').val() !== '0000-00-00'){
        let dateOfDeath = $.datepicker.parseDate( "yy-mm-dd", $('#date-of-death-alt-field').val() );
        $( "#date-of-death" ).datepicker( "setDate", dateOfDeath );
      }
    }

  });

}(window.jQuery));