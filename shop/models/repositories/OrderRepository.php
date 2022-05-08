<?php

namespace app\models\repositories;

use app\models\entities\Order;
use app\models\Repository;

class OrderRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'orders';
    }

    protected function getEntityClass(): string
    {
        //Возвращает полное имя класса (вместе с namespace)
        return Order::class;
    }
}