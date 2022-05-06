<?php

namespace app\models\entities;

use app\engine\Session;
use app\models\Model;
use app\models\repositories\UserRepository;

class Order extends Model
{
    protected ?int $id = null;
    protected ?string $cart_session;
    protected ?string $login;
    protected ?string $customer_name;
    protected ?string $phone_number;
    protected ?string $email;
    protected ?float $total_price;
    protected ?string $status;
    protected $props = [
        'cart_session' => false,
        'login' => false,
        'customer_name' => false,
        'phone_number' => false,
        'email' => false,
        'total_price' => false,
        'status' => false
    ];


    public function __construct(
        ?string $cart_session = null,
        ?string $login = null,
        ?string $customer_name = null,
        ?string $phone_number = null,
        ?string $email = null,
        ?float $total_price = null,
        ?string $status = null

    ) {
        $this->cart_session = (new Session())->getId();
        $this->login = (new UserRepository())->getLogin();
        $this->customer_name = $customer_name;
        $this->phone_number = $phone_number;
        $this->email = $email;
        $this->total_price = $total_price;
        $this->status = $status;
    }
}