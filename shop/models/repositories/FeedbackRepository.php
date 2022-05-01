<?php

namespace app\models\repositories;

use app\models\Repository;

class FeedbackRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'feedback';
    }
}