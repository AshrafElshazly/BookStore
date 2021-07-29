<?php

namespace App\Models;

use Source\Database\Db;

class Setting 
{
    public static function connectTable()
    {
        return Db::getInstance()->table("settings");
    }
}