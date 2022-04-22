<?php

namespace app\models;

class Order extends DBModel
{
    public ?int $id = null;
    public ?string $cart_session;
    public ?string $login;
    public ?string $customer_name;
    public ?string $phone_number;

    protected static function getTableName(): string
    {
        return 'orders';
    }
}