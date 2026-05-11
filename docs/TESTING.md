# Testing Guide

This document explains how to test `finance-api-demo` with Postman.

## 1. Start Local Server

```bash
php -S 127.0.0.1:8000 -t public
```

## 2. Import Postman Collection

Open Postman and import:

```text
postman/finance-api-demo.postman_collection.json
```

## 3. Set Environment Variable

Create or select an environment in Postman:

| Variable | Value |
|---|---|
| base_url | http://127.0.0.1:8000 |

## 4. Suggested Test Order

### 4.1 Health Check

```http
GET /
```

Expected result:

- HTTP 200
- `success = true`
- Project name returned

### 4.2 Query Assets

```http
GET /api/assets
```

Expected result:

- Asset list returned
- Response contains `items`

### 4.3 Create Asset

```http
POST /api/assets
```

Request body:

```json
{
  "asset_code": "FUND002",
  "asset_name": "Income Fund B",
  "asset_type": "fund",
  "risk_level": "medium",
  "current_value": 98000.00
}
```

Expected result:

- HTTP 201
- New asset ID returned

### 4.4 Query Trades

```http
GET /api/trades
```

Expected result:

- Trade list returned
- Customer and asset names joined correctly

### 4.5 Create Trade

```http
POST /api/trades
```

Request body:

```json
{
  "customer_id": 1,
  "asset_id": 1,
  "trade_type": "buy",
  "amount": 10000.00,
  "trade_date": "2026-04-01"
}
```

Expected result:

- HTTP 201
- New trade ID returned

### 4.6 Customer Summary

```http
GET /api/reports/customer-summary?customer_id=1
```

Expected result:

- Customer information returned
- Summary grouped by asset type

### 4.7 Asset Performance

```http
GET /api/reports/asset-performance
```

Expected result:

- Asset performance data returned
- Total buy, total sell and net amount returned

### 4.8 Export CSV

```http
GET /api/reports/export-csv
```

Expected result:

- CSV file downloaded
- File contains trade data

## 5. Common Issues

### Database connection failed

Check `.env` database configuration:

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=finance_api_demo
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Route not found

Check API path and request method.

### Empty data returned

Make sure SQL seed data has been imported:

```bash
mysql -u root -p finance_api_demo < database/seed.sql
```
