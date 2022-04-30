<?php

namespace app\models;

class User extends DBModel
{
    public ?int $id = null;
    protected ?string $login;
    protected ?string $password;
    protected ?string $hash;

    /**
     * @param  string  $login
     * @param  string  $pass
     * @param  string  $hash
     * хеш пароля
     */
    public function __construct(string $login = null, string $password = null, string $hash = null)
    {
        $this->login = $login;
        $this->password = $password;
        $this->hash = $hash;
    }

    /**
     * Возвращает результат проверки наличия пользователя в БД и соответствие переданного пароля hash, хранимому в БД
     * @param  string  $login
     * @param  string password
     * @return bool
     */
    public static function Auth(string $login, string $password)
    {
        $user = User::getWhere('login', $login);
        if ($user != false && password_verify($password, $user->password)) {
            $_SESSION['login'] = $login;

            if (isset($_POST['save'])) {
                //генерация hash для сохранения в cookie и БД
                $hash = uniqid(rand(), true);
                unset($user->hash);
                $user->hash = $hash;
                $user->update();
                //обновляем hash в БД для соответствующего пользователя

                setcookie('hash', $hash, time() + 3600, '/');
            }
            return true;
        }
        return false;
    }

    public static function isAuth()
    {
        $cookieHash = $_COOKIE['hash'];
        if (isset($cookieHash)) {
            $user = User::getWhere('hash', $cookieHash);

            if ($user) {
                $_SESSION['login'] = $user->login;
            }
        }
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