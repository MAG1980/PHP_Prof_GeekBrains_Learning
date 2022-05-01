<?php

namespace app\models\entities;

use app\models\Repository;

class ImageRepository extends Repository
{
    protected static function getTableName(): string
    {
        return 'images';
    }
}