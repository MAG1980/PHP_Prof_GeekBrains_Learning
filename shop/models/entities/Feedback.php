<?php

namespace app\models\entities;

use app\models\Model;

class Feedback extends Model
{
    protected ?int $id = null;
    protected ?string $name;
    protected ?string $text;
    protected $props = [
        'name' => false,
        'text' => false,
    ];

    public function __construct(string $name = null, string $text = null)
    {
        $this->name = $name;
        $this->text = $text;
    }
}