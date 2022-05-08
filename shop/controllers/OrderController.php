<?php

namespace app\controllers;

use app\engine\App;
use app\models\entities\Order;

class OrderController extends Controller
{
    public function actionAdd()
    {
//        $data = (new Request())->getParams();
        $data = App::call()->request->getParams();
        $cart_session = $data['cart_session'];
        $customer_name = $data['customer_name'];
        $phone_number = $data['phone_number'];
        $email = $data['email'];
        $total_price = $data['total_price'];
//TODO Переделать на getWhere
        //создаём экземпляр заказа и вызываем у него insert() или update()
        $order = new Order($cart_session, $login, $customer_name, $phone_number, $email, $total_price);
//        var_dump($data, $order);

//        if ((new OrderRepository())->save($order)) {
        if (App::call()->orderRepository->save($order)) {
            $status = 'ok';
        } else {
            $status = 'order-error1';
        };

        $response = [
            'status' => $status,
//            'order_id' => Db::getInstance()->lastInsertId()
            'order_id' => App::call()->db->lastInsertId()
        ];
//        (new Session())->regenerate_id();
        App::call()->session->regenerate_id();
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die();

        /*      при синхронных запросах (статическом рендеринге) после опрации с БД нужно выполнить редирект
                header('Location:/product/catalog');
                die();*/
    }

    protected function actionList()
    {
//        $login = (new UserRepository())->getLogin();
        $login = App::call()->userRepository->getLogin();
        //        $page = $_GET['page'] ?? 0;
//        $page = (new Request())->getParams()['page'] ?? 0;;
        $page = App::call()->request->getParams()['page'] ?? 0;;
        $limit = ($page + 1) * App::call()->config['product_per_page'];
        if ($login === 'admin') {

//            $orders = (new OrderRepository())->getLimit($limit);
            $orders = App::call()->orderRepository->getLimit($limit);

        } else {
//            $orders = (new OrderRepository())->getWhereWithLimit('login', $login, $limit);
            $orders = App::call()->orderRepository->getWhereWithLimit('login', $login, $limit);

        }
        echo $this->render('orders/list', [
            'orders' => $orders,
            'page' => ++$page
        ]);

    }

    protected function actionUnit()
    {
//        $request = new Request();
        //   $id = $_GET['id'];
//        $id = $request->getParams()['id'];
        $id = App::call()->request->getParams()['id'];
//        $order = (new OrderRepository())->getWhere(['id' => $id]);
        $order = App::call()->orderRepository->getWhere(['id' => $id]);

        echo $this->render('orders/unit', [
            'order' => $order,
//            'isAdmin' => (new Session())->getLogin() === 'admin'
            'isAdmin' => App::call()->session->getLogin() === 'admin'
        ]);
    }

    protected function actionStatus()
    {
//        $data = (new Request())->getParams();
        $data = App::call()->request->getParams();
        $id = $data['id'];
        $status = $data['status'];
//        $order_repository = new OrderRepository();
        $order_repository = App::call()->orderRepository;
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
//        $data = (new Request())->getParams();
        $data = App::call()->request->getParams();

        $parameters = [
            'session_id' => $data['cart_session'],
        ];


//        $oldCart = (new CartRepository())->getAllWhere($parameters);
//        $cart = (new CartRepository())->getAllJoinGoodsOnId($parameters);
        $cart = App::call()->cartRepository->getAllJoinGoodsOnId($parameters);
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