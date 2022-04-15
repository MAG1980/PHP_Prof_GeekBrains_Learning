<?php

namespace app\models;

class Order extends Model
{
    public $id;
    public $cart_session;
    public $login;
    public $customer_name;
    public $phone_number;

    public function getTableName(): string
    {
        return 'orders';
    }
}