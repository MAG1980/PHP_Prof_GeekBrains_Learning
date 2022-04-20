<?php

namespace app\models;

class Image extends DBModel
{
    public ?int $id = null;
    public ?string $filename;
    public ?int $likes;

    public function getTableName(): string
    {
        return 'images';
    }
}