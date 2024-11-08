<?php
namespace app\classes;
use app\classes\validator;
require_once "validator.php";


class Str implements validator{
    public function check($key, $value)
    {
        if(is_numeric($value)){
            return " $key must be string";
        }else{
            return false ; 
        }
    }
}