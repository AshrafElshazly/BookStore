<?php

namespace Source\Http;

use App\Models\User;
use Source\Support\Session;

class Auth
{

    public static function check()
    {
        $session = new Session;
        return $session->has('logged_user');
    }
}