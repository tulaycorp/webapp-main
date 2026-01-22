# Webapp Main - Streetwear E-Commerce Store

A Laravel-based e-commerce storefront for streetwear products.

## Overview

This is the main customer-facing storefront application that handles:
- Product catalog browsing
- Shopping cart functionality
- Order placement and checkout
- User authentication

**Related Project:** [webapp-admin-panel](../webapp-admin-panel) - Admin dashboard for managing products, orders, and customers.

## Requirements

- PHP 8.2+
- Composer
- MySQL 8.0+
- Node.js 18+ (for frontend assets)

## Quick Start

### 1. Install Dependencies

```bash
composer install
npm install
```

### 2. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Configure Database

Update `.env` with your MySQL credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=webapp_store
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Initialize Database

**Full setup with sample data:**
```bash
php artisan migrate:fresh --seed
```

**Essentials only (no sample products/categories):**
```bash
php artisan migrate:fresh-essentials
```

### 5. Build Frontend Assets

```bash
npm run dev
```

### 6. Start the Server

```bash
php artisan serve --port=8000
```

Visit: http://localhost:8000

## Project Structure

```
webapp-main/
├── app/
│   ├── Http/Controllers/    # Request handlers
│   ├── Models/              # Eloquent models
│   └── Services/            # Business logic
├── database/
│   ├── migrations/          # Database schema
│   └── seeders/             # Sample data
├── resources/
│   ├── views/               # Blade templates
│   ├── css/                 # Stylesheets
│   └── js/                  # JavaScript
└── routes/
    ├── web.php              # Web routes
    ├── api.php              # Public API routes
    └── api_admin.php        # Admin API routes
```

## Database Schema

| Table | Description |
|-------|-------------|
| `users` | Customer accounts |
| `categories` | Product categories |
| `products` | Product catalog |
| `orders` | Customer orders |
| `order_items` | Order line items |
| `carts` | Shopping carts |
| `cart_items` | Cart contents |

## API Endpoints

### Public API (`/api`)
- `GET /products` - List products
- `GET /products/{id}` - Get product details
- `GET /categories` - List categories

### Admin API (`/api/admin`)
- Full CRUD for products, orders, categories
- Used by the admin panel application

## Admin Credentials

```
Email: admin@example.com
Password: password
```

## Running with Admin Panel

Both applications share the same MySQL database. Run them on different ports:

```bash
# Terminal 1 - Main Store
cd webapp-main
php artisan serve --port=8000

# Terminal 2 - Admin Panel  
cd webapp-admin-panel
php artisan serve --port=8001
```

## Tech Stack

- **Backend:** Laravel 12, PHP 8.2
- **Frontend:** Blade, Tailwind CSS, Vite
- **Database:** MySQL 8.0
- **API:** RESTful JSON

## License

MIT License
