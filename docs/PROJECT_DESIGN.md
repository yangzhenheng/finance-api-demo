# Project Design

This document explains the design of `finance-api-demo`.

## Business Scenario

The project simulates a financial data management API used by an internal business system. The system manages customers, assets and trade records, then provides summary reports for internal analysis.

The main business flow is:

1. Maintain asset data.
2. Maintain customer trade records.
3. Query assets and trades with filters.
4. Generate summary reports.
5. Export trade data as CSV.

## Module Design

### public/index.php

The API entry file. It handles:

- Environment loading
- CORS headers
- Router registration
- Controller binding

### src/Core/Router.php

A simple router implementation that maps request methods and paths to controller methods.

Example:

```php
$router->get('/api/assets', [$assetController, 'index']);
$router->post('/api/assets', [$assetController, 'store']);
```

### src/Core/Database.php

Database connection wrapper based on PDO.

Main responsibilities:

- Read database config from `.env`
- Create PDO connection
- Set error mode
- Use associative array fetch mode

### src/Core/Response.php

Unified JSON response helper.

Main responsibilities:

- Return success response
- Return error response
- Set HTTP status code
- Keep API response format consistent

### Controllers

| Controller | Responsibility |
|---|---|
| AssetController | Asset query and creation |
| TradeController | Trade query and creation |
| ReportController | Customer summary, asset performance and CSV export |

## API Design Principles

- Use JSON as the standard response format.
- Use clear endpoint naming.
- Keep controller methods focused on one responsibility.
- Use prepared statements to reduce SQL injection risk.
- Use HTTP status codes to indicate request result.
- Use basic validation for required fields.

## Why PDO

PDO is used because:

- It supports prepared statements.
- It provides a consistent database access interface.
- It is suitable for small PHP API projects.
- It helps avoid direct SQL string concatenation.

## Why DECIMAL for Money

Money-related fields use `DECIMAL(15,2)` instead of float because floating-point values may cause precision problems. `DECIMAL` is more suitable for financial amounts.

## Current Limitations

This is a demo-level backend project. It does not yet include:

- User authentication
- Role-based access control
- Pagination
- Request logging
- Unit tests
- Docker deployment

These are listed as future improvements in README.
