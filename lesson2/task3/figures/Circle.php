<?php

namespace lesson2\task3\figures;

class Circle extends Figure
{
    protected $radius;

    public function __construct($radius)
    {
        $this -> radius = $radius;
        $this -> name = $this -> getFigureName();
        $this -> area = $this -> getArea();
        $this -> perimeter = $this -> getPerimeter();
    }

    public function getArea()
    {
        return pi() * (pow($this -> radius, 2));
    }

    public function getPerimeter()
    {
        return 2 * pi() * $this -> radius;
    }

    public function getFigureName(): string
    {
        return "Круг";
    }
}