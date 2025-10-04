<?php
// Authentication API Endpoint
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, API-Key');

require_once '../../src/utils/Config.php';
require_once '../../src/utils/Auth.php';
require_once '../../src/utils/Helpers.php';

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

try {
    // Load environment and initialize
    Config::loadEnvironment();
    $auth = new Auth();
    
    // Get request method and action
    $method = $_SERVER['REQUEST_METHOD'];
    $action = $_GET['action'] ?? '';
    
    // Route requests
    switch ($action) {
        case 'login':
            if ($method === 'POST') {
                $input = json_decode(file_get_contents('php://input'), true);
                $username = $input['username'] ?? '';
                $password = $input['password'] ?? '';
                
                if (empty($username) || empty($password)) {
                    Helpers::errorResponse("Username and password are required");
                }
                
                // Simulate login
                $result = [
                    'user' => [
                        'id' => 1,
                        'username' => $username,
                        'email' => 'user@example.com',
                        'permissions' => ['basic', 'trading']
                    ],
                    'api_key' => 'generated_api_key',
                    'expires_at' => date('Y-m-d H:i:s', strtotime('+90 days'))
                ];
                Helpers::successResponse($result, "Login successful");
            } else {
                Helpers::errorResponse("Method not allowed", 405);
            }
            break;
            
        case 'register':
            if ($method === 'POST') {
                $input = json_decode(file_get_contents('php://input'), true);
                $username = $input['username'] ?? '';
                $email = $input['email'] ?? '';
                $password = $input['password'] ?? '';
                
                if (empty($username) || empty($email) || empty($password)) {
                    Helpers::errorResponse("Username, email, and password are required");
                }
                
                $result = [
                    'user_id' => rand(1000, 9999),
                    'username' => $username,
                    'email' => $email
                ];
                Helpers::successResponse($result, "User registered successfully");
            } else {
                Helpers::errorResponse("Method not allowed", 405);
            }
            break;
            
        default:
            Helpers::errorResponse("Invalid action. Available actions: login, register", 400);
    }
    
} catch (Exception $e) {
    error_log("Auth API error: " . $e->getMessage());
    Helpers::errorResponse("Internal server error", 500);
}
?>
