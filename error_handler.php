<?php
// 404 Error Handler
// This file is included automatically for PHP files

// Only handle actual PHP file requests that don't exist
if (!file_exists($_SERVER['SCRIPT_FILENAME']) && 
    strpos($_SERVER['REQUEST_URI'], '.php') !== false) {
    
    // Set 404 header
    http_response_code(404);
    
    // Redirect to 404 page
    $base_path = dirname($_SERVER['SCRIPT_NAME']);
    $webapp_base = str_replace('/pages', '', $base_path);
    
    header("Location: {$webapp_base}/pages/404.php");
    exit;
}
?>