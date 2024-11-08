<?php

namespace app\classes ;


class Request{

    public function get($key){
        return (isset($_GET[$key]))? $_GET[$key] : null ;

    }


    public function post($key){
        return (isset($_POST[$key]))? $_POST[$key] : null ;

    }

    public function filter($data){

        return trim(htmlspecialchars($data)) ;


    }

    public function check($data){
        return (isset($data));
    }


    public function checkMethod(){

        return $_SERVER['REQUEST_METHOD'];

    }
    public function redirect($file){
        header("location:$file");
    }

}

