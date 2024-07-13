<?php

declare(strict_types=1);

require "vendor/autoload.php";

use Mir\TruthWhisper\controller\UserController;
use Mir\TruthWhisper\router\Route;

$route = new Route();
// TODO: Add routes 
$route->add("GET", "/", [UserController::class, "test"]);
$route->dispatch();
