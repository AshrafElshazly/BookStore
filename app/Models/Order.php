<?php

namespace App\Models;

use Source\Database\Db;

class Order 
{
    public static function connectTable()
    {
        return Db::getInstance()->table("orders");
    }
}