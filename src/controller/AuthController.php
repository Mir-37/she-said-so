<?php

namespace Mir\TruthWhisper\controller;

use Mir\TruthWhisper\model\User;
use Mir\TruthWhisper\model\Session;

class AuthController
{
    public function __construct()
    {
        if (isset($_SESSION["login"])) header("Location: /dashboard");
    }
    public function showLoginPage(): void
    {
        require "./src/resources/views/login.php";
    }
    public function showRegisterPage(): void
    {
        require "./src/resources/views/register.php";
    }

    public function register(): void
    {
        $user = new User();
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $user->joined_at = date("Y-m-d");
        $user->save();

        header('Location: /login');

        // var_dump($_POST);
    }

    public function login(): void
    {

        $user = new User();
        $users = $user->get();
        var_dump($users);
        foreach ($users as $user) {
            if (
                isset($user["email"]) &&
                $user["email"] == $_POST["email"] &&
                password_verify($_POST["password"], $user["password"])
            ) {
                $_SESSION["login"] = [
                    "user" => $user["name"],
                    "email" => $user["email"],
                    "id" => $user["id"],
                    "feedback_uid" => generateUniqueId(8),
                ];
                header('Location: /dashboard');
            } else {

                header('Location: /login');
            }
        }
    }

    public function logout(): void
    {
        session_destroy();
        session_regenerate_id(true);
        header('Location: /');
    }
}
