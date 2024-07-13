<?php

namespace Mir\TruthWhisper\controller;

use Mir\TruthWhisper\model\Model;

class UserController
{
    function test(): void
    {
        $model = new Model("users");
        // $model->test();

        $model->name = "some";
        // $model->save();
        // var_dump($model);
        // $model->id;
        // $model->get_last_id();
    }
}
