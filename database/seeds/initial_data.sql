-- Initial Data Seeding for Quantum Blockchain Trading System
USE quantum_blockchain;

-- Add sample market data
INSERT IGNORE INTO market_data (asset_pair, price, volume, source) VALUES
('BTC/USDT', 45000.50, 25000.75, 'binance'),
('ETH/USDT', 3000.25, 15000.50, 'binance'),
('ADA/USDT', 0.45, 5000000.00, 'binance'),
('DOT/USDT', 7.50, 750000.00, 'binance'),
('LINK/USDT', 15.75, 350000.00, 'binance');

-- Add sample portfolio positions
INSERT IGNORE INTO portfolio (user_id, asset, quantity, average_buy_price, current_price, current_value, unrealized_pnl) VALUES
(1, 'BTC', 0.5, 44000.00, 45000.50, 22500.25, 500.25),
(1, 'ETH', 5.0, 2900.00, 3000.25, 15001.25, 501.25),
(1, 'ADA', 10000.0, 0.40, 0.45, 4500.00, 500.00);

-- Add sample quantum computations
INSERT IGNORE INTO quantum_computations (processor_id, algorithm, input_parameters, output_result, computation_time, status, created_by) VALUES
(1, 'shor', '{"number": 15}', '{"factors": [3, 5]}', 150.5, 'completed', 1),
(1, 'grover', '{"search_space": 1000}', '{"solution_found": true}', 89.2, 'completed', 1),
(2, 'qml_training', '{"training_data": "market_data"}', '{"accuracy": 0.92}', 234.7, 'completed', 1);

-- Add sample smart contracts
INSERT IGNORE INTO smart_contracts (contract_address, contract_name, contract_type, contract_code, abi_definition, deployed_by, current_state) VALUES
('0x742d35cc6634c0532925a3b8b23b0f3c4a1a1a1a', 'QuantumTradingV1', 'trading', 'pragma solidity ^0.8.0; contract QuantumTrading { }', '[]', 1, '{"total_trades": 15, "active": true}'),
('0x842d35cc6634c0532925a3b8b23b0f3c4a1a1a1b', 'NFTPortfolioV1', 'nft', 'pragma solidity ^0.8.0; contract NFTPortfolio { }', '[]', 1, '{"total_nfts": 5, "floor_price": 1.5}');

-- Add sample blockchain transactions
INSERT IGNORE INTO blockchain_transactions (tx_hash, contract_address, function_called, parameters, status, gas_used, executed_by) VALUES
('0xabc123def456abc123def456abc123def456abc123def456abc123def456abcd', '0x742d35cc6634c0532925a3b8b23b0f3c4a1a1a1a', 'executeTrade', '{"asset": "BTC", "amount": 0.1}', 'confirmed', 85000, 1),
('0xdef456abc123def456abc123def456abc123def456abc123def456abc123def4', '0x842d35cc6634c0532925a3b8b23b0f3c4a1a1a1b', 'mintNFT', '{"tokenId": 1, "to": "0x123..."}', 'confirmed', 120000, 1);

-- Add sample trading orders
INSERT IGNORE INTO trading_orders (strategy_id, order_id, asset_pair, order_type, order_side, quantity, price, status, exchange, pnl) VALUES
(1, 'order_001', 'BTC/USDT', 'buy', 'long', 0.1, 44900.00, 'filled', 'binance', 15.50),
(1, 'order_002', 'ETH/USDT', 'sell', 'short', 2.0, 3010.00, 'filled', 'binance', -25.75),
(2, 'order_003', 'ADA/USDT', 'buy', 'long', 1000.0, 0.44, 'pending', 'binance', 0.00);

-- Add sample system metrics
INSERT IGNORE INTO system_metrics (metric_name, metric_value, metric_type) VALUES
('quantum_computations_per_hour', 12.5, 'performance'),
('average_trade_execution_time', 0.15, 'performance'),
('api_response_time_avg', 45.2, 'performance'),
('system_uptime', 99.98, 'resource'),
('memory_usage_percent', 65.3, 'resource');

-- Add sample audit logs
INSERT IGNORE INTO audit_logs (user_id, action, resource_type, resource_id, details, ip_address) VALUES
(1, 'user_login', 'user', 1, '{"method": "api_key"}', '192.168.1.100'),
(1, 'quantum_computation', 'quantum', 1, '{"algorithm": "shor", "result": "success"}', '192.168.1.100'),
(1, 'trade_execution', 'trading', 1, '{"asset": "BTC", "quantity": 0.1}', '192.168.1.100');

COMMIT;
SELECT 'Initial data seeding completed successfully!' as message;
