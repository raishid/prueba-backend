<?php

namespace App\validations;

use App\models\User;


class user_validation
{
    static function store($data)
    {
        $errors = [];

        if(!isset($data['username'])){
            $errors['username'] = 'Username is required';
        }

        if(!isset($data['password'])){
            $errors['password'] = 'Password is required';
        }

        if(!isset($data['password_confirmation'])){
            $errors['password_confirmation'] = 'Password confirmation is required';
        }

        if(!isset($data['email'])){
            $errors['email'] = 'Email is required';
        }

        if(isset($data['password']) && isset($data['password_confirmation'])){
            if($data['password'] !== $data['password_confirmation']){
                $errors['password'] = 'Password and password confirmation do not match';
            }
        }
        
        if(isset($data['email'])){
            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Email is not valid';
            }
        }


        if(isset($data['username'])){
            $user = User::where('username', $data['username'])->first();

            if($user){
                $errors['username'] = 'Username already exists';
            }
        }

        if(isset($data['email'])){
            $user = User::where('email', $data['email'])->first();

            if($user){
                $errors['email'] = 'Email already exists';
            }
        }

        return $errors;
    }

    static function update($data)
    {
        $errors = [];

        if(isset($data['username'])){
            $user = User::where('username', $data['username'])->first();

            if($user){
                $errors['username'] = 'Username already exists';
            }
        }

        if(isset($data['email'])){
            $user = User::where('email', $data['email'])->first();

            if($user){
                $errors['email'] = 'Email already exists';
            }
        }
        

        if(isset($data['password']) && isset($data['password_confirmation'])){
            if($data['password'] !== $data['password_confirmation']){
                $errors['password'] = 'Password and password confirmation do not match';
            }
        }
        
        if(isset($data['email'])){
            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Email is not valid';
            }
        }

        return $errors;
    }
}