<?php
/**
 * Products API - Database-backed product catalog
 * Handles product listing and details
 */

header('Content-Type: application/json');
header('Cache-Control: no-store');

require_once __DIR__ . '/../config/database.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? 'list';

// Handle different API actions
switch ($action) {
    case 'list':
        handleList();
        break;
    case 'get':
        handleGet();
        break;
    case 'featured':
        handleFeatured();
        break;
    case 'categories':
        handleCategories();
        break;
    default:
        http_response_code(400);
        echo json_encode(['error' => 'Invalid action']);
        break;
}

/**
 * Get all products or filter by category
 */
function handleList() {
    try {
        $pdo = getDbConnection();
        $category = $_GET['category'] ?? '';
        
        if (!empty($category)) {
            $stmt = $pdo->prepare("SELECT * FROM products WHERE category = ? ORDER BY name");
            $stmt->execute([$category]);
        } else {
            $stmt = $pdo->query("SELECT * FROM products ORDER BY category, name");
        }
        
        $products = $stmt->fetchAll();
        
        // Convert featured from 0/1 to boolean
        foreach ($products as &$product) {
            $product['featured'] = (bool)$product['featured'];
            $product['price'] = (float)$product['price'];
            $product['stock_quantity'] = (int)$product['stock_quantity'];
            $product['img'] = $product['image_url']; // Alias for frontend compatibility
        }
        
        echo json_encode(['success' => true, 'products' => $products]);
    } catch (Exception $e) {
        error_log("Products list error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Server error']);
    }
}

/**
 * Get a single product by ID
 */
function handleGet() {
    $id = $_GET['id'] ?? '';
    
    if (empty($id)) {
        http_response_code(400);
        echo json_encode(['error' => 'Product ID required']);
        return;
    }
    
    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch();
        
        if (!$product) {
            http_response_code(404);
            echo json_encode(['error' => 'Product not found']);
            return;
        }
        
        $product['featured'] = (bool)$product['featured'];
        $product['price'] = (float)$product['price'];
        $product['stock_quantity'] = (int)$product['stock_quantity'];
        $product['img'] = $product['image_url'];
        
        echo json_encode(['success' => true, 'product' => $product]);
    } catch (Exception $e) {
        error_log("Product get error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Server error']);
    }
}

/**
 * Get featured products
 */
function handleFeatured() {
    try {
        $pdo = getDbConnection();
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 3;
        
        $stmt = $pdo->prepare("SELECT * FROM products WHERE featured = 1 ORDER BY name LIMIT ?");
        $stmt->execute([$limit]);
        $products = $stmt->fetchAll();
        
        foreach ($products as &$product) {
            $product['featured'] = (bool)$product['featured'];
            $product['price'] = (float)$product['price'];
            $product['stock_quantity'] = (int)$product['stock_quantity'];
            $product['img'] = $product['image_url'];
        }
        
        echo json_encode(['success' => true, 'products' => $products]);
    } catch (Exception $e) {
        error_log("Featured products error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Server error']);
    }
}

/**
 * Get list of all categories
 */
function handleCategories() {
    try {
        $pdo = getDbConnection();
        $stmt = $pdo->query("SELECT DISTINCT category FROM products ORDER BY category");
        $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        echo json_encode(['success' => true, 'categories' => $categories]);
    } catch (Exception $e) {
        error_log("Categories error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Server error']);
    }
}
?>
