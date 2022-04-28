<?php

namespace app\models;

class Feedback extends DBModel
{
    public ?int $id = null;
    public ?string $name;
    public ?string $text;

    public function __construct(int $id = null, string $name = null, string $text = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->text = $text;
    }


    protected static function getTableName(): string
    {
        return 'feedback';
    }
}