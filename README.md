# finance-api-demo

> PHP RESTful API demo for financial data management and report generation.  
> 一个面向金融数据处理、交易记录管理和报表导出的 PHP 后端 API 示例项目。

## Overview

`finance-api-demo` 是一个基于 **PHP + MySQL + RESTful API** 的后端项目，用于模拟企业内部金融数据管理系统的基础服务能力。

项目围绕客户、资产、交易记录和报表统计进行设计，重点实现：

- 金融资产数据管理
- 客户交易记录管理
- 资产与交易数据查询
- 客户持仓汇总
- 资产交易表现统计
- CSV 报表导出
- RESTful API 文档与 Postman 测试集合

该项目主要展示后端开发中的 **接口设计、数据库建模、参数校验、统一响应、错误处理、SQL 查询与接口文档编写能力**。

## Tech Stack

| Category | Technology |
|---|---|
| Language | PHP 8+ |
| Database | MySQL |
| Database Access | PDO |
| API Style | RESTful API |
| Response Format | JSON |
| API Testing | Postman |
| Documentation | Markdown |
| Version Control | Git / GitHub |

## Features

### Asset Management

- Create asset records
- Query asset list
- Filter assets by type
- Filter assets by risk level
- Query asset detail

### Trade Management

- Create trade records
- Query trade list
- Filter trades by customer
- Filter trades by asset
- Filter trades by trade type

### Report APIs

- Customer summary report
- Asset performance report
- CSV report export

### Engineering Design

- Simple router implementation
- PDO database connection wrapper
- Controller-based project structure
- Unified JSON response format
- Basic request validation
- Basic exception and error response handling
- SQL schema and seed data
- Postman collection for API testing

## Project Structure

```text
finance-api-demo
├── public
│   └── index.php
├── src
│   ├── Core
│   │   ├── Database.php
│   │   ├── Response.php
│   │   └── Router.php
│   └── Controllers
│       ├── AssetController.php
│       ├── TradeController.php
│       └── ReportController.php
├── database
│   ├── schema.sql
│   └── seed.sql
├── docs
│   ├── API.md
│   ├── DATABASE.md
│   ├── TESTING.md
│   └── PROJECT_DESIGN.md
├── postman
│   └── finance-api-demo.postman_collection.json
├── .env.example
├── .gitignore
├── composer.json
└── README.md
```

## Quick Start

### 1. Clone Repository

```bash
git clone https://github.com/yangzhenheng/finance-api-demo.git
cd finance-api-demo
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Create Database

```sql
CREATE DATABASE finance_api_demo DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 4. Import SQL Files

```bash
mysql -u root -p finance_api_demo < database/schema.sql
mysql -u root -p finance_api_demo < database/seed.sql
```

### 5. Configure Environment

```bash
cp .env.example .env
```

Update `.env`:

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=finance_api_demo
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 6. Start Development Server

```bash
php -S 127.0.0.1:8000 -t public
```

Visit:

```text
http://127.0.0.1:8000
```

## API Examples

### Health Check

```http
GET /
```

### Get Asset List

```http
GET /api/assets
```

### Create Asset

```http
POST /api/assets
Content-Type: application/json

{
  "asset_code": "FUND002",
  "asset_name": "Income Fund B",
  "asset_type": "fund",
  "risk_level": "medium",
  "current_value": 98000.00
}
```

### Get Trade List

```http
GET /api/trades
```

### Create Trade

```http
POST /api/trades
Content-Type: application/json

{
  "customer_id": 1,
  "asset_id": 1,
  "trade_type": "buy",
  "amount": 10000.00,
  "trade_date": "2026-04-01"
}
```

### Customer Summary Report

```http
GET /api/reports/customer-summary?customer_id=1
```

### Asset Performance Report

```http
GET /api/reports/asset-performance
```

### Export CSV Report

```http
GET /api/reports/export-csv
```

## Documentation

| File | Description |
|---|---|
| [docs/API.md](docs/API.md) | API documentation |
| [docs/DATABASE.md](docs/DATABASE.md) | Database schema and table relationship |
| [docs/TESTING.md](docs/TESTING.md) | Postman testing guide |
| [docs/PROJECT_DESIGN.md](docs/PROJECT_DESIGN.md) | Project design and technical explanation |

## Database Design

The project includes three main tables:

| Table | Description |
|---|---|
| customers | Customer profile table |
| assets | Financial asset table |
| trades | Trade record table |

Relationship:

- One customer can have multiple trade records.
- One asset can be linked to multiple trade records.
- The `trades` table connects customers and assets through `customer_id` and `asset_id`.

See details in [docs/DATABASE.md](docs/DATABASE.md).

## Postman

Postman collection:

```text
postman/finance-api-demo.postman_collection.json
```

Set environment variable:

```text
base_url = http://127.0.0.1:8000
```

Then run API requests in Postman.

## Highlights

- Clear RESTful API structure
- Basic MVC-style organization with Controller and Core modules
- PDO-based database access
- MySQL schema with foreign key relationships
- Unified JSON response format
- API documentation and Postman collection included
- CSV export endpoint for report generation
- Suitable for demonstrating backend fundamentals in PHP API development

## Future Improvements

- Add Token-based authentication
- Add pagination and sorting
- Add request logging
- Add Docker deployment
- Add PHPUnit tests
- Add frontend admin dashboard
- Add role-based access control

## Author

**Henny / 杨振恒**

- GitHub: https://github.com/yangzhenheng
- Project: https://github.com/yangzhenheng/finance-api-demo
