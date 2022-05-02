<?php

namespace app\models\entities;

use app\models\Model;

class Image extends Model
{
    public ?int $id = null;
    public ?string $filename;
    public ?int $likes;
    protected $props = [
        'filename' => false,
        'likes' => false,
    ];

    /**
     * @param  string|null  $filename
     * @param  int|null  $likes
     * @param  false[]  $props
     */
    public function __construct(?string $filename, ?int $likes)
    {
        $this->filename = $filename;
        $this->likes = $likes;
    }
}