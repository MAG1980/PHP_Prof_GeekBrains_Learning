<?php

namespace app\controllers;

use app\engine\Request;
use app\models\{User};

class AuthController extends Controller
{
    //action="/?c=auth&a=login"
    public function actionLogin()
    {
        $request = new Request();
//        $login = $_POST['login'];
        $login = ($request->getParams())['login'];
//        $pass = $_POST['password'];
        $pass = $request->getParams()['password'];
        if (User::Auth($login, $pass)) {
            header('Location:'.$_SERVER["HTTP_REFERER"]);
            die();
        } else {
            die('Такой пользователь не существует или введён неправильный пароль!');
        }
    }

    public function actionLogOut()
    {
        session_regenerate_id();
        session_destroy();

        //Делаем cookie просроченными
        setcookie('hash', '', time() - 3600, '/');
        header('Location:/');
        die();
    }
}