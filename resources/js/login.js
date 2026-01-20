// login.js - lightweight jQuery-powered login modal handler
(function (window, $) {
  if (!window || !$) return;

  var loginModal = function () { return $('#login-modal'); };
  var signupModal = function () { return $('#signup-modal'); };
  var openBtn = function () { return $('#nav-login-btn'); };
  var signupTooltips = [];

  function initSignupTooltips() {
    if (!window.bootstrap || !window.bootstrap.Tooltip) return;
    disposeSignupTooltips();
    signupTooltips = Array.from(document.querySelectorAll('#signup-modal [data-bs-toggle="tooltip"]'))
      .map(function (el) { return new window.bootstrap.Tooltip(el); });
  }

  function disposeSignupTooltips() {
    if (!signupTooltips || !signupTooltips.length) {
      signupTooltips = [];
      return;
    }
    signupTooltips.forEach(function (instance) {
      try { instance.dispose(); } catch (err) { }
    });
    signupTooltips = [];
  }

  function showLoginModal() {
    hideSignupModal();
    loginModal().removeClass('d-none').addClass('show').css('display', 'block').attr('aria-hidden', 'false');
    if ($('.modal-backdrop.show').length === 0) {
      $('<div class="modal-backdrop fade show"></div>').appendTo(document.body);
    }
    $('body').addClass('modal-open');
    $('#login-email').focus();
  }

  function hideLoginModal() {
    loginModal().removeClass('show').addClass('d-none').css('display', 'none').attr('aria-hidden', 'true');
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    // Clear form
    $('#login-form')[0].reset();
    $('#login-form .is-invalid').removeClass('is-invalid');
    $('#login-feedback').hide();
  }

  function showSignupModal() {
    hideLoginModal();
    signupModal().removeClass('d-none').addClass('show').css('display', 'block').attr('aria-hidden', 'false');
    if ($('.modal-backdrop.show').length === 0) {
      $('<div class="modal-backdrop fade show"></div>').appendTo(document.body);
    }
    $('body').addClass('modal-open');
    // Initialize tooltips for the signup modal
    initSignupTooltips();
    $('#signup-first-name').focus();
  }

  function hideSignupModal() {
    // Dispose of tooltips before hiding the modal
    disposeSignupTooltips();
    signupModal().removeClass('show').addClass('d-none').css('display', 'none').attr('aria-hidden', 'true');
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    // Clear form
    $('#signup-form')[0].reset();
    $('#signup-form .is-invalid').removeClass('is-invalid');
    $('#signup-feedback').hide();
  }

  function setLoggedIn(userData) {
    // Store user data (including session_token) in localStorage for persistence
    try {
      localStorage.setItem('eshop_user', JSON.stringify({
        session_token: userData.session_token,
        email: userData.email,
        first_name: userData.first_name,
        last_name: userData.last_name,
        role: userData.role || 'user'
      }));
    } catch (e) { console.error('Failed to save user to localStorage:', e); }

    var displayName = userData.first_name || userData.email.split('@')[0];
    // Update nav link text and ensure proper classes without relying on button styles
    openBtn()
      .text(displayName)
      .prop('disabled', false)
      .removeClass('btn-outline-light btn-success btn btn-sm')
      .addClass('nav-link');
  }

  function setLoggedOut() {
    var userData = null;
    try {
      userData = JSON.parse(localStorage.getItem('eshop_user') || 'null');
    } catch (e) { }

    var sessionToken = userData?.session_token || null;

    // Clear localStorage FIRST (before any async calls)
    try {
      localStorage.removeItem('eshop_user');
      localStorage.removeItem('eshop-cart-v1');
      console.log('Cleared localStorage: eshop_user and eshop-cart-v1');
    } catch (e) {
      console.error('Failed to clear localStorage:', e);
    }

    // Dispatch cart-updated event immediately to clear UI
    window.dispatchEvent(new CustomEvent('cart-updated', { detail: [] }));

    // Update UI immediately
    openBtn()
      .text('Login')
      .prop('disabled', false)
      .removeClass('btn-success btn btn-sm')
      .addClass('nav-link');

    // Call logout API if we have a session token
    if (sessionToken) {
      $.ajax({
        url: '../api/users.php?action=logout',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ session_token: sessionToken }),
        xhrFields: { withCredentials: true },
        timeout: 3000
      });
    }

    // Reset guest cart cookie (rotate to fresh guest session)
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    if (csrfToken) {
      $.ajax({
        url: '/cart/guest/reset',
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken },
        xhrFields: { withCredentials: true },
        timeout: 3000,
        success: function () {
          console.log('Guest session reset successful');
          // Reload the page to ensure completely fresh state
          window.location.reload();
        },
        error: function (xhr, status, err) {
          console.error('Failed to reset guest session:', err);
          // Still reload to clear state
          window.location.reload();
        }
      });
    } else {
      // No CSRF token, just reload
      window.location.reload();
    }
  }

  function init() {
    // No inline styles: rely on compiled Bootstrap-based stylesheet in dist/styles.css

    // Real-time email sanitization and validation (login)
    $(document).on('input', '#login-email', function () {
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
    $(document).on('keydown', '#login-email', function (e) {
      var email = $(this).val();
      if (e.key === ' ' && email.trim().length === 0) {
        e.preventDefault();
        return false;
      }
    });

    // Handle paste events for login email
    $(document).on('paste', '#login-email', function () {
      var self = this;
      setTimeout(function () {
        var email = $(self).val();
        if (email.trim().length === 0 && email.length > 0) {
          $(self).val('');
          $(self).addClass('is-invalid');
        }
      }, 1);
    });

    // Real-time password validation
    $(document).on('input', '#login-password', function () {
      var pw = $(this).val();
      if (pw.trim().length === 0 && pw.length > 0) {
        $(this).addClass('is-invalid');
      } else {
        $(this).removeClass('is-invalid');
      }
    });

    // Wire up navbar Login/Sign Out button (prevent default for anchor)
    openBtn().on('click', function (e) {
      if (e && typeof e.preventDefault === 'function') e.preventDefault();
      var sessionToken = null;
      try { sessionToken = sessionStorage.getItem('eshop_session_token'); } catch (e) { }
      if (sessionToken) {
        var userEmail = '';
        try { userEmail = sessionStorage.getItem('eshop_user_email') || ''; } catch (e) { }
        $('#signout-identity').text(userEmail);
        var $m = $('#signout-modal');
        if ($m.length) {
          $m.removeClass('d-none').addClass('show').css('display', 'block').attr('aria-hidden', 'false');
          if ($('.modal-backdrop.show').length === 0) {
            $('<div class="modal-backdrop fade show"></div>').appendTo(document.body);
          }
          $('body').addClass('modal-open');
        } else {
          if (confirm('Sign out ' + userEmail + '?')) { setLoggedOut(); }
        }
        return;
      }
      showLoginModal();
    });

    // Sign Out modal close helpers
    function hideSignoutModal() {
      var $m = $('#signout-modal');
      $m.removeClass('show').addClass('d-none').css('display', 'none').attr('aria-hidden', 'true');
      $('.modal-backdrop').remove();
      $('body').removeClass('modal-open');
    }
    $(document).on('click', '#signout-close, #signout-cancel', hideSignoutModal);
    $(document).on('click', '#signout-modal', function (e) { if (e.target.id === 'signout-modal') hideSignoutModal(); });
    $(document).on('keydown', function (e) { if (e.key === 'Escape' && !$('#signout-modal').hasClass('d-none')) hideSignoutModal(); });
    $(document).on('click', '#signout-confirm', function () { setLoggedOut(); hideSignoutModal(); });

    // Modal control buttons
    $(document).on('click', '#login-close, #login-cancel', function () { hideLoginModal(); });
    $(document).on('click', '#signup-close, #signup-cancel', function () { hideSignupModal(); });

    // Modal switching
    $(document).on('click', '#show-signup-modal', function (e) { e.preventDefault(); showSignupModal(); });
    $(document).on('click', '#show-login-modal', function (e) { e.preventDefault(); showLoginModal(); });

    // Password visibility toggles
    $(document).on('click', '#toggle-login-password', function () {
      var input = $('#login-password');
      var icon = $('#login-eye-icon');
      if (input.attr('type') === 'password') { input.attr('type', 'text'); icon.removeClass('bi-eye').addClass('bi-eye-slash'); }
      else { input.attr('type', 'password'); icon.removeClass('bi-eye-slash').addClass('bi-eye'); }
    });
    $(document).on('click', '#toggle-signup-password', function () {
      var input = $('#signup-password');
      var icon = $('#signup-eye-icon');
      if (input.attr('type') === 'password') { input.attr('type', 'text'); icon.removeClass('bi-eye').addClass('bi-eye-slash'); }
      else { input.attr('type', 'password'); icon.removeClass('bi-eye-slash').addClass('bi-eye'); }
    });
    $(document).on('click', '#toggle-signup-confirm', function () {
      var input = $('#signup-password-confirm');
      var icon = $('#signup-confirm-icon');
      if (input.attr('type') === 'password') { input.attr('type', 'text'); icon.removeClass('bi-eye').addClass('bi-eye-slash'); }
      else { input.attr('type', 'password'); icon.removeClass('bi-eye-slash').addClass('bi-eye'); }
    });

    // Forgot Password modal open
    $(document).on('click', '#forgot-password-link', function (e) {
      e.preventDefault();
      hideLoginModal();
      var $m = $('#forgot-modal');
      if ($m.length) {
        $m.removeClass('d-none').addClass('show').css('display', 'block').attr('aria-hidden', 'false');
        if ($('.modal-backdrop.show').length === 0) { $('<div class="modal-backdrop fade show"></div>').appendTo(document.body); }
        $('body').addClass('modal-open');
        $('#forgot-email').focus();
      } else {
        alert('Enter your email and we\'ll send you a reset link.');
      }
    });

    // Forgot Password modal close
    function hideForgotModal() {
      var $m = $('#forgot-modal');
      $m.removeClass('show').addClass('d-none').css('display', 'none').attr('aria-hidden', 'true');
      $('.modal-backdrop').remove();
      $('body').removeClass('modal-open');
      var form = document.getElementById('forgot-form'); if (form) form.reset();
      $('#forgot-feedback').hide().removeClass('alert-danger alert-success alert-info');
      $('#forgot-email').removeClass('is-invalid');
    }
    $(document).on('click', '#forgot-close, #forgot-cancel', hideForgotModal);
    $(document).on('click', '#forgot-modal', function (e) { if (e.target.id === 'forgot-modal') hideForgotModal(); });
    $(document).on('keydown', function (e) { if (e.key === 'Escape' && !$('#forgot-modal').hasClass('d-none')) hideForgotModal(); });

    // From Forgot back to Login
    $(document).on('click', '#show-login-from-forgot', function (e) { e.preventDefault(); hideForgotModal(); showLoginModal(); });

    // Forgot Password submit handler with account existence validation
    $(document).on('submit', '#forgot-form', function (e) {
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
        url: '../api/users.php?action=check-email&email=' + encodeURIComponent(email),
        method: 'GET',
        dataType: 'json',
        timeout: 5000,
        success: function (response) {
          if (response && response.exists) {
            $feedback.removeClass('alert-info').addClass('alert-success')
              .html('<i class="bi bi-check-circle me-1"></i>We found an account for <strong>' + email + '</strong>. A reset link has been sent (demo).').show();
            setTimeout(function () { hideForgotModal(); showLoginModal(); $('#login-email').val(email).focus(); }, 1200);
          } else {
            $feedback.removeClass('alert-info').addClass('alert-danger')
              .html('<i class="bi bi-exclamation-triangle me-1"></i>No account found for <strong>' + email + '</strong>.').show();
          }
        },
        error: function () {
          $feedback.removeClass('alert-info').addClass('alert-danger')
            .html('<i class="bi bi-exclamation-triangle me-1"></i>Unable to check account. Please try again later.').show();
        },
        complete: function () { setTimeout(function () { $submit.prop('disabled', false); }, 400); }
      });
    });

    // Legacy create account link (now handled by modal switching)
    $(document).on('click', '#create-account-link', function (e) { e.preventDefault(); showSignupModal(); });

    // Backdrop click closes
    $(document).on('click', '#login-modal', function (e) { if (e.target.id === 'login-modal') hideLoginModal(); });
    $(document).on('click', '#signup-modal', function (e) { if (e.target.id === 'signup-modal') hideSignupModal(); });

    // ESC key closes login/signup modals
    $(document).on('keydown', function (e) {
      if (e.key === 'Escape') {
        if (!loginModal().hasClass('d-none')) hideLoginModal();
        if (!signupModal().hasClass('d-none')) hideSignupModal();
      }
    });

    // Login form submit (validate and authenticate)
    $(document).on('submit', '#login-form', function (e) {
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

      // Get guest session ID from cookie to send with login (for cart merge)
      function getGuestSessionId() {
        var match = document.cookie.match(/eshop_session_id=([^;]+)/);
        return match ? decodeURIComponent(match[1]) : null;
      }
      var guestSessionId = getGuestSessionId();

      $.ajax({
        url: '../api/users.php?action=login',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
          email: email,
          password: pw,
          guest_session_id: guestSessionId
        }),
        dataType: 'json',
        xhrFields: { withCredentials: true },
        timeout: 5000,
        success: function (response) {
          if (response && response.success && response.user) {
            var userName = response.user.first_name + ' ' + response.user.last_name;
            $('#login-feedback').text('Welcome, ' + response.user.first_name + '!').removeClass('text-info').addClass('text-success').show();
            setLoggedIn(response.user);
            setTimeout(function () {
              hideLoginModal();
              // Check if there was a checkout intent
              var intent = null;
              try { intent = localStorage.getItem('eshop_intent'); } catch (e) { }
              if (intent === 'checkout') {
                try { localStorage.removeItem('eshop_intent'); } catch (e) { }
                window.location.href = '/checkout';
              } else {
                // Reload page to fetch fresh merged cart from server
                window.location.reload();
              }
            }, 800);
          } else {
            $('#login-feedback').text(response.error || 'Invalid email or password. Please try again.').removeClass('text-info').addClass('text-danger').show();
          }
        },
        error: function (xhr) {
          var errorMsg = 'Unable to sign in. Please check your connection and try again.';
          try {
            var response = JSON.parse(xhr.responseText);
            if (response && response.error) {
              errorMsg = response.error;
            }
          } catch (e) { }
          $('#login-feedback').text(errorMsg).removeClass('text-info').addClass('text-danger').show();
        },
        complete: function () { setTimeout(function () { $btn.prop('disabled', false).text('Sign in'); }, 500); }
      });
    });

    // Signup form validation
    $(document).on('input', '#signup-password-confirm', function () {
      var password = $('#signup-password').val();
      var confirm = $(this).val();
      if (confirm && password !== confirm) {
        $(this).addClass('is-invalid');
      } else {
        $(this).removeClass('is-invalid');
      }
    });

    // Real-time phone validation
    $(document).on('input', '#signup-phone', function () {
      var phone = $(this).val().trim();
      var cleanPhone = phone.replace(/[\s\-\(\)\.]/g, '');
      if (phone.length > 0) {
        if (!/^\d{7,15}$/.test(cleanPhone)) { // Allow 7-15 digits for international numbers
          $(this).addClass('is-invalid');
        } else {
          $(this).removeClass('is-invalid');
        }
      } else {
        $(this).removeClass('is-invalid'); // Optional field, so no validation needed when empty
      }
    });

    // Signup form submission
    $(document).on('submit', '#signup-form', function (e) {
      e.preventDefault();
      var firstName = ($('#signup-first-name').val() || '').replace(/\s+$/, '');
      var middleName = ($('#signup-middle-name').val() || '').replace(/\s+$/, '');
      var lastName = ($('#signup-last-name').val() || '').replace(/\s+$/, '');
      var email = $('#signup-email').val().trim();
      var address1 = ($('#signup-address1').val() || '').replace(/\s+$/, '');
      var address2 = ($('#signup-address2').val() || '').replace(/\s+$/, '');
      var countryCode = $('#signup-country-code').val() || '+64';
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

      // Validate address1 (required)
      if (address1.length < 3) {
        $('#signup-address1').addClass('is-invalid');
        valid = false;
      }

      // Validate phone number (optional, but if provided should be valid)
      if (phone.length > 0) {
        var cleanPhone = phone.replace(/[\s\-\(\)\.]/g, ''); // Remove spaces, dashes, parentheses, dots
        if (!/^\d{7,15}$/.test(cleanPhone)) { // Allow 7-15 digits for international numbers
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

      console.log('Sending signup request...', {
        first_name: firstName,
        last_name: lastName,
        email: email
      });

      // Send signup request to API
      $.ajax({
        url: '../api/users.php?action=signup',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
          first_name: firstName,
          middle_name: middleName,
          last_name: lastName,
          email: email,
          password: password,
          address1: address1,
          address2: address2,
          country_code: countryCode,
          phone: phone
        }),
        dataType: 'json',
        timeout: 5000,
        success: function (response) {
          console.log('Signup success:', response);
          if (response && response.success) {
            $('#signup-feedback').removeClass('alert-info').addClass('alert-success')
              .html('<i class="bi bi-check-circle me-1"></i>Account created successfully! You can now sign in.')
              .show();

            setTimeout(function () {
              hideSignupModal();
              showLoginModal();
              $('#login-email').val(email);
              $('#login-password').focus();
            }, 2000);
          } else {
            $('#signup-feedback').removeClass('alert-info').addClass('alert-danger')
              .html('<i class="bi bi-exclamation-triangle me-1"></i>' + (response.error || 'Unable to create account.'))
              .show();
          }
        },
        error: function (xhr) {
          console.error('Signup error:', xhr.status, xhr.responseText);
          var errorMsg = 'Unable to create account. Please try again later.';
          try {
            var response = JSON.parse(xhr.responseText);
            if (response && response.error) {
              errorMsg = response.error;
            }
          } catch (e) {
            console.error('Error parsing response:', e);
          }
          $('#signup-feedback').removeClass('alert-info').addClass('alert-danger')
            .html('<i class="bi bi-exclamation-triangle me-1"></i>' + errorMsg)
            .show();
        },
        complete: function () {
          $('#signup-form button[type="submit"]').prop('disabled', false);
        }
      });
    });

    // restore session state from localStorage
    var userData = null;
    try { userData = JSON.parse(localStorage.getItem('eshop_user') || 'null'); } catch (e) { }
    if (userData && userData.session_token) {
      setLoggedIn(userData);
    }
  }

  // Expose LoginHandler globally so app.js can initialize it after modals are loaded
  window.LoginHandler = {
    init: init,
    showLoginModal: showLoginModal,
    hideLoginModal: hideLoginModal,
    showSignupModal: showSignupModal,
    hideSignupModal: hideSignupModal,
    showSignoutModal: function () {
      // Re-use existing logic logic from openBtn click handler
      var sessionToken = null;
      try {
        var user = JSON.parse(localStorage.getItem('eshop_user') || 'null');
        sessionToken = user?.session_token;
      } catch (e) { }

      if (sessionToken) {
        var userEmail = '';
        try {
          var user = JSON.parse(localStorage.getItem('eshop_user') || 'null');
          userEmail = user?.email || 'User';
        } catch (e) { }

        $('#signout-identity').text(userEmail);
        var $m = $('#signout-modal');
        if ($m.length) {
          $m.removeClass('d-none').addClass('show').css('display', 'block').attr('aria-hidden', 'false');
          if ($('.modal-backdrop.show').length === 0) {
            $('<div class="modal-backdrop fade show"></div>').appendTo(document.body);
          }
          $('body').addClass('modal-open');
        } else {
          // Fallback if modal doesn't exist
          if (confirm('Sign out ' + userEmail + '?')) { setLoggedOut(); }
        }
      } else {
        // Not logged in, so just show login modal
        showLoginModal();
      }
    }
  };

  // Only auto-initialize if modals already exist (fallback for pages that don't use components)
  $(document).ready(function () {
    if ($('#login-modal').length && $('#signup-modal').length) {
      init();
    }
  });
})(window, window.jQuery);
