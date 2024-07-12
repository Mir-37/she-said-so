<?php

declare(strict_types=1);

require "vendor/autoload.php";

use Mir\TruthWhisper\controller\TestController;
use Mir\TruthWhisper\router\Route;

$route = new Route();

$route->add("GET", "/", [TestController::class, 'test']);
$route->add("GET", "/test2", [TestController::class, 'test2']);
$route->add("GET", "/test2", [TestController::class, 'test2']);

// $url_path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
// try {
//     $route->dispatch();
// } catch (\Throwable $th) {
//     return 400;
// }

$route->dispatch();
