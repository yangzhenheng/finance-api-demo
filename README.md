# finance-api-demo

> PHP RESTful API demo for financial data management and report generation.  
> 一个面向金融数据处理与报表导出的 PHP 后端 API 示例项目。

## 项目简介

`finance-api-demo` 是一个使用 **PHP + MySQL + RESTful API** 开发的后端项目，用于模拟企业内部金融数据管理场景。项目围绕资产数据、客户交易记录、收益统计和 CSV 报表导出进行设计，重点展示后端开发中的接口设计、数据库建模、参数校验、统一响应、错误处理和接口文档能力。

该项目适合作为初级后端开发工程师求职作品，尤其匹配以下岗位方向：

- PHP 后端开发
- RESTful API 开发
- 金融数据处理
- 后台管理系统接口
- 报表统计与导出
- GitHub 项目展示与接口文档编写

## 技术栈

| 类型 | 技术 |
|---|---|
| 后端语言 | PHP 8+ |
| 数据库 | MySQL |
| 数据库连接 | PDO |
| 接口风格 | RESTful API |
| 数据格式 | JSON |
| 接口测试 | Postman |
| 文档 | Markdown |
| 版本管理 | Git / GitHub |

## 核心功能

### 资产管理

- 新增资产数据
- 查询资产列表
- 按资产类型筛选
- 按风险等级筛选
- 查询资产详情

### 交易记录

- 新增客户交易记录
- 查询交易流水
- 按客户 ID 筛选
- 按资产 ID 筛选
- 按交易类型筛选

### 报表统计

- 客户资产汇总
- 资产交易表现统计
- 买入 / 卖出金额汇总
- CSV 报表导出

### 工程设计

- 简易路由封装
- PDO 数据库连接封装
- 统一 JSON 响应结构
- 基础参数校验
- 基础错误处理
- Postman 接口测试集合

## 项目结构

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
│   └── API.md
├── postman
│   └── finance-api-demo.postman_collection.json
├── .env.example
├── .gitignore
├── composer.json
└── README.md
```

## 快速启动

### 1. 克隆项目

```bash
git clone https://github.com/yangzhenheng/finance-api-demo.git
cd finance-api-demo
```

### 2. 安装依赖

```bash
composer install
```

### 3. 创建数据库

```sql
CREATE DATABASE finance_api_demo DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 4. 导入表结构和测试数据

```bash
mysql -u root -p finance_api_demo < database/schema.sql
mysql -u root -p finance_api_demo < database/seed.sql
```

### 5. 配置环境变量

```bash
cp .env.example .env
```

根据本地 MySQL 修改 `.env`：

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=finance_api_demo
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 6. 启动项目

```bash
php -S 127.0.0.1:8000 -t public
```

浏览器访问：

```text
http://127.0.0.1:8000
```

## 接口示例

### 查询资产列表

```http
GET /api/assets
```

### 新增资产

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

### 查询交易记录

```http
GET /api/trades
```

### 查询客户汇总报表

```http
GET /api/reports/customer-summary?customer_id=1
```

### 导出 CSV 报表

```http
GET /api/reports/export-csv
```

完整接口文档见：

```text
docs/API.md
```

## 数据库设计

项目包含 3 张核心表：

| 表名 | 说明 |
|---|---|
| customers | 客户信息表 |
| assets | 金融资产表 |
| trades | 交易记录表 |

核心关系：

- 一个客户可以有多条交易记录
- 一个资产可以关联多条交易记录
- 交易记录通过 `customer_id` 和 `asset_id` 关联客户与资产

## Postman 测试

Postman 集合文件：

```text
postman/finance-api-demo.postman_collection.json
```

导入 Postman 后，将环境变量设置为：

```text
base_url = http://127.0.0.1:8000
```

即可测试资产、交易和报表相关接口。

## 项目亮点

- 使用 PHP 原生方式实现后端 API，便于展示基础功底
- 使用 PDO 操作 MySQL，避免直接拼接 SQL
- 通过 Controller / Core 分层组织代码，结构清晰
- README、API 文档、SQL 文件和 Postman 集合完整
- 项目场景与金融数据处理、报表导出、企业内部 API 开发岗位匹配

## 后续优化计划

- 增加 Token 鉴权
- 增加分页与排序
- 增加接口访问日志
- 增加 Docker 部署文件
- 增加 PHPUnit 单元测试
- 增加后台管理前端页面

## 作者

**Henny / 杨振恒**

- GitHub: https://github.com/yangzhenheng
- Project: https://github.com/yangzhenheng/finance-api-demo
