<?php

namespace App\Models;

use Source\Database\Db;

class UserContact
{
    public static function connectTable()
    {
        return Db::getInstance()->table("user_contacts");
    }
}