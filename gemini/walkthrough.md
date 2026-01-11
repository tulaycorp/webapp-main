# Walkthrough - Fix Guest Cart Merge

## Changes
The guest cart was not being merged into the user cart upon login because the `eshop_session_id` cookie was set to `HttpOnly`. This prevented the JavaScript frontend from reading the guest session ID and sending it to the login API.

### `app/Services/CartService.php`
- Updated `ensureGuestIdCookie` and `resetGuestSession` methods.
- Changed `Cookie::queue` to explicitly set `httpOnly` to `false`.

```php
// Before
Cookie::queue('eshop_session_id', $guestId, 60 * 24 * 30);

// After
Cookie::queue('eshop_session_id', $guestId, 60 * 24 * 30, null, null, null, false);
```

## Verification Results
1. **Guest Session**: Added 3 items (Bomber Jacket, Cargo Joggers, Oversized Logo Hoodie).
2. **Login**: Logged in as existing user with 2 items (Crossbody Bag, Five Panel Cap).
3. **Merge**: Server response showed 5 items total, confirming successful merge.
4. **Logout/Reset**: Confirmed session reset works correctly.

## Conclusion
The cart merge functionality is now working as expected.
