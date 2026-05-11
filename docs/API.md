# API Documentation

Base URL:

```text
http://127.0.0.1:8000
```

## Response Format

### Success Response

```json
{
  "success": true,
  "message": "success",
  "data": {}
}
```

### Error Response

```json
{
  "success": false,
  "message": "error message",
  "errors": {}
}
```

## 1. Health Check

### Request

```http
GET /
```

### Response Example

```json
{
  "success": true,
  "message": "success",
  "data": {
    "project": "finance-api-demo",
    "message": "Financial data report API is running.",
    "docs": "/docs/API.md"
  }
}
```

## 2. Asset APIs

### 2.1 Get Asset List

```http
GET /api/assets
```

Optional query parameters:

| Parameter | Type | Required | Description |
|---|---|---|---|
| asset_type | string | No | Asset type, such as fund, stock, bond, etf |
| risk_level | string | No | Risk level, such as low, medium, high |

Request example:

```http
GET /api/assets?asset_type=fund&risk_level=medium
```

Response data fields:

| Field | Description |
|---|---|
| id | Asset ID |
| asset_code | Asset code |
| asset_name | Asset name |
| asset_type | Asset type |
| risk_level | Risk level |
| current_value | Current value |
| created_at | Created time |

### 2.2 Get Asset Detail

```http
GET /api/assets/show?id=1
```

Query parameters:

| Parameter | Type | Required | Description |
|---|---|---|---|
| id | int | Yes | Asset ID |

### 2.3 Create Asset

```http
POST /api/assets
Content-Type: application/json
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

Request fields:

| Field | Type | Required | Description |
|---|---|---|---|
| asset_code | string | Yes | Asset code |
| asset_name | string | Yes | Asset name |
| asset_type | string | Yes | Asset type |
| risk_level | string | Yes | Risk level |
| current_value | decimal | Yes | Current value |

Response example:

```json
{
  "success": true,
  "message": "Asset created",
  "data": {
    "id": 5
  }
}
```

## 3. Trade APIs

### 3.1 Get Trade List

```http
GET /api/trades
```

Optional query parameters:

| Parameter | Type | Required | Description |
|---|---|---|---|
| customer_id | int | No | Customer ID |
| asset_id | int | No | Asset ID |
| trade_type | string | No | buy or sell |

Request example:

```http
GET /api/trades?customer_id=1&trade_type=buy
```

Response data fields:

| Field | Description |
|---|---|
| id | Trade ID |
| customer_name | Customer name |
| asset_code | Asset code |
| asset_name | Asset name |
| trade_type | Trade type |
| amount | Trade amount |
| trade_date | Trade date |
| created_at | Created time |

### 3.2 Create Trade

```http
POST /api/trades
Content-Type: application/json
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

Request fields:

| Field | Type | Required | Description |
|---|---|---|---|
| customer_id | int | Yes | Customer ID |
| asset_id | int | Yes | Asset ID |
| trade_type | string | Yes | buy or sell |
| amount | decimal | Yes | Trade amount |
| trade_date | date | Yes | Trade date |

Response example:

```json
{
  "success": true,
  "message": "Trade created",
  "data": {
    "id": 8
  }
}
```

## 4. Report APIs

### 4.1 Customer Summary

```http
GET /api/reports/customer-summary?customer_id=1
```

Query parameters:

| Parameter | Type | Required | Description |
|---|---|---|---|
| customer_id | int | Yes | Customer ID |

This endpoint returns:

- Customer basic information
- Trade count grouped by asset type
- Net trade amount grouped by asset type

### 4.2 Asset Performance

```http
GET /api/reports/asset-performance
```

This endpoint returns:

- Asset basic information
- Total buy amount
- Total sell amount
- Net trade amount

### 4.3 Export CSV

```http
GET /api/reports/export-csv
```

This endpoint exports trade records as a CSV file.

CSV fields:

| Field | Description |
|---|---|
| customer_name | Customer name |
| asset_code | Asset code |
| asset_name | Asset name |
| trade_type | Trade type |
| amount | Trade amount |
| trade_date | Trade date |

## 5. HTTP Status Codes

| Status Code | Description |
|---|---|
| 200 | OK |
| 201 | Created |
| 400 | Bad Request |
| 404 | Not Found |
| 500 | Internal Server Error |

## 6. Postman Testing

Postman collection:

```text
postman/finance-api-demo.postman_collection.json
```

Environment variable:

```text
base_url = http://127.0.0.1:8000
```

Suggested test order:

1. Health Check
2. Get Assets
3. Create Asset
4. Get Trades
5. Create Trade
6. Customer Summary
7. Asset Performance
8. Export CSV
