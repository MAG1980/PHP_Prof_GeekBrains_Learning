<?php

namespace lesson2\task3\figures;

class Rectangle extends Figure
{
    protected $sideA;
    protected $sideB;

    public function __construct($sideA, $sideB)
    {
        $this -> sideA = $sideA;
        $this -> sideB = $sideB;
        $this -> name = $this -> getFigureName();
        $this -> area = $this -> getArea();
        $this -> perimeter = $this -> getPerimeter();
    }

    public function getArea()
    {
        return $this -> sideA * $this -> sideB;
    }

    public function getPerimeter()
    {
        return 2 * ($this -> sideA + $this -> sideB);
    }

    protected function getFigureName(): string
    {
        return "Прямоугольник";
    }

}