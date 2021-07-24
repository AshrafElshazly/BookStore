<?php

namespace App\Http\Controllers;

use Source\View\View;

class CartController
{
    public function index()
    {
        View::load("web/cart/index");
    }
}