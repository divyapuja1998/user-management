/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function($){
  "use strict";
  $(document).ready(function() {
    // Use below code.
    /**
      * onchange event handler for the file input field.
      * It emplements very basic validation using the file extension.
      * If the filename passes validation it will show the image
         using it's blob URL and will hide the input field and show a delete
         button to allow the user to remove the image.
      */

    jQuery( document ).delegate('#image', 'change', function() {
        var ext = jQuery(this).val().split('.').pop().toLowerCase();
        if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            resetFormElement(jQuery(this));
            window.alert('Not an image!');
        } else {
            var reader = new FileReader();
            var image_holder = jQuery("#"+jQuery(this).attr('class')+"-preview");
            image_holder.empty();

            reader.onload = function (e) {
                jQuery(image_holder).attr('src', e.target.result);
            }

            reader.readAsDataURL((this).files[0]);
            jQuery('#image_preview').slideDown();
            jQuery(this).slideUp();
        }
    });

    /**
    onclick event handler for the delete button.
    It removes the image, clears and unhides the file input field.
    */
    jQuery('#image_preview a').bind('click', function () {
        resetFormElement(jQuery('#image'));
        jQuery('#image').slideDown();
        jQuery(this).parent().slideUp();
        return false;
    });

    /**
     * Reset form element
     *
     * @param e jQuery object
     */
    function resetFormElement(e) {
        e.wrap('<form>').closest('form').get(0).reset();
        e.unwrap();
    }

    // Validation for the form.
    $("#register-form").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        name: {
          required: true,
          minlength: 2,
          lettersonly: true
        },
        email: {
          required: true,
          // Specify that email should be validated
          // by the built-in "email" rule
          email: true
        },
        mobile: "required",
      },
      // Specify validation error messages
      messages: {
        firstname: "Please enter your firstname",
        email: "Please enter a valid email address",
        mobile: "Please enter your mobile number",
      },
      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    });

    // Letters only validation.
    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-z," "]+$/i.test(value);
    }, "Letters and spaces only please");

    // Datepicker.
    $( function() {
      $( "#datepicker" ).datepicker({
       maxDate: "0",
       showWeek:true,
       showAnim: "slide",
      });
    });

    // Validation
    $("#datepicker").change(function () {
    var CurrentDate = new Date();
    var startDate = document.getElementById("datepicker").value;

    if ((Date.parse(startDate) >= CurrentDate)) {
        alert("Date of Birth should be lesser than Current date");
        document.getElementById("datepicker").value = "";
    }
});

  });
})(jQuery);
