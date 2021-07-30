<?php

namespace App\Http\Controllers;

use Source\Http\Auth;
use Source\Http\Request;
use Source\Support\Session;
use Source\Validation\Validator;
use Source\View\View;

class AuthController
{
    
    public function register()
    {
        View::load("web/auth/register");
    }

    public function doRegister()
    {
        $session = new Session;
        $request = new Request;
        extract($_POST);

        $request_data = [
            [
                'name'  => 'username',
                'value' => $username,
                'rules' => 'required|str'
            ],
            [
                'name'  => 'email',
                'value' => $email,
                'rules' => 'required|email'
            ],
            [
                'name'  => 'password',
                'value' => $password,
                'rules' => 'required|password'
            ],
            [
                'name'  => 'phone',
                'value' => $phone,
                'rules' => 'required|str'
            ],
            [
                'name'  => 'address',
                'value' => $address,
                'rules' => 'required|str'
            ]
        ];

        $errors = Validator::make($request_data);

        (empty($errors)) ? Auth::insertAndLogin($username, $email, $password, $phone, $address) : $session->set("errors", $errors) && $request->redirect("register");
    }

    public function login()
    {
        View::load("web/auth/login");
    }

    public function doLogin()
    {
        $session = new Session;
        $request = new Request;
        extract($_POST);

        $request_data = [
            [
                'name'  => 'email',
                'value' => $email,
                'rules' => 'required|email'
            ],
            [
                'name'  => 'password',
                'value' => $password,
                'rules' => 'required|password'
            ],
        ];
        $errors = Validator::make($request_data);
        (empty($errors)) ? Auth::attempt($email, $password) : $session->set("errors", $errors) && $request->redirect("login");

    }

    public function logout()
    {
            Auth::logout();
    }
}