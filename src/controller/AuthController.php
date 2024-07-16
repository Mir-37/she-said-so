<?php

namespace Mir\TruthWhisper\controller;

use Mir\TruthWhisper\model\User;

class AuthController
{
    public function showLoginPage(): void
    {
        require "./src/resources/views/login.html";
    }
    public function showRegisterPage(): void
    {
        require "./src/resources/views/register.html";
    }

    public function register(): void
    {
        $user = new User();
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $user->joined_at = date("Y-m-d");
        $user->save();
        // var_dump($_POST);
    }

    public function login(): void
    {
        $user = new User();
        $users = $user->get();

        foreach ($users as $user) {
            if (
                isset($user["email"]) &&
                $user["email"] == $_POST["email"] &&
                password_verify($_POST["password"], $user["password"])
            ) {
                header('Location: /truth-whisper/dashboard');
            }
        }
    }
}
