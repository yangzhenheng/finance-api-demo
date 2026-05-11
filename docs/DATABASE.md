# Database Design

This document describes the database design of `finance-api-demo`.

## Tables

The project contains three core tables:

| Table | Description |
|---|---|
| customers | Stores customer information |
| assets | Stores financial asset information |
| trades | Stores trade records |

## Entity Relationship

```text
customers 1 ---- N trades N ---- 1 assets
```

Explanation:

- One customer can have many trade records.
- One asset can appear in many trade records.
- The `trades` table links customers and assets through foreign keys.

## Table: customers

Stores basic customer information.

| Field | Type | Description |
|---|---|---|
| id | INT UNSIGNED | Primary key |
| customer_name | VARCHAR(100) | Customer name |
| email | VARCHAR(150) | Customer email |
| phone | VARCHAR(30) | Customer phone |
| created_at | TIMESTAMP | Created time |

## Table: assets

Stores financial asset information.

| Field | Type | Description |
|---|---|---|
| id | INT UNSIGNED | Primary key |
| asset_code | VARCHAR(50) | Unique asset code |
| asset_name | VARCHAR(150) | Asset name |
| asset_type | VARCHAR(50) | Asset type |
| risk_level | VARCHAR(30) | Risk level |
| current_value | DECIMAL(15,2) | Current asset value |
| created_at | TIMESTAMP | Created time |

## Table: trades

Stores customer trade records.

| Field | Type | Description |
|---|---|---|
| id | INT UNSIGNED | Primary key |
| customer_id | INT UNSIGNED | Foreign key to customers.id |
| asset_id | INT UNSIGNED | Foreign key to assets.id |
| trade_type | ENUM('buy', 'sell') | Trade type |
| amount | DECIMAL(15,2) | Trade amount |
| trade_date | DATE | Trade date |
| created_at | TIMESTAMP | Created time |

## Indexes

| Table | Index | Purpose |
|---|---|---|
| trades | idx_customer_id | Improve customer trade query |
| trades | idx_asset_id | Improve asset trade query |
| trades | idx_trade_date | Improve report query by date |

## Design Notes

- `DECIMAL(15,2)` is used for money-related values to avoid floating-point precision issues.
- Foreign keys are used to keep data relationship clear.
- Trade type is limited to `buy` and `sell` to avoid invalid transaction types.
- Indexes are added to fields frequently used in filtering and reporting.
