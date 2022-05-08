<?php

namespace app\interfaces;

interface IRepository
{
    public function getOne(int $id);

    public function getAll();
}