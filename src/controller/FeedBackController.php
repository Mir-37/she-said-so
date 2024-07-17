<?php

namespace Mir\TruthWhisper\controller;

use Mir\TruthWhisper\model\Category;
use Mir\TruthWhisper\model\FeedBack;
use Mir\TruthWhisper\model\User;

class FeedBackController
{
    public function index(): void
    {
        $users = new User();
        $c = new Category();
        $names = [];
        $categories = array_filter($c->get(), function ($query) {
            return $query["status"] == "active";
        });
        foreach ($users->get() as $value) {
            if ($value["id"] == $_SESSION["login"]["id"]) continue;
            $names[] = [
                "id" => $value["id"],
                "name" => $value["name"]
            ];
        }
        require "./src/resources/views/feedback.php";
    }

    public function saveFeedBack(): void
    {
        $feedback = new FeedBack();
        $feedback->user_id = $_SESSION["login"]["id"];
        $feedback->to_user = (int)$_POST["user_id"] == 0 ? null : (int)$_POST["user_id"];
        $feedback->category_id = (int)$_POST["category_id"] == 0 ? null : (int)$_POST["category_id"];
        $feedback->feedback = htmlspecialchars($_POST["feedback"]);
        $feedback->status = "public";
        $feedback->file = null;
        $feedback->created_at = date("Y-m-d");
        $feedback->save();

        header("Location: /feedback-submit/success");
    }

    function successPage(): void
    {
        require "./src/resources/views/feedback-success.php";
    }

    public function delete(): void
    {
        $feedback = new FeedBack();
        $feedback->delete($_GET["id"]);
        header('Location: /dashboard');
    }
}
