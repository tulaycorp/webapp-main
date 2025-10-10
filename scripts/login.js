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
  $('#signup-first-name').focus();
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

    // Real-time email sanitization and validation (login)
    $(document).on('input', '#login-email', function(){
      var email = $(this).val();
      var cleanEmail = email.replace(/^\s+/, '');
      if (cleanEmail.length === 0 && email.length > 0) {
        $(this).val('');
        $(this).addClass('is-invalid');
        return;
      }
      if (cleanEmail !== email) {
        $(this).val(cleanEmail);
        email = cleanEmail;
      }
      var finalEmail = email.replace(/\s+@/g, '@');
      if (finalEmail !== email) {
        $(this).val(finalEmail);
      }
      if (email.trim().length > 0) {
        $(this).removeClass('is-invalid');
      }
    });

    // Prevent leading spaces in login email
    $(document).on('keydown', '#login-email', function(e){
      var email = $(this).val();
      if (e.key === ' ' && email.trim().length === 0) {
        e.preventDefault();
        return false;
      }
    });

    // Handle paste events for login email
    $(document).on('paste', '#login-email', function(){
      var self = this;
      setTimeout(function(){
        var email = $(self).val();
        if (email.trim().length === 0 && email.length > 0) {
          $(self).val('');
          $(self).addClass('is-invalid');
        }
      }, 1);
    });

    // Real-time password validation
    $(document).on('input', '#login-password', function(){
      var pw = $(this).val();
      if (pw.trim().length === 0 && pw.length > 0) {
        $(this).addClass('is-invalid');
      } else {
        $(this).removeClass('is-invalid');
      }
    });

    // Wire up navbar Login/Sign Out button
    openBtn().on('click', function(){
      var u = null;
      try { u = localStorage.getItem('eshop_user'); } catch(e) {}
      if (u) {
        $('#signout-identity').text(u);
        var $m = $('#signout-modal');
        if ($m.length) {
          $m.removeClass('d-none').addClass('show').css('display','block').attr('aria-hidden','false');
          if ($('.modal-backdrop.show').length === 0) {
            $('<div class="modal-backdrop fade show"></div>').appendTo(document.body);
          }
          $('body').addClass('modal-open');
        } else {
          if (confirm('Sign out ' + u + '?')) { setLoggedOut(); }
        }
        return;
      }
      showLoginModal();
    });

    // Sign Out modal close helpers
    function hideSignoutModal(){
      var $m = $('#signout-modal');
      $m.removeClass('show').addClass('d-none').css('display','none').attr('aria-hidden','true');
      $('.modal-backdrop').remove();
      $('body').removeClass('modal-open');
    }
    $(document).on('click', '#signout-close, #signout-cancel', hideSignoutModal);
    $(document).on('click', '#signout-modal', function(e){ if (e.target.id === 'signout-modal') hideSignoutModal(); });
    $(document).on('keydown', function(e){ if (e.key === 'Escape' && !$('#signout-modal').hasClass('d-none')) hideSignoutModal(); });
    $(document).on('click', '#signout-confirm', function(){ setLoggedOut(); hideSignoutModal(); });

    // Modal control buttons
    $(document).on('click', '#login-close, #login-cancel', function(){ hideLoginModal(); });
    $(document).on('click', '#signup-close, #signup-cancel', function(){ hideSignupModal(); });
    
    // Modal switching
    $(document).on('click', '#show-signup-modal', function(e){ e.preventDefault(); showSignupModal(); });
    $(document).on('click', '#show-login-modal', function(e){ e.preventDefault(); showLoginModal(); });

    // Password visibility toggles
    $(document).on('click', '#toggle-login-password', function(){
      var input = $('#login-password');
      var icon = $('#login-eye-icon');
      if (input.attr('type') === 'password') { input.attr('type', 'text'); icon.removeClass('bi-eye').addClass('bi-eye-slash'); }
      else { input.attr('type', 'password'); icon.removeClass('bi-eye-slash').addClass('bi-eye'); }
    });
    $(document).on('click', '#toggle-signup-password', function(){
      var input = $('#signup-password');
      var icon = $('#signup-eye-icon');
      if (input.attr('type') === 'password') { input.attr('type', 'text'); icon.removeClass('bi-eye').addClass('bi-eye-slash'); }
      else { input.attr('type', 'password'); icon.removeClass('bi-eye-slash').addClass('bi-eye'); }
    });
    $(document).on('click', '#toggle-signup-confirm', function(){
      var input = $('#signup-password-confirm');
      var icon = $('#signup-confirm-icon');
      if (input.attr('type') === 'password') { input.attr('type', 'text'); icon.removeClass('bi-eye').addClass('bi-eye-slash'); }
      else { input.attr('type', 'password'); icon.removeClass('bi-eye-slash').addClass('bi-eye'); }
    });

    // Forgot Password modal open
    $(document).on('click', '#forgot-password-link', function(e){
      e.preventDefault();
      hideLoginModal();
      var $m = $('#forgot-modal');
      if ($m.length) {
        $m.removeClass('d-none').addClass('show').css('display', 'block').attr('aria-hidden','false');
        if ($('.modal-backdrop.show').length === 0) { $('<div class="modal-backdrop fade show"></div>').appendTo(document.body); }
        $('body').addClass('modal-open');
        $('#forgot-email').focus();
      } else {
        alert('Enter your email and we\'ll send you a reset link.');
      }
    });

    // Forgot Password modal close
    function hideForgotModal(){
      var $m = $('#forgot-modal');
      $m.removeClass('show').addClass('d-none').css('display','none').attr('aria-hidden','true');
      $('.modal-backdrop').remove();
      $('body').removeClass('modal-open');
      var form = document.getElementById('forgot-form'); if (form) form.reset();
      $('#forgot-feedback').hide().removeClass('alert-danger alert-success alert-info');
      $('#forgot-email').removeClass('is-invalid');
    }
    $(document).on('click', '#forgot-close, #forgot-cancel', hideForgotModal);
    $(document).on('click', '#forgot-modal', function(e){ if (e.target.id === 'forgot-modal') hideForgotModal(); });
    $(document).on('keydown', function(e){ if (e.key === 'Escape' && !$('#forgot-modal').hasClass('d-none')) hideForgotModal(); });

    // From Forgot back to Login
    $(document).on('click', '#show-login-from-forgot', function(e){ e.preventDefault(); hideForgotModal(); showLoginModal(); });

    // Forgot Password submit handler with account existence validation
    $(document).on('submit', '#forgot-form', function(e){
      e.preventDefault();
      var email = ($('#forgot-email').val() || '').trim();
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      var $feedback = $('#forgot-feedback');
      var $submit = $('#forgot-form button[type="submit"]');
      $('#forgot-email').removeClass('is-invalid');
      $feedback.removeClass('alert-danger alert-success alert-info').hide();
      if (!emailPattern.test(email)) { $('#forgot-email').addClass('is-invalid'); return; }
      $feedback.addClass('alert-info').text('Checking account...').show();
      $submit.prop('disabled', true);
      $.ajax({
        url: '../users.json', method: 'GET', dataType: 'json', timeout: 5000,
        success: function(data){
          var exists = false;
          if (data && Array.isArray(data.users)) {
            exists = data.users.some(function(user){ return ((user.email||'').trim().toLowerCase() === email.toLowerCase()); });
          }
          if (exists) {
            $feedback.removeClass('alert-info').addClass('alert-success')
              .html('<i class="bi bi-check-circle me-1"></i>We found an account for <strong>'+email+'</strong>. A reset link has been sent (demo).').show();
            setTimeout(function(){ hideForgotModal(); showLoginModal(); $('#login-email').val(email).focus(); }, 1200);
          } else {
            $feedback.removeClass('alert-info').addClass('alert-danger')
              .html('<i class="bi bi-exclamation-triangle me-1"></i>No account found for <strong>'+email+'</strong>.').show();
          }
        },
        error: function(){
          var demoUsers = [ { email: 'test@test.com' } ];
          var exists = demoUsers.some(function(u){ return u.email.toLowerCase() === email.toLowerCase(); });
          if (exists) {
            $feedback.removeClass('alert-info').addClass('alert-success')
              .html('<i class="bi bi-check-circle me-1"></i>We found an account for <strong>'+email+'</strong>. A reset link has been sent (demo).').show();
            setTimeout(function(){ hideForgotModal(); showLoginModal(); $('#login-email').val(email).focus(); }, 1200);
          } else {
            $feedback.removeClass('alert-info').addClass('alert-danger')
              .html('<i class="bi bi-exclamation-triangle me-1"></i>No account found for <strong>'+email+'</strong>.').show();
          }
        },
        complete: function(){ setTimeout(function(){ $submit.prop('disabled', false); }, 400); }
      });
    });

    // Legacy create account link (now handled by modal switching)
    $(document).on('click', '#create-account-link', function(e){ e.preventDefault(); showSignupModal(); });

    // Backdrop click closes
    $(document).on('click', '#login-modal', function(e){ if (e.target.id === 'login-modal') hideLoginModal(); });
    $(document).on('click', '#signup-modal', function(e){ if (e.target.id === 'signup-modal') hideSignupModal(); });

    // ESC key closes login/signup modals
    $(document).on('keydown', function(e){ 
      if (e.key === 'Escape') { 
        if (!loginModal().hasClass('d-none')) hideLoginModal();
        if (!signupModal().hasClass('d-none')) hideSignupModal();
      }
    });

    // Login form submit (validate and authenticate)
    $(document).on('submit', '#login-form', function(e){
      e.preventDefault();
      var email = ($('#login-email').val() || '').trim();
      var pw = ($('#login-password').val() || '');
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      $('#login-feedback').removeClass('text-danger text-success text-info').hide();
      $('#login-email, #login-password').removeClass('is-invalid');
      var valid = true;
      if (!emailPattern.test(email)) { $('#login-email').addClass('is-invalid'); valid = false; }
      if (pw.trim().length < 3) { $('#login-password').addClass('is-invalid'); valid = false; }
      if (!valid) return;
      var $btn = $('#login-form button[type="submit"]');
      $btn.prop('disabled', true).text('Signing in...');

      $.ajax({
        url: '../users.json', method: 'GET', dataType: 'json', timeout: 5000,
        success: function(data){
          var matchedUser = null;
          if (data && data.users) {
            matchedUser = data.users.find(function(user){
              var uEmail = (user.email || '').trim().toLowerCase();
              var uPass = (user.password || '').trim();
              return uEmail === email.toLowerCase() && uPass === pw;
            }) || null;
          }
          if (matchedUser) {
            $('#login-feedback').text('Welcome, ' + matchedUser.name + '!').removeClass('text-info').addClass('text-success').show();
            try {
              localStorage.setItem('eshop_user', email);
              localStorage.setItem('eshop_user_name', matchedUser.name);
              localStorage.setItem('eshop_user_role', matchedUser.role);
            } catch(e) {}
            setLoggedIn(email);
            setTimeout(function(){
              hideLoginModal();
              try {
                var intent = localStorage.getItem('eshop_intent');
                if (intent === 'checkout') {
                  localStorage.removeItem('eshop_intent');
                  var btn = document.getElementById('checkout');
                  if (btn) btn.click();
                }
              } catch(e) {}
            }, 800);
          } else {
            $('#login-feedback').text('Invalid email or password. Please try again.').removeClass('text-info').addClass('text-danger').show();
          }
        },
        error: function(){
          var demoUsers = [ { email: 'test@test.com', password: 'test123', name: 'Test User', role: 'user' } ];
          var matchedUser = demoUsers.find(function(user){
            return (user.email || '').trim().toLowerCase() === email.toLowerCase() && (user.password || '').trim() === pw;
          }) || null;
          if (matchedUser) {
            $('#login-feedback').text('Welcome, ' + matchedUser.name + '!').removeClass('text-info').addClass('text-success').show();
            try {
              localStorage.setItem('eshop_user', email);
              localStorage.setItem('eshop_user_name', matchedUser.name);
              localStorage.setItem('eshop_user_role', matchedUser.role);
            } catch(e) {}
            setLoggedIn(email);
            setTimeout(function(){
              hideLoginModal();
              try {
                var intent = localStorage.getItem('eshop_intent');
                if (intent === 'checkout') {
                  localStorage.removeItem('eshop_intent');
                  var btn = document.getElementById('checkout');
                  if (btn) btn.click();
                }
              } catch(e) {}
            }, 800);
          } else {
            $('#login-feedback').removeClass('text-info').addClass('text-danger')
              .html('Unable to verify credentials (offline).<br>Tip: Use demo account <strong>test@test.com</strong> / <strong>test123</strong>.').show();
          }
        },
        complete: function(){ setTimeout(function(){ $btn.prop('disabled', false).text('Sign in'); }, 500); }
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

    // Real-time phone validation
    $(document).on('input', '#signup-phone', function(){
      var phone = $(this).val().trim();
      var cleanPhone = phone.replace(/[\s\-\(\)\.]/g, '');
      if (phone.length > 0) {
        if (!/^\d{11}$/.test(cleanPhone)) {
          $(this).addClass('is-invalid');
        } else {
          $(this).removeClass('is-invalid');
        }
      } else {
        $(this).removeClass('is-invalid'); // Optional field, so empty is valid
      }
    });

    // Signup form submission
    $(document).on('submit', '#signup-form', function(e){
      e.preventDefault();
      var firstName = ($('#signup-first-name').val() || '').replace(/\s+$/, '');
      var middleName = ($('#signup-middle-name').val() || '').replace(/\s+$/, '');
      var lastName = ($('#signup-last-name').val() || '').replace(/\s+$/, '');
      var email = $('#signup-email').val().trim();
      var phone = ($('#signup-phone').val() || '').trim();
      var password = $('#signup-password').val();
      var confirmPassword = $('#signup-password-confirm').val();
      var agreeTerms = $('#agree-terms').is(':checked');
      var valid = true;

      // Reset validation
      $('#signup-form .is-invalid').removeClass('is-invalid');

      // Validate first and last name
      if (firstName.length < 2) { $('#signup-first-name').addClass('is-invalid'); valid = false; }
      if (lastName.length < 2) { $('#signup-last-name').addClass('is-invalid'); valid = false; }

      // Validate email
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
        $('#signup-email').addClass('is-invalid');
        valid = false;
      }

      // Validate phone number (must be exactly 11 digits)
      var cleanPhone = phone.replace(/[\s\-\(\)\.]/g, ''); // Remove spaces, dashes, parentheses, dots
      if (phone.length > 0) {
        if (!/^\d{11}$/.test(cleanPhone)) {
          $('#signup-phone').addClass('is-invalid');
          valid = false;
        }
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
