<?php

namespace Mir\TruthWhisper\controller;

use Mir\TruthWhisper\model\Category;

class CategoryController
{
    public function index(): void
    {
        require "./src/resources/views/category.php";
    }

    public function create(): void
    {
        $category = new Category();
        $category->name = $_POST["category"];
        $category->created_by = $_SESSION["login"]["id"];
        $category->status = $_POST["status"];
        $category->created_at = date("Y-m-d");
        $category->save();
        header("Location: /dashboard");
    }
}
