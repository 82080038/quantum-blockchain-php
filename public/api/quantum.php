<?php
// Quantum Computing API Endpoint
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
        case 'compute':
            if ($method === 'POST') {
                handleComputeRequest($apiKeyData);
            } else {
                Helpers::errorResponse("Method not allowed", 405);
            }
            break;
            
        case 'status':
            if ($method === 'GET') {
                $processors = [
                    ['id' => 1, 'name' => 'Quantum Processor A', 'status' => 'active', 'qubits' => 128],
                    ['id' => 2, 'name' => 'Quantum Processor B', 'status' => 'active', 'qubits' => 64]
                ];
                Helpers::successResponse(['processors' => $processors]);
            } else {
                Helpers::errorResponse("Method not allowed", 405);
            }
            break;
            
        default:
            Helpers::errorResponse("Invalid action. Available actions: compute, status", 400);
    }
    
} catch (Exception $e) {
    error_log("Quantum API error: " . $e->getMessage());
    Helpers::errorResponse("Internal server error", 500);
}

function handleComputeRequest($apiKeyData) {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        Helpers::errorResponse("Invalid JSON input");
    }
    
    $algorithm = $input['algorithm'] ?? '';
    $parameters = $input['parameters'] ?? [];
    
    if (empty($algorithm)) {
        Helpers::errorResponse("Algorithm parameter is required");
    }
    
    // Simulate quantum computation
    $result = [
        'computation_id' => rand(1000, 9999),
        'algorithm' => $algorithm,
        'result' => ['status' => 'completed', 'data' => $parameters],
        'computation_time' => rand(50, 200),
        'qubits_used' => rand(10, 50)
    ];
    
    Helpers::successResponse($result, "Quantum computation executed successfully");
}
?>
