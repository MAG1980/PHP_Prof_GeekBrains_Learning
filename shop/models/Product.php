<?php

namespace app\models;

class Product extends Model
{
    public $id;
    public $name;
    public $description;
    public $price;

    function getTableName(): string
    {
        return 'goods';
    }
}