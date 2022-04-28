<?php

namespace app\models;

use app\engine\Db;

class Cart extends DBModel
{
    protected int $id;
    protected string $session_id;
    protected int $goods_id;
    protected float $price;
    protected int $number;

    public static function getCart($session_id)
    {
        $sql = "SELECT cart.goods_id, COUNT(*) as number, COUNT(*) * goods.price as full_price, cart.session_id, goods.name AS good_name, goods.image AS good_image, goods.description AS good_description, goods.price AS good_price FROM cart  INNER JOIN goods ON cart.goods_id = goods.id WHERE cart.session_id = {$session_id} GROUP BY cart.goods_id";
        return Db::getInstance()->queryAll($sql);
    }

    public function add()
    {

    }

    protected static function getTableName(): string
    {
        return 'cart';
    }
}