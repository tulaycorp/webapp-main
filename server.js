const express = require('express');
const path = require('path');
const cors = require('cors');
const fs = require('fs').promises;

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(express.static('public'));

// Sample product catalog (in a real app, this would be in a database)
const CATALOG = [
  { id: 'chair-1', name: 'Elegant Chair', price: 99, category: 'Furniture', featured: true, img: 'https://picsum.photos/300/200?chair' },
  { id: 'lamp-1', name: 'Smart Lamp', price: 49, category: 'Lighting', featured: true, img: 'https://picsum.photos/300/200?lamp' },
  { id: 'desk-1', name: 'Modern Desk', price: 199, category: 'Furniture', featured: true, img: 'https://picsum.photos/300/200?desk' },
  { id: 'headphones-1', name: 'Wireless Headphones', price: 149, category: 'Electronics', featured: false, img: 'https://picsum.photos/300/200?headphones' },
  { id: 'plant-1', name: 'Decorative Plant', price: 25, category: 'Decor', featured: false, img: 'https://picsum.photos/300/200?plant' },
  { id: 'mug-1', name: 'Ceramic Mug', price: 15, category: 'Kitchen', featured: false, img: 'https://picsum.photos/300/200?mug' },
  { id: 'notebook-1', name: 'Premium Notebook', price: 12, category: 'Stationery', featured: false, img: 'https://picsum.photos/300/200?notebook' },
  { id: 'backpack-1', name: 'Urban Backpack', price: 89, category: 'Accessories', featured: false, img: 'https://picsum.photos/300/200?backpack' },
  { id: 'bottle-1', name: 'Steel Water Bottle', price: 29, category: 'Accessories', featured: false, img: 'https://picsum.photos/300/200?bottle' }
];

// In-memory storage for demo (use a real database in production)
let users = [];
let sessions = new Map();

// Load users from file if it exists
const loadUsers = async () => {
  try {
    const data = await fs.readFile('users.json', 'utf8');
    users = JSON.parse(data);
  } catch (error) {
    console.log('No existing users file, starting with empty user list');
  }
};

// Save users to file
const saveUsers = async () => {
  try {
    await fs.writeFile('users.json', JSON.stringify(users, null, 2));
  } catch (error) {
    console.error('Error saving users:', error);
  }
};

// API Routes

// Get all products
app.get('/api/products', (req, res) => {
  const { category, search, sort, featured } = req.query;
  
  let filteredProducts = [...CATALOG];
  
  // Filter by category
  if (category) {
    filteredProducts = filteredProducts.filter(p => p.category === category);
  }
  
  // Filter by search term
  if (search) {
    const searchTerm = search.toLowerCase();
    filteredProducts = filteredProducts.filter(p => 
      p.name.toLowerCase().includes(searchTerm)
    );
  }
  
  // Filter by featured
  if (featured === 'true') {
    filteredProducts = filteredProducts.filter(p => p.featured);
  }
  
  // Sort products
  switch (sort) {
    case 'price-asc':
      filteredProducts.sort((a, b) => a.price - b.price);
      break;
    case 'price-desc':
      filteredProducts.sort((a, b) => b.price - a.price);
      break;
    case 'alpha':
      filteredProducts.sort((a, b) => a.name.localeCompare(b.name));
      break;
    default:
      filteredProducts.sort((a, b) => (b.featured ? 1 : 0) - (a.featured ? 1 : 0));
  }
  
  res.json(filteredProducts);
});

// Get single product
app.get('/api/products/:id', (req, res) => {
  const product = CATALOG.find(p => p.id === req.params.id);
  if (!product) {
    return res.status(404).json({ error: 'Product not found' });
  }
  res.json(product);
});

// Get categories
app.get('/api/categories', (req, res) => {
  const categories = [...new Set(CATALOG.map(p => p.category))].sort();
  res.json(categories);
});

// User registration
app.post('/api/auth/register', async (req, res) => {
  const { name, email, password } = req.body;
  
  if (!name || !email || !password) {
    return res.status(400).json({ error: 'Name, email, and password are required' });
  }
  
  // Check if user already exists
  if (users.find(u => u.email === email)) {
    return res.status(400).json({ error: 'User already exists with this email' });
  }
  
  // Create new user (in production, hash the password!)
  const newUser = {
    id: Date.now().toString(),
    name,
    email,
    password, // In production, use bcrypt to hash this
    role: 'user',
    createdAt: new Date().toISOString()
  };
  
  users.push(newUser);
  await saveUsers();
  
  // Don't send password back
  const { password: _, ...userResponse } = newUser;
  res.status(201).json({ user: userResponse });
});

// User login
app.post('/api/auth/login', (req, res) => {
  const { email, password } = req.body;
  
  if (!email || !password) {
    return res.status(400).json({ error: 'Email and password are required' });
  }
  
  const user = users.find(u => u.email === email && u.password === password);
  if (!user) {
    return res.status(401).json({ error: 'Invalid credentials' });
  }
  
  // Create session (in production, use proper JWT or session management)
  const sessionId = Date.now().toString();
  sessions.set(sessionId, { userId: user.id, email: user.email });
  
  const { password: _, ...userResponse } = user;
  res.json({ user: userResponse, sessionId });
});

// Contact form submission
app.post('/api/contact', (req, res) => {
  const { name, email, message } = req.body;
  
  if (!name || !email || !message) {
    return res.status(400).json({ error: 'Name, email, and message are required' });
  }
  
  // In a real app, you'd save this to a database or send an email
  console.log('Contact form submission:', { name, email, message, timestamp: new Date().toISOString() });
  
  res.json({ success: true, message: 'Thank you for your message! We\'ll get back to you soon.' });
});

// Serve HTML pages
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

app.get('/products', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'products.html'));
});

app.get('/cart', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'cart.html'));
});

app.get('/about', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'about.html'));
});

app.get('/contact', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'contact.html'));
});

// Initialize and start server
const startServer = async () => {
  await loadUsers();
  
  app.listen(PORT, () => {
    console.log(`🚀 Server running on http://localhost:${PORT}`);
    console.log(`📁 Serving static files from 'public' directory`);
    console.log(`🛍️  E-commerce API available at /api/*`);
  });
};

startServer();