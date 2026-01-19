-- =============================================================================
-- Database Initialization Script
-- For: webapp-main & webapp-admin-panel (Shared MySQL Database)
-- Generated: January 19, 2026
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
DROP TABLE IF EXISTS `order_items`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `sessions`;
DROP TABLE IF EXISTS `password_reset_tokens`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `failed_jobs`;
DROP TABLE IF EXISTS `job_batches`;
DROP TABLE IF EXISTS `jobs`;
DROP TABLE IF EXISTS `cache_locks`;
DROP TABLE IF EXISTS `cache`;
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
-- Users & Authentication Tables
-- =============================================================================
CREATE TABLE `users` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    `remember_token` VARCHAR(100) NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_reset_tokens` (
    `email` VARCHAR(255) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
    `id` VARCHAR(255) NOT NULL,
    `user_id` BIGINT UNSIGNED NULL DEFAULT NULL,
    `ip_address` VARCHAR(45) NULL DEFAULT NULL,
    `user_agent` TEXT NULL,
    `payload` LONGTEXT NOT NULL,
    `last_activity` INT NOT NULL,
    PRIMARY KEY (`id`),
    KEY `sessions_user_id_index` (`user_id`),
    KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Cache Tables
-- =============================================================================
CREATE TABLE `cache` (
    `key` VARCHAR(255) NOT NULL,
    `value` MEDIUMTEXT NOT NULL,
    `expiration` INT NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache_locks` (
    `key` VARCHAR(255) NOT NULL,
    `owner` VARCHAR(255) NOT NULL,
    `expiration` INT NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Job Queue Tables
-- =============================================================================
CREATE TABLE `jobs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `queue` VARCHAR(255) NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `attempts` TINYINT UNSIGNED NOT NULL,
    `reserved_at` INT UNSIGNED NULL DEFAULT NULL,
    `available_at` INT UNSIGNED NOT NULL,
    `created_at` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `job_batches` (
    `id` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `total_jobs` INT NOT NULL,
    `pending_jobs` INT NOT NULL,
    `failed_jobs` INT NOT NULL,
    `failed_job_ids` LONGTEXT NOT NULL,
    `options` MEDIUMTEXT NULL,
    `cancelled_at` INT NULL DEFAULT NULL,
    `created_at` INT NOT NULL,
    `finished_at` INT NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `uuid` VARCHAR(255) NOT NULL,
    `connection` TEXT NOT NULL,
    `queue` TEXT NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `exception` LONGTEXT NOT NULL,
    `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Categories Table
-- =============================================================================
CREATE TABLE `categories` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `description` TEXT NULL,
    `image_url` VARCHAR(255) NULL DEFAULT NULL,
    `parent_id` BIGINT UNSIGNED NULL DEFAULT NULL,
    `sort_order` INT NOT NULL DEFAULT 0,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `categories_slug_unique` (`slug`),
    KEY `categories_parent_id_index` (`parent_id`),
    CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Products Table
-- =============================================================================
CREATE TABLE `products` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `description` TEXT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `category` VARCHAR(255) NULL DEFAULT NULL,
    `category_id` BIGINT UNSIGNED NULL DEFAULT NULL,
    `image_url` VARCHAR(255) NULL DEFAULT NULL,
    `additional_images` JSON NULL,
    `featured` TINYINT(1) NOT NULL DEFAULT 0,
    `status` VARCHAR(255) NOT NULL DEFAULT 'active',
    `stock_quantity` INT NOT NULL DEFAULT 0,
    `sku` VARCHAR(255) NULL DEFAULT NULL,
    `sizes` JSON NULL,
    `color` VARCHAR(255) NULL DEFAULT NULL,
    `material` VARCHAR(255) NULL DEFAULT NULL,
    `care_instructions` TEXT NULL,
    `brand` VARCHAR(255) NULL DEFAULT NULL,
    `tags` VARCHAR(255) NULL DEFAULT NULL,
    `discount_price` DECIMAL(10,2) NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `products_slug_unique` (`slug`),
    UNIQUE KEY `products_sku_unique` (`sku`),
    KEY `products_status_featured_index` (`status`, `featured`),
    KEY `products_category_index` (`category`),
    KEY `products_category_id_index` (`category_id`),
    KEY `products_stock_quantity_index` (`stock_quantity`),
    KEY `products_featured_index` (`featured`),
    CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Orders Table
-- =============================================================================
CREATE TABLE `orders` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT UNSIGNED NULL DEFAULT NULL,
    `order_number` VARCHAR(255) NOT NULL,
    `status` ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') NOT NULL DEFAULT 'pending',
    `subtotal` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `tax` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `shipping` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `total` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `shipping_first_name` VARCHAR(255) NULL DEFAULT NULL,
    `shipping_last_name` VARCHAR(255) NULL DEFAULT NULL,
    `shipping_email` VARCHAR(255) NULL DEFAULT NULL,
    `shipping_phone` VARCHAR(255) NULL DEFAULT NULL,
    `shipping_address1` TEXT NULL,
    `shipping_address2` TEXT NULL,
    `shipping_city` VARCHAR(255) NULL DEFAULT NULL,
    `shipping_state` VARCHAR(255) NULL DEFAULT NULL,
    `shipping_zip` VARCHAR(255) NULL DEFAULT NULL,
    `shipping_country` VARCHAR(255) NULL DEFAULT NULL,
    `notes` TEXT NULL,
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
    `product_id` BIGINT UNSIGNED NULL DEFAULT NULL,
    `product_name` VARCHAR(255) NOT NULL,
    `product_price` DECIMAL(10,2) NOT NULL,
    `quantity` INT NOT NULL DEFAULT 1,
    `total` DECIMAL(10,2) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `order_items_order_id_foreign` (`order_id`),
    KEY `order_items_product_id_foreign` (`product_id`),
    CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
    CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================================
-- Shopping Carts Table
-- =============================================================================
CREATE TABLE `carts` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NULL DEFAULT NULL,
    `session_id` VARCHAR(255) NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `carts_user_id_unique` (`user_id`),
    UNIQUE KEY `carts_session_id_unique` (`session_id`),
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
    ('2026_01_10_000002_create_categories_table', 1),
    ('2026_01_10_000003_create_products_table', 1),
    ('2026_01_10_000005_create_order_items_table', 1),
    ('2026_01_10_190500_add_performance_indexes', 1),
    ('2026_01_10_220345_create_carts_and_items_table', 1),
    ('2026_01_11_160000_add_cart_unique_constraints', 1),
    ('2026_01_19_000001_sync_products_category_to_category_id', 1);

-- =============================================================================
-- Default Test Users (password: 'password')
-- =============================================================================
INSERT INTO `users` (`name`, `email`, `email_verified_at`, `password_hash`, `created_at`, `updated_at`) VALUES
    ('Admin User', 'admin@example.com', NOW(), '$2y$10$aFh9HtXZAh1j3giTROc9OenBis50Kwy4TKYlWUxl3sBsYTybafLoi', NOW(), NOW()),
    ('Test User', 'test@example.com', NOW(), '$2y$10$aFh9HtXZAh1j3giTROc9OenBis50Kwy4TKYlWUxl3sBsYTybafLoi', NOW(), NOW());

-- =============================================================================
-- Sample Categories
-- =============================================================================
INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image_url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
    (1, 'Hoodies', 'hoodies', 'Premium heavyweight hoodies for the streets', 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=800&q=80', 1, 1, NOW(), NOW()),
    (2, 'T-Shirts', 't-shirts', 'Essential streetwear tees with bold graphics', 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&q=80', 2, 1, NOW(), NOW()),
    (3, 'Bottoms', 'bottoms', 'Joggers, cargo pants, and streetwear bottoms', 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=800&q=80', 3, 1, NOW(), NOW()),
    (4, 'Outerwear', 'outerwear', 'Jackets, bombers, and layering pieces', 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=800&q=80', 4, 1, NOW(), NOW()),
    (5, 'Accessories', 'accessories', 'Caps, bags, and finishing touches', 'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?w=800&q=80', 5, 1, NOW(), NOW());

-- =============================================================================
-- Sample Products
-- =============================================================================
INSERT INTO `products` (`name`, `slug`, `description`, `price`, `category`, `category_id`, `image_url`, `featured`, `status`, `stock_quantity`, `tags`, `discount_price`, `created_at`, `updated_at`) VALUES
    ('Oversized Logo Hoodie', 'oversized-logo-hoodie', 'Heavyweight 400gsm cotton hoodie with embroidered chest logo and kangaroo pocket. Relaxed oversized fit.', 129.00, 'Hoodies', 1, 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=800&q=80', 1, 'active', 45, 'oversized, logo, heavyweight, winter', 159.00, NOW(), NOW()),
    ('Washed Black Hoodie', 'washed-black-hoodie', 'Vintage washed black hoodie with distressed details. Pre-shrunk cotton blend.', 119.00, 'Hoodies', 1, 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&q=80', 0, 'active', 32, 'vintage, washed, black', NULL, NOW(), NOW()),
    ('Zip-Up Essential Hoodie', 'zip-up-essential-hoodie', 'Clean minimal zip-up hoodie with metal hardware. Perfect for layering.', 99.00, 'Hoodies', 1, 'https://images.unsplash.com/photo-1578681994506-b8f463449011?w=800&q=80', 0, 'active', 28, 'zip-up, minimal, essential', NULL, NOW(), NOW()),
    ('Graphic Print Tee', 'graphic-print-tee', 'Oversized t-shirt with bold chest graphic. 100% combed cotton, custom fit.', 59.00, 'T-Shirts', 2, 'https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=800&q=80', 1, 'active', 75, 'graphic, oversized, print', NULL, NOW(), NOW()),
    ('Essential Box Logo Tee', 'essential-box-logo-tee', 'Classic box logo t-shirt. Premium heavyweight cotton.', 49.00, 'T-Shirts', 2, 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&q=80', 0, 'active', 120, 'essential, box logo, classic', NULL, NOW(), NOW()),
    ('Vintage Racing Tee', 'vintage-racing-tee', 'Retro racing-inspired graphic tee with distressed print.', 55.00, 'T-Shirts', 2, 'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?w=800&q=80', 0, 'active', 42, 'vintage, racing, retro', 69.00, NOW(), NOW()),
    ('Cargo Joggers', 'cargo-joggers', 'Utility cargo joggers with multiple pockets. Tapered fit with elastic cuffs.', 89.00, 'Bottoms', 3, 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=800&q=80', 1, 'active', 38, 'cargo, joggers, utility', NULL, NOW(), NOW()),
    ('Wide Leg Pants', 'wide-leg-pants', 'Relaxed wide leg pants with adjustable waist. Japanese cotton twill.', 109.00, 'Bottoms', 3, 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=800&q=80', 0, 'active', 22, 'wide leg, japanese, relaxed', NULL, NOW(), NOW()),
    ('Bomber Jacket', 'bomber-jacket', 'Classic bomber jacket with satin finish. Ribbed collar and cuffs.', 179.00, 'Outerwear', 4, 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=800&q=80', 1, 'active', 15, 'bomber, satin, classic', 219.00, NOW(), NOW()),
    ('Puffer Vest', 'puffer-vest', 'Quilted puffer vest with stand collar. Lightweight warmth.', 139.00, 'Outerwear', 4, 'https://images.unsplash.com/photo-1544022613-e87ca75a784a?w=800&q=80', 0, 'active', 18, 'puffer, vest, lightweight', NULL, NOW(), NOW()),
    ('Five Panel Cap', 'five-panel-cap', 'Embroidered five panel cap with adjustable strap.', 45.00, 'Accessories', 5, 'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?w=800&q=80', 0, 'active', 85, 'cap, embroidered, adjustable', NULL, NOW(), NOW()),
    ('Crossbody Bag', 'crossbody-bag', 'Compact crossbody bag with multiple compartments.', 65.00, 'Accessories', 5, 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=800&q=80', 0, 'active', 55, 'bag, crossbody, compact', NULL, NOW(), NOW());

-- =============================================================================
-- Done! Database is ready for both webapp-main and webapp-admin-panel
-- =============================================================================
SELECT 'Database initialization complete!' AS status;
SELECT COUNT(*) AS user_count FROM users;
SELECT COUNT(*) AS category_count FROM categories;
SELECT COUNT(*) AS product_count FROM products;
