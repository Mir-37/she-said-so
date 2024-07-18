<?php

namespace Mir\TruthWhisper\controller;

use Mir\TruthWhisper\model\User;
use Mir\TruthWhisper\model\Session;
use Mir\TruthWhisper\model\Category;
use Mir\TruthWhisper\model\FeedBack;

class DashboardController
{
    public function __construct()
    {
        if (!isset($_SESSION["login"])) {
            header("location: /");
        }
    }

    public function index(): void
    {

        $feedback = new FeedBack();
        $cats = new Category();
        $received_feedbacks = [];
        $given_feedbacks = [];
        foreach ($feedback->where("to_user", $_SESSION["login"]["id"])->get() as $received_feedback) {
            $received_feedbacks[] = [
                "id" => $received_feedback["id"],
                "feedback" => $received_feedback["feedback"],
                "created_at" => $received_feedback["created_at"],
                "category" => array_merge(...$cats->where("id", $received_feedback["category_id"])->get())["name"] ?? "None"
            ];
        }
        foreach ($feedback->where("user_id", $_SESSION["login"]["id"])->get() as $given_feedback) {
            $given_feedbacks[] = [
                "id" => $given_feedback["id"],
                "feedback" => $given_feedback["feedback"],
                "created_at" => $given_feedback["created_at"],
                "category" => array_merge(...$cats->where("id", $given_feedback["category_id"])->get())["name"] ?? "None"
            ];
        }
        require "./src/resources/views/dashboard.php";
    }
}
