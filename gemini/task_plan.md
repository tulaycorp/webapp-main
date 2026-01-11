# Task Plan: Fix Guest Cart Merge on Login

## Goal
Ensure that items in the guest cart are correctly merged into the user's persistent cart when they log in.

## Phases
- [x] Phase 1: Analyze current implementation (Frontend & Backend)
- [x] Phase 2: Identify the root cause of the merge failure
- [x] Phase 3: Implement the fix
- [x] Phase 4: Verify the fix

## Key Questions
1. How is the guest session ID passed to the login API? -> Retrieved from `eshop_session_id` cookie.
2. Does `CartMergeService` receive the correct guest ID? -> Yes, now that cookie is accessible to JS.
3. Is `CartMergeService` correctly identifying the guest cart and the user cart? -> Yes.
4. Is the merge logic (updating rows in DB) working as expected? -> Yes, verified by logs.

## Decisions Made
- We must disable `HttpOnly` for the `eshop_session_id` cookie so the frontend can read it and send it during login.
- Modified `CartService::ensureGuestIdCookie` and `resetGuestSession` to set `httpOnly` false.

## Errors Encountered
- Logs showed `"guest_session_id":null` initially.
- Fixed by allowing JS access to the cookie.

## Status
Task Complete.
