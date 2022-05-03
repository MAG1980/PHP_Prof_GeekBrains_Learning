<?php

namespace app\tests;

use app\models\entities\Product;
use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase
{
    protected $entity;
    protected $fixture;


    public function setUp(): void
    {
        $this->entity = new Product();
    }

    public function tearDown(): void
    {
        $this->entity = null;
    }

    /**
     * Тестирует возможность записи данных в поля, отсутствующие в объекте
     * @dataProvider providerMissingFields
     * @return void
     */
    public function testExceptionBySetField($field, $value)
    {
        $this->expectException(\Exception::class);

        $this->entity->$field = $value;

    }

    /**
     * Тестирует возможность записи данных из полей, отсутствующих в объекте
     * @dataProvider providerMissingFields
     * @return void
     */
    public function testExceptionByGetField($field)
    {
        $this->expectException(\Exception::class);

        $this->entity->$field;

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
