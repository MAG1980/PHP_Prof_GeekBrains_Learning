<?php

namespace app\tests;

use app\models\entities\{Cart, Feedback, Product, User};
use PHPUnit\Framework\TestCase;

class EntitiesExceptionTest extends TestCase
{
    protected $product;
    protected $cart;
    protected $user;
    protected $feedback;
    protected $order;
    protected $image;


    public function setUp(): void
    {
        $this->product = new Product();
        $this->cart = new Cart();
        $this->user = new User();
        $this->feedback = new Feedback();
//        $this->order = new Order();
//        $this->image = new Image();
    }

    public function tearDown(): void
    {
        $this->product = null;
        $this->cart = null;
        $this->user = null;
        $this->feedback = null;
        $this->order = null;
        $this->image = null;
    }

    /**
     * Тестирует возможность записи данных в поля, отсутствующие в объекте
     * @dataProvider providerMissingFields
     * @return void
     */
    public function testExceptionBySetField($field, $value)
    {
        $this->expectException(\Exception::class);

        $this->product->$field = $value;
        $this->cart->$field = $value;
        $this->user->$field = $value;
        $this->feedback->$field = $value;
//        $this->order->$field = $value;
//        $this->image->$field = $value;

    }

    /**
     * Тестирует возможность записи данных из полей, отсутствующих в объекте
     * @dataProvider providerMissingFields
     * @return void
     */
    public function testExceptionByGetField($field)
    {
        $this->expectException(\Exception::class);

        $this->product->$field;
        $this->cart->$field;
        $this->user->$field;
        $this->feedback->$field;
//        $this->order->$field;
//        $this->image->$field;

    }

    public function providerMissingFields()
    {
        return [
            ['count', 11],
            ['family', 'Россия'],
            ['city', "Воронеж"],
            ['age', 125]
        ];
    }
}
