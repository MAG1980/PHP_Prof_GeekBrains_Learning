<?php

namespace app\models;

use app\engine\Db;

abstract class DBModel extends Model
{
    abstract protected static function getTableName(): string;

    public function insert(): object
    {
        $keys = [];
        $names = '';
        $values = '';
        $params = [];

        $tableName = static::getTableName();
        foreach ($this as $key => $value) {
//            if ($key === 'id') {
//                continue;
//            }
            if ($key != 'id' && $key != 'lastUpdated' && $key != 'updPropList') {
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

    public function update()
    {
        $tableName = $this->getTableName();
        $updatedFields = [];
        $params = [':id' => $this->id];
        foreach ($this->updPropList as $key => $value) {
            $updatedFields[] = "{$key}=:{$key}";
            $params[":{$key}"] = $value;
        }

        $this->updPropList = [];
        $this->lastUpdated = '';

        $updatedFields = implode(', ', $updatedFields);
        $sql = "UPDATE {$tableName} SET {$updatedFields} WHERE id=:id";
        var_dump($sql);
        var_dump($params);
//        die();
        Db::getInstance()->execute($sql, $params);
        return $this;
    }

    /**
     * Для уменьшения объема передаваемых данных, в запросе участвует только последнее изменённое свойство объекта.
     * @return object
     */
    public function updateOneProp(): object
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
        $this->updPropList = [];
        $this->lastUpdated = '';
        return $this;
    }

    public function delete()
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $this->id]);
    }


    public static function getOne(int $id): object
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
//        return Db::getInstance()->queryOne($sql, ['id' => $id]);
        return Db::getInstance()->queryOneObject($sql, ['id' => $id], static::class);

    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public static function getLimit($limit)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";
        return Db::getInstance()->queryLimit($sql, $limit);

    }

    public function save()
    {
        //TODO реализовать умный save
        if (is_null($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }
}



