<?php

namespace app\traits;

trait TSingletone
{
    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    //статический метод позволит вызывать себя без создания экземпляра класса
    public static function getInstance()
    {
        //используем позднее статическое связывание
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}