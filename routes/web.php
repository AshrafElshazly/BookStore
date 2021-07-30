<?php

use Source\Http\Route;

$num = "([\d]+)";
$str = "([\w-]+)";

Route::get("dashboard","DashboardController@index");

Route::get("","HomeController@index");

Route::get("login","AuthController@login");
Route::post("do-login","AuthController@doLogin");

Route::get("register","AuthController@register");
Route::post("do-register","AuthController@doRegister");

Route::get("logout","AuthController@logout","UserAuth");

Route::get("cart","CartController@index");
Route::get("contact-us","ContactController@index");
Route::get("books","BooksController@index");