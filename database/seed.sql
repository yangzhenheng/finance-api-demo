INSERT INTO customers (customer_name, email, phone) VALUES
('Alice Chen', 'alice@example.com', '13800000001'),
('Bob Wang', 'bob@example.com', '13800000002'),
('Cindy Liu', 'cindy@example.com', '13800000003');

INSERT INTO assets (asset_code, asset_name, asset_type, risk_level, current_value) VALUES
('FUND001', 'Growth Fund A', 'fund', 'medium', 120000.00),
('STK001', 'Technology Stock Portfolio', 'stock', 'high', 86000.00),
('BOND001', 'Stable Bond Plan', 'bond', 'low', 54000.00),
('ETF001', 'Index ETF Plan', 'etf', 'medium', 73000.00);

INSERT INTO trades (customer_id, asset_id, trade_type, amount, trade_date) VALUES
(1, 1, 'buy', 20000.00, '2026-01-10'),
(1, 2, 'buy', 15000.00, '2026-02-05'),
(1, 1, 'sell', 5000.00, '2026-03-01'),
(2, 3, 'buy', 30000.00, '2026-01-20'),
(2, 4, 'buy', 12000.00, '2026-02-18'),
(3, 2, 'buy', 18000.00, '2026-02-25'),
(3, 4, 'sell', 3000.00, '2026-03-08');
