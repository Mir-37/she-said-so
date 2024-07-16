<?php

declare(strict_types=1);

require "vendor/autoload.php";

use Mir\TruthWhisper\controller\AuthController;
use Mir\TruthWhisper\router\Route;
use Mir\TruthWhisper\controller\DashboardController;

$route = new Route();
// TODO: Add routes 
$route->add("GET", "/", [DashboardController::class, "index"]);
$route->add("GET", "/login", [AuthController::class, "showLoginPage"]);
$route->add("GET", "/register", [AuthController::class, "showRegisterPage"]);
$route->add("POST", "/register", [AuthController::class, "register"]);
$route->add("POST", "/login", [AuthController::class, "login"]);
$route->dispatch();
