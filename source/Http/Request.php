<?php

namespace Source\Http;

class Request
{

    public static function get(String $key , $value = null)
    {
       return isset($_GET[$key])? $_GET[$key] :(($value)? $_GET[$key] = $value : null);
    }
        
    public static function post(String $key , $value = null)
    {
       return isset($_POST[$key])? $_GET[$key] :(($value)? $_POST[$key] = $value : null);
    }

    public static function cookie(String $key , $value = null)
    {
       return isset($_COOKIE[$key])? $_GET[$key] :(($value)? $_COOKIE[$key] = $value : null);
    }

    public function server(string $key)
    {
        return $_SERVER[$key];
    }

    public function serverAll()
    {
        foreach ($_SERVER as $key => $value) {
            echo "<strong>$key:</strong> $value <br>";
        }
    }

    public function redirect($path)
    {
        header("Location:". URL . $path);
    }

    public function back($path)
    {
        header("Location:". $_SERVER["HTTP_REFERER"]);
    }
    
}