# finance-api-demo API 文档

基础地址：

```text
http://127.0.0.1:8000
```

## 统一响应格式

### 成功响应

```json
{
  "success": true,
  "message": "success",
  "data": {}
}
```

### 失败响应

```json
{
  "success": false,
  "message": "error message",
  "errors": {}
}
```

## 1. 系统状态

### 1.1 健康检查

```http
GET /
```

响应示例：

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

## 2. 资产接口

### 2.1 查询资产列表

```http
GET /api/assets
```

可选查询参数：

| 参数 | 类型 | 必填 | 说明 |
|---|---|---|---|
| asset_type | string | 否 | 资产类型，例如 fund、stock、bond、etf |
| risk_level | string | 否 | 风险等级，例如 low、medium、high |

请求示例：

```http
GET /api/assets?asset_type=fund&risk_level=medium
```

响应字段说明：

| 字段 | 说明 |
|---|---|
| id | 资产 ID |
| asset_code | 资产编码 |
| asset_name | 资产名称 |
| asset_type | 资产类型 |
| risk_level | 风险等级 |
| current_value | 当前资产价值 |
| created_at | 创建时间 |

### 2.2 查询资产详情

```http
GET /api/assets/show?id=1
```

### 2.3 新增资产

```http
POST /api/assets
Content-Type: application/json
```

请求体：

```json
{
  "asset_code": "FUND002",
  "asset_name": "Income Fund B",
  "asset_type": "fund",
  "risk_level": "medium",
  "current_value": 98000.00
}
```

成功响应：

```json
{
  "success": true,
  "message": "Asset created",
  "data": {
    "id": 5
  }
}
```

## 3. 交易接口

### 3.1 查询交易记录

```http
GET /api/trades
```

可选查询参数：

| 参数 | 类型 | 必填 | 说明 |
|---|---|---|---|
| customer_id | int | 否 | 客户 ID |
| asset_id | int | 否 | 资产 ID |
| trade_type | string | 否 | 交易类型：buy / sell |

请求示例：

```http
GET /api/trades?customer_id=1&trade_type=buy
```

### 3.2 新增交易记录

```http
POST /api/trades
Content-Type: application/json
```

请求体：

```json
{
  "customer_id": 1,
  "asset_id": 1,
  "trade_type": "buy",
  "amount": 10000.00,
  "trade_date": "2026-04-01"
}
```

## 4. 报表接口

### 4.1 客户持仓汇总

```http
GET /api/reports/customer-summary?customer_id=1
```

功能说明：

- 查询指定客户基础信息
- 按资产类型聚合交易记录
- 统计交易次数和净交易金额

### 4.2 资产表现统计

```http
GET /api/reports/asset-performance
```

功能说明：

- 查询所有资产
- 汇总每个资产的买入金额
- 汇总每个资产的卖出金额
- 计算净交易金额

### 4.3 导出 CSV 报表

```http
GET /api/reports/export-csv
```

CSV 字段：

| 字段 | 说明 |
|---|---|
| customer_name | 客户名称 |
| asset_code | 资产编码 |
| asset_name | 资产名称 |
| trade_type | 交易类型 |
| amount | 交易金额 |
| trade_date | 交易日期 |

## 5. 错误码说明

| HTTP 状态码 | 说明 |
|---|---|
| 200 | 请求成功 |
| 201 | 创建成功 |
| 400 | 参数错误 |
| 404 | 资源不存在 |
| 500 | 服务器错误 |

## 6. Postman 测试

Postman 集合路径：

```text
postman/finance-api-demo.postman_collection.json
```

导入后设置变量：

```text
base_url = http://127.0.0.1:8000
```

然后依次测试：

1. Health Check
2. Get Assets
3. Create Asset
4. Get Trades
5. Create Trade
6. Customer Summary
7. Asset Performance
8. Export CSV
