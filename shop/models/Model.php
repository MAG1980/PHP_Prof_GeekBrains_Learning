<?php

namespace app\models;

use app\interfaces\IModel;

abstract class Model implements IModel
{
    public $updPropList = [];


    public function __set($name, $value)
    {
        $this->$name = $value;
        $this->updPropList[] = $name;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    /**Проверяет наличие у объекта поля с именем $name
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->$name);
    }
}