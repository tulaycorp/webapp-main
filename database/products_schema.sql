-- Products table schema
USE webapp_db;

CREATE TABLE IF NOT EXISTS products (
    id VARCHAR(50) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    category VARCHAR(100) NOT NULL,
    featured BOOLEAN DEFAULT 0,
    stock_quantity INT DEFAULT 0,
    image_url VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_category (category),
    INDEX idx_featured (featured)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert initial product data
INSERT INTO products (id, name, description, price, category, featured, stock_quantity, image_url) VALUES
('chair-1', 'Elegant Chair', 'Comfortable and stylish chair perfect for any room', 99.00, 'Furniture', 1, 50, 'https://picsum.photos/300/200?chair'),
('lamp-1', 'Smart Lamp', 'Modern smart lamp with adjustable brightness', 49.00, 'Lighting', 1, 100, 'https://picsum.photos/300/200?lamp'),
('desk-1', 'Modern Desk', 'Spacious desk with clean modern design', 199.00, 'Furniture', 1, 30, 'https://picsum.photos/300/200?desk'),
('headphones-1', 'Wireless Headphones', 'Premium wireless headphones with noise cancellation', 149.00, 'Electronics', 0, 75, 'https://picsum.photos/300/200?headphones'),
('plant-1', 'Decorative Plant', 'Beautiful indoor plant for home decoration', 25.00, 'Decor', 0, 120, 'https://picsum.photos/300/200?plant'),
('mug-1', 'Ceramic Mug', 'High-quality ceramic mug for your favorite beverage', 15.00, 'Kitchen', 0, 200, 'https://picsum.photos/300/200?mug'),
('notebook-1', 'Premium Notebook', 'High-quality paper notebook for notes and sketches', 12.00, 'Stationery', 0, 150, 'https://picsum.photos/300/200?notebook'),
('backpack-1', 'Urban Backpack', 'Durable backpack for daily commute', 89.00, 'Accessories', 0, 60, 'https://picsum.photos/300/200?backpack'),
('bottle-1', 'Steel Water Bottle', 'Insulated stainless steel water bottle', 29.00, 'Accessories', 0, 90, 'https://picsum.photos/300/200?bottle')
ON DUPLICATE KEY UPDATE
    name = VALUES(name),
    description = VALUES(description),
    price = VALUES(price),
    category = VALUES(category),
    featured = VALUES(featured),
    stock_quantity = VALUES(stock_quantity),
    image_url = VALUES(image_url);
