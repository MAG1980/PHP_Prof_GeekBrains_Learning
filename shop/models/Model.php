<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;

abstract class Model implements IModel
{
    protected $db;

    public function __construct(Db $db)
    {
        $this -> db = $db;
    }

    public function getOne($id): string
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id=$id";
        return $this -> db -> queryOne($sql);
    }

    public function getAll(): string
    {
        $sql = "SELECT * from {$this->getTableName()}";
        return $this -> db -> queryAll($sql);
    }

    abstract protected function getTableName(): string;

}