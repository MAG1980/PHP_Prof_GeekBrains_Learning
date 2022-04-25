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
}