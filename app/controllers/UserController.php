<?php

namespace App\controllers;

use App\models\User;
use App\traits\request_data;

use App\validations\user_validation;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController
{   
    use request_data;

    private function responseUser(User $user)
    {
        return [
            "id" => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            "comments" => $user->comments()->latest()->get()->map(function($comment){
                return [
                    'id' => $comment->id,
                    'comment' => $comment->comment,
                    'created_at' => $comment->created_at,
                    'updated_at' => $comment->updated_at
                ];
            }),
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
        ];
    }

    function index()
    {
        $users = User::all();
        return new JsonResponse($users, 200);
    }

    function store(Request $request)
    {
        $data = $this->all($request);
        
        $validation = user_validation::store($data);

        if(count($validation) > 0){
            return new JsonResponse($validation, 422);
        }

        $user = new User;
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->save();

        $responseData = $this->responseUser($user);

        return new JsonResponse($responseData, 201);
        
    }

    function update(Request $request)
    {
        $id = $request->getAttribute('id');

        $user = User::find(intval($id));

        if(!$user){
            return new JsonResponse(['message' => 'User not found'], 404);
        }

        $data = $this->all($request);

        $validation = user_validation::update($data);

        if(count($validation) > 0){
            return new JsonResponse($validation, 422);
        }

        if(isset($data['username'])){
            $user->username = $data['username'];
        }

        if(isset($data['email'])){
            $user->email = $data['email'];
        }

        if(isset($data['password'])){
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        if(isset($data['password_confirmation'])){
            $user->password = password_hash($data['password_confirmation'], PASSWORD_DEFAULT);
        }

        $user->save();

        $responseData = $this->responseUser($user);

        return new JsonResponse($responseData, 200);
    }

    function show(Request $request)
    {
        $id = $request->getAttribute('id');

        $user = User::find(intval($id));

        if(!$user){
            return new JsonResponse(['message' => 'User not found'], 404);
        }

        $responseData = $this->responseUser($user);

        return new JsonResponse($responseData, 200);
    }

    function destroy(Request $request)
    {
        $id = $request->getAttribute('id');

        $user = User::find(intval($id));

        if(!$user){
            return new JsonResponse(['message' => 'User not found'], 404);
        }

        $user->delete();

        return new JsonResponse(['message' => 'User deleted'], 200);
    }
}