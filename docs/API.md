# API 文档

基础地址：

```text
http://127.0.0.1:8000
```

## 统一响应结构

成功：

```json
{
  "success": true,
  "message": "success",
  "data": {}
}
```

失败：

```json
{
  "success": false,
  "message": "error message",
  "errors": {}
}
```

## 资产接口

### 查询资产列表

```http
GET /api/assets
```

可选参数：

| 参数 | 说明 |
|---|---|
| asset_type | 资产类型，例如 fund、stock、bond、etf |
| risk_level | 风险等级，例如 low、medium、high |

示例：

```http
GET /api/assets?asset_type=fund&risk_level=medium
```

### 查看资产详情

```http
GET /api/assets/show?id=1
```

### 新增资产

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

## 交易接口

### 查询交易记录

```http
GET /api/trades
```

可选参数：

| 参数 | 说明 |
|---|---|
| customer_id | 客户 ID |
| asset_id | 资产 ID |
| trade_type | buy 或 sell |

### 新增交易记录

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

## 报表接口

### 客户持仓汇总

```http
GET /api/reports/customer-summary?customer_id=1
```

### 资产表现统计

```http
GET /api/reports/asset-performance
```

### 导出 CSV 报表

```http
GET /api/reports/export-csv
```
