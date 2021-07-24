<?php

namespace Source\Support;

class Session
{

    public function __construct()
    {
        (!session_id()) ? session_start() : null;
    }

    public function get(string $key)
    {
        return $this->has($key) ? $_SESSION[$key] : null;
    }

    public function set(string $key , $value)
    {
        return $_SESSION[$key] = $value;
    }

    public function has(string $key)
    {
        return isset($_SESSION[$key]);
    }

    public function remove(string $key)
    {
        unset($_SESSION[$key]);
    }

    public function flash(string $key)
    {
        $value = $this->get($key);
        $this->remove($key);
        return $value;
    }

    public function destroy()
    {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), "", time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
    }

}