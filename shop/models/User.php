<?php

namespace app\models;

class User extends Model
{
    public $id;
    public $login;
    public $pass;

    function getTableName(): string
    {
        return 'users';
    }

}