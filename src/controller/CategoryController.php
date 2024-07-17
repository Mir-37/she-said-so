<?php

namespace Mir\TruthWhisper\controller;

use Mir\TruthWhisper\model\Category;

class CategoryController
{
    private Category $category;

    public function __construct()
    {
        $this->category = new Category();
    }
    public function index(): void
    {
        $cats = [];
        foreach ($this->category->get() as $cat) {
            $cats[] = [
                "name" => $cat["name"],
                "id" => $cat["id"]
            ];
        }

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

        header("Location: /manage-category");
    }

    public function showUpdatePage(): void
    {
        $cats = [];
        foreach ($this->category->get() as $cat) {
            $cats[] = [
                "name" => $cat["name"],
                "id" => $cat["id"]
            ];
        }

        $cat = array_merge(...$this->category->where("id", $_GET["id"])->get());

        require "./src/resources/views/category_update.php";
    }

    public function update(): void
    {
        $category = $this->category->update($_POST["id"], [
            "name" => $_POST["category"],
            "created_by" => $_SESSION["login"]["id"],
            "status" => $_POST["status"],
            "created_at" => date("Y-m-d"),
        ]);
        header("Location: /manage-category/update?id=" . $_POST["id"]);
    }

    public function delete(): void
    {
        $category = new Category();
        $category->delete($_GET["id"]);
        header('Location: /manage-category');
    }
}
