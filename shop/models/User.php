<?php

namespace app\models;

class User extends Model
{
    public ?int $id = null;
    protected ?string $login;
    protected ?string $password;
    protected ?string $hash;

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