<?php

namespace Mir\TruthWhisper\controller;

class HomeController
{
    public function index(): void
    {
        if (isset($_SESSION["login"])) {
            header("Location: /dashboard");
        }
        require "./src/resources/views/index.php";
    }
}
