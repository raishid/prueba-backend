<?php

namespace App\validations;

use App\models\User;


class comment_validation
{
    static function store($data)
    {
        $errors = [];

        if(!isset($data['comment'])){
            $errors['comment'] = 'Comment is required';
        }

        if(!isset($data['user_id'])){
            $errors['user_id'] = 'User id is required';
        }

        return $errors;
    }

    static function update($data)
    {
        $errors = [];

        if(isset($data['comment'])){
            if(strlen($data['comment']) === 0){
                $errors['comment'] = 'Comment is required';
            }
        }

        return $errors;
        
    }
}