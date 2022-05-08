<?php

namespace app\models\repositories;

use app\models\entities\Image;
use app\models\Repository;

class ImageRepository extends Repository
{
    protected function getTableName(): string
    {
        return 'images';
    }

    protected function getEntityClass(): string
    {
        //Возвращает полное имя класса (вместе с namespace)
        return Image::class;
    }
}