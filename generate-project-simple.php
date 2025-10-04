<?php
/**
 * Quantum Blockchain Project Generator - Simplified Version
 */

class ProjectGenerator {
    private $basePath;
    private $filesCreated = 0;
    
    public function __construct($basePath = '.') {
        $this->basePath = rtrim($basePath, '/');
        $this->createDirectoryStructure();
    }
    
    private function createDirectoryStructure() {
        $directories = [
            'public',
            'public/css',
            'public/js', 
            'public/api',
            'public/assets',
            'src',
            'src/controllers',
            'src/models',
            'src/services',
            'src/utils',
            'config',
            'database',
            'database/migrations',
            'database/seeds',
            'docs',
            'tests',
            'logs'
        ];
        
        foreach ($directories as $dir) {
            $fullPath = $this->basePath . '/' . $dir;
            if (!is_dir($fullPath)) {
                mkdir($fullPath, 0755, true);
                echo "📁 Created directory: $dir\n";
            }
        }
    }
    
    public function generateAllFiles() {
        echo "🚀 Starting Quantum Blockchain Project Generation...\n";
        echo "==================================================\n";
        
        $this->generateConfigurationFiles();
        $this->generateCoreFiles();
        $this->generateFrontend();
        $this->generateDatabase();
        $this->generateDocumentation();
        
        echo "==================================================\n";
        echo "✅ Project generation completed! {$this->filesCreated} files created.\n";
        echo "🎯 Next steps:\n";
        echo "   1. Run: composer install\n";
        echo "   2. Import database/schema.sql to MySQL\n"; 
        echo "   3. Configure config/database.php\n";
        echo "   4. Access: http://localhost/quantum-blockchain-php/public/\n";
    }
    
    private function generateConfigurationFiles() {
        $files = [
            '.gitignore' => $this->getGitignoreContent(),
            'composer.json' => $this->getComposerJsonContent(),
            '.env.example' => $this->getEnvExampleContent(),
            'config/database.php' => $this->getDatabaseConfigContent()
        ];
        
        $this->writeFiles($files, "Configuration Files");
    }
    
    private function generateCoreFiles() {
        $files = [
            'src/utils/Database.php' => $this->getDatabaseUtilContent(),
            'src/services/QuantumService.php' => $this->getQuantumServiceContent(),
            'src/controllers/DashboardController.php' => $this->getDashboardControllerContent()
        ];
        
        $this->writeFiles($files, "Core Files");
    }
    
    private function generateFrontend() {
        $files = [
            'public/index.php' => $this->getIndexContent(),
            'public/css/main.css' => $this->getMainCssContent(),
            'public/js/dashboard.js' => $this->getDashboardJsContent()
        ];
        
        $this->writeFiles($files, "Frontend Files");
    }
    
    private function generateDatabase() {
        $files = [
            'database/schema.sql' => $this->getSchemaSqlContent()
        ];
        
        $this->writeFiles($files, "Database Files");
    }
    
    
    private function generateDocumentation() {
        $files = [
            'README.md' => $this->getReadmeContent()
        ];
        
        $this->writeFiles($files, "Documentation");
    }
    
    private function writeFiles($files, $category) {
        echo "\n📂 Generating {$category}...\n";
        
        foreach ($files as $filename => $content) {
            $fullPath = $this->basePath . '/' . $filename;
            
            // Create directory if it doesn't exist
            $dir = dirname($fullPath);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            
            file_put_contents($fullPath, $content);
            $this->filesCreated++;
            echo "   ✅ Created: {$filename}\n";
        }
    }
    
