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
    $( "#foundation-date" ).datepicker({
      ...dpBaseConfig,
      ...{altField: "#foundation-date-alt-field", dateFormat: "M d, yy"}
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
    if($('#foundation-date').length){
      if($('#foundation-date-alt-field').val() !== '0000-00-00'){
        let foundationDate = $.datepicker.parseDate( "yy-mm-dd", $('#foundation-date-alt-field').val() );
        $( "#foundation-date" ).datepicker( "setDate", foundationDate );
      }
    }

  });

}(window.jQuery));