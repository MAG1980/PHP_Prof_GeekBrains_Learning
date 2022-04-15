<?php

class Autoload
{
    public function loadClass($className)
    {
        $className = preg_replace('/^app/', dirname(__DIR__), $className . '.php');

        $className = explode('\\', $className);
        $className = implode('/', $className);

        if (file_exists($className)) {
            include $className;
        }
    }
}