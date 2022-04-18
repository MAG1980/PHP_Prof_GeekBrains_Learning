<?php

namespace app\models;

class Image extends Model
{
    public ?int $id = null;
    public ?string $filename;
    public ?int $likes;

    public function getTableName(): string
    {
        return 'images';
    }
}