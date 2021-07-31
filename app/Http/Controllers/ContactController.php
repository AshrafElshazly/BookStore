<?php

namespace App\Http\Controllers;

use Source\View\View;
use App\Models\Message;
use App\Models\Setting;
use Source\Http\Request;
use Source\Support\Session;
use Source\Validation\Validator;

class ContactController
{
    public function index()
    {
        $data['setting'] = Setting::connectTable()->select("email, phone, website, map, address")->getOne();

        View::load("web/contact/index",$data);
    }

    public function send()
    {
        $session = new Session;
        $request = new Request;
        extract($_POST);

        $request_data = [
            [
                'name' => 'name',
                'value' => $name,
                'rules' => 'required|str'
            ],
            [
                'name' => 'email',
                'value' => $email,
                'rules' => 'required|email'
            ],
            [
                'name' => 'subject',
                'value' => $subject,
                'rules' => 'required|str'
            ],
            [
                'name' => 'message',
                'value' => $message,
                'rules' => 'required|str'
            ],
        ];
        
        $errors = Validator::make($request_data);

        if(! empty($errors)) {
            $session = new Session;
            $session->set("errors", $errors);
        } else {
            Message::connectTable()->insert([
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message,
            ])->save();
        }

        $request->redirect("contact-us");
    }
}