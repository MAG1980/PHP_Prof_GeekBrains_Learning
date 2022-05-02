<?php

namespace app\models\entities;

use app\models\Model;

class Cart extends Model
{
    protected $id;
<<<<<<< Updated upstream
    protected ?string $session_id;
    protected ?int $goods_id;
    protected ?float $price;
    protected ?int $number;

    protected $props = [
        'session_id' => false,
        'goods_id' => false,
        'price' => false,
        'number' => false,
    ];
=======
    protected string $session_id;
    protected int $goods_id;
    protected float $price;
    protected int $number;
>>>>>>> Stashed changes

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
    }
}