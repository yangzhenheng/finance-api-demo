<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Core\Response;
use PDO;

class AssetController
{
    public function index(): void
    {
        $pdo = Database::connection();

        $where = [];
        $params = [];

        if (!empty($_GET['asset_type'])) {
            $where[] = 'asset_type = :asset_type';
            $params['asset_type'] = $_GET['asset_type'];
        }

        if (!empty($_GET['risk_level'])) {
            $where[] = 'risk_level = :risk_level';
            $params['risk_level'] = $_GET['risk_level'];
        }

        $sql = 'SELECT * FROM assets';
        if ($where) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }
        $sql .= ' ORDER BY id DESC';

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        Response::success([
            'items' => $stmt->fetchAll(),
            'filters' => $_GET
        ]);
    }

    public function show(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            Response::error('Invalid asset id');
        }

        $stmt = Database::connection()->prepare('SELECT * FROM assets WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $asset = $stmt->fetch();

        if (!$asset) {
            Response::error('Asset not found', 404);
        }

        Response::success($asset);
    }

    public function store(): void
    {
        $input = json_decode(file_get_contents('php://input'), true) ?? [];

        $required = ['asset_code', 'asset_name', 'asset_type', 'risk_level', 'current_value'];
        foreach ($required as $field) {
            if (!isset($input[$field]) || $input[$field] === '') {
                Response::error("Missing required field: {$field}");
            }
        }

        $sql = 'INSERT INTO assets (asset_code, asset_name, asset_type, risk_level, current_value)
                VALUES (:asset_code, :asset_name, :asset_type, :risk_level, :current_value)';

        $stmt = Database::connection()->prepare($sql);
        $stmt->execute([
            'asset_code' => $input['asset_code'],
            'asset_name' => $input['asset_name'],
            'asset_type' => $input['asset_type'],
            'risk_level' => $input['risk_level'],
            'current_value' => $input['current_value'],
        ]);

        Response::success([
            'id' => (int)Database::connection()->lastInsertId()
        ], 'Asset created', 201);
    }
}
