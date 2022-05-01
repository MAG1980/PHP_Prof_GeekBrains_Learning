<?php

namespace app\controllers;

use app\engine\Request;
use app\engine\Session;
use app\models\{repositories\UserRepository};

class AuthController extends Controller
{

    public function actionLogin()
    {
        $request = new Request();
        $login = ($request->getParams())['login'];
        $pass = $request->getParams()['password'];
        if ((new UserRepository())->Auth($login, $pass)) {
            header('Location:'.$_SERVER["HTTP_REFERER"]);
            die();
        } else {
            die('Такой пользователь не существует или введён неправильный пароль!');
        }
    }

    public function actionLogOut()
    {
        $session = new Session();
        $session->regenerate_id();
        $session->destroy();


        //Делаем cookie просроченными
        setcookie('hash', '', time() - 3600, '/');
        header('Location:/');
        die();
    }
}