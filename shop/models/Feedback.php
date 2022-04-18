<?php

namespace app\models;

class Feedback extends Model
{
    public ?int $id = null;
    public ?string $name;
    public ?string $text;

    public function getTableName(): string
    {
        return 'feedback';
    }
}