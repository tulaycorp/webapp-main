// auth.js - Authentication utilities for signup and user management
(function(window, $) {
  if (!window || !$) return;

  // Signup functionality
  function handleSignup() {
    const $form = $("#signup-form");
    if (!$form.length) return;

    // Enhanced form validation
    function validateMatch() {
      const p1 = $("#su-password").val();
      const p2 = $("#su-password2").val();
      const match = p1 === p2 && p2.length > 0;
      const $pw2 = $("#su-password2");
      
      if (!match) {
        $pw2.addClass("is-invalid");
        $("#pw2-error").text("This password does not match");
      } else {
        $pw2.removeClass("is-invalid");
      }
      return match;
    }

    // Real-time password matching
    $("#su-password, #su-password2").on("input", validateMatch);

    // Character restrictions for inputs
    const allowedName = /^[a-zA-Z\s\-']$/;
    const allowedEmail = /^[a-zA-Z0-9@._+\-]$/;

    $("#su-name").on("keypress", function(e) {
      const ch = String.fromCharCode(e.which || e.keyCode);
      if (!allowedName.test(ch)) e.preventDefault();
    });

    $("#su-email").on("keypress", function(e) {
      const ch = String.fromCharCode(e.which || e.keyCode);
      if (!allowedEmail.test(ch)) e.preventDefault();
    });

    // Form submission
    if ($.fn.validate) {
      $form.validate({
        errorPlacement: function(error, element) {
          error.attr('style', 'font-style: italic; color: #dc3545; font-size: 0.875rem; margin-top: 0.25rem; display: block;');
          error.insertAfter(element);
        },
        rules: {
          name: { required: true, minlength: 2 },
          email: { required: true, email: true },
          password: { required: true, minlength: 6 },
          password2: { required: true, minlength: 6, equalTo: "#su-password" }
        },
        messages: {
          name: "Please enter your name (at least 2 characters).",
          email: "Enter a valid email address.",
          password: "Password must be at least 6 characters.",
          password2: { equalTo: "This password does not match" }
        },
        submitHandler: function(form, ev) {
          ev.preventDefault();
          if (!validateMatch()) return;
          
          const payload = {
            name: form.name.value.trim(),
            email: form.email.value.trim(),
            password: form.password.value,
            role: "user"
          };

          // Simulate account creation (in a real app, this would POST to a server)
          try {
            // For demo purposes, just show success message
            $("#signup-success").removeClass("d-none").text(
              `Account created successfully for ${payload.email}! You can now log in on any page.`
            );
            form.reset();
            
            // Optional: Add user to local users.json simulation
            console.log("New user would be created:", payload);
            
            // Show login suggestion
            setTimeout(function() {
              if (confirm("Account created! Would you like to return to the homepage to log in?")) {
                window.location.href = "../pages/bootstrap.php";
              }
            }, 1500);
            
          } catch (err) {
            alert("Error creating account. Please try again.");
            console.error("Signup error:", err);
          }
        }
      });
    } else {
      // Fallback for when jQuery validation isn't available
      $form.on('submit', function(e) {
        e.preventDefault();
        if (!this.checkValidity() || !validateMatch()) {
          this.classList.add('was-validated');
          return;
        }
        
        // Simple success handling
        $("#signup-success").removeClass("d-none");
        this.reset();
      });
    }
  }

  // Initialize auth features
  function init() {
    handleSignup();
  }

  // Auto-initialize when DOM is ready
  $(document).ready(init);

  // Expose auth utilities globally
  window.Auth = {
    handleSignup: handleSignup
  };

})(window, window.jQuery);