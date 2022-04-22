<?php

namespace app\models;

class User extends DBModel
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


    protected static function getTableName(): string
    {
        return 'users';
    }

}