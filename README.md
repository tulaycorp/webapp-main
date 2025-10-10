# Webapp Auth Server Setup

This project now includes a minimal Node/Express auth server with JWT to back user login and signup.

## Run locally (Windows PowerShell)

```powershell
# install deps
npm install

# build CSS (optional for UI)
npm run build

# start the auth server on http://localhost:4000
npm start

# for auto-reload during development
npm run dev
```

The frontend JS points to `http://localhost:4000` for auth by default.

## Endpoints

- POST /api/auth/register { name, email, password, ... } -> { token, user }
- POST /api/auth/login { email, password } -> { token, user }
- GET  /api/auth/me (Authorization: Bearer <token>) -> { user }
- GET  /api/auth/exists?email=... -> { exists: boolean }

Users are stored in `users.json` with bcrypt-hashed passwords. For production, use a real database and set `JWT_SECRET`.

## Frontend changes

- Login modal sends credentials to `/api/auth/login` and stores a JWT in `localStorage` as `eshop_token`.
- Signup modal calls `/api/auth/register` and auto-signs in on success.
- Sign out clears `eshop_token` and user info.

If you deploy the server elsewhere, update `API_BASE` in `scripts/login.js` and `scripts/auth.js`.

## Troubleshooting

- CORS: The server allows all origins for local development.
- Port conflicts: Set `PORT=5000` in your env then visit `http://localhost:5000` (update API_BASE accordingly).
- Invalid token: Clear localStorage or sign in again.
