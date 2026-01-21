-- =============================================================================
-- Database Initialization Script
-- For: webapp-main & webapp-admin-panel (Shared MySQL Database)
-- Generated: January 19, 2026 (Updated to match actual schema)
-- =============================================================================
-- 
-- Usage:
--   mysql -u root -p < init.sql
--   OR import via phpMyAdmin/MySQL Workbench
--
-- This script creates a fresh database with all tables needed for both
-- the main webapp and admin panel applications.
-- =============================================================================

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS `webapp_db` 
    CHARACTER SET utf8mb4 
    COLLATE utf8mb4_unicode_ci;

USE `webapp_db`;

-- =============================================================================
-- Drop existing tables (in correct order due to foreign keys)
-- =============================================================================
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `cart_items`;
DROP TABLE IF EXISTS `carts`;
DROP TABLE IF EXISTS `product_images`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `order_items`;
DROP TABLE IF EXISTS `admin_sessions`;
DROP TABLE IF EXISTS `personal_access_tokens`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `migrations`;

SET FOREIGN_KEY_CHECKS = 1;

-- =============================================================================
-- Laravel Migrations Table
-- =============================================================================
CREATE TABLE `migrations` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `migration` VARCHAR(255) NOT NULL,
    `batch` INT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Users Table (Custom Schema)
-- =============================================================================
CREATE TABLE `users` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(255) NOT NULL,
    `middle_name` VARCHAR(255) NULL DEFAULT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    `address1` TEXT NULL DEFAULT NULL,
    `address2` TEXT NULL DEFAULT NULL,
    `country_code` VARCHAR(10) NULL DEFAULT NULL,
    `phone` VARCHAR(50) NULL DEFAULT NULL,
    `role` VARCHAR(50) NOT NULL DEFAULT 'customer',
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`),
    KEY `idx_email` (`email`),
    KEY `idx_role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Admins Table
