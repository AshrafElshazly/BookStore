<?php

namespace App\Http\Middlewares;

use Source\Http\Auth;

class UserAuth
{
    public static function handle($request)
    {
        if(! Auth::check()) {
            $request->redirect('login');
            die();
        }
    }
}