<?php

namespace App\Http\Controllers;
use Source\View\View;

class DashboardController
{
    public function index()
    {
        View::Load("admin/index"); 
    }
}