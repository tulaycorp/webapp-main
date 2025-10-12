<?php
// Simple users endpoint serving JSON for demo login/signup flows
// In production, replace with database-backed auth.
header('Content-Type: application/json');
header('Cache-Control: no-store');

$file = __DIR__ . '/../users.json';
if (file_exists($file)) {
    readfile($file);
    exit;
}

echo json_encode([ 'users' => [
    [ 'email' => 'test@test.com', 'password' => 'test123', 'name' => 'Test User', 'role' => 'user' ]
]]);
?>
