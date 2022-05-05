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
    protected $props = [
        'cart_session' => false,
        'login' => false,
        'customer_name' => false,
        'phone_number' => false,
    ];


    /**
     * @param  string|null  $cart_session
     * @param  string|null  $login
     * @param  string|null  $customer_name
     * @param  string|null  $phone_number
     */
    public function __construct(
        ?string $cart_session = null,
        ?string $login = null,
        ?string $customer_name = null,
        ?string $phone_number = null
    ) {
        $this->cart_session = (new Session())->getId();
        $this->login = (new UserRepository())->getLogin();
        $this->customer_name = $customer_name;
        $this->phone_number = $phone_number;
    }
}