<?php

namespace App\controllers;

use App\models\Comment;

use App\traits\request_data;
use App\validations\comment_validation;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface as Request;

class CommentController
{   
    use request_data;

    private function responseComment(Comment $comment)
    {
        return [
            "id" => $comment->id,
            'comment' => $comment->comment,
            'user' => $comment->user->username,
            'created_at' => $comment->created_at,
            'updated_at' => $comment->updated_at
        ];
    }

    function index()
    {
        $comments = Comment::all();

        return new JsonResponse($comments, 200);
    }

    function store(Request $request)
    {
        $data = $this->all($request);
        
        $validation = comment_validation::store($data);

        if(count($validation) > 0){
            return new JsonResponse($validation, 422);
        }

        
        $comment = new Comment;
        $comment->comment = $data['comment'];
        $comment->user_id = $data['user_id'];
        $comment->save();


        $responseData = $this->responseComment($comment);

        return new JsonResponse($responseData, 201);
        
    }

    function update(Request $request)
    {
        $id = $request->getAttribute('id');

        $comment = Comment::find(intval($id));

        if(!$comment){
            return new JsonResponse(['message' => 'Comment not found'], 404);
        }

        $data = $this->all($request);

        $validation = comment_validation::update($data);

        if(count($validation) > 0){
            return new JsonResponse($validation, 422);
        }

        $comment->comment = $data['comment'];
        $comment->save();

        $responseData = $this->responseComment($comment);

        return new JsonResponse($responseData, 200);
    }

    function show(Request $request)
    {
        $id = $request->getAttribute('id');

        $comment = Comment::find(intval($id));

        if(!$comment){
            return new JsonResponse(['message' => 'Comment not found'], 404);
        }

        $responseData = $this->responseComment($comment);

        return new JsonResponse($responseData, 200);
    }

    function destroy(Request $request)
    {
        $id = $request->getAttribute('id');

        $comment = Comment::find(intval($id));

        if(!$comment){
            return new JsonResponse(['message' => 'Comment not found'], 404);
        }

        $comment->delete();

        return new JsonResponse(['message' => 'Comment deleted'], 200);
    }
}