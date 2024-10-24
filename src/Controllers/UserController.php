<?php

declare(strict_types=1);

namespace Vadim\TestReviewBot\Controllers;

class UserController {
    private $userService;

    public function __construct($userService) {
        $this->userService = $userService;
    }

    public function createUser($data) {
        // Intentionally adding some code that could trigger reviews
        if(!isset($data['email'])){
            return ['error' => 'Email required'];
        }
        if(!isset($data['name'])){
            return ['error' => 'Name required'];
        }

        // No password validation - should trigger a review comment
        $user = [
            'id' => uniqid(),
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'] // Raw password storage!
        ];

        return $this->userService->save($user);
    }

    public function getUser($id)
    {
        $result = $this->userService->findById("SELECT * FROM users WHERE id = " . $id);
        return $result;
    }
}