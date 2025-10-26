<?php
/**
 * Users API - Database-backed authentication
 * Handles login, signup, and password reset
 */

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

header('Content-Type: application/json');
header('Cache-Control: no-store');

require_once __DIR__ . '/../config/database.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

// Handle different API actions
switch ($action) {
    case 'login':
        handleLogin();
        break;
    case 'signup':
        handleSignup();
        break;
    case 'check-email':
        handleCheckEmail();
        break;
    case 'logout':
        handleLogout();
        break;
    default:
        http_response_code(400);
        echo json_encode(['error' => 'Invalid action']);
        break;
}

/**
 * Handle user login
 */
function handleLogin() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        return;
    }

    $input = json_decode(file_get_contents('php://input'), true);
    $email = trim($input['email'] ?? '');
    $password = $input['password'] ?? '';

    if (empty($email) || empty($password)) {
        http_response_code(400);
        echo json_encode(['error' => 'Email and password are required']);
        return;
    }

    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user['password_hash'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid email or password']);
            return;
        }

        // Create session token
        $sessionToken = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+30 days'));

        $stmt = $pdo->prepare("INSERT INTO sessions (user_id, session_token, expires_at) VALUES (?, ?, ?)");
        $stmt->execute([$user['id'], $sessionToken, $expiresAt]);

        // Return user data (excluding password)
        echo json_encode([
            'success' => true,
            'user' => [
                'id' => $user['id'],
                'email' => $user['email'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'role' => $user['role'],
                'session_token' => $sessionToken
            ],
            'expires_at' => $expiresAt
        ]);
    } catch (Exception $e) {
        error_log("Login error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Server error']);
    }
}

/**
 * Handle user signup
 */
function handleSignup() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        return;
    }

    $input = json_decode(file_get_contents('php://input'), true);
    
    $firstName = trim($input['first_name'] ?? '');
    $middleName = trim($input['middle_name'] ?? '');
    $lastName = trim($input['last_name'] ?? '');
    $email = trim($input['email'] ?? '');
    $password = $input['password'] ?? '';
    $address1 = trim($input['address1'] ?? '');
    $address2 = trim($input['address2'] ?? '');
    $countryCode = trim($input['country_code'] ?? '+64');
    $phone = trim($input['phone'] ?? '');

    // Validation
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($address1)) {
        http_response_code(400);
        echo json_encode(['error' => 'Required fields are missing']);
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid email format']);
        return;
    }

    if (strlen($password) < 6) {
        http_response_code(400);
        echo json_encode(['error' => 'Password must be at least 6 characters']);
        return;
    }

    try {
        $pdo = getDbConnection();
        
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            http_response_code(409);
            echo json_encode(['error' => 'Email already registered']);
            return;
        }

        // Hash password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $stmt = $pdo->prepare("
            INSERT INTO users (first_name, middle_name, last_name, email, password_hash, 
                             address1, address2, country_code, phone, role)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'user')
        ");
        
        $result = $stmt->execute([
            $firstName,
            $middleName ?: null,
            $lastName,
            $email,
            $passwordHash,
            $address1,
            $address2 ?: null,
            $countryCode,
            $phone ?: null
        ]);

        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Account created successfully'
            ]);
        } else {
            throw new Exception('Failed to insert user');
        }
    } catch (Exception $e) {
        error_log("Signup error: " . $e->getMessage());
        error_log("Stack trace: " . $e->getTraceAsString());
        http_response_code(500);
        echo json_encode([
            'error' => 'Server error: ' . $e->getMessage(),
            'details' => $e->getTraceAsString()
        ]);
    }
}

/**
 * Check if email exists (for forgot password)
 */
function handleCheckEmail() {
    $email = trim($_GET['email'] ?? '');
    
    if (empty($email)) {
        http_response_code(400);
        echo json_encode(['error' => 'Email is required']);
        return;
    }

    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $exists = $stmt->fetch() !== false;

        echo json_encode(['exists' => $exists]);
    } catch (Exception $e) {
        error_log("Check email error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Server error']);
    }
}

/**
 * Handle logout
 */
function handleLogout() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        return;
    }

    $input = json_decode(file_get_contents('php://input'), true);
    $sessionToken = $input['session_token'] ?? '';

    if (empty($sessionToken)) {
        http_response_code(400);
        echo json_encode(['error' => 'Session token required']);
        return;
    }

    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("DELETE FROM sessions WHERE session_token = ?");
        $stmt->execute([$sessionToken]);

        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        error_log("Logout error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Server error']);
    }
}
?>
