<?php

namespace app\engine;

class Autoload
{
    public function loadClass($className)
    {
        $className = preg_replace('/^app/', ROOT, $className.'.php');

        $className = str_replace('\\', '/', $className);

        if (file_exists($className)) {
            include $className;
        }
    }
}