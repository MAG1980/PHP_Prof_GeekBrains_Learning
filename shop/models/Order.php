<?php

namespace app\models;

class Order extends Model
{
    public ?int $id = null;
    public ?string $cart_session;
    public ?string $login;
    public ?string $customer_name;
    public ?string $phone_number;

    public function getTableName(): string
    {
        return 'orders';
    }
}