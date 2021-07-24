<?php

namespace App\Models;

use Source\Database\Db;


class Books
{
    public static function connectTable()
    {
        return Db::getInstance()->table('books');
    }
}