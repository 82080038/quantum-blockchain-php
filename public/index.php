<?php
require_once '../src/utils/Database.php';
require_once '../src/services/QuantumService.php';
require_once '../src/controllers/DashboardController.php';

use QuantumBlockchain\Utils\Database;
use QuantumBlockchain\Services\QuantumService;
use QuantumBlockchain\Controllers\DashboardController;

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
        </div>
    </div>

    <script src="js/dashboard.js"></script>
</body>
</html>