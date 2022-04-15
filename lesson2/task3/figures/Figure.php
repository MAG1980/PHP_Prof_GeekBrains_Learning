<?php

namespace lesson2\task3\figures;

abstract class Figure
{
    protected $name;
    protected $area;
    protected $perimeter;

    abstract public function getArea();

    abstract public function getPerimeter();

    abstract protected function getFigureName();

    public function showInfo(): string
    {
        return "Фигура: {$this->getFigureName()}<br>Площадь {$this->getArea()}<br>Периметр: {$this->getPerimeter()}<br><br>";
    }
}