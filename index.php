<?php

declare(strict_types=1);


// index.php
require_once __DIR__ . '/vendor/autoload.php';

use Vadim\TestReviewBot\Controllers\UserController;
use Vadim\TestReviewBot\Services\UserService;
use Vadim\TestReviewBot\Models\User;

$router = new \Bramus\Router\Router();

// Simple routing implementation
$router->get('/', function () {
    echo json_encode(['message' => 'Welcome to Test API']);
});

// User routes with potential code review triggers
$router->mount('/api', function () use ($router) {
    $userController = new UserController(new UserService());

    $router->post('/users', function () use ($userController) {
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $userController->createUser($data);
        echo json_encode($result);
    });

    $router->get('/users/{id}', function ($id) use ($userController) {
        $result = $userController->getUser($id);
        echo json_encode($result);
    });
});

$router->run();