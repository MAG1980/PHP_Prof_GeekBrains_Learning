<?php

namespace app\tests;

use app\models\repositories\UserRepository;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    protected $userRepository;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository();
    }

    protected function tearDown(): void
    {
        $this->userRepository = null;
    }

    /**
     * Тестирует получение логина пользователя из сессии
     * @dataProvider providerLogin
     * @param $login
     * @return void
     */
    public function testGetLogin($login1, $login2)
    {
        $_SESSION['login'] = $login1;
        $this->assertEquals($this->userRepository->getLogin(), $login2);
    }

    public function providerLogin()
    {
        return [['admin', 'admin'], ['user', 'user'], ['cat', 'cat'], ['dog', 'dog'], ['bird', 'bird']];
    }
}