<?php

namespace app\models\repositories;

use app\engine\App;
use app\models\entities\User;
use app\models\Repository;

class UserRepository extends Repository
{
    /**
     * Возвращает результат проверки наличия пользователя в БД и соответствие переданного пароля hash, хранимому в БД
     * @param  string  $login
     * @param  string password
     * @return bool
     */
    public function Auth(string $login, string $password)
    {
        $user = $this->getWhere(['login' => $login]);
        if ($user != false && password_verify($password, $user->password)) {
//            new Session($login);
            App::call()->session->set('login', $login);

//            if (isset((new Request())->getParams()['save'])) {
            if (isset(App::call()->request->getParams()['save'])) {
                //генерация hash для сохранения в cookie и БД
                $hash = uniqid(rand(), true);
//                unset($user->hash);

                //обновляем hash в БД для соответствующего пользователя
                $user->hash = $hash;
                $this->update($user);

//                new Cookie($hash);
                App::call()->cookie->set('hash', $hash);
//                setcookie('hash', $hash, time() + 3600, '/');
            }
            return true;
        }
        return false;
    }

    public function isAuth()
    {
//        $cookieHash = $_COOKIE['hash'];
        $cookieHash = App::call()->cookie->getCookieHash();
        if (isset($cookieHash)) {
            $user = $this->getWhere(['hash' => $cookieHash]);

            if ($user) {
//                new Session($user->login);
                App::call()->session->set('login', $user->login);
            }
        }
//        $login = (new Session())->getLogin();
        $login = App::call()->session->getLogin();
        return isset($login);
    }

    public function getLogin()
    {
//        return (new Session())->getLogin();
        return App::call()->session->getLogin();
    }

    protected function getTableName(): string
    {
        return 'users';
    }

    protected function getEntityClass(): string
    {
        //Возвращает полное имя класса (вместе с namespace)
        return User::class;
    }
}