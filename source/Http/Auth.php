<?php

namespace Source\Http;

use App\Models\User;
use Source\Http\Request;
use App\Models\UserContact;
use Source\Support\Session;

class Auth
{
    public static function attempt(string $email , string $pasword)
    {
        $session = new Session;
        $request = new Request;

        $user = User::connectTable()->select()->where("email","=",$email)->getOne();

        if($user) {
            $is_verified = password_verify($pasword,$user["password"]);

            if($is_verified) {
                $session->set("logged_user",$user);
                $request->redirect("");
            }else {
                $errors = ["password not correct"];
                $session->set("errors",$errors);
                $request->redirect("login");
            }
        }else {
            $errors = ["there's no account for this email"];
            $session->set("errors",$errors);
            $request->redirect("login");
        }
    }

    public static function insertAndLogin($username, $email, $password, $phone, $address)
    {
        $session = new Session;
        $request = new Request;

        $user_id = User::connectTable()->insert([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ])->saveAndGetId();
        
        UserContact::connectTable()->insert([
            'user_id' => $user_id,
            'phone' => $phone,
            'address' => $address,
        ])->save();

        $user = User::connectTable()->select()
        ->where("id", "=", $user_id)
        ->getOne();

        $session->set("logged_user", $user);

        $request->redirect("");
        
    }

    public static function logout() 
    {
        $request = new Request;
        $session = new Session;

        $session->remove("logged_user");
        $request->redirect("");
    }

    public static function check()
    {
        $session = new Session;
        return $session->has("logged_user");
    }
}