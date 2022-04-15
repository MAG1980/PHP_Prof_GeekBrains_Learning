<?php

namespace app\models;

class Image extends Model
{
    public $id;
    public $filename;
    public $likes;

    public function getTableName(): string
    {
        return 'images';
    }
}