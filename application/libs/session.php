<?php

class Session
{

    public function __construct()
    {
        if (empty($_SESSION))
        {
            session_start();
        }
    }

    public function get($name)
    {
        if (empty($_SESSION[$name]))
        {
            return null;
        }

        return $_SESSION[$name];
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function destroy()
    {
        session_destroy();
    }
}
