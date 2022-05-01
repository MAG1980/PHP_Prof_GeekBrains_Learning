<?php

namespace app\models\entities;

use app\models\Repository;

class OrderRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'orders';
    }
}