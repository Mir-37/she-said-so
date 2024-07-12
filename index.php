<?php

declare(strict_types=1);

require "vendor/autoload.php";

use Mir\TruthWhisper\controller\TestController;
use Mir\TruthWhisper\router\Route;

$route = new Route();

// $route->add("GET", "/", [TestController::class, 'test']);

// $url_path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// print_r($_SERVER);

// $route->dispatch($url_path);
