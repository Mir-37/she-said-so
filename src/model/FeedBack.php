<?php

namespace Mir\TruthWhisper\model;

class FeedBack extends Model
{

    public function __construct()
    {
        parent::__construct("feedbacks", ["id", "user_id", "to_user", "category_id", "title", "feedback", "file", "status", "created_at"]);
    }
}
