/**
 * Contact Form Validation
 * Handles form validation for the contact page using jQuery Validation plugin
 */
(function() {
  // Only run if jQuery and validation plugin are available
  if (!window.jQuery || !$.fn.validate) return;

  // Add custom email validation method
  $.validator.addMethod("strictEmail", function(value, element) {
    // More strict email validation pattern
    // Requires proper domain with at least one dot and valid TLD
    var emailPattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$/;
    return this.optional(element) || emailPattern.test(value);
  }, "Please enter a valid email address with a proper domain (e.g., user@example.com)");

  $("#contact-form").validate({
    errorPlacement: function(error, element) {
      error.attr('style', 'font-style: italic; color: #dc3545; font-size: 0.875rem; margin-top: 0.25rem; display: block;');
      error.insertAfter(element);
    },
    rules: {
      firstName: { required: true, minlength: 2 },
      middleName: { required: false },
      lastName: { required: true, minlength: 2 },
      email: { required: true, strictEmail: true },
      topic: { required: true },
      message: { required: true, minlength: 5 }
    },
    messages: {
      firstName: "Please enter your first name (at least 2 characters).",
      lastName: "Please enter your last name (at least 2 characters).",
      email: "Enter a valid email address with a proper domain.",
      topic: "Please choose a topic.",
      message: "Message cannot be empty."
    },
    submitHandler: function(form, event) {
      event.preventDefault();
      $("#contact-success").removeClass("d-none");
      form.reset();
      $(form).find("select").prop("selectedIndex", 0);
      $(form).validate().resetForm();
    }
  });
})();