<?php

namespace App\validations;

use App\models\User;


class user_validation
{
    static function store($data)
    {
        $errors = [];

        if (!isset($data['fullname'])) {
            $errors['fullname'] = 'Fullname is required';
        }

        if (!isset($data['pass'])) {
            $errors['pass'] = 'Password is required';
        }

        if (!isset($data['email'])) {
            $errors['email'] = 'Email is required';
        }

        if (isset($data['email'])) {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email is not valid';
            }
        }


        if (isset($data['email'])) {
            $user = User::where('email', $data['email'])->first();

            if ($user) {
                $errors['email'] = 'Email already exists';
            }
        }

        return $errors;
    }

    static function update($data)
    {
        $errors = [];

        if (count($data) === 0) {
            $errors['data'] = 'email, fullname or pass is required';
        }

        if (isset($data['email'])) {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email is not valid';
            }
        }


        if (isset($data['email'])) {
            $user = User::where('email', $data['email'])->first();

            if ($user) {
                $errors['email'] = 'Email already exists';
            }
        }

        if (isset($data['pass'])) {
            if (strlen($data['pass']) === 0) {
                $errors['pass'] = 'Password is not empty';
            }
        }

        return $errors;
    }
}
