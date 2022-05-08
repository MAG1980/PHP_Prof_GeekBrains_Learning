<?php

namespace app\controllers;

use app\engine\App;
use app\models\entities\Cart;

class CartController extends Controller
{
    //Выполняется, если экшен не передан
    public function actionIndex()
    {
//        $session_id = (new Session())->getId();
        $session_id = App::call()->session->getId();
//        $cart = (new CartRepository())->getCart($session_id);
        $cart = App::call()->cartRepository->getCart($session_id);
        echo $this->render('cart', [
            'cart' => $cart
        ]);
    }

    public function actionAdd()
    {
//        $data = (new Request())->getParams();
        $data = App::call()->request->getParams();
        $goods_id = (int) $data['id'];
        $price = $data['price'];
        $number = $data['number'];
//        $session_id = (new Session())->getId();
        $session_id = App::call()->session->getId();
//TODO Переделать на getWhere
        //создаём экземпляр корзины и вызываем у него insert() или update()
        $cart = new Cart($session_id, $goods_id, $price, $number);
//        var_dump($data, $cart);

//        if ((new CartRepository())->save($cart)) {
        if (App::call()->cartRepository->save($cart)) {
            $status = 'ok';
        } else {
            $status = 'error3';
        };

        $response = [
            'status' => $status,
//            'count' => (new CartRepository())->getCountWhere('session_id', $session_id)
            'count' => App::call()->cartRepository->getCountWhere('session_id', $session_id)
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

//        $data = (new Request())->getParams();
        $data = App::call()->request->getParams();

        $id = (int) $data['id'];

//        $session_id = (new Session())->getId();  // пользователь
        $session_id = App::call()->session->getId();  // пользователь

        $status = 'ok';
//        $cart = (new CartRepository())->getWhere(['id' => $id]);
        $cart = App::call()->cartRepository->getWhere(['id' => $id]);
        if (!$cart) {
            $status = 'error1';
        }

//        $currentSession = (new Session())->getId(); // пользователь
        $currentSession = App::call()->session->getId(); // пользователь

        //Проверка прав пользователя на удаление товара
        if ($currentSession === $cart->session_id) {
//            (new CartRepository())->delete($cart);
            App::call()->cartRepository->delete($cart);
        } else {
            $status = 'error2';
        }

        $response = [
            'status' => $status,
//            'count' => (new CartRepository())->getCountWhere('session_id', $currentSession)
            'count' => App::call()->cartRepository->getCountWhere('session_id', $currentSession)
        ];

        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        die();
    }
}