<?php

namespace App\controllers;

use App\models\User;
use App\traits\request_data;

use App\validations\user_validation;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface as Request;
use Ramsey\Uuid\Uuid;

class UserController
{
    use request_data;

    private function responseUser(User $user)
    {
        return [
            "id" => $user->id,
            'fullname' => $user->fullname,
            'email' => $user->email,
            'openid' => $user->openid,
            "comments" => $user->comments()->latest()->get()->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'coment_text' => $comment->coment_text,
                    'likes' => $comment->likes,
                    'creation_date' => $comment->creation_date,
                    'update_date' => $comment->update_date
                ];
            }),
            'creation_date' => $user->creation_date,
            'update_date' => $user->update_date
        ];
    }

    function index()
    {
        $users = User::all();

        $dataResponse = $users->map(function ($user) {
            return $this->responseUser($user);
        });

        return new JsonResponse($dataResponse, 200);
    }

    function store(Request $request)
    {
        $data = $this->all($request);

        $validation = user_validation::store($data);

        if (count($validation) > 0) {
            return new JsonResponse($validation, 422);
        }

        $user = new User;
        $user->fullname = $data['fullname'];
        $user->email = $data['email'];
        $user->openid = Uuid::uuid4();
        $user->pass = password_hash($data['pass'], PASSWORD_DEFAULT);
        $user->save();

        $responseData = $this->responseUser($user);

        return new JsonResponse($responseData, 201);
    }

    function update(Request $request)
    {
        $id = $request->getAttribute('id');

        $user = User::find(intval($id));

        if (!$user) {
            return new JsonResponse(['message' => 'User not found'], 404);
        }

        $data = $this->all($request);

        $validation = user_validation::update($data);

        if (count($validation) > 0) {
            return new JsonResponse($validation, 422);
        }

        if (isset($data['fullname'])) {
            $user->fullname = $data['fullname'];
        }

        if (isset($data['email'])) {
            $user->email = $data['email'];
        }

        if (isset($data['pass'])) {
            $user->pass = password_hash($data['pass'], PASSWORD_DEFAULT);
        }

        $user->save();

        $responseData = $this->responseUser($user);

        return new JsonResponse($responseData, 200);
    }

    function show(Request $request)
    {
        $id = $request->getAttribute('id');

        $user = User::find(intval($id));

        if (!$user) {
            return new JsonResponse(['message' => 'User not found'], 404);
        }

        $responseData = $this->responseUser($user);

        return new JsonResponse($responseData, 200);
    }

    function destroy(Request $request)
    {
        $id = $request->getAttribute('id');

        $user = User::find(intval($id));

        if (!$user) {
            return new JsonResponse(['message' => 'User not found'], 404);
        }

        $user->delete();

        return new JsonResponse(['message' => 'User deleted'], 200);
    }
}
