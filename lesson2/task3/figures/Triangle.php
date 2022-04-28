<?php

namespace lesson2\task3\figures;

class Triangle extends Figure
{
    protected $base;
    protected $height;
    protected $sideA;
    protected $sideB;

    public function __construct($base, $height, $sideA, $sideB)
    {
        $this -> base = $base;
        $this -> height = $height;
        $this -> sideA = $sideA;
        $this -> sideB = $sideB;

        $this -> name = $this -> getFigureName();
        $this -> area = $this -> getArea();
        $this -> perimeter = $this -> getPerimeter();
    }

    public function getArea()
    {
        return $this -> base * $this -> height / 2;
    }

    public function getPerimeter()
    {
        return $this -> base + $this -> sideA + $this -> sideB;
    }

    protected function getFigureName(): string
    {
        return "Треугольник";
    }

}