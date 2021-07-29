<?php

namespace App\Models;

use Source\Database\Db;

class Message 
{
    public static function connectTable()
    {
        return Db::getInstance()->table("messages");
    }
}