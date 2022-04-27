<?php

namespace app\models;

use app\engine\Db;

abstract class DBModel extends Model
{
    abstract protected static function getTableName(): string;

    /**Формирует SQL запрос с условием вида $name=$value
     * @param $name название столбца в БД
     * @param $value искомое значение
     * @return mixed
     */
    public static function getWhere(string $name, string $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM $tableName WHERE {$name}=:value";
        //$name не может прийти от пользователя, поэтому для этой переменной подготовленный запрос не требуется
        $params = ['value' => $value];
        return Db::getInstance()->queryOneObject($sql, $params, static::class);
    }

    public function insert(): object
    {

        $keys = [];
        $names = '';
        $values = '';
        $params = [];

        $tableName = static::getTableName();
        foreach ($this as $key => $value) {
            if ($key === 'updPropList') {
                continue;
            }
            $keys[] = $key;
            $params[":".$key] = $value;
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
        $object = $this->getOne($this->id);
        foreach ($object as $key => $value) {
            if ($object->$key === $this->$key || $key === "updPropList") {
                continue;
            }
            $updPropList[$key] = $key;
        }
        $this->updPropList = $updPropList;

        $tableName = static::getTableName();
        $updatedFields = [];
        $params = [':id' => $this->id];
        foreach ($this->updPropList as $key) {
            $updatedFields[] = "{$key}=:{$key}";
            $params[":{$key}"] = $this->$key;
        }
        $this->updPropList = [];

        $updatedFields = implode(', ', $updatedFields);
        $sql = "UPDATE {$tableName} SET {$updatedFields} WHERE id=:id";
        var_dump($sql, $params);

        Db::getInstance()->execute($sql, $params);
        return $this;
    }

    /**
     * Для уменьшения объема передаваемых данных, в запросе участвует только последнее изменённое свойство объекта.
     * @return object
     */

    public static function delete($id)
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $id], static::class);
    }


    public static function getOne($id): object
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



