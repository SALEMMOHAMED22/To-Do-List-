<?php

namespace app\classes;
class Sesseion{


    public function __construct()
    {
        session_start();
    }

    public static function set($key , $value){

        $_SESSION[$key] = $value;
    }

    public function get($key){

        if (isset($_SESSION[$key]))
        return $_SESSION[$key];

    }

    public function remove($key){

        unset($_SESSION[$key]);
    }

    public function destroy(){
        session_destroy();
    }
}