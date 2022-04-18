<?php

namespace app\models;

class Product extends Model
{
    public ?int $id = null;
    public string $name;
    public string $image;
    public string $description;
    public float $price;

    /**
     * @param $name
     * @param $description  $id будет сгенерирован БД автоматически (автоинкремент)
     * @param $price
     */
    public function __construct($name = null, $image = null, $description = null, $price = null)
    {
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
        $this->price = $price;
    }

    function getTableName(): string
    {
        return 'goods';
    }
}