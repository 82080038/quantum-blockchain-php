<?php
// Trading Engine API Endpoint
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
    
    // Authenticate API key
    $apiKey = $_SERVER['HTTP_API_KEY'] ?? '';
    if (empty($apiKey)) {
        Helpers::errorResponse("API key required", 401);
    }
    
    $apiKeyData = $auth->validateApiKey($apiKey);
    if (!$apiKeyData) {
        Helpers::errorResponse("Invalid API key", 401);
    }
    
    // Get request method and action
    $method = $_SERVER['REQUEST_METHOD'];
    $action = $_GET['action'] ?? '';
    
    // Route requests
    switch ($action) {
        case 'start':
            if ($method === 'POST') {
                $input = json_decode(file_get_contents('php://input'), true);
                $strategyId = $input['strategy_id'] ?? 0;
                $result = ['strategy_id' => $strategyId, 'status' => 'started'];
                Helpers::successResponse($result, "Trading strategy started successfully");
            } else {
                Helpers::errorResponse("Method not allowed", 405);
            }
            break;
            
        case 'portfolio':
            if ($method === 'GET') {
                $portfolio = [
                    'total_value' => 50000.00,
                    'positions' => [
                        ['asset' => 'BTC', 'quantity' => 0.5, 'value' => 22500.00],
                        ['asset' => 'ETH', 'quantity' => 5.0, 'value' => 15000.00]
                    ]
                ];
                Helpers::successResponse(['portfolio' => $portfolio]);
            } else {
                Helpers::errorResponse("Method not allowed", 405);
            }
            break;
            
        default:
            Helpers::errorResponse("Invalid action. Available actions: start, portfolio", 400);
    }
    
} catch (Exception $e) {
    error_log("Trading API error: " . $e->getMessage());
    Helpers::errorResponse("Internal server error", 500);
}
?>
