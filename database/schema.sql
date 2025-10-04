-- Quantum Blockchain Trading System Database Schema
-- Created: 2025-10-04 19:57:55

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
    processor_type ENUM('simulated', 'real') DEFAULT 'simulated',
    qubit_count INT NOT NULL,
    status ENUM('active', 'inactive', 'maintenance') DEFAULT 'active',
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
('Quantum Processor 1', 'simulated', 128, 'active'),
('Quantum Processor 2', 'simulated', 256, 'active');

INSERT INTO trading_strategies (name, description, parameters) VALUES
('Arbitrage Strategy', 'Cross-exchange arbitrage trading', '{"max_position_size": 0.1, "risk_tolerance": 0.02}'),
('Market Making', 'Provide liquidity to markets', '{"spread": 0.001, "max_inventory": 1000}'),
('Trend Following', 'Follow market trends using technical analysis', '{"lookback_period": 20, "threshold": 0.05}'),
('Quantum AI', 'AI-driven strategy using quantum algorithms', '{"quantum_qubits": 64, "learning_rate": 0.01}');