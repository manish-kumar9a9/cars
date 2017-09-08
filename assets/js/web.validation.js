

// When the browser is ready...
  $(function() {
  
    // Setup form validation on the #register-form element
    $("#user_profile_updation").validate({
    
        // Specify the validation rules
        rules: {
            firstName: "required",
            lastName: "required",
            country: "required",
            about_user: "required",
        },
        
        /* Specify the validation error messages
        messages: {
            firstName: "Please enter your first name.",
            lastName: "Please enter your last name.",
            country: "Please enter your country name.",
            about_user: "Please enter something about you.",
        },*/
        
        submitHandler: function(form) {

        }
    });

  });