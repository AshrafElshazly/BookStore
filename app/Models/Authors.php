<?php

namespace App\Models;

use Source\Database\Db;


class Authors
{
    public static function connectTable()
    {
        return Db::getInstance()->table('authors');
    }
}