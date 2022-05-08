<?php

namespace app\controllers;

use app\engine\App;

//use app\engine\Session;

class AuthController extends Controller
{

    public function actionLogin()
    {
//        $request = new Request();
        $login = App::call()->request->getParams()['login'];
        $pass = App::call()->request->getParams()['password'];
//        if ((new UserRepository())->Auth($login, $pass)) {
        if (App::call()->userRepository->Auth($login, $pass)) {
            header('Location:'.$_SERVER["HTTP_REFERER"]);
            die();
        } else {
            die('Такой пользователь не существует или введён неправильный пароль!');
        }
    }

    public function actionLogOut()
    {
        /*        $session = new Session();
                $session->regenerate_id();
                $session->destroy();*/

        App::call()->session->regenerate_id();
        App::call()->session->destroy();


        //Делаем cookie просроченными
//        setcookie('hash', '', time() - 3600, '/');
//        (new Cookie())->setCookieOverdue();
        App::call()->cookie->setCookieOverdue();
        header('Location:/');
        die();
    }
}