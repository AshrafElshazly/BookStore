<?php

namespace App\Models;

use Source\Database\Db;


class Cats
{
    public static function connectTable()
    {
        return Db::getInstance()->table('cats');
    }
}