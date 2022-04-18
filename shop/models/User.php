<?php

namespace app\models;

class User extends Model
{
    public ?int $id = null;
    public ?string $login;
    public ?string $password;
    public ?string $hash;

    /**
     * @param $login
     * @param $pass
     */
    public function __construct($login = null, $password = null, $hash = null)
    {
        $this->login = $login;
        $this->password = $password;
        $this->hash = $hash;
    }


    function getTableName(): string
    {
        return 'users';
    }

}