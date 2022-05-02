<?php

namespace app\models\entities;

use app\models\Model;

class Product extends Model
{
    public ?int $id = null;
    protected ?string $name;
    protected ?string $image;
    protected ?string $description;
    protected ?float $price;
    protected $props = [
        'name' => false,
        'image' => false,
        'description' => false,
        'price' => false,
    ];


    /**
     * @param  string  $name
     * наименование товара
     * @param  string  $image
     * название файла с изображением товара
     * @param  string  $description
     * @param  number  $id
     * количество товаров
     * @param  float  $price
     * цена единицы товара
     */
    public function __construct(
        string $name = null,
        string $image = null,
        string $description = null,
        float $price =
        null
    ) {
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
        $this->price = $price;
    }
}