<?php

namespace app\models;

class Feedback extends Model
{
    public $id;
    public $name;
    public $text;

    public function getTableName(): string
    {
        return 'feedback';
    }
}