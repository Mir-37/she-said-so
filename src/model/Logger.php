<?php

namespace Mir\TruthWhisper\model;

class Logger extends Model
{
    public function __construct()
    {
        parent::__construct("logs", ["id", "message", "created_at"]);
    }
}
