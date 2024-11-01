(function($) {

  'use strict';

  $(document).ready(function() {

    "use strict";

    //will be used to store the wp.media object
    var file_frame;

    //ad reference to the link used to add and remove the images
    var da_media_button;

    //.button_add_media click event handler
    $(document.body).on('click', '.button_add_media' , function( event ){

      //prevent the default behavior of this event
      event.preventDefault();

      //save this in a variable
      da_media_button = $(this);

      if($(this).attr('data-set-remove') == "set"){

        //reopen the media frame if already exists
        if ( file_frame ) {
          file_frame.open();
          return;
        }

        //extend the wp.media object
        file_frame = window.wp.media.frames.file_frame = window.wp.media({
          title: $( this ).data( 'Insert image' ),
          button: {
            text: $( this ).data( 'Insert image' ),
          },
          multiple: false//false -> allows single file | true -> allows multiple files
        });

        //run a callback when an image is selected
        file_frame.on( 'select', function() {

          //get the attachment from the uploader
          var attachment = file_frame.state().get('selection').first().toJSON();

          //change the da_media_button label
          da_media_button.text(da_media_button.attr('data-remove'));

          //change the da_media_button current status
          da_media_button.attr('data-set-remove', 'remove');

          //assign the attachment.url ( or attachment.id ) to the DOM element ( an input text ) that comes just before the "Add Media" button
          da_media_button.prev().val(attachment.url);

          //assign the attachment.url to the src of the image two times before the "Add Media" button
          da_media_button.prev().prev().attr("src",attachment.url);

          //show the image
          da_media_button.prev().prev().show();

          //hide the description
          da_media_button.next().hide();

        });

        //open the modal window
        file_frame.open();

      }else{

        //change the da_media_button label
        da_media_button.html(da_media_button.attr('data-set'));

        //change the da_media_button current status
        da_media_button.attr('data-set-remove', 'set');

        //clear the src of the image two times before the "Add Media" button
        da_media_button.prev().prev().attr("src",'');

        //hide the image
        da_media_button.prev().prev().hide();

        //set empty to the hidden field
        da_media_button.prev().val("");

        //show the description
        da_media_button.next().show();

      }

    });

  });

}(window.jQuery));