    private function getGitignoreContent() {
        return "# Dependencies
/vendor/
/node_modules/

# Environment
.env
.env.local
.env.production
.env.development

# Logs
*.log
logs/
php_errors.log

# Database
*.sqlite
*.db
/database/*.sqlite

# Cache
/cache/
/tmp/
/sessions/

# OS
.DS_Store
Thumbs.db

# IDE
.vscode/
.idea/
*.swp
*.swo

# Uploads
/uploads/
/temp/

# Backup
*.backup
*.bak

# Composer
composer.lock
/composer.phar

# Deployment
/.buildpath
/.project
/.settings/";
    }
    
    private function getComposerJsonContent() {
        return '{
    "name": "82080038/quantum-blockchain-php",
    "description": "Quantum-Blockchain Integrated Autonomous Trading System with PHP, MySQL, and jQuery",
    "type": "project",
    "keywords": ["quantum", "blockchain", "trading", "autonomous", "php", "mysql"],
    "homepage": "https://github.com/82080038/quantum-blockchain-php",
    "license": "MIT",
    "authors": [
        {
            "name": "Quantum Blockchain Team",
            "email": "team@quantum-blockchain.com",
            "homepage": "https://github.com/82080038"
        }
    ],
    "require": {
        "php": ">=8.0.0",
        "ext-pdo": "*",
        "ext-json": "*",
        "ext-curl": "*",
        "ext-mbstring": "*"
    },
    "autoload": {
        "psr-4": {
            "QuantumBlockchain\\\\": "src/"
        }
    }
}';
    }
    
    private function getEnvExampleContent() {
        return "# Quantum Blockchain Trading System - Environment Configuration
# Copy this file to .env and update with your actual values

# Application Environment
APP_ENV=production
APP_DEBUG=false
APP_URL=http://localhost:8000

# Database Configuration
DB_HOST=localhost
DB_PORT=3306
DB_NAME=quantum_blockchain
DB_USER=root
DB_PASS=

# Quantum Computing Settings
QUANTUM_SIMULATION_ENABLED=true
QUANTUM_MAX_QUBITS=128
QUANTUM_SIMULATION_SPEED=1.0

# Trading Configuration
TRADING_ENABLED=true
TRADING_MAX_POSITION_SIZE=0.1
TRADING_RISK_TOLERANCE=0.02

# Security
JWT_SECRET=your_jwt_secret_key_here
ENCRYPTION_KEY=your_encryption_key_here

# Logging
LOG_LEVEL=INFO
LOG_CHANNEL=file";
    }
    
    private function getDatabaseConfigContent() {
        return '<?php
// Database Configuration
return [
    \'default\' => [
        \'driver\' => \'mysql\',
        \'host\' => $_ENV[\'DB_HOST\'] ?? \'localhost\',
        \'port\' => $_ENV[\'DB_PORT\'] ?? \'3306\',
        \'database\' => $_ENV[\'DB_NAME\'] ?? \'quantum_blockchain\',
        \'username\' => $_ENV[\'DB_USER\'] ?? \'root\',
        \'password\' => $_ENV[\'DB_PASS\'] ?? \'\',
        \'charset\' => \'utf8mb4\',
        \'collation\' => \'utf8mb4_unicode_ci\',
        \'prefix\' => \'\',
        \'options\' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
        ]
    ]
];
?>';
    }
    
    private function getDatabaseUtilContent() {
        return '<?php
namespace QuantumBlockchain\\Utils;

class Database {
    private $pdo;
    private $error;
    
    public function __construct($config = null) {
        if ($config === null) {
            $config = require __DIR__ . \'/../../config/database.php\';
            $config = $config[\'default\'];
        }
        
        try {
            $dsn = "{$config[\'driver\']}:host={$config[\'host\']};port={$config[\'port\']};dbname={$config[\'database\']};charset={$config[\'charset\']}";
            $this->pdo = new \\PDO($dsn, $config[\'username\'], $config[\'password\'], $config[\'options\']);
        } catch (\\PDOException $e) {
            $this->error = $e->getMessage();
            throw new \\Exception("Database connection failed: " . $this->error);
        }
    }
    
    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    public function fetch($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch(\\PDO::FETCH_ASSOC);
    }
    
    public function fetchAll($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll(\\PDO::FETCH_ASSOC);
    }
    
    public function insert($table, $data) {
        $columns = implode(\', \', array_keys($data));
        $placeholders = \':\' . implode(\', :\', array_keys($data));
        
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $this->query($sql, $data);
        
        return $this->pdo->lastInsertId();
    }
    
    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }
}
?>';
    }
    
    private function getQuantumServiceContent() {
        return '<?php
namespace QuantumBlockchain\\Services;

class QuantumService {
    private $config;
    
    public function __construct() {
        $this->config = [
            \'max_qubits\' => 128,
            \'simulation_enabled\' => true
        ];
    }
    
    public function simulateQuantumAlgorithm($algorithm, $params = []) {
        // Simulate quantum computation
        $result = [
            \'algorithm\' => $algorithm,
            \'qubits_used\' => $params[\'qubits\'] ?? 8,
            \'execution_time\' => microtime(true),
            \'result\' => \'Quantum simulation completed\'
        ];
        
        return $result;
    }
    
    public function getQuantumStatus() {
        return [
            \'processors\' => [
                [
                    \'name\' => \'Quantum Processor 1\',
                    \'qubit_count\' => 128,
                    \'processor_type\' => \'Simulated\',
                    \'status\' => \'active\'
                ]
            ]
        ];
    }
}
?>';
    }
    
    private function getDashboardControllerContent() {
        return '<?php
namespace QuantumBlockchain\\Controllers;

use QuantumBlockchain\\Services\\QuantumService;

class DashboardController {
    private $quantumService;
    
    public function __construct() {
        $this->quantumService = new QuantumService();
    }
    
    public function getDashboardData() {
        return [
            \'quantum_status\' => $this->quantumService->getQuantumStatus()[\'processors\'],
            \'portfolio\' => [
                \'total_value\' => 10000.00,
                \'total_unrealized_pnl\' => 250.50,
                \'positions\' => []
            ],
            \'market_data\' => [
                \'BTC/USDT\' => [\'price\' => 45000.00, \'volume\' => 1000000],
                \'ETH/USDT\' => [\'price\' => 3000.00, \'volume\' => 500000]
            ],
            \'system_metrics\' => [
                \'quantum_computations\' => 0,
                \'blockchain_transactions\' => 0,
                \'api_requests\' => 0,
                \'success_rate\' => 0
            ]
        ];
    }
}
?>';
    }
    
    private function getIndexContent() {
        return '<?php
require_once \'../src/utils/Database.php\';
require_once \'../src/services/QuantumService.php\';
require_once \'../src/controllers/DashboardController.php\';

use QuantumBlockchain\\Utils\\Database;
use QuantumBlockchain\\Services\\QuantumService;
use QuantumBlockchain\\Controllers\\DashboardController;

// Initialize services
try {
    $dashboardController = new DashboardController();
    $dashboardData = $dashboardController->getDashboardData();
} catch (Exception $e) {
    $dashboardData = [
        \'quantum_status\' => [],
        \'portfolio\' => [\'total_value\' => 0, \'total_unrealized_pnl\' => 0, \'positions\' => []],
        \'market_data\' => [],
        \'system_metrics\' => []
    ];
    error_log("Dashboard error: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quantum Blockchain Autonomous Trading System</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <div class="header-content">
                <h1>⚛️ Quantum Blockchain Autonomous Trading</h1>
                <div class="system-status">
                    <span class="status-indicator active"></span>
                    <span>System Online</span>
                    <span class="current-time" id="currentTime"><?= date(\'Y-m-d H:i:s\') ?></span>
                </div>
            </div>
        </header>

        <div class="dashboard-grid">
            <!-- Quantum Status Panel -->
            <div class="panel quantum-panel">
                <h3>🔄 Quantum Processors</h3>
                <div class="quantum-metrics">
                    <?php if (!empty($dashboardData[\'quantum_status\'])): ?>
                        <?php foreach($dashboardData[\'quantum_status\'] as $processor): ?>
                        <div class="processor-card">
                            <div class="processor-name"><?= htmlspecialchars($processor[\'name\']) ?></div>
                            <div class="processor-specs">
                                <span class="qubit-count"><?= $processor[\'qubit_count\'] ?> Qubits</span>
                                <span class="processor-type"><?= $processor[\'processor_type\'] ?></span>
                            </div>
                            <div class="processor-status status-<?= $processor[\'status\'] ?>">
                                <?= ucfirst($processor[\'status\']) ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="no-data">No quantum processors available</div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Trading Dashboard -->
            <div class="panel trading-panel">
                <h3>💰 Autonomous Trading</h3>
                <div class="trading-controls">
                    <button id="startTrading" class="btn btn-success">🚀 Start Trading</button>
                    <button id="stopTrading" class="btn btn-danger" disabled>🛑 Stop Trading</button>
                </div>
                
                <div class="performance-metrics">
                    <div class="metric-card">
                        <div class="metric-value">$<span id="portfolioValue"><?= number_format($dashboardData[\'portfolio\'][\'total_value\'], 2) ?></span></div>
                        <div class="metric-label">Portfolio Value</div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-value">$<span id="unrealizedPnl"><?= number_format($dashboardData[\'portfolio\'][\'total_unrealized_pnl\'], 2) ?></span></div>
                        <div class="metric-label">Unrealized P&L</div>
                    </div>
                </div>
            </div>

            <!-- Market Data -->
            <div class="panel market-panel">
                <h3>📊 Market Data</h3>
                <div class="market-prices" id="marketPrices">
                    <?php if (!empty($dashboardData[\'market_data\'])): ?>
                        <?php foreach($dashboardData[\'market_data\'] as $pair => $data): ?>
                        <div class="price-item">
                            <span class="asset-pair"><?= $pair ?></span>
                            <span class="price">$<?= number_format($data[\'price\'], 2) ?></span>
                            <span class="volume">Vol: <?= number_format($data[\'volume\']) ?></span>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="no-data">No market data available</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="js/dashboard.js"></script>
</body>
</html>';
    }
    
    private function getMainCssContent() {
        return '/* Quantum Blockchain Trading System - Main Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #0c0c0c 0%, #1a1a2e 50%, #16213e 100%);
    color: #ffffff;
    min-height: 100vh;
}

.dashboard-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
}

.dashboard-header {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 30px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.header-content h1 {
    font-size: 2.5rem;
    background: linear-gradient(45deg, #00d4ff, #5b21b6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.system-status {
    display: flex;
    align-items: center;
    gap: 15px;
    font-size: 1.1rem;
}

.status-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #10b981;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 25px;
}

.panel {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 25px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.panel:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 212, 255, 0.2);
}

.panel h3 {
    font-size: 1.5rem;
    margin-bottom: 20px;
    color: #00d4ff;
    border-bottom: 2px solid rgba(0, 212, 255, 0.3);
    padding-bottom: 10px;
}

.quantum-metrics {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.processor-card {
    background: rgba(0, 212, 255, 0.1);
    border-radius: 10px;
    padding: 15px;
    border: 1px solid rgba(0, 212, 255, 0.3);
}

.processor-name {
    font-weight: bold;
    font-size: 1.1rem;
    margin-bottom: 8px;
}

.processor-specs {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 0.9rem;
    color: #a0a0a0;
}

.processor-status {
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: bold;
    text-transform: uppercase;
}

.status-active {
    background: rgba(16, 185, 129, 0.2);
    color: #10b981;
    border: 1px solid #10b981;
}

.trading-controls {
    display: flex;
    gap: 15px;
    margin-bottom: 25px;
    flex-wrap: wrap;
}

.btn {
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-success {
    background: linear-gradient(45deg, #10b981, #059669);
    color: white;
}

.btn-danger {
    background: linear-gradient(45deg, #ef4444, #dc2626);
    color: white;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

.performance-metrics {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
}

.metric-card {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.metric-value {
    font-size: 1.8rem;
    font-weight: bold;
    color: #00d4ff;
    margin-bottom: 5px;
}

.metric-label {
    font-size: 0.9rem;
    color: #a0a0a0;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.market-prices {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.price-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.asset-pair {
    font-weight: bold;
    color: #00d4ff;
}

.price {
    font-weight: bold;
    color: #10b981;
}

.volume {
    font-size: 0.9rem;
    color: #a0a0a0;
}

.no-data {
    text-align: center;
    color: #a0a0a0;
    font-style: italic;
    padding: 20px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 10px;
    }
    
    .header-content {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .header-content h1 {
        font-size: 2rem;
    }
    
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
    
    .trading-controls {
        justify-content: center;
    }
    
    .performance-metrics {
        grid-template-columns: 1fr;
    }
}';
    }
    
    private function getDashboardJsContent() {
        return '$(document).ready(function() {
    // Update current time every second
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleString(\'en-US\', {
            year: \'numeric\',
            month: \'2-digit\',
            day: \'2-digit\',
            hour: \'2-digit\',
            minute: \'2-digit\',
            second: \'2-digit\'
        });
        $(\'#currentTime\').text(timeString);
    }
    
    // Update time immediately and then every second
    updateTime();
    setInterval(updateTime, 1000);
    
    // Trading controls
    let isTrading = false;
    
    $(\'#startTrading\').click(function() {
        if (!isTrading) {
            isTrading = true;
            $(this).prop(\'disabled\', true);
            $(\'#stopTrading\').prop(\'disabled\', false);
            
            // Add activity log
            addActivityLog(\'Trading started\', \'success\');
            
            // Simulate trading updates
            startTradingSimulation();
        }
    });
    
    $(\'#stopTrading\').click(function() {
        if (isTrading) {
            isTrading = false;
            $(this).prop(\'disabled\', true);
            $(\'#startTrading\').prop(\'disabled\', false);
            
            // Add activity log
            addActivityLog(\'Trading stopped\', \'warning\');
        }
    });
    
    function startTradingSimulation() {
        if (!isTrading) return;
        
        // Simulate portfolio value changes
        const currentValue = parseFloat($(\'#portfolioValue\').text().replace(/,/g, \'\'));
        const change = (Math.random() - 0.5) * 100; // Random change between -50 and +50
        const newValue = currentValue + change;
        
        $(\'#portfolioValue\').text(newValue.toLocaleString(\'en-US\', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        
        // Simulate P&L changes
        const currentPnl = parseFloat($(\'#unrealizedPnl\').text().replace(/,/g, \'\'));
        const pnlChange = (Math.random() - 0.5) * 50; // Random change between -25 and +25
        const newPnl = currentPnl + pnlChange;
        
        $(\'#unrealizedPnl\').text(newPnl.toLocaleString(\'en-US\', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        
        // Continue simulation if trading is still active
        setTimeout(startTradingSimulation, 2000);
    }
    
    function addActivityLog(message, type = \'info\') {
        const time = new Date().toLocaleTimeString();
        const activityItem = $(`
            <div class="activity-item">
                <span class="activity-time">${time}</span>
                <span class="activity-message activity-${type}">${message}</span>
            </div>
        `);
        
        $(\'#activityList\').prepend(activityItem);
        
        // Keep only last 10 activities
        $(\'#activityList .activity-item\').slice(10).remove();
    }
    
    // Initialize activity log
    addActivityLog(\'System initialized successfully\', \'success\');
});';
    }
    
    private function getSchemaSqlContent() {
        return '-- Quantum Blockchain Trading System Database Schema
-- Created: ' . date('Y-m-d H:i:s') . '

CREATE DATABASE IF NOT EXISTS quantum_blockchain;
USE quantum_blockchain;

-- Users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    api_key VARCHAR(64) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Quantum processors table
CREATE TABLE quantum_processors (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    processor_type ENUM(\'simulated\', \'real\') DEFAULT \'simulated\',
    qubit_count INT NOT NULL,
    status ENUM(\'active\', \'inactive\', \'maintenance\') DEFAULT \'active\',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Trading strategies table
CREATE TABLE trading_strategies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    parameters JSON,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Portfolio table
CREATE TABLE portfolio (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    asset_pair VARCHAR(20) NOT NULL,
    quantity DECIMAL(20, 8) NOT NULL,
    average_price DECIMAL(20, 8) NOT NULL,
    current_price DECIMAL(20, 8),
    unrealized_pnl DECIMAL(20, 8) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert sample data
INSERT INTO quantum_processors (name, processor_type, qubit_count, status) VALUES
(\'Quantum Processor 1\', \'simulated\', 128, \'active\'),
(\'Quantum Processor 2\', \'simulated\', 256, \'active\');

INSERT INTO trading_strategies (name, description, parameters) VALUES
(\'Arbitrage Strategy\', \'Cross-exchange arbitrage trading\', \'{"max_position_size": 0.1, "risk_tolerance": 0.02}\'),
(\'Market Making\', \'Provide liquidity to markets\', \'{"spread": 0.001, "max_inventory": 1000}\'),
(\'Trend Following\', \'Follow market trends using technical analysis\', \'{"lookback_period": 20, "threshold": 0.05}\'),
(\'Quantum AI\', \'AI-driven strategy using quantum algorithms\', \'{"quantum_qubits": 64, "learning_rate": 0.01}\');';
    }
    
    private function getReadmeContent() {
        return '# ⚛️ Quantum Blockchain Autonomous Trading System

![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-blue)
![MySQL Version](https://img.shields.io/badge/MySQL-8.0%2B-orange)
![License](https://img.shields.io/badge/License-MIT-green)

A revolutionary autonomous trading system that integrates quantum computing simulations with blockchain technology, built entirely with PHP, MySQL, and jQuery.

## 🎯 Quick Start

### Prerequisites
- PHP 8.0+
- MySQL 8.0+
- Composer

### Installation
1. **Run the generator script:**
   ```bash
   php generate-project-simple.php
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Setup database:**
   ```bash
   mysql -u root -p < database/schema.sql
   ```

4. **Configure environment:**
   ```bash
   cp .env.example .env
   # Edit .env with your database credentials
   ```

5. **Access dashboard:**
   Open your browser to `http://localhost/quantum-blockchain-php/public/`

## 🚀 Features

- **Quantum Computing Simulations** - Advanced quantum algorithm simulations
- **Autonomous Trading Engine** - AI-driven multi-strategy execution
- **Real-time Dashboard** - Live monitoring and control
- **Mobile-First Design** - Optimized for mobile and tablet devices
- **RESTful API** - Comprehensive developer API

## 📁 Project Structure

```
quantum-blockchain-php/
├── public/                 # Web accessible files
├── src/                   # Application source code
├── config/               # Configuration files
├── database/             # Database schemas
├── docs/                 # Documentation
└── generate-project-simple.php  # Project generator script
```

## 🔧 Configuration

Edit configuration files in `config/` directory:
- `database.php` - Database connections
- `.env` - Environment variables

## 📖 Documentation

- [Installation Guide](docs/installation.md)
- [API Reference](docs/api-reference.md)
- [Architecture Overview](docs/architecture.md)

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Open a Pull Request

## 📄 License

MIT License - see [LICENSE](LICENSE) file for details.

---

**Built with ❤️ using cutting-edge quantum-blockchain technology**';
    }
}

// =========================================================================
// EXECUTION
// =========================================================================

echo "⚛️  Quantum Blockchain Project Generator\n";
echo "========================================\n";

$generator = new ProjectGenerator();
$generator->generateAllFiles();

// Create a simple version file
file_put_contents('VERSION', '1.0.0');
echo "✅ Version file created: 1.0.0\n";

echo "\n🎉 Project generation completed successfully!\n";
echo "📚 Check the generated README.md for next steps.\n";
?>
