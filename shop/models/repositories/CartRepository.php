<?php

namespace app\models\repositories;

use app\engine\Db;
use app\models\entities\Cart;
use app\models\Repository;

class CartRepository extends Repository
{
    public function getCart($session_id)
    {
        $sql = "SELECT cart.id as cart_id, cart.goods_id, cart.session_id, goods.name AS good_name, goods.image AS good_image, goods.description AS good_description, cart.price AS good_price, cart.number as good_number FROM cart  INNER JOIN goods ON cart.goods_id = goods.id WHERE cart.session_id = '{$session_id}'";
        return Db::getInstance()->queryAll($sql);
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
}