<?php

namespace App\Http\Controllers;

use Source\View\View;

class BooksController
{
    public function index()
    {
        View::load("web/books/index");
    }
}