<?php

namespace app\interfaces;

interface IModel
{
    public function getOne();

    public static function getAll();
}