<?php

namespace app\models\entities;

use app\models\Model;

class Feedback extends Model
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
}