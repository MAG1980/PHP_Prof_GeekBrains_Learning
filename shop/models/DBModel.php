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
        foreach ($obj as $key => $value) {
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
        $obj->id = Db::getInstance()->lastInsertId();
        return $obj;
    }

    public function update()
    {
        $editable_feedback = $this->getOne();
        var_dump($obj);
        foreach ($obj->updPropList as $key) {

            if ($editable_feedback->$key === $obj->$key) {
                continue;
            }
            $updPropList[$key] = $obj->$key;
        }

        $tableName = static::getTableName();
        $updatedFields = [];
        $params = [':id' => $obj->id];
        foreach ($obj->updPropList as $key) {
            $updatedFields[] = "{$key}=:{$key}";
            $params[":{$key}"] = $obj->$key;
        }

        $obj->updPropList = [];

        $updatedFields = implode(', ', $updatedFields);
        $sql = "UPDATE {$tableName} SET {$updatedFields} WHERE id=:id";
        var_dump($sql);
        die();
        Db::getInstance()->execute($sql, $params);
        return $obj;
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


    public function getOne(): object
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
//        return Db::getInstance()->queryOne($sql, ['id' => $id]);
        return Db::getInstance()->queryOneObject($sql, ['id' => $this->id], static::class);

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



