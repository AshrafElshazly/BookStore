<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Cats;
use Source\View\View;

class HomeController
{
    public function index()
    {
        $data['cats'] = Cats::connectTable()
                        ->select("id, name, brief")
                        ->where("is_top", "=", 1)
                        ->limit(4)
                        ->get();


        $data['books'] = Books::connectTable()
                        ->select("id, img, name, price")
                        ->orderBy("created_at","DESC")
                        ->limit(6)
                        ->get();

        View::load("web/index",$data);
    }
}