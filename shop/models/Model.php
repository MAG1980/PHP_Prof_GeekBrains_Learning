<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;

abstract class Model implements IModel
{
    public $lastUpdated = null;


    public function __set($name, $value)
    {
        $this->$name = $value;
        $this->lastUpdated = $name;
    }

    public function insert(): object
    {
        $keys = [];
        $names = '';
        $values = '';
        $params = [];

        $tableName = $this->getTableName();
        foreach ($this as $key => $value) {
//            if ($key === 'id') {
//                continue;
//            }
            if ($key != 'id' && $key != 'lastUpdated') {
                $keys[] = $key;
                $params[":".$key] = $value;
            }
        }

        $names = "(".implode(", ", $keys).")";
        $values = "(".implode(", ", array_keys($params)).")";

        $sql = "INSERT INTO {$tableName} {$names} VALUES {$values}";

        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();
        return $this;
    }

    /**
     * Для уменьшения объема передаваемых данных, в запросе участвует только последнее изменённое свойство объекта.
     * @return object
     */
    public function update(): object
    {
        $tableName = $this->getTableName();
        $updatedFieldTitle = $this->lastUpdated;
        $value = ":".$updatedFieldTitle;
        $params = [
            $value => $this->$updatedFieldTitle,
            ':id' => $this->id
        ];

        $sql = "UPDATE {$tableName} SET {$updatedFieldTitle} = {$value} WHERE id = :id";

        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();
        return $this;
    }


    public function delete()
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $this->id]);
    }


    public function getOne(int $id): object
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
//        return Db::getInstance()->queryOne($sql, ['id' => $id]);
        return Db::getInstance()->queryOneObject($sql, ['id' => $id], static::class);

    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->getTableName()}";
        return Db::getInstance()->queryOne($sql);
    }

    abstract protected function getTableName(): string;

}