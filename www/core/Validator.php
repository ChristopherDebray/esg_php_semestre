<?php

namespace App\core;

class Validator
{
    public $data;
    public $listOfErrors = [];
    public function __construct(){
        $this->data = ($this->method == "POST")? $_POST: $_GET;
    }

    public function isValid(): bool
    {
        if( count($this->config["inputs"])+1 != count($this->data) ){
            die("Tentative de hack");
        }

        foreach ($this->config["inputs"] as $name=>$attr)
        {
            if(!isset($this->data[$name])){
                die("Tentative de hack");
            }

            if(!empty($attr["min"]) && !self::minLength($this->data[$name], $attr["min"])){
                $this->listOfErrors[] = $attr["error"];
            }

            if(!empty($attr["max"]) && !self::maxLength($this->data[$name], $attr["max"])){
                $this->listOfErrors[] = $attr["error"];
            }

        }

        return empty($this->listOfErrors);
    }


    public static function minLength(int $value, int $length): bool
    {
        return strlen(trim($value))>=$length;
    }
    public static function maxLength(int $value, int $length): bool
    {
        return strlen(trim($value))<=$length;
    }

    public function isSubmited(): bool
    {
        if($_SERVER["REQUEST_METHOD"] == $this->method &&
            !empty($this->data["submit"])){
            return true;
        }
        return false;
    }


    public static function isValidEmail(string $email): bool
    {

    }

    public function isPasswordCorrect($inputedPassword, $userPassword) {
        $isPasswordCorrect = password_verify($inputedPassword, $userPassword);
        if (!$isPasswordCorrect) {
            $this->listOfErrors[] = "Identifiant incorrect.";
        }

        return $isPasswordCorrect;
    }

    public function addError(string $error): void
    {
        $this->listOfErrors[] = $error;
    }
}