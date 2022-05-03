<?php

namespace app\tests;

use app\models\entities\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testNameInProductConstructor()
    {
        $name = "Чай";
        $product = new Product($name);
        $this->assertEquals($product->name, $name);
    }

    public function testImageInProductConstructor()
    {
        $image = "tea.jpg";
        $product = new Product(null, $image);
        $this->assertEquals($product->image, $image);
    }

    public function testDescriptionInProductConstructor()
    {
        $description = "Описание продукта";
        $product = new Product(null, null, $description);
        $this->assertEquals($product->description, $description);
    }

    public function testPriceInProductConstructor()
    {
        $price = 35.1;
        $product = new Product(null, null, null, $price);
        $this->assertEquals($product->price, $price);
    }
}