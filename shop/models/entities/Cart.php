<?php

namespace app\models\entities;

use app\models\Model;

class Cart extends Model
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
}