<?php

namespace app\models;

use app\exceptions\ModelException;

abstract class Model
{
    protected $props = [];


    public function __set($name, $value)
    {
        //TODO разрешать менять только те поля, что есть в params
        if (property_exists($this, $name)) {
            $this->props[$name] = true;
            $this->$name = $value;
        } else {
            throw new ModelException("Попытка записи в несуществующее свойство объекта!");
        }
    }

    public function __get($name)
    {
        //TODO разрешать читать только те поля, что есть в params

        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            throw new ModelException("Попытка чтения данных из несуществующего свойства объекта!");
        }
    }

    /**
     * Проверяет наличие у объекта поля с именем $name
     * будет выполнен при использовании isset() или empty() на недоступных (защищённых или приватных) или несуществующих свойствах.
     * @param  string  $name
     * название поля объекта
     * @return bool
     */
    public function __isset(string $name)
    {
        return isset($this->$name);
    }
}