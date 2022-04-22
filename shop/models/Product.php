<?php

namespace app\models;

class Product extends DBModel
{
    public ?int $id = null;
    protected ?string $name;
    protected ?string $image;
    protected ?string $description;
    protected ?float $price;

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

    protected static function getTableName(): string
    {
        return 'goods';
    }
}