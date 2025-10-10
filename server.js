// Simple Auth Server for webapp-main
// Endpoints:
// POST /api/auth/register { name, email, password, ... }
// POST /api/auth/login { email, password }
// GET  /api/auth/me (Authorization: Bearer <token>)
// GET  /api/auth/exists?email=...

const express = require('express');
const cors = require('cors');
const fs = require('fs');
const fsp = require('fs/promises');
const path = require('path');
const jwt = require('jsonwebtoken');
const bcrypt = require('bcryptjs');

const app = express();
const PORT = process.env.PORT || 4000;
const JWT_SECRET = process.env.JWT_SECRET || 'dev-secret-change-me';
const USERS_FILE = path.join(__dirname, 'users.json');

app.use(cors({ origin: '*'}));
app.use(express.json());

// Ensure users.json exists
function ensureUsersFile(){
  if (!fs.existsSync(USERS_FILE)){
    fs.writeFileSync(USERS_FILE, JSON.stringify({ users: [] }, null, 2), 'utf8');
  }
}

async function readUsers(){
  ensureUsersFile();
  const raw = await fsp.readFile(USERS_FILE, 'utf8');
  try { return JSON.parse(raw); } catch { return { users: [] }; }
}

async function writeUsers(data){
  await fsp.writeFile(USERS_FILE, JSON.stringify(data, null, 2), 'utf8');
}

function toPublicUser(user){
  const { password, ...rest } = user;
  return rest;
}

function signToken(user){
  return jwt.sign({ sub: user.email, role: user.role || 'user', name: user.name || '' }, JWT_SECRET, { expiresIn: '7d' });
}

app.get('/api/health', (req, res) => {
  res.json({ ok: true, service: 'auth', time: new Date().toISOString() });
});

// Check if email exists
app.get('/api/auth/exists', async (req, res) => {
  const email = (req.query.email || '').toString().trim().toLowerCase();
  if (!email) return res.status(400).json({ error: 'email required' });
  const data = await readUsers();
  const exists = (data.users || []).some(u => (u.email || '').toLowerCase() === email);
  res.json({ exists });
});

// Register
app.post('/api/auth/register', async (req, res) => {
  const { email, password, name, firstName, lastName, role, ...profile } = req.body || {};
  const cleanEmail = (email || '').toString().trim().toLowerCase();
  const pwd = (password || '').toString();
  const displayName = name || [firstName, lastName].filter(Boolean).join(' ').trim();
  if (!cleanEmail || !pwd || pwd.length < 6 || !displayName) {
    return res.status(400).json({ error: 'Invalid input' });
  }
  const data = await readUsers();
  const users = data.users || [];
  const exists = users.some(u => (u.email || '').toLowerCase() === cleanEmail);
  if (exists) return res.status(409).json({ error: 'Email already registered' });

  const hash = await bcrypt.hash(pwd, 10);
  const newUser = {
    email: cleanEmail,
    password: hash,
    name: displayName,
    role: role || 'user',
    ...profile
  };
  users.push(newUser);
  await writeUsers({ users });
  const token = signToken(newUser);
  res.status(201).json({ token, user: toPublicUser(newUser) });
});

// Login
app.post('/api/auth/login', async (req, res) => {
  const { email, password } = req.body || {};
  const cleanEmail = (email || '').toString().trim().toLowerCase();
  const pwd = (password || '').toString();
  if (!cleanEmail || !pwd) return res.status(400).json({ error: 'Invalid credentials' });
  const data = await readUsers();
  const users = data.users || [];
  const idx = users.findIndex(u => (u.email || '').toLowerCase() === cleanEmail);
  if (idx === -1) return res.status(401).json({ error: 'Invalid email or password' });
  const user = users[idx];

  // Determine if stored password is bcrypt hash
  const stored = user.password || '';
  const looksHashed = typeof stored === 'string' && /^\$2[aby]\$\d{2}\$/.test(stored);
  let ok = false;
  if (looksHashed) {
    ok = await bcrypt.compare(pwd, stored);
  } else {
    // Legacy plaintext support
    ok = stored === pwd;
    if (ok) {
      // Migrate to bcrypt
      try {
        const newHash = await bcrypt.hash(pwd, 10);
        users[idx] = { ...user, password: newHash };
        await writeUsers({ users });
      } catch (e) {
        // Non-fatal
      }
    }
  }
  if (!ok) return res.status(401).json({ error: 'Invalid email or password' });
  const token = signToken(user);
  res.json({ token, user: toPublicUser(user) });
});

// Me
app.get('/api/auth/me', async (req, res) => {
  const hdr = req.headers.authorization || '';
  const m = hdr.match(/^Bearer\s+(.+)$/i);
  if (!m) return res.status(401).json({ error: 'Missing token' });
  try {
    const payload = jwt.verify(m[1], JWT_SECRET);
    const data = await readUsers();
    const user = (data.users || []).find(u => (u.email || '').toLowerCase() === (payload.sub || '').toLowerCase());
    if (!user) return res.status(404).json({ error: 'User not found' });
    res.json({ user: toPublicUser(user) });
  } catch (e) {
    res.status(401).json({ error: 'Invalid token' });
  }
});

app.listen(PORT, () => {
  console.log(`[auth-server] listening on http://localhost:${PORT}`);
});
