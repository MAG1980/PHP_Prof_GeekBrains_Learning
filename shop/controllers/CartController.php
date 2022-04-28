<?php

namespace app\controllers;

use app\models\{Cart};

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
}