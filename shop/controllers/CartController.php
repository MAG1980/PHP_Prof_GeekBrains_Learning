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

    public function actionAdd()
    {
        $id = $_GET['id'];              // товар
        $session_id = session_id();     // пользователь
        //создаём экземпляр корзины и вызываем у него insert() или update()
        $cart = new Cart($session_id, $id);
        $cart->save();
        $response = [
            'status' => 'ok',
            'count' => Cart::getCountWhere('session_id', $session_id)
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die();

        /*      при синхронных запросах (статическом рендеринге) после опрации с БД нужно выполнить редирект
                header('Location:/product/catalog');
                die();*/
    }
}