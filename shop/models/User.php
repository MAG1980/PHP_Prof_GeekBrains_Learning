<?php

namespace app\models;

class User extends DBModel
{
    public ?int $id = null;
    protected ?string $login;
    protected ?string $password;
    protected ?string $hash;

    /**
     * @param $login
     * @param $pass
     */
    public function __construct(string $login = null, string $password = null, string $hash = null)
    {
        $this->login = $login;
        $this->password = $password;
        $this->hash = $hash;
    }

    /**Возвращает результат проверки наличия пользователя в БД и соответствие переданного пароля hash, хранимому в БД
     * @param $login
     * @param $password
     * @return bool
     */
    public static function Auth($login, $password)
    {
        $user = User::getWhere('login', $login);
        if (password_verify($password, $user->password)) {
            $_SESSION['login'] = $login;
            return true;
        }
        return false;
    }

    public static function isAuth()
    {
        return isset($_SESSION['login']);
    }

    public static function getLogin()
    {
        return $_SESSION['login'];
    }

    protected static function getTableName(): string
    {
        return 'users';
    }

}