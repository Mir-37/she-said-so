<?php

namespace Mir\TruthWhisper\controller;

class HomeController
{
    public function index(): void
    {
        if (isset($_SESSION["login"])) {
            session_unset();
            session_regenerate_id(true);
        }
        require "./src/resources/views/index.php";
    }
}
