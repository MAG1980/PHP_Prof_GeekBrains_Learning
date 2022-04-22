<?php

namespace app\models;

class Feedback extends DBModel
{
    public ?int $id = null;
    public ?string $name;
    public ?string $text;

    protected static function getTableName(): string
    {
        return 'feedback';
    }
}