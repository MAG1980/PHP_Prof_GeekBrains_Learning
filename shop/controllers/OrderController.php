<?php

namespace app\controllers;

use app\engine\Db;
use app\engine\Request;
use app\engine\Session;
use app\models\entities\Order;
use app\models\repositories\CartRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\UserRepository;

class OrderController extends Controller
{
    public function actionAdd()
    {
        $data = (new Request())->getParams();
        $cart_session = $data['cart_session'];
        $customer_name = $data['customer_name'];
        $phone_number = $data['phone_number'];
        $email = $data['email'];
        $total_price = $data['total_price'];
//TODO Переделать на getWhere
        //создаём экземпляр заказа и вызываем у него insert() или update()
        $order = new Order($cart_session, $login, $customer_name, $phone_number, $email, $total_price);
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

    protected function actionList()
    {
        $login = (new UserRepository())->getLogin();
        //        $page = $_GET['page'] ?? 0;
        $page = (new Request())->getParams()['page'] ?? 0;;
        $limit = ($page + 1) * 2;
        if ($login === 'admin') {

            $orders = (new OrderRepository())->getLimit($limit);

        } else {
            $orders = (new OrderRepository())->getWhereWithLimit('login', $login, $limit);

        }
        echo $this->render('orders/list', [
            'orders' => $orders,
            'page' => ++$page
        ]);

    }

    protected function actionUnit()
    {
        $request = new Request();
        //   $id = $_GET['id'];
        $id = $request->getParams()['id'];
        $order = (new OrderRepository())->getWhere(['id' => $id]);

        echo $this->render('orders/unit', [
            'order' => $order,
            'isAdmin' => (new Session())->getLogin() === 'admin'
        ]);
    }

    protected function actionStatus()
    {
        $data = (new Request())->getParams();
        $id = $data['id'];
        $status = $data['status'];
        $order_repository = new OrderRepository();
        $order = $order_repository->getWhere(['id' => $id]);
//        var_dump($order);
        $order->__set('status', $status);

        if ($order_repository->update($order)) {
            $status = 'ok';
        } else {
            $status = 'order-error2';
        };

        $response = [
            'status' => $status
        ];

        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die();

    }

    protected function actionDetails()
    {
        $data = (new Request())->getParams();

        $parameters = [
            'session_id' => $data['cart_session'],
        ];


        $cart = (new CartRepository())->getAllWhere($parameters);

        if ($cart) {
            $status = 'ok';
        } else {
            $status = 'order-error3';
        };

        $response = [
            'status' => $status,
            'cart' => $cart
        ];

        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die();

    }

}