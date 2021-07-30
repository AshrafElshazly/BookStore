<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Source\Database\Db;
use Source\View\View;

class BooksController
{
    public function index()
    {
        $data['books'] = Db::getInstance()
                ->innerJoin(
                    [
                        'books'   =>['id','name','img','price'],
                        'authors' =>['id','name']
                    ]
                    ,'books',
                    [
                        'authors' => ['authors.id'=>'books.author_id']
                    ]
                )
                ->orderBy('book_id')
                ->get();
                
        View::load("web/books/index",$data);
    }
}