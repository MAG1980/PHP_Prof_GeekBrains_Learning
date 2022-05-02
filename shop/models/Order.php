<?php

namespace app\models;

use app\engine\Session;

class Order extends DBModel
{
    public ?int $id = null;
    public ?string $cart_session;
    public ?string $login;
    public ?string $customer_name;
    public ?string $phone_number;

    /**
     * @param  string|null  $cart_session
     * @param  string|null  $login
     * @param  string|null  $customer_name
     * @param  string|null  $phone_number
     */
    public function __construct(?string $cart_session, ?string $login, ?string $customer_name, ?string $phone_number)
    {
        $this->cart_session = (new Session())->getId();
        $this->login = $login;
        $this->customer_name = $customer_name;
        $this->phone_number = $phone_number;
    }

    protected static function getTableName(): string
    {
        return 'orders';
    }
}