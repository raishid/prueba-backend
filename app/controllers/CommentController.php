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
            'coment_text' => $comment->coment_text,
            'likes' => $comment->likes,
            'user' => $comment->userComment,
            'creation_date' => $comment->creation_date,
            'update_date' => $comment->update_date
        ];
    }

    function index()
    {
        $comments = Comment::all();

        $comments = $comments->map(function ($comment) {
            return $this->responseComment($comment);
        });

        return new JsonResponse($comments, 200);
    }

    function store(Request $request)
    {
        $data = $this->all($request);

        $validation = comment_validation::store($data);

        if (count($validation) > 0) {
            return new JsonResponse($validation, 422);
        }


        $comment = new Comment;
        $comment->coment_text = $data['coment_text'];
        $comment->user = $data['user'];
        $comment->likes = 0;
        $comment->save();


        $responseData = $this->responseComment($comment);

        return new JsonResponse($responseData, 201);
    }

    function update(Request $request)
    {
        $id = $request->getAttribute('id');

        $comment = Comment::find(intval($id));

        if (!$comment) {
            return new JsonResponse(['message' => 'Comment not found'], 404);
        }

        $data = $this->all($request);

        $validation = comment_validation::update($data);

        if (count($validation) > 0) {
            return new JsonResponse($validation, 422);
        }

        $comment->coment_text = $data['coment_text'];
        $comment->save();

        $responseData = $this->responseComment($comment);

        return new JsonResponse($responseData, 200);
    }

    function show(Request $request)
    {
        $id = $request->getAttribute('id');

        $comment = Comment::find(intval($id));

        if (!$comment) {
            return new JsonResponse(['message' => 'Comment not found'], 404);
        }

        $responseData = $this->responseComment($comment);

        return new JsonResponse($responseData, 200);
    }

    function destroy(Request $request)
    {
        $id = $request->getAttribute('id');

        $comment = Comment::find(intval($id));

        if (!$comment) {
            return new JsonResponse(['message' => 'Comment not found'], 404);
        }

        $comment->delete();

        return new JsonResponse(['message' => 'Comment deleted'], 200);
    }

    function addLike(Request $request)
    {
        $id = $request->getAttribute('id');

        $comment = Comment::find(intval($id));

        if (!$comment) {
            return new JsonResponse(['message' => 'Comment not found'], 404);
        }

        $comment->likes = $comment->likes + 1;
        $comment->save();

        $responseData = $this->responseComment($comment);

        return new JsonResponse($responseData, 200);
    }

    function removeLike(Request $request)
    {
        $id = $request->getAttribute('id');

        $comment = Comment::find(intval($id));

        if (!$comment) {
            return new JsonResponse(['message' => 'Comment not found'], 404);
        }

        // Check if likes is greater than 0

        if ($comment->likes === 0) {
            return new JsonResponse(['message' => 'Comment has no likes'], 422);
        }

        $comment->likes = $comment->likes - 1;
        $comment->save();

        $responseData = $this->responseComment($comment);

        return new JsonResponse($responseData, 200);
    }
}
