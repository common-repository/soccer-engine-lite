(function($) {

  'use strict';

  $(document).ready(function() {

    'use strict';

    if($('#cancel').length){
      $(document.body).on('click', '#cancel' , function(){
        event.preventDefault();
        window.location.replace($('#cancel').attr('data-url'));
      });
    }

  });

}(window.jQuery));