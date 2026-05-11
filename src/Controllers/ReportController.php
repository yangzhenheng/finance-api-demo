<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Core\Response;

class ReportController
{
    public function customerSummary(): void
    {
        $customerId = (int)($_GET['customer_id'] ?? 0);
        if ($customerId <= 0) {
            Response::error('Invalid customer_id');
        }

        $pdo = Database::connection();

        $customerStmt = $pdo->prepare('SELECT * FROM customers WHERE id = :id');
        $customerStmt->execute(['id' => $customerId]);
        $customer = $customerStmt->fetch();

        if (!$customer) {
            Response::error('Customer not found', 404);
        }

        $summarySql = '
            SELECT
                a.asset_type,
                COUNT(t.id) AS trade_count,
                SUM(CASE WHEN t.trade_type = "buy" THEN t.amount ELSE -t.amount END) AS net_amount
            FROM trades t
            LEFT JOIN assets a ON a.id = t.asset_id
            WHERE t.customer_id = :customer_id
            GROUP BY a.asset_type
        ';

        $stmt = $pdo->prepare($summarySql);
        $stmt->execute(['customer_id' => $customerId]);

        Response::success([
            'customer' => $customer,
            'summary' => $stmt->fetchAll()
        ]);
    }

    public function assetPerformance(): void
    {
        $sql = '
            SELECT
                a.id,
                a.asset_code,
                a.asset_name,
                a.asset_type,
                a.current_value,
                COALESCE(SUM(CASE WHEN t.trade_type = "buy" THEN t.amount ELSE 0 END), 0) AS total_buy,
                COALESCE(SUM(CASE WHEN t.trade_type = "sell" THEN t.amount ELSE 0 END), 0) AS total_sell,
                COALESCE(SUM(CASE WHEN t.trade_type = "buy" THEN t.amount ELSE -t.amount END), 0) AS net_trade_amount
            FROM assets a
            LEFT JOIN trades t ON t.asset_id = a.id
            GROUP BY a.id
            ORDER BY a.id DESC
        ';

        $stmt = Database::connection()->query($sql);

        Response::success([
            'items' => $stmt->fetchAll()
        ]);
    }

    public function exportCsv(): void
    {
        $sql = '
            SELECT
                c.customer_name,
                a.asset_code,
                a.asset_name,
                t.trade_type,
                t.amount,
                t.trade_date
            FROM trades t
            LEFT JOIN customers c ON c.id = t.customer_id
            LEFT JOIN assets a ON a.id = t.asset_id
            ORDER BY t.trade_date DESC
        ';

        $rows = Database::connection()->query($sql)->fetchAll();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=finance-report.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['customer_name', 'asset_code', 'asset_name', 'trade_type', 'amount', 'trade_date']);

        foreach ($rows as $row) {
            fputcsv($output, $row);
        }

        fclose($output);
        exit;
    }
}
