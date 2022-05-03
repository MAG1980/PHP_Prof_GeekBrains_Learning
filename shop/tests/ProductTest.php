<?php

namespace app\tests;

use app\models\entities\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    protected $fixture;

    /**
     *Создаёт один экземпляр класса Product перед началом тестирования
     * @return void
     */
    protected function setUp(): void
    {
        $this->fixture = $product = new Product();
    }

    /**
     * Тестирует Сеттеры с помощью провайдера данных
     * @dataProvider providerSetters
     * @param $field
     * @param $value
     * @return void
     */
    public function testProductSetters($field, $value)
    {
        $this->fixture->$field = $value;

        $this->assertEquals($this->fixture->$field, $value);
    }

    public function providerSetters()
    {
        return [
            ['name', 'cake'],
            ['image', 'photo'],
            ['description', "Торт со сливками"],
            ['price', 125]
        ];
    }

    public function testNameInProductConstructor()
    {
        $name = "Чай";
        $product = new Product($name);
        $this->assertEquals($product->name, $name);
        $product = null;
    }

    public function testImageInProductConstructor()
    {
        $image = "tea.jpg";
        $product = new Product(null, $image);
        $this->assertEquals($product->image, $image);
        $product = null;
    }

    public function testDescriptionInProductConstructor()
    {
        $description = "Описание продукта";
        $product = new Product(null, null, $description);
        $this->assertEquals($product->description, $description);
        $product = null;
    }

    public function testPriceInProductConstructor()
    {
        $price = 35.1;
        $product = new Product(null, null, null, $price);
        $this->assertEquals($product->price, $price);
        $product = null;
    }

    /**
     * После выполнения всех тестов освобождает поле $this->fixture от экземпляра класса Product для "сборки мусора"
     * @return void
     */
    protected function tearDown(): void
    {
        $this->fixture = null;
    }
}