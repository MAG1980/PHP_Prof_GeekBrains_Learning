<?php

namespace app\models;

class Cart extends Model
{
    public ?int $id = null;
    public ?string $session_id;
    public ?int $goods_id;
    public ?int $number;

    function getTableName(): string
    {
        return 'cart';
    }
}