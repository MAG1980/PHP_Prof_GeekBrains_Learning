<?php

namespace app\models;

class Cart extends Model
{
    public $id;
    public $session_id;
    public $goods_id;
    public $number;

    function getTableName(): string
    {
        return 'cart';
    }
}