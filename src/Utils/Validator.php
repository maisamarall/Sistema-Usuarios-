<?php

class Validator 
{
    public static function validateEmail( string $email) : bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false; 
    }

    public static function validatePassword( string $password) : bool
    {
        if(strlen($password) < 8){
            return false;
        } 

        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }

        if (!preg_match('/[A-Z]/', $password)){
            return false;
        }
        
            return true;
    }
}