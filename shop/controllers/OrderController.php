<?php

namespace app\controllers;

use app\engine\Db;
use app\engine\Request;
use app\engine\Session;
use app\models\entities\Order;
use app\models\repositories\OrderRepository;

class OrderController extends Controller
{
    public function actionAdd()
    {
        $data = (new Request())->getParams();
        $cart_session = $data['cart_session'];
//        $login = (new Session())->getLogin();
        $customer_name = $data['customer_name'];
        $phone_number = $data['phone_number'];
//TODO Переделать на getWhere
        //создаём экземпляр заказа и вызываем у него insert() или update()
        $order = new Order($cart_session, $login, $customer_name, $phone_number);
//        var_dump($data, $order);

        if ((new OrderRepository())->save($order)) {
            $status = 'ok';
        } else {
            $status = 'order-error1';
        };

        $response = [
            'status' => $status,
            'order_id' => Db::getInstance()->lastInsertId()
        ];
        (new Session())->regenerate_id();
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die();

        /*      при синхронных запросах (статическом рендеринге) после опрации с БД нужно выполнить редирект
                header('Location:/product/catalog');
                die();*/
    }
}