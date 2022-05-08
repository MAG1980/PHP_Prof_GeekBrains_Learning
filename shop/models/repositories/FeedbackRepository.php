<?php

namespace app\models\repositories;

use app\models\entities\Feedback;
use app\models\Repository;

class FeedbackRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'feedback';
    }

    protected function getEntityClass(): string
    {
        //Возвращает полное имя класса (вместе с namespace)
        return Feedback::class;
    }
}