<?php

namespace app\models;

use app\engine\Db;

class Cart extends DBModel
{
    protected $id;
    protected $session_id;
    protected $goods_id;
    protected $price;
    protected $number;

    /**
     * @param  string  $session_id
     * @param  int  $goods_id
     * @param  float  $price
     * @param  int  $number
     */
    //Параметры по умолчанию нужно указать, чтобы сработал метод getOneObject()
    public function __construct(
        string $session_id = null,
        int $goods_id = null,
        float $price = null,
        int $number = null
    ) {
        $this->session_id = $session_id;
        $this->goods_id = $goods_id;
        $this->price = $price;
        $this->number = $number;
    }

    public static function getCart($session_id)
    {
        //Этот запрос позволяет получить суммарное количество по каждому id
        /*        $sql = "SELECT cart.goods_id, COUNT(*) as number, COUNT(*) * goods.price as full_price, cart.session_id, goods.name AS good_name, goods.image AS good_image, goods.description AS good_description, goods.price AS good_price FROM cart  INNER JOIN goods ON cart.goods_id = goods.id WHERE cart.session_id = '{$session_id}' GROUP BY cart.goods_id";*/
        $sql = "SELECT cart.id as cart_id, cart.goods_id, cart.session_id, goods.name AS good_name, goods.image AS good_image, goods.description AS good_description, goods.price AS good_price, cart.number as good_number FROM cart  INNER JOIN goods ON cart.goods_id = goods.id WHERE cart.session_id = '{$session_id}'";
        return Db::getInstance()->queryAll($sql);
    }


    protected static function getTableName(): string
    {
        return 'cart';
    }
}