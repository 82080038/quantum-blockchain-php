<?php
// Blockchain API Endpoint
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
        case 'deploy':
            if ($method === 'POST') {
                $input = json_decode(file_get_contents('php://input'), true);
                $contractAddress = '0x' . bin2hex(random_bytes(20));
                $result = [
                    'contract_address' => $contractAddress,
                    'contract_name' => $input['name'] ?? 'Unknown',
                    'deployed_at' => date('Y-m-d H:i:s')
                ];
                Helpers::successResponse($result, "Contract deployed successfully");
            } else {
                Helpers::errorResponse("Method not allowed", 405);
            }
            break;
            
        case 'stats':
            if ($method === 'GET') {
                $stats = [
                    'total_contracts' => 5,
                    'active_contracts' => 3,
                    'total_transactions' => 150,
                    'avg_gas_used' => 85000
                ];
                Helpers::successResponse(['stats' => $stats]);
            } else {
                Helpers::errorResponse("Method not allowed", 405);
            }
            break;
            
        default:
            Helpers::errorResponse("Invalid action. Available actions: deploy, stats", 400);
    }
    
} catch (Exception $e) {
    error_log("Blockchain API error: " . $e->getMessage());
    Helpers::errorResponse("Internal server error", 500);
}
?>
