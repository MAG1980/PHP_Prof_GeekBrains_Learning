<?php

namespace app\models;

use app\interfaces\IModel;

abstract class Model implements IModel
{
    public $lastUpdated = '';
    public $updPropList = [];


    public function __set($name, $value)
    {
        $this->$name = $value;
        $this->lastUpdated = $name;
        $this->updPropList["{$name}"] = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}