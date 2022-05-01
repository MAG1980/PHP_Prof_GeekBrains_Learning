<?php

namespace app\models\entities;

use app\models\Repository;

class ProductRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'goods';
    }
}