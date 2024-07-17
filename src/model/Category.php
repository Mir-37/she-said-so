<?php

namespace Mir\TruthWhisper\model;

class Category extends Model
{

    public function __construct()
    {
        parent::__construct("categories", ["id", "created_by", "name", "status", "created_at"]);
    }
}
