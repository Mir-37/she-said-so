<?php

namespace Mir\TruthWhisper\controller;

use Mir\TruthWhisper\model\User;
use Mir\TruthWhisper\model\Session;
use Mir\TruthWhisper\model\FeedBack;

class DashboardController
{
    public function __construct()
    {
        // if (!isset($_SESSION["login"])) {
        //     header('Location: /login');
        // }
    }

    public function index(): void
    {
        $feedback = new FeedBack();
        $received_feedbacks = $feedback->where("to_user", $_SESSION["login"]["id"])->get();
        $given_feedbacks = $feedback->where("user_id", $_SESSION["login"]["id"])->get();
        require "./src/resources/views/dashboard.php";
    }
}
