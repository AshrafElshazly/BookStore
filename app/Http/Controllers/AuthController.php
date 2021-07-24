<?php

namespace App\Http\Controllers;

use Source\View\View;

class AuthController
{
   public function login()
   {
       View::load("web/auth/login");
   }

   public function register()
   {
       View::load("web/auth/register");
   } 
}