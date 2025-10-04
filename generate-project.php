<?php
/**
 * Quantum Blockchain Project Generator
 * Script untuk generate seluruh struktur project sekaligus
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
        $this->generateCoreUtils();
        $this->generateServices();
        $this->generateModels();
        $this->generateControllers();
        $this->generateFrontend();
        $this->generateAPIs();
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
            'config/database.php' => $this->getDatabaseConfigContent(),
            'config/quantum.php' => $this->getQuantumConfigContent(),
            'config/trading.php' => $this->getTradingConfigContent(),
            'config/blockchain.php' => $this->getBlockchainConfigContent()
        ];
        
        $this->writeFiles($files, "Configuration Files");
    }
    
    private function generateCoreUtils() {
        $files = [
            'src/utils/Database.php' => $this->getDatabaseUtilContent(),
            'src/utils/Auth.php' => $this->getAuthUtilContent(),
            'src/utils/Config.php' => $this->getConfigUtilContent(),
            'src/utils/Helpers.php' => $this->getHelpersContent(),
            'src/utils/Logger.php' => $this->getLoggerContent()
        ];
        
        $this->writeFiles($files, "Core Utilities");
    }
    
    private function generateServices() {
        $files = [
            'src/services/QuantumService.php' => $this->getQuantumServiceContent(),
            'src/services/BlockchainService.php' => $this->getBlockchainServiceContent(),
            'src/services/TradingService.php' => $this->getTradingServiceContent(),
            'src/services/SecurityService.php' => $this->getSecurityServiceContent(),
            'src/services/MarketDataService.php' => $this->getMarketDataServiceContent()
        ];
        
        $this->writeFiles($files, "Business Services");
    }
    
    private function generateModels() {
        $files = [
            'src/models/QuantumModel.php' => $this->getQuantumModelContent(),
            'src/models/TradingModel.php' => $this->getTradingModelContent(),
            'src/models/UserModel.php' => $this->getUserModelContent(),
            'src/models/BlockchainModel.php' => $this->getBlockchainModelContent(),
            'src/models/PortfolioModel.php' => $this->getPortfolioModelContent()
        ];
        
        $this->writeFiles($files, "Data Models");
    }
    
    private function generateControllers() {
        $files = [
            'src/controllers/DashboardController.php' => $this->getDashboardControllerContent(),
            'src/controllers/ApiController.php' => $this->getApiControllerContent(),
            'src/controllers/QuantumController.php' => $this->getQuantumControllerContent(),
            'src/controllers/TradingController.php' => $this->getTradingControllerContent()
        ];
        
        $this->writeFiles($files, "Controllers");
    }
    
    private function generateFrontend() {
        $files = [
            'public/index.php' => $this->getIndexContent(),
            'public/css/main.css' => $this->getMainCssContent(),
            'public/css/quantum-theme.css' => $this->getQuantumThemeCssContent(),
            'public/js/dashboard.js' => $this->getDashboardJsContent(),
            'public/js/trading-engine.js' => $this->getTradingEngineJsContent(),
            'public/js/quantum-animations.js' => $this->getQuantumAnimationsJsContent()
        ];
        
        $this->writeFiles($files, "Frontend Files");
    }
    
    private function generateAPIs() {
        $files = [
            'public/api/quantum-api.php' => $this->getQuantumApiContent(),
            'public/api/trading-api.php' => $this->getTradingApiContent(),
            'public/api/blockchain-api.php' => $this->getBlockchainApiContent(),
            'public/api/auth-api.php' => $this->getAuthApiContent()
        ];
        
        $this->writeFiles($files, "API Endpoints");
    }
    
    private function generateDatabase() {
        $files = [
            'database/schema.sql' => $this->getSchemaSqlContent(),
            'database/migrations/001_initial_schema.sql' => $this->getInitialMigrationContent(),
            'database/seeds/initial_data.sql' => $this->getInitialDataContent()
        ];
        
        $this->writeFiles($files, "Database Files");
    }
    
    private function generateDocumentation() {
        $files = [
            'README.md' => $this->getReadmeContent(),
            'docs/installation.md' => $this->getInstallationGuideContent(),
            'docs/api-reference.md' => $this->getApiReferenceContent(),
            'docs/architecture.md' => $this->getArchitectureDocContent(),
            'deployment-guide.md' => $this->getDeploymentGuideContent()
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
    
    // =========================================================================
    // FILE CONTENT METHODS
    // =========================================================================
    
    private function getGitignoreContent() {
        return `# Dependencies
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
/.settings/`;
    }
    
    private function getComposerJsonContent() {
        return `{
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
    "support": {
        "email": "support@quantum-blockchain.com",
        "issues": "https://github.com/82080038/quantum-blockchain-php/issues",
        "source": "https://github.com/82080038/quantum-blockchain-php"
    },
    "require": {
        "php": ">=8.0.0",
        "ext-pdo": "*",
        "ext-json": "*",
        "ext-curl": "*",
        "ext-mbstring": "*",
        "ramsey/uuid": "^4.7",
        "monolog/monolog": "^2.9"
    },
    "require-dev": {
        "phpunit/phpunit": "^9.6",
        "squizlabs/php_codesniffer": "^3.7"
    },
    "autoload": {
        "psr-4": {
            "QuantumBlockchain\\\\": "src/"
        },
        "files": [
            "src/utils/Helpers.php"
        ]
    },
    "autoload-dev": {
        "psr-4": {
            "QuantumBlockchain\\\\Tests\\\\": "tests/"
        }
    },
    "scripts": {
        "test": "phpunit tests/",
        "check-style": "phpcs src/ tests/",
        "fix-style": "phpcbf src/ tests/",
        "post-install-cmd": [
            "php -r \\"if (!file_exists('.env')) { copy('.env.example', '.env'); }\\""
        ]
    },
    "config": {
        "sort-packages": true,
        "platform-check": true
    },
    "minimum-stability": "stable",
    "prefer-stable": true
}`;
    }
    
    private function getEnvExampleContent() {
        return `# Quantum Blockchain Trading System - Environment Configuration
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

# API Configuration
API_RATE_LIMIT=1000
API_KEY_EXPIRY_DAYS=90

# Exchange API Keys (for real trading - keep secure!)
BINANCE_API_KEY=your_binance_api_key
BINANCE_SECRET_KEY=your_binance_secret_key
KRAKEN_API_KEY=your_kraken_api_key
KRAKEN_PRIVATE_KEY=your_kraken_private_key

# Security
JWT_SECRET=your_jwt_secret_key_here
ENCRYPTION_KEY=your_encryption_key_here

# Logging
LOG_LEVEL=INFO
LOG_CHANNEL=file`;
    }
    
    private function getDatabaseConfigContent() {
        return `<?php
// Database Configuration
return [
    'default' => [
        'driver' => 'mysql',
        'host' => $_ENV['DB_HOST'] ?? 'localhost',
        'port' => $_ENV['DB_PORT'] ?? '3306',
        'database' => $_ENV['DB_NAME'] ?? 'quantum_blockchain',
        'username' => $_ENV['DB_USER'] ?? 'root',
        'password' => $_ENV['DB_PASS'] ?? '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
        ]
    ],
    
    'test' => [
        'driver' => 'sqlite',
        'database' => ':memory:',
        'prefix' => '',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];
?>`;
    }
    
    private function getQuantumConfigContent() {
        return `<?php
// Quantum Computing Configuration
return [
    'simulation' => [
        'enabled' => $_ENV['QUANTUM_SIMULATION_ENABLED'] ?? true,
        'max_qubits' => $_ENV['QUANTUM_MAX_QUBITS'] ?? 128,
        'simulation_speed' => $_ENV['QUANTUM_SIMULATION_SPEED'] ?? 1.0
    ],
    
    'processors' => [
        'default' => [
            'max_qubits' => 128,
            'coherence_time' => 100.0,
            'gate_time' => 50,
            'error_rates' => [
                'single_qubit' => 0.001,
                'two_qubit' => 0.01,
                'readout' => 0.02
            ]
        ]
    ],
    
    'algorithms' => [
        'shor' => [
            'enabled' => true,
            'max_number_size' => 1000000,
            'default_qubits' => 12,
            'simulation_time' => 0.5
        ],
        
        'grover' => [
            'enabled' => true,
            'max_search_space' => 1000000,
            'default_qubits' => 8,
            'simulation_time' => 0.3
        ],
        
        'vqe' => [
            'enabled' => true,
            'max_iterations' => 100,
            'default_qubits' => 6,
            'simulation_time' => 1.0
        ],
        
        'qml_training' => [
            'enabled' => true,
            'max_epochs' => 50,
            'default_qubits' => 10,
            'simulation_time' => 2.0
        ]
    ]
];
?>`;
    }
    
    private function getDatabaseUtilContent() {
        return `<?php
namespace QuantumBlockchain\\Utils;

class Database {
    private $pdo;
    private $error;
    
    public function __construct($config = null) {
        if ($config === null) {
            $config = require __DIR__ . '/../../config/database.php';
            $config = $config['default'];
        }
        
        try {
            $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";
            $this->pdo = new \\PDO($dsn, $config['username'], $config['password'], $config['options']);
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
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $this->query($sql, $data);
        
        return $this->pdo->lastInsertId();
    }
    
    public function update($table, $data, $where, $whereParams = []) {
        $setParts = [];
        foreach (array_keys($data) as $column) {
            $setParts[] = "{$column} = :{$column}";
        }
        $setClause = implode(', ', $setParts);
        
        $sql = "UPDATE {$table} SET {$setClause} WHERE {$where}";
        $this->query($sql, array_merge($data, $whereParams));
        
        return true;
    }
    
    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }
    
    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }
    
    public function commit() {
        return $this->pdo->commit();
    }
    
    public function rollBack() {
        return $this->pdo->rollBack();
    }
    
    public function getError() {
        return $this->error;
    }
}
?>`;
    }
    
    // ... (Methods untuk file lainnya akan dilanjutkan di part berikutnya)
    // Karena response terlalu panjang, saya akan break menjadi beberapa parts
    
    private function getIndexContent() {
        return `<?php
require_once '../src/utils/Database.php';
require_once '../src/services/QuantumService.php';
require_once '../src/services/TradingService.php';
require_once '../src/controllers/DashboardController.php';

use QuantumBlockchain\\Utils\\Database;
use QuantumBlockchain\\Services\\QuantumService;
use QuantumBlockchain\\Services\\TradingService;
use QuantumBlockchain\\Controllers\\DashboardController;

// Initialize services
try {
    $dashboardController = new DashboardController();
    $dashboardData = $dashboardController->getDashboardData();
} catch (Exception $e) {
    $dashboardData = [
        'quantum_status' => [],
        'portfolio' => ['total_value' => 0, 'total_unrealized_pnl' => 0, 'positions' => []],
        'market_data' => [],
        'system_metrics' => []
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
    <link rel="stylesheet" href="css/quantum-theme.css">
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
                    <span class="current-time" id="currentTime"><?= date('Y-m-d H:i:s') ?></span>
                </div>
            </div>
        </header>

        <div class="dashboard-grid">
            <!-- Quantum Status Panel -->
            <div class="panel quantum-panel">
                <h3>🔄 Quantum Processors</h3>
                <div class="quantum-metrics">
                    <?php if (!empty($dashboardData['quantum_status'])): ?>
                        <?php foreach($dashboardData['quantum_status'] as $processor): ?>
                        <div class="processor-card">
                            <div class="processor-name"><?= htmlspecialchars($processor['name']) ?></div>
                            <div class="processor-specs">
                                <span class="qubit-count"><?= $processor['qubit_count'] ?> Qubits</span>
                                <span class="processor-type"><?= $processor['processor_type'] ?></span>
                            </div>
                            <div class="processor-status status-<?= $processor['status'] ?>">
                                <?= ucfirst($processor['status']) ?>
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
                    
                    <select id="strategySelect" class="strategy-select">
                        <option value="1">Arbitrage Strategy</option>
                        <option value="2">Market Making</option>
                        <option value="3">Trend Following</option>
                        <option value="4">Quantum AI</option>
                    </select>
                </div>
                
                <div class="performance-metrics">
                    <div class="metric-card">
                        <div class="metric-value">$<span id="portfolioValue"><?= number_format($dashboardData['portfolio']['total_value'], 2) ?></span></div>
                        <div class="metric-label">Portfolio Value</div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-value">$<span id="unrealizedPnl"><?= number_format($dashboardData['portfolio']['total_unrealized_pnl'], 2) ?></span></div>
                        <div class="metric-label">Unrealized P&L</div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-value" id="activeOrders">0</div>
                        <div class="metric-label">Active Orders</div>
                    </div>
                </div>
            </div>

            <!-- Market Data -->
            <div class="panel market-panel">
                <h3>📊 Market Data</h3>
                <div class="market-prices" id="marketPrices">
                    <?php if (!empty($dashboardData['market_data'])): ?>
                        <?php foreach($dashboardData['market_data'] as $pair => $data): ?>
                        <div class="price-item">
                            <span class="asset-pair"><?= $pair ?></span>
                            <span class="price">$<?= number_format($data['price'], 2) ?></span>
                            <span class="volume">Vol: <?= number_format($data['volume']) ?></span>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="no-data">No market data available</div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- System Metrics -->
            <div class="panel metrics-panel">
                <h3>📈 System Metrics</h3>
                <div class="system-metrics">
                    <div class="metric-item">
                        <span class="metric-name">Quantum Computations</span>
                        <span class="metric-value" id="quantumComputations">0</span>
                    </div>
                    <div class="metric-item">
                        <span class="metric-name">Blockchain Transactions</span>
                        <span class="metric-value" id="blockchainTransactions">0</span>
                    </div>
                    <div class="metric-item">
                        <span class="metric-name">API Requests</span>
                        <span class="metric-value" id="apiRequests">0</span>
                    </div>
                    <div class="metric-item">
                        <span class="metric-name">Success Rate</span>
                        <span class="metric-value" id="successRate">0%</span>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="panel chart-panel full-width">
                <h3>📊 Performance Analytics</h3>
                <div class="chart-container">
                    <canvas id="performanceChart" width="800" height="300"></canvas>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="panel activity-panel">
                <h3>🔄 Recent Activity</h3>
                <div class="activity-list" id="activityList">
                    <div class="activity-item">
                        <span class="activity-time">Just now</span>
                        <span class="activity-message">System initialized successfully</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/dashboard.js"></script>
    <script src="js/trading-engine.js"></script>
    <script src="js/quantum-animations.js"></script>
</body>
</html>`;
    }
    
    // ... (Methods untuk file-file lainnya)
    
    private function getReadmeContent() {
        return `# ⚛️ Quantum Blockchain Autonomous Trading System

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
   \`\`\`bash
   php generate-project.php
   \`\`\`

2. **Install dependencies:**
   \`\`\`bash
   composer install
   \`\`\`

3. **Setup database:**
   \`\`\`bash
   mysql -u root -p < database/schema.sql
   \`\`\`

4. **Configure environment:**
   \`\`\`bash
   cp .env.example .env
   # Edit .env with your database credentials
   \`\`\`

5. **Access dashboard:**
   Open your browser to \`http://localhost/quantum-blockchain-php/public/\`

## 🚀 Features

- **Quantum Computing Simulations** - Shor, Grover, VQE algorithms
- **Blockchain Smart Contracts** - Secure transaction processing
- **Autonomous Trading Engine** - AI-driven multi-strategy execution
- **Real-time Dashboard** - Live monitoring and control
- **RESTful API** - Comprehensive developer API

## 📁 Project Structure

\`\`\`
quantum-blockchain-php/
├── public/                 # Web accessible files
├── src/                   # Application source code
├── config/               # Configuration files
├── database/             # Database schemas
├── docs/                 # Documentation
└── generate-project.php  # Project generator script
\`\`\`

## 🔧 Configuration

Edit configuration files in \`config/\` directory:
- \`database.php\` - Database connections
- \`quantum.php\` - Quantum algorithm parameters
- \`trading.php\` - Trading strategy settings

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

**Built with ❤️ using cutting-edge quantum-blockchain technology**`;
    }
}

// =========================================================================
// EXECUTION
// =========================================================================

echo "⚛️  Quantum Blockchain Project Generator\n";
echo "========================================\n";

// Check if running in correct directory
if (file_exists('generate-project.php') && $argc > 1 && $argv[1] === '--self') {
    echo "⚠️  Generator is running itself. This is normal for initial setup.\n";
}

$generator = new ProjectGenerator();
$generator->generateAllFiles();

// Create a simple version file
file_put_contents('VERSION', '1.0.0');
echo "✅ Version file created: 1.0.0\n";

echo "\n🎉 Project generation completed successfully!\n";
echo "📚 Check the generated README.md for next steps.\n";
?>
