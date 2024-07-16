<?php

namespace Mir\TruthWhisper\model;

class User extends Model
{
    public function __construct()
    {
        parent::__construct("users", ["id", "name", "password", "email", "joined_at"]);
    }
}
