<?php

namespace App\validations;

use App\models\User;


class comment_validation
{
    static function store($data)
    {
        $errors = [];

        if (!isset($data['coment_text'])) {
            $errors['coment_text'] = 'Comment is required';
        }

        if (!isset($data['user'])) {
            $errors['user'] = 'User id is required';
        }

        if (isset($data['user'])) {
            $user = User::find(intval($data['user']));

            if (!$user) {
                $errors['user'] = 'User not found';
            }
        }

        return $errors;
    }

    static function update($data)
    {
        $errors = [];

        if (count($data) === 0) {
            $errors['data'] = 'coment_text is required';
        }

        if (isset($data['coment_text'])) {
            if (strlen($data['coment_text']) === 0) {
                $errors['coment_text'] = 'Comment is required';
            }
        }

        return $errors;
    }
}
