<?php

use App\controllers\CommentController;
use App\controllers\UserController;

/**
 * @var League\Route\Router $router
 */

$router->map('GET', '/users', [UserController::class, 'index']);
$router->map('GET', 'users/{id}', [UserController::class, 'show']);
$router->map('POST', '/users', [UserController::class, 'store']);
$router->map('PATCH', '/users/{id}', [UserController::class, 'update']);
$router->map('DELETE', '/users/{id}', [UserController::class, 'destroy']);

$router->map('GET', '/comments', [CommentController::class, 'index']);
$router->map('GET', '/comments/{id}', [CommentController::class, 'show']);
$router->map('POST', '/comments', [CommentController::class, 'store']);
$router->map('PATCH', '/comments/{id}', [CommentController::class, 'update']);
$router->map('DELETE', '/comments/{id}', [CommentController::class, 'destroy']);
$router->map('PATCH', '/comments/{id}/like', [CommentController::class, 'addLike']);
$router->map('PATCH', '/comments/{id}/like-remove', [CommentController::class, 'removeLike']);
