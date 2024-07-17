<?php

namespace Mir\TruthWhisper\controller;

use Mir\TruthWhisper\model\User;

class TestController
{
    public function test(): void
    {
        $user = new User();
        echo $user->id;
        var_dump($user);
    }
}
