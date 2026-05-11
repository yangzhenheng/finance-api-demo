# finance-api-demo

金融数据报表 API 系统 Demo。  
本项目使用 **PHP + MySQL + RESTful API** 实现资产、交易记录、收益统计和报表导出等基础功能，用于展示后端 API 开发、数据库设计、接口文档编写和 Postman 测试能力。

## 项目定位

该项目模拟企业内部金融数据管理场景，支持对资产数据、交易流水和收益情况进行录入、查询、筛选、统计和导出。项目适合作为初级后端开发工程师求职作品，重点展示：

- PHP 后端接口开发能力
- MySQL 数据表设计能力
- RESTful API 设计能力
- JSON 响应结构、参数校验、错误处理
- Postman 接口测试与接口文档整理
- 金融数据处理与报表导出基础能力

## 技术栈

- PHP 8+
- MySQL 5.7 / 8.0
- PDO
- RESTful API
- Postman
- Git / GitHub

## 项目结构

```text
finance-api-demo
├── public
│   └── index.php              # API 入口文件
├── src
│   ├── Core
│   │   ├── Database.php       # 数据库连接
│   │   ├── Response.php       # 统一 JSON 响应
│   │   └── Router.php         # 简易路由
│   └── Controllers
│       ├── AssetController.php
│       ├── TradeController.php
│       └── ReportController.php
├── database
│   ├── schema.sql             # 数据库表结构
│   └── seed.sql               # 测试数据
├── docs
│   └── API.md                 # 接口文档
├── postman
│   └── finance-api-demo.postman_collection.json
├── .env.example
├── composer.json
└── README.md
```

## 核心功能

### 资产管理

- 新增资产
- 查询资产列表
- 按资产类型、风险等级筛选
- 查看资产详情

### 交易记录

- 新增交易记录
- 查询交易流水
- 按客户、资产、交易类型筛选

### 数据统计

- 客户总持仓统计
- 资产收益率统计
- 交易金额汇总
- 报表数据导出为 CSV

## 快速启动

### 1. 克隆项目

```bash
git clone https://github.com/yangzhenheng/finance-api-demo.git
cd finance-api-demo
```

### 2. 配置数据库

新建 MySQL 数据库：

```sql
CREATE DATABASE finance_api_demo DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

导入表结构和测试数据：

```bash
mysql -u root -p finance_api_demo < database/schema.sql
mysql -u root -p finance_api_demo < database/seed.sql
```

### 3. 配置环境变量

复制配置文件：

```bash
cp .env.example .env
```

修改 `.env` 中的数据库配置：

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=finance_api_demo
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. 启动 PHP 内置服务器

```bash
php -S 127.0.0.1:8000 -t public
```

访问：

```text
http://127.0.0.1:8000
```

## 常用接口示例

### 查询资产列表

```http
GET /api/assets
```

### 新增资产

```http
POST /api/assets
Content-Type: application/json

{
  "asset_code": "FUND001",
  "asset_name": "Growth Fund A",
  "asset_type": "fund",
  "risk_level": "medium",
  "current_value": 120000.00
}
```

### 查询交易记录

```http
GET /api/trades
```

### 查询客户报表

```http
GET /api/reports/customer-summary?customer_id=1
```

### 导出 CSV 报表

```http
GET /api/reports/export-csv
```

## 简历对应说明

本项目对应简历中的：

> finance-api-demo｜金融数据报表 API 系统  
> PHP + MySQL + Postman

主要展示后端 API 开发、数据库设计、金融数据处理、报表导出和接口文档能力。

## 后续优化方向

- 增加 Token 鉴权
- 增加分页和排序
- 增加接口日志
- 增加 Docker 部署
- 增加单元测试
- 增加前端管理页面

## 作者

Henny / 杨振恒  
GitHub: https://github.com/yangzhenheng
