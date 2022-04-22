<?php

namespace app\models;

class Cart extends Model
{
    public ?int $id = null;
    public ?string $session_id;
    public ?int $goods_id;
    public ?int $number;

    public static function getBasket()
    {
        //запрос на корзину
    }

    protected static function getTableName(): string
    {
        return 'cart';
    }
}