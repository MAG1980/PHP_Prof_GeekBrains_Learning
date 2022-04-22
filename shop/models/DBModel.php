<?php

namespace app\models;

use app\engine\Db;

abstract class DBModel extends Model
{
    abstract protected static function getTableName(): string;

    public static function insert($obj): object
    {
        var_dump($obj);
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
        var_dump($sql, $params);
        Db::getInstance()->execute($sql, $params);
        $obj->id = Db::getInstance()->lastInsertId();
        return $obj;
    }

    public static function update($obj)
    {
        $editable_feedback = Feedback::getOne($obj->id);
        var_dump($obj, $editable_feedback);

        $updPropList = [];
        foreach ($obj as $key => $value) {

            if ($editable_feedback->$key === $obj->$key) {
                continue;
            }
            $updPropList[$key] = $obj->$key;
        }
        $obj->updPropList = $updPropList;
        var_dump($obj);
        $tableName = static::getTableName();
        $updatedFields = [];
        $params = [':id' => $obj->id];
        foreach ($obj->updPropList as $key => $value) {
            $updatedFields[] = "{$key}=:{$key}";
            $params[":{$key}"] = $value;
        }

        $obj->updPropList = [];
        $obj->lastUpdated = '';

        $updatedFields = implode(', ', $updatedFields);
        $sql = "UPDATE {$tableName} SET {$updatedFields} WHERE id=:id";
        var_dump($sql);
        var_dump($params);
        Db::getInstance()->execute($sql, $params);
        return $obj;
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

    public static function delete($id)
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $id], static::class);
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

    public static function save($obj)
    {
        //TODO реализовать умный save
        if (is_null($obj->id)) {
            Feedback::insert($obj);
        } else {
            Feedback::update($obj);
        }
    }
}



