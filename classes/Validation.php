<?php 
namespace app\classes ;
require_once 'Required.php';
require_once 'Str.php';

class Validation {
    private $errors = [];
    public function endValidation($key , $value , $rules){

        foreach ($rules as $rule ){
            $rule =  "app\classes\\" . $rule ;
            $obj = new $rule;
            $result = $obj->check($key , $value);
            if($result != false){
                $this->errors[] = $result;
            }
        }
    }

    public function getError(){
        return $this->errors;

    }
}