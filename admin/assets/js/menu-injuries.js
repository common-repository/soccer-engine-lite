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
    $( "#start-date" ).datepicker({
      ...dpBaseConfig,
      ...{altField: "#start-date-alt-field", dateFormat: "M d, yy"}
    });
    $( "#end-date" ).datepicker({
      ...dpBaseConfig,
      ...{altField: "#end-date-alt-field", dateFormat: "M d, yy"}
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
     * Note that before applying this change the format of the date available in the alternative field #date-alt-field
     * should be changed.
     *
     */
    if($('#start-date').length){
      let startDate = $.datepicker.parseDate( "yy-mm-dd", $('#start-date-alt-field').val() );
      $( "#start-date" ).datepicker( "setDate", startDate );
    }
    if($('#end-date').length){
      let endDate = $.datepicker.parseDate( "yy-mm-dd", $('#end-date-alt-field').val() );
      $( "#end-date" ).datepicker( "setDate", endDate );
    }

  });

}(window.jQuery));