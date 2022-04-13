<?php

namespace app\interfaces;

interface IModel
{
    public function getOne($id): string;

    public function getAll(): string;

}