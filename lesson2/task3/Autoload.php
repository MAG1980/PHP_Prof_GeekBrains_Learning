<?php

namespace lesson2\task3;

class Autoload
{
    public function loadClass($className)
    {
        $className = preg_replace('/^lesson2/', dirname(__DIR__), $className.'.php');
        $className = explode('\\', $className);
        $className = implode('/', $className);

        if (file_exists($className)) {
            include $className;
        }
    }
}