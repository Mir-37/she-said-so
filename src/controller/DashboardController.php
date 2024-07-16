<?php

namespace Mir\TruthWhisper\controller;

class DashboardController
{
    public function index(): void
    {
        require "./src/resources/views/index.html";
    }
}
