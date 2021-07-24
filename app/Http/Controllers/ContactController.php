<?php

namespace App\Http\Controllers;

use Source\View\View;

class ContactController
{
    public function index()
    {
        View::load("web/contact/index");
    }
}