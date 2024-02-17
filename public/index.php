<?php

declare (strict_types = 1);

use App\App;
use App\Config;
use App\Controllers\HomeController;
use App\Controllers\TransactionController;
use App\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// echo '<pre>';
// phpinfo();
// echo '</pre>';
// exit;

define('STORAGE_PATH', __DIR__ . '/../transactions-temp-storage');
define('VIEW_PATH', __DIR__ . '/../views');

$router = new Router();

$router
    ->get('/', [HomeController::class, 'index'])
    ->get('/test', [HomeController::class, 'test'])
    ->get('/transactions', [TransactionController::class, 'index'])
    ->post('/transactions/upload', [TransactionController::class, 'upload'])
    ->get('/transactions/view', [TransactionController::class, 'view']);

(new App(
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();
