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
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, true);

        $id = (int) $data['id'];
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

    public function actionRemove()
    {
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, true);

        $id = (int) $data['id'];
        $session_id = session_id();     // пользователь
        //создаём экземпляр корзины и вызываем у него delete()
        $cart = new Cart($session_id, $id);
        $cart->delete($id);
        $response = [
            'status' => 'ok',
            'count' => Cart::getCountWhere('session_id', $session_id)
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die();
    }
}