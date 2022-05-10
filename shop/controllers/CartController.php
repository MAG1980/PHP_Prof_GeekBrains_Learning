<?php

namespace app\controllers;

use app\engine\Request;
use app\engine\Session;
use app\models\entities\Cart;
use app\models\repositories\CartRepository;

class CartController extends Controller
{
    //Выполняется, если экшен не передан
    public function actionIndex()
    {
        $session_id = (new Session())->getId();
        $cart = (new CartRepository())->getCart($session_id);
        echo $this->render('cart', [
            'cart' => $cart
        ]);
    }

    public function actionAdd()
    {
        $data = (new Request())->getParams();
        $goods_id = (int) $data['id'];
        $price = $data['price'];
        $number = $data['number'];
        $session_id = (new Session())->getId();
//TODO Переделать на getWhere
        //создаём экземпляр корзины и вызываем у него insert() или update()
        $cart = new Cart($session_id, $goods_id, $price, $number);
//        var_dump($data, $cart);
      
        if ((new CartRepository())->save($cart)) {
            $status = 'ok';
        } else {
            $status = 'error3';
        };

        $response = [
            'status' => $status,
            'count' => (new CartRepository())->getCountWhere('session_id', $session_id)
        ];

        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die();

        /*      при синхронных запросах (статическом рендеринге) после опрации с БД нужно выполнить редирект
                header('Location:/product/catalog');
                die();*/
    }

    public function actionRemove()
    {
//Получение данных c Frontend вынес в класс Request

        $data = (new Request())->getParams();

        $id = (int) $data['id'];

        $session_id = (new Session())->getId();  // пользователь

        $status = 'ok';
        $cart = (new CartRepository())->getWhere('id', $id);
        if (!$cart) {
            $status = 'error1';
        }

        $currentSession = (new Session())->getId(); // пользователь

        //Проверка прав пользователя на удаление товара
        if ($currentSession === $cart->session_id) {
            (new CartRepository())->delete($cart);
        } else {
            $status = 'error2';
        }

        $response = [
            'status' => $status,
            'count' => (new CartRepository())->getCountWhere('session_id', $currentSession)
        ];

        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        die();
    }
}