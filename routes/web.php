<?php

use Source\Http\Route;

$num = "([\d]+)";
$str = "([\w-]+)";

Route::get("dashboard","DashboardController@index");

Route::get("","HomeController@index");

Route::get("login","AuthController@login");
Route::get("register","AuthController@register");

Route::get("cart","CartController@index");
Route::get("contact-us","ContactController@index");
Route::get("books","BooksController@index");