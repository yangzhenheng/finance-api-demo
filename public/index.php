<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Core\Response;
use App\Controllers\AssetController;
use App\Controllers\TradeController;
use App\Controllers\ReportController;

$envPath = dirname(__DIR__);
if (file_exists($envPath . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable($envPath);
    $dotenv->safeLoad();
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    Response::success(['message' => 'ok']);
    exit;
}

$router = new Router();

$assetController = new AssetController();
$tradeController = new TradeController();
$reportController = new ReportController();

$router->get('/', function () {
    Response::success([
        'project' => 'finance-api-demo',
        'message' => 'Financial data report API is running.',
        'docs' => '/docs/API.md'
    ]);
});

$router->get('/api/assets', [$assetController, 'index']);
$router->post('/api/assets', [$assetController, 'store']);
$router->get('/api/assets/show', [$assetController, 'show']);

$router->get('/api/trades', [$tradeController, 'index']);
$router->post('/api/trades', [$tradeController, 'store']);

$router->get('/api/reports/customer-summary', [$reportController, 'customerSummary']);
$router->get('/api/reports/asset-performance', [$reportController, 'assetPerformance']);
$router->get('/api/reports/export-csv', [$reportController, 'exportCsv']);

$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
