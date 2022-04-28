<?php

namespace app\controllers;

use app\models\{Cart, User};

class CartController extends Controller
{
    //Выполняется, если экшен не передан
    public function actionIndex()
    {
        $session_id = session_id();
        $cart = Cart::getCart($session_id);
        echo $this->render('cart', [
            'cart' => $cart
        ]);
    }

    private function render($template, $params = [])
    {
        $params ['is_auth'] = User::isAuth();
        $params ['user'] = User::getLogin();
        return $this->renderTemplate('layouts/main', [
            'menu' => $this->renderTemplate('menu', $params),
            'content' => $this->renderTemplate($template, $params)
        ]);

    }

    private function renderTemplate($template, $params = [])
    {
        return $this->render->renderTemplate($template, $params);
    }
}