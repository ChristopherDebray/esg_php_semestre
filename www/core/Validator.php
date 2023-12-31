<?php

namespace App\core;
use App\core\Logger;
use App\core\Security;

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
            $this->listOfErrors[] = "Tentative de hack";
        }

        foreach ($this->config["inputs"] as $name=>$attr)
        {
            if(!isset($this->data[$name]) || Security::hasScriptTag($this->data[$name])){
                $this->listOfErrors[] = "Tentative de hack";
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


    public static function minLength(string $value, int $length): bool
    {
        return strlen(trim($value))>=$length;
    }
    public static function maxLength(string $value, int $length): bool
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
        return filter_var($email, FILTER_VALIDATE_EMAIL);
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