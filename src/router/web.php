<?php

use Mir\TruthWhisper\router\Route;
use Mir\TruthWhisper\controller\AuthController;
use Mir\TruthWhisper\controller\HomeController;
use Mir\TruthWhisper\controller\TestController;
use Mir\TruthWhisper\controller\CategoryController;
use Mir\TruthWhisper\controller\FeedBackController;
use Mir\TruthWhisper\controller\DashboardController;

$route = new Route();

$route->add("GET", "/", [HomeController::class, "index"]);
$route->add("GET", "/login", [AuthController::class, "showLoginPage"]);
$route->add("GET", "/register", [AuthController::class, "showRegisterPage"]);
$route->add("POST", "/register", [AuthController::class, "register"]);
$route->add("POST", "/login", [AuthController::class, "login"]);
$route->add("GET", "/logout", [AuthController::class, "logout"]);
$route->add("GET", "/dashboard", [DashboardController::class, "index"]);


if (isset($_SESSION["login"])) {
    $route->add("GET", "/feedback/{$_SESSION['login']['feedback_uid']}", [FeedBackController::class, "index"]);
    $route->add("POST", "/feedback-submit", [FeedBackController::class, "saveFeedBack"]);
    $route->add("GET", "/feedback-submit/success", [FeedBackController::class, "successPage"]);
    $route->add("GET", "/feedback/delete", [FeedBackController::class, "delete"]);

    $route->add("GET", "/manage-category", [CategoryController::class, "index"]);
    $route->add("POST", "/manage-category/create", [CategoryController::class, "create"]);
    $route->add("GET", "/manage-category/update", [CategoryController::class, "showUpdatePage"]);
    $route->add("POST", "/manage-category/update", [CategoryController::class, "update"]);
    $route->add("GET", "/manage-category/delete", [CategoryController::class, "delete"]);
} else {
    $route->add("GET", "/login", [AuthController::class, "showLoginPage"]);
}

// $route->add("GET", "/test", [TestController::class, "test"]);

$route->dispatch();
