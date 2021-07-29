<?php

namespace App\Models;

use Source\Database\Db;

class OrderItem
{
    public static function connectTable()
    {
        return Db::getInstance()->table("order_items");
    }
}