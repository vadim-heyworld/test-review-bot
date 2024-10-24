<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Vadim\TestReviewBot\Controllers\UserController;
use Vadim\TestReviewBot\Services\UserService;

class UserControllerTest extends TestCase {
    public function testCreateUser() {
        $controller = new UserController(new UserService());

        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123456'
        ];

        $result = $controller->createUser($userData);
        $this->assertNotNull($result['id']);
        $this->assertEquals($userData['name'], $result['name']);
    }
}