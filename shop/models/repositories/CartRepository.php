<?php

namespace app\models\repositories;

use app\engine\App;
use app\models\entities\Cart;
use app\models\Repository;

class CartRepository extends Repository
{
    public function getCart($session_id)
    {
        $sql = "SELECT cart.id as cart_id, cart.goods_id, cart.session_id, goods.name AS good_name, goods.image AS good_image, goods.description AS good_description, cart.price AS good_price, cart.number as good_number FROM cart  INNER JOIN goods ON cart.goods_id = goods.id WHERE cart.session_id = '{$session_id}'";
//        return Db::getInstance()->queryAll($sql);
        return App::call()->db->queryAll($sql);
    }

    protected function getTableName(): string
    {
        return 'cart';
    }

    protected function getEntityClass(): string
    {
        //Возвращает полное имя класса (вместе с namespace)
        return Cart::class;
    }

    public function getAllJoinGoodsOnId($parameters)
    {
        $sql = "SELECT cart.id, session_id, goods_id, cart.number, cart.price, goods.name, goods.image, goods.description FROM cart INNER JOIN goods ON cart.goods_id=goods.id  WHERE session_id = :session_id";

//        return Db::getInstance()->query($sql, $parameters)->fetchAll();
        return App::call()->db->query($sql, $parameters)->fetchAll();
    }
}