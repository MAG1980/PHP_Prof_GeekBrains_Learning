<?php

namespace app\models\entities;

use app\models\Model;

class Image extends Model
{
    public ?int $id = null;
    public ?string $filename;
    public ?int $likes;
}