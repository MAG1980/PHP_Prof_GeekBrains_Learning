<?php

namespace app\models\entities;

use app\models\Model;

class User extends Model
{
    public ?int $id = null;
    protected ?string $login;
    protected ?string $password;
    protected ?string $hash;
    protected $props = [
        'login' => false,
        'password' => false,
        'hash' => false,
    ];

    /**
     * @param  string  $login
     * @param  string  $pass
     * @param  string  $hash
     * хеш пароля
     */
    public function __construct(string $login = null, string $password = null, string $hash = null)
    {
        $this->login = $login;
        $this->password = $password;
        $this->hash = $hash;
    }
}