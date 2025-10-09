// login.js - lightweight jQuery-powered login modal handler
(function(window, $){
  if (!window || !$) return;

  var loginModal = function() { return $('#login-modal'); };
  var signupModal = function() { return $('#signup-modal'); };
  var openBtn = function() { return $('#nav-login-btn'); };

  function showLoginModal() {
    hideSignupModal();
    loginModal().removeClass('d-none').addClass('show').css('display', 'block').attr('aria-hidden','false');
    if ($('.modal-backdrop.show').length === 0) {
      $('<div class="modal-backdrop fade show"></div>').appendTo(document.body);
    }
    $('body').addClass('modal-open');
    $('#login-email').focus();
  }
  
  function hideLoginModal() {
    loginModal().removeClass('show').addClass('d-none').css('display', 'none').attr('aria-hidden','true');
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    // Clear form
    $('#login-form')[0].reset();
    $('#login-form .is-invalid').removeClass('is-invalid');
    $('#login-feedback').hide();
  }

  function showSignupModal() {
    hideLoginModal();
    signupModal().removeClass('d-none').addClass('show').css('display', 'block').attr('aria-hidden','false');
    if ($('.modal-backdrop.show').length === 0) {
      $('<div class="modal-backdrop fade show"></div>').appendTo(document.body);
    }
    $('body').addClass('modal-open');
    $('#signup-name').focus();
  }
  
  function hideSignupModal() {
    signupModal().removeClass('show').addClass('d-none').css('display', 'none').attr('aria-hidden','true');
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    // Clear form
    $('#signup-form')[0].reset();
    $('#signup-form .is-invalid').removeClass('is-invalid');
    $('#signup-feedback').hide();
  }

  function setLoggedIn(email) {
    try { localStorage.setItem('eshop_user', email); } catch(e){}
    // Try to get user name from localStorage, fallback to email prefix
    var displayName = email.split('@')[0];
    try {
      var storedName = localStorage.getItem('eshop_user_name');
      if (storedName) {
        displayName = storedName.split(' ')[0]; // Use first name only
      }
    } catch(e) {}
    openBtn().text(displayName).prop('disabled', false).removeClass('btn-outline-light').addClass('btn-success');
  }
  function setLoggedOut() {
    try { 
      localStorage.removeItem('eshop_user');
      localStorage.removeItem('eshop_user_name');
      localStorage.removeItem('eshop_user_role');
    } catch(e){}
    openBtn().text('Login').prop('disabled', false).removeClass('btn-success').addClass('btn-outline-light');
  }

  function init() {
    // No inline styles: rely on compiled Bootstrap-based stylesheet in dist/styles.css
    
    // Real-time email validation to prevent leading spaces and space-only input
    $(document).on('input', '#login-email', function(){
      var email = $(this).val();
      
      // Remove any leading spaces (spaces before any character)
      var cleanEmail = email.replace(/^\s+/, '');
      
      // Prevent email field from containing only spaces
      if (cleanEmail.length === 0 && email.length > 0) {
        $(this).val('');
        $(this).addClass('is-invalid');
        return;
      }
      
      // Update field if we removed leading spaces
      if (cleanEmail !== email) {
        $(this).val(cleanEmail);
        email = cleanEmail;
      }
      
      // Also remove spaces before @ symbol (existing functionality)
      var finalEmail = email.replace(/\s+@/g, '@');
      if (finalEmail !== email) {
        $(this).val(finalEmail);
      }
      
      // Remove invalid class if field has valid content
      if (email.trim().length > 0) {
        $(this).removeClass('is-invalid');
      }
    });

    // Prevent typing spaces at the beginning of email field
    $(document).on('keydown', '#login-email', function(e){
      var email = $(this).val();
      // Prevent space key if field is empty or contains only spaces
      if (e.key === ' ' && email.trim().length === 0) {
        e.preventDefault();
        return false;
      }
    });

    // Handle paste events in email field to prevent space-only content
    $(document).on('paste', '#login-email', function(e){
      var self = this;
      setTimeout(function(){
        var email = $(self).val();
        // If pasted content is only spaces, clear the field
        if (email.trim().length === 0 && email.length > 0) {
          $(self).val('');
          $(self).addClass('is-invalid');
        }
      }, 1);
    });

    // Real-time password validation
    $(document).on('input', '#login-password', function(){
      var pw = $(this).val();
      // Check if password is only spaces
      if (pw.trim().length === 0 && pw.length > 0) {
        $(this).addClass('is-invalid');
      } else {
        $(this).removeClass('is-invalid');
      }
    });

    // wire up open button
    openBtn().on('click', function(){
      // if logged in, show simple logout prompt
      var u = localStorage.getItem('eshop_user');
      if (u) {
        if (confirm('Sign out ' + u + '?')) { setLoggedOut(); }
        return;
      }
      showLoginModal();
    });

    // Modal control buttons
    $(document).on('click', '#login-close, #login-cancel', function(){ hideLoginModal(); });
    $(document).on('click', '#signup-close, #signup-cancel', function(){ hideSignupModal(); });
    
    // Modal switching
    $(document).on('click', '#show-signup-modal', function(e){
      e.preventDefault();
      showSignupModal();
    });
    $(document).on('click', '#show-login-modal', function(e){
      e.preventDefault();
      showLoginModal();
    });

    // Password visibility toggles
    $(document).on('click', '#toggle-login-password', function(){
      var input = $('#login-password');
      var icon = $('#login-eye-icon');
      if (input.attr('type') === 'password') {
        input.attr('type', 'text');
        icon.removeClass('bi-eye').addClass('bi-eye-slash');
      } else {
        input.attr('type', 'password');
        icon.removeClass('bi-eye-slash').addClass('bi-eye');
      }
    });

    $(document).on('click', '#toggle-signup-password', function(){
      var input = $('#signup-password');
      var icon = $('#signup-eye-icon');
      if (input.attr('type') === 'password') {
        input.attr('type', 'text');
        icon.removeClass('bi-eye').addClass('bi-eye-slash');
      } else {
        input.attr('type', 'password');
        icon.removeClass('bi-eye-slash').addClass('bi-eye');
      }
    });

    $(document).on('click', '#toggle-signup-confirm', function(){
      var input = $('#signup-password-confirm');
      var icon = $('#signup-confirm-icon');
      if (input.attr('type') === 'password') {
        input.attr('type', 'text');
        icon.removeClass('bi-eye').addClass('bi-eye-slash');
      } else {
        input.attr('type', 'password');
        icon.removeClass('bi-eye-slash').addClass('bi-eye');
      }
    });

    // forgot password link
    $(document).on('click', '#forgot-password-link', function(e){
      e.preventDefault();
      alert('Forgot Password feature coming soon!\n\nFor now, you can use any email and password to sign in.');
    });

    // Legacy create account link (now handled by modal switching)
    $(document).on('click', '#create-account-link', function(e){
      e.preventDefault();
      showSignupModal();
    });

    // backdrop click closes
    $(document).on('click', '#login-modal', function(e){ 
      if (e.target.id === 'login-modal') hideLoginModal(); 
    });
    $(document).on('click', '#signup-modal', function(e){ 
      if (e.target.id === 'signup-modal') hideSignupModal(); 
    });

    // ESC key closes modal
    $(document).on('keydown', function(e){ 
      if (e.key === 'Escape') { 
        if (!loginModal().hasClass('d-none')) hideLoginModal();
        if (!signupModal().hasClass('d-none')) hideSignupModal();
      } 
    });

    // simple validation and fake auth
    $(document).on('submit', '#login-form', function(e){
      e.preventDefault();
      var email = $('#login-email').val() || '';
      var pw = $('#login-password').val() || '';
      var valid = true;
      
      // Enhanced email validation - check format, no spaces before @, and not just spaces
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      var hasSpaceBeforeAt = /\s@/.test(email);
      var isOnlySpaces = email.trim().length === 0 && email.length > 0;
      
      if (!emailPattern.test(email) || hasSpaceBeforeAt || isOnlySpaces || email.trim().length === 0) { 
        $('#login-email').addClass('is-invalid'); 
        valid = false; 
      } else { 
        $('#login-email').removeClass('is-invalid'); 
      }
      
      // Enhanced password validation - check length and not just spaces
      var trimmedPw = pw.trim();
      if (pw.length < 3 || trimmedPw.length === 0) { 
        $('#login-password').addClass('is-invalid'); 
        valid = false; 
      } else { 
        $('#login-password').removeClass('is-invalid'); 
      }
      
      if (!valid) return;

      // JSON file authentication: verify against users.json
      $('#login-feedback').hide().removeClass('text-danger text-success');
      $('#login-feedback').text('Verifying credentials...').addClass('text-info').show();
      
      // Disable submit button during verification
      $('#login-form button[type="submit"]').prop('disabled', true).text('Signing in...');
      
      // Fetch users from JSON file
      $.ajax({
        url: '../users.json',
        method: 'GET',
        dataType: 'json',
        timeout: 5000,
        success: function(data) {
          // Find matching user
          var matchedUser = null;
          if (data && data.users) {
            for (var i = 0; i < data.users.length; i++) {
              var user = data.users[i];
              if (user.email.toLowerCase() === email.toLowerCase() && user.password === pw) {
                matchedUser = user;
                break;
              }
            }
          }
          
          if (matchedUser) {
            // Login successful
            $('#login-feedback').text('Welcome, ' + matchedUser.name + '!').removeClass('text-info').addClass('text-success').show();
            // Store user info in localStorage
            try {
              localStorage.setItem('eshop_user', email);
              localStorage.setItem('eshop_user_name', matchedUser.name);
              localStorage.setItem('eshop_user_role', matchedUser.role);
            } catch(e) {}
            setLoggedIn(email);
            setTimeout(function(){ hideModal(); }, 800);
          } else {
            // Login failed - clear field validation errors and show only auth error
            $('#login-email, #login-password').removeClass('is-invalid');
            $('#login-feedback').text('Invalid email or password. Please try again.').removeClass('text-info').addClass('text-danger').show();
          }
        },
        error: function() {
          // Show error when JSON file can't be loaded - clear field validation errors
          $('#login-email, #login-password').removeClass('is-invalid');
          $('#login-feedback').text('Unable to verify credentials. Please check your connection and try again.').removeClass('text-info').addClass('text-danger').show();
        },
        complete: function() {
          // Re-enable submit button
          setTimeout(function(){
            $('#login-form button[type="submit"]').prop('disabled', false).text('Sign in');
          }, 500);
        }
      });
    });

    // Signup form validation
    $(document).on('input', '#signup-password-confirm', function(){
      var password = $('#signup-password').val();
      var confirm = $(this).val();
      if (confirm && password !== confirm) {
        $(this).addClass('is-invalid');
      } else {
        $(this).removeClass('is-invalid');
      }
    });

    // Signup form submission
    $(document).on('submit', '#signup-form', function(e){
      e.preventDefault();
      var name = $('#signup-name').val().trim();
      var email = $('#signup-email').val().trim();
      var password = $('#signup-password').val();
      var confirmPassword = $('#signup-password-confirm').val();
      var agreeTerms = $('#agree-terms').is(':checked');
      var valid = true;

      // Reset validation
      $('#signup-form .is-invalid').removeClass('is-invalid');

      // Validate name
      if (name.length < 2) {
        $('#signup-name').addClass('is-invalid');
        valid = false;
      }

      // Validate email
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
        $('#signup-email').addClass('is-invalid');
        valid = false;
      }

      // Validate password
      if (password.length < 6) {
        $('#signup-password').addClass('is-invalid');
        valid = false;
      }

      // Validate password confirmation
      if (password !== confirmPassword) {
        $('#signup-password-confirm').addClass('is-invalid');
        valid = false;
      }

      // Validate terms agreement
      if (!agreeTerms) {
        $('#agree-terms').addClass('is-invalid');
        valid = false;
      }

      if (!valid) return;

      // Show loading state
      $('#signup-feedback').removeClass('alert-danger alert-success').addClass('alert-info').text('Creating account...').show();
      $('#signup-form button[type="submit"]').prop('disabled', true);

      // Check if user already exists
      $.ajax({
        url: '../users.json',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
          var existingUser = null;
          if (data && data.users) {
            existingUser = data.users.find(function(user) {
              return user.email.toLowerCase() === email.toLowerCase();
            });
          }

          if (existingUser) {
            $('#signup-feedback').removeClass('alert-info').addClass('alert-danger')
                                .html('<i class="bi bi-exclamation-triangle me-1"></i>An account with this email already exists.')
                                .show();
          } else {
            // In a real app, you would send this to your backend
            // For demo purposes, we'll simulate success
            $('#signup-feedback').removeClass('alert-info').addClass('alert-success')
                                .html('<i class="bi bi-check-circle me-1"></i>Account created successfully! You can now sign in.')
                                .show();
            
            setTimeout(function(){
              hideSignupModal();
              showLoginModal();
              $('#login-email').val(email);
              $('#login-password').focus();
            }, 2000);
          }
        },
        error: function() {
          $('#signup-feedback').removeClass('alert-info').addClass('alert-success')
                              .html('<i class="bi bi-check-circle me-1"></i>Account created successfully! You can now sign in.')
                              .show();
          
          setTimeout(function(){
            hideSignupModal();
            showLoginModal();
            $('#login-email').val(email);
            $('#login-password').focus();
          }, 2000);
        },
        complete: function() {
          $('#signup-form button[type="submit"]').prop('disabled', false);
        }
      });
    });

    // restore session state
    var saved = null;
    try { saved = localStorage.getItem('eshop_user'); } catch(e){}
    if (saved) setLoggedIn(saved);
  }

  // Expose LoginHandler globally so app.js can initialize it after modals are loaded
  window.LoginHandler = {
    init: init,
    showLoginModal: showLoginModal,
    hideLoginModal: hideLoginModal,
    showSignupModal: showSignupModal,
    hideSignupModal: hideSignupModal
  };

  // Only auto-initialize if modals already exist (fallback for pages that don't use components)
  $(document).ready(function() {
    if ($('#login-modal').length && $('#signup-modal').length) {
      init();
    }
  });
})(window, window.jQuery);
