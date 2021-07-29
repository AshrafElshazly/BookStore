<?php

namespace App\Models;

use Source\Database\Db;

class User 
{
    public static function connectTable()
    {
        return Db::getInstance()->table("users");
    }
}