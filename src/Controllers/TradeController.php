<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Core\Response;

class TradeController
{
    public function index(): void
    {
        $pdo = Database::connection();

        $where = [];
        $params = [];

        if (!empty($_GET['customer_id'])) {
            $where[] = 't.customer_id = :customer_id';
            $params['customer_id'] = (int)$_GET['customer_id'];
        }

        if (!empty($_GET['asset_id'])) {
            $where[] = 't.asset_id = :asset_id';
            $params['asset_id'] = (int)$_GET['asset_id'];
        }

        if (!empty($_GET['trade_type'])) {
            $where[] = 't.trade_type = :trade_type';
            $params['trade_type'] = $_GET['trade_type'];
        }

        $sql = '
            SELECT
                t.id,
                c.customer_name,
                a.asset_code,
                a.asset_name,
                t.trade_type,
                t.amount,
                t.trade_date,
                t.created_at
            FROM trades t
            LEFT JOIN customers c ON c.id = t.customer_id
            LEFT JOIN assets a ON a.id = t.asset_id
        ';

        if ($where) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }

        $sql .= ' ORDER BY t.trade_date DESC, t.id DESC';

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        Response::success([
            'items' => $stmt->fetchAll()
        ]);
    }

    public function store(): void
    {
        $input = json_decode(file_get_contents('php://input'), true) ?? [];

        $required = ['customer_id', 'asset_id', 'trade_type', 'amount', 'trade_date'];
        foreach ($required as $field) {
            if (!isset($input[$field]) || $input[$field] === '') {
                Response::error("Missing required field: {$field}");
            }
        }

        if (!in_array($input['trade_type'], ['buy', 'sell'], true)) {
            Response::error('trade_type must be buy or sell');
        }

        $sql = 'INSERT INTO trades (customer_id, asset_id, trade_type, amount, trade_date)
                VALUES (:customer_id, :asset_id, :trade_type, :amount, :trade_date)';

        $stmt = Database::connection()->prepare($sql);
        $stmt->execute([
            'customer_id' => (int)$input['customer_id'],
            'asset_id' => (int)$input['asset_id'],
            'trade_type' => $input['trade_type'],
            'amount' => (float)$input['amount'],
            'trade_date' => $input['trade_date'],
        ]);

        Response::success([
            'id' => (int)Database::connection()->lastInsertId()
        ], 'Trade created', 201);
    }
}