-- =============================================================================
CREATE TABLE `admins` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NULL DEFAULT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    `remember_token` VARCHAR(100) NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Admin Sessions Table
-- =============================================================================
CREATE TABLE `admin_sessions` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `admin_id` BIGINT UNSIGNED NOT NULL,
    `session_token` VARCHAR(255) NOT NULL,
    `expires_at` TIMESTAMP NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `session_token` (`session_token`),
    KEY `admin_id` (`admin_id`),
    KEY `expires_at` (`expires_at`),
    CONSTRAINT `admin_sessions_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Personal Access Tokens Table (Laravel Sanctum style)
-- =============================================================================
CREATE TABLE `personal_access_tokens` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `tokenable_type` VARCHAR(255) NOT NULL,
    `tokenable_id` BIGINT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `token` VARCHAR(64) NOT NULL,
    `abilities` TEXT NULL DEFAULT NULL,
    `last_used_at` TIMESTAMP NULL DEFAULT NULL,
    `expires_at` TIMESTAMP NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
    KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`, `tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Categories Table
-- =============================================================================
CREATE TABLE `categories` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `description` TEXT NULL DEFAULT NULL,

  
    `sort_order` INT NOT NULL DEFAULT 0,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Products Table (String ID, Shopify-style fields)
-- =============================================================================
CREATE TABLE `products` (
    `id` VARCHAR(255) NOT NULL,
    `sku` VARCHAR(255) NULL DEFAULT NULL,
    `barcode` VARCHAR(255) NULL DEFAULT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT NULL DEFAULT NULL,
    `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `compare_at_price` DECIMAL(10,2) NULL DEFAULT NULL,
    `cost_per_item` DECIMAL(10,2) NULL DEFAULT NULL,
    `stock_quantity` INT NOT NULL DEFAULT 0,
    `track_inventory` TINYINT(1) NOT NULL DEFAULT 1,
    `continue_selling_when_out_of_stock` TINYINT(1) NOT NULL DEFAULT 0,
    `featured` TINYINT(1) NOT NULL DEFAULT 0,
    `status` ENUM('active','draft','archived') NOT NULL DEFAULT 'active',
    `category` VARCHAR(255) NULL DEFAULT NULL,
    `category_id` BIGINT UNSIGNED NULL DEFAULT NULL,
    `vendor` VARCHAR(255) NULL DEFAULT NULL,
    `product_type` VARCHAR(255) NULL DEFAULT NULL,
    `tags` TEXT NULL DEFAULT NULL,
    `image_url` TEXT NULL DEFAULT NULL,
    `images` LONGTEXT NULL DEFAULT NULL CHECK (json_valid(`images`)),
    `weight` DECIMAL(10,3) NULL DEFAULT NULL,
    `weight_unit` ENUM('kg','g','lb','oz') NOT NULL DEFAULT 'kg',
    `requires_shipping` TINYINT(1) NOT NULL DEFAULT 1,
    `length` DECIMAL(10,2) NULL DEFAULT NULL,
    `width` DECIMAL(10,2) NULL DEFAULT NULL,
    `height` DECIMAL(10,2) NULL DEFAULT NULL,
    `dimension_unit` ENUM('cm','in','m') NOT NULL DEFAULT 'cm',
    `taxable` TINYINT(1) NOT NULL DEFAULT 1,
    `tax_code` VARCHAR(255) NULL DEFAULT NULL,
    `seo_title` VARCHAR(255) NULL DEFAULT NULL,
    `seo_description` TEXT NULL DEFAULT NULL,
    `metafields` LONGTEXT NULL DEFAULT NULL CHECK (json_valid(`metafields`)),
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `products_sku_unique` (`sku`),
    KEY `products_category_id_index` (`category_id`),
    KEY `products_status_index` (`status`),
    KEY `products_sku_index` (`sku`),
    KEY `products_stock_quantity_index` (`stock_quantity`),
    KEY `products_featured_index` (`featured`),
    KEY `products_vendor_index` (`vendor`),
    KEY `products_barcode_index` (`barcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Product Images Table
-- =============================================================================
CREATE TABLE `product_images` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `product_id` VARCHAR(255) NOT NULL,
    `url` VARCHAR(255) NOT NULL,
    `alt_text` VARCHAR(255) NULL DEFAULT NULL,
    `position` INT NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `product_images_product_id_index` (`product_id`),
    CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Orders Table
-- =============================================================================
CREATE TABLE `orders` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT UNSIGNED NULL DEFAULT NULL,
    `order_number` VARCHAR(255) NOT NULL,
    `status` ENUM('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
    `subtotal` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `tax` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `shipping` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `total` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `shipping_first_name` VARCHAR(255) NULL DEFAULT NULL,
    `shipping_last_name` VARCHAR(255) NULL DEFAULT NULL,
    `shipping_email` VARCHAR(255) NULL DEFAULT NULL,
    `shipping_phone` VARCHAR(255) NULL DEFAULT NULL,
    `shipping_address1` TEXT NULL DEFAULT NULL,
    `shipping_address2` TEXT NULL DEFAULT NULL,
    `shipping_city` VARCHAR(255) NULL DEFAULT NULL,
    `shipping_state` VARCHAR(255) NULL DEFAULT NULL,
    `shipping_zip` VARCHAR(255) NULL DEFAULT NULL,
    `shipping_country` VARCHAR(255) NULL DEFAULT NULL,
    `notes` TEXT NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `orders_order_number_unique` (`order_number`),
    KEY `orders_user_id_index` (`user_id`),
    KEY `orders_status_index` (`status`),
    KEY `orders_created_at_index` (`created_at`),
    KEY `orders_status_created_at_index` (`status`, `created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Order Items Table
-- =============================================================================
CREATE TABLE `order_items` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `order_id` BIGINT UNSIGNED NOT NULL,
    `product_id` VARCHAR(255) NULL DEFAULT NULL,
    `product_name` VARCHAR(255) NOT NULL,
    `product_price` DECIMAL(10, 2) NOT NULL,
    `quantity` INT NOT NULL,
    `total` DECIMAL(10, 2) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `order_items_order_id_index` (`order_id`),
    KEY `order_items_product_id_index` (`product_id`),
    CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
    CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Shopping Carts Table
-- =============================================================================
CREATE TABLE `carts` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NULL DEFAULT NULL,
    `session_id` TEXT NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `carts_user_id_unique` (`user_id`),
    KEY `carts_user_id_index` (`user_id`),
    KEY `carts_session_id_index` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Cart Items Table
-- =============================================================================
CREATE TABLE `cart_items` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `cart_id` BIGINT UNSIGNED NOT NULL,
    `product_id` VARCHAR(255) NOT NULL,
    `quantity` INT NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `cart_items_cart_id_product_id_unique` (`cart_id`, `product_id`),
    KEY `cart_items_product_id_index` (`product_id`),
    CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Record Migrations as Completed
-- =============================================================================
INSERT INTO `migrations` (`migration`, `batch`) VALUES
    ('0001_01_01_000000_create_users_table', 1),
    ('0001_01_01_000001_create_cache_table', 1),
    ('0001_01_01_000002_create_jobs_table', 1),
    ('2026_01_10_000001_create_orders_table', 1),
    ('2026_01_10_000002_create_order_items_table', 1),
    ('2026_01_10_000003_create_categories_table', 1),
    ('2026_01_10_000004_add_shopify_fields_to_products', 1),
    ('2026_01_10_190500_add_performance_indexes', 1),
    ('2026_01_10_220345_create_carts_and_items_table', 1),
    ('2026_01_11_160000_add_cart_unique_constraints', 1),
    ('2026_01_19_000001_sync_products_category_to_category_id', 1),
    ('2026_01_19_000002_add_full_product_metadata', 1),
    ('2026_01_19_131124_add_images_to_products', 1),
    ('2026_01_22_000000_create_admins_table', 1),
    ('2026_01_22_000001_update_admin_sessions_foreign_key', 1);

-- =============================================================================
-- Default Admin User (password: 'password')
-- =============================================================================
INSERT INTO `admins` (`first_name`, `last_name`, `email`, `password_hash`, `created_at`, `updated_at`) VALUES
    ('Admin', 'User', 'admin@email.com', '$2y$12$Kq3hG7pJ.kFz8A1xCwE5YOfiSz5nR8J1V0K2m9QxT6L4wN3pY.abc', NOW(), NOW());

-- =============================================================================
-- Sample Categories
-- =============================================================================
INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
    (1, 'Hoodies', 'hoodies', 'Premium heavy weight cotton hoodies.', 0, 1, '2023-10-01 12:00:00', '2023-10-01 12:00:00'),
(2, 'T-Shirts', 't-shirts', 'Boxy fit oversized tees.', 1, 1, '2023-10-01 12:00:00', '2023-10-01 12:00:00'),
(3, 'Accessories', 'accessories', 'Hats, bags, and more.', 2, 1, '2023-10-01 12:00:00', '2023-10-01 12:00:00'),
(4, 'Pants', 'pants', 'Cargo and sweatpants.', 3, 1, '2023-10-01 12:00:00', '2023-10-01 12:00:00'),
(5, 'Outerwear', 'outerwear', 'Jackets and coats.', 4, 1, '2023-10-01 12:00:00', '2023-10-01 12:00:00');

-- =============================================================================
-- Sample Products (String IDs)
-- =============================================================================
INSERT INTO `products` (`id`, `sku`, `name`, `description`, `price`, `compare_at_price`, `category`, `category_id`, `image_url`, `featured`, `status`, `stock_quantity`, `tags`, `created_at`, `updated_at`) VALUES
    ('oversized-logo-hoodie-abc12', 'HOOD001', 'Oversized Logo Hoodie', 'Heavyweight 400gsm cotton hoodie with embroidered chest logo and kangaroo pocket. Relaxed oversized fit.', 129.00, 159.00, 'Hoodies', 1, 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=800&q=80', 1, 'active', 45, 'oversized,logo,heavyweight,winter', NOW(), NOW()),
    ('washed-black-hoodie-def34', 'HOOD002', 'Washed Black Hoodie', 'Vintage washed black hoodie with distressed details. Pre-shrunk cotton blend.', 119.00, NULL, 'Hoodies', 1, 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&q=80', 0, 'active', 32, 'vintage,washed,black', NOW(), NOW()),
    ('zip-up-essential-hoodie-ghi56', 'HOOD003', 'Zip-Up Essential Hoodie', 'Clean minimal zip-up hoodie with metal hardware. Perfect for layering.', 99.00, NULL, 'Hoodies', 1, 'https://images.unsplash.com/photo-1578681994506-b8f463449011?w=800&q=80', 0, 'active', 28, 'zip-up,minimal,essential', NOW(), NOW()),
    ('graphic-print-tee-jkl78', 'TEE001', 'Graphic Print Tee', 'Oversized t-shirt with bold chest graphic. 100% combed cotton, custom fit.', 59.00, NULL, 'T-Shirts', 2, 'https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=800&q=80', 1, 'active', 75, 'graphic,oversized,print', NOW(), NOW()),
    ('essential-box-logo-tee-mno90', 'TEE002', 'Essential Box Logo Tee', 'Classic box logo t-shirt. Premium heavyweight cotton.', 49.00, NULL, 'T-Shirts', 2, 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&q=80', 0, 'active', 120, 'essential,box logo,classic', NOW(), NOW()),
    ('vintage-racing-tee-pqr12', 'TEE003', 'Vintage Racing Tee', 'Retro racing-inspired graphic tee with distressed print.', 55.00, 69.00, 'T-Shirts', 2, 'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?w=800&q=80', 0, 'active', 42, 'vintage,racing,retro', NOW(), NOW()),
    ('cargo-joggers-stu34', 'BOT001', 'Cargo Joggers', 'Utility cargo joggers with multiple pockets. Tapered fit with elastic cuffs.', 89.00, NULL, 'Bottoms', 3, 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=800&q=80', 1, 'active', 38, 'cargo,joggers,utility', NOW(), NOW()),
    ('wide-leg-pants-vwx56', 'BOT002', 'Wide Leg Pants', 'Relaxed wide leg pants with adjustable waist. Japanese cotton twill.', 109.00, NULL, 'Bottoms', 3, 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=800&q=80', 0, 'active', 22, 'wide leg,japanese,relaxed', NOW(), NOW()),
    ('bomber-jacket-yza78', 'OUT001', 'Bomber Jacket', 'Classic bomber jacket with satin finish. Ribbed collar and cuffs.', 179.00, 219.00, 'Outerwear', 4, 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=800&q=80', 1, 'active', 15, 'bomber,satin,classic', NOW(), NOW()),
    ('puffer-vest-bcd90', 'OUT002', 'Puffer Vest', 'Quilted puffer vest with stand collar. Lightweight warmth.', 139.00, NULL, 'Outerwear', 4, 'https://images.unsplash.com/photo-1544022613-e87ca75a784a?w=800&q=80', 0, 'active', 18, 'puffer,vest,lightweight', NOW(), NOW()),
    ('five-panel-cap-efg12', 'ACC001', 'Five Panel Cap', 'Embroidered five panel cap with adjustable strap.', 45.00, NULL, 'Accessories', 5, 'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?w=800&q=80', 0, 'active', 85, 'cap,embroidered,adjustable', NOW(), NOW()),
    ('crossbody-bag-hij34', 'ACC002', 'Crossbody Bag', 'Compact crossbody bag with multiple compartments.', 65.00, NULL, 'Accessories', 5, 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=800&q=80', 0, 'active', 55, 'bag,crossbody,compact', NOW(), NOW());

-- =============================================================================
-- Done! Database is ready for both webapp-main and webapp-admin-panel
-- =============================================================================
SELECT 'Database initialization complete!' AS status;
SELECT COUNT(*) AS user_count FROM users;
SELECT COUNT(*) AS category_count FROM categories;
SELECT COUNT(*) AS product_count FROM products;
