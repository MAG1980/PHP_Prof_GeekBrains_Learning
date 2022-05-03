<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IRepository;

abstract class Repository implements IRepository
{
    abstract protected function getTableName(): string;

    abstract protected function getEntityClass(): string;


    /**
     * Формирует SQL запрос с условием вида $name=$value
     * @param    $name Repository
     * @param    $value string
     * @return mixed
     */
    public function getWhere(string $name, string $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM $tableName WHERE {$name}=:value";
        //$name не может прийти от пользователя, поэтому для этой переменной подготовленный запрос не требуется
        $params = ['value' => $value];
        return Db::getInstance()->queryOneObject($sql, $params, $this->getEntityClass());
    }

    /**
     * Подсчёт количества записей, удовлетворяющих параметрам запроса
     * @param  string  $name
     * @param  string  $value
     * @return int
     * количество записей в БД, удовлетворяющих условию запроса
     */
    public function getCountWhere(string $name, string $value): int
    {

        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE {$name}=:value";
        $params = ['value' => $value];
        return Db::getInstance()->queryOne($sql, $params)['count'];
    }

    public function insert(Model $entity)
    {
        $params = [];
        $columns = [];

        foreach ($entity->props as $key => $value) {
            $params[":".$key] = $entity->$key;
            $columns[] = $key;
        }


        $columns = implode(', ', $columns);
        $values = implode(', ', array_keys($params));

        $tableName = $this->getTableName();

        $sql = "INSERT INTO `{$tableName}`($columns) VALUES ($values)";

        $result = Db::getInstance()->execute($sql, $params);
        $entity->id = Db::getInstance()->lastInsertId();
        return $result;
    }

    public function update(Model $entity)
    {
        $params = [];
        $colums = [];

        $tableName = static::getTableName();

        foreach ($entity->props as $key => $value) {
            if (!$value) {
                continue;
            }
            $params["{$key}"] = $entity->$key;
            $colums[] .= "`{$key}` = :{$key}";
            $entity->props[$key] = false;
        }
        $colums = implode(", ", $colums);
        $params['id'] = $entity->id;

        $sql = "UPDATE `{$tableName}` SET {$colums} WHERE `id` = :id";
        $result = Db::getInstance()->execute($sql, $params);
        return $result;
    }

    /**
     * Для уменьшения объема передаваемых данных, в запросе участвует только последнее изменённое свойство объекта.
     * @return object
     */

    public function delete(Model $entity): object
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $entity->id]);
    }


    public function getOne($id): object
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
//        return Db::getInstance()->queryOne($sql, ['id' => $id]);
        return Db::getInstance()->queryOneObject($sql, ['id' => $id], $this->getEntityClass());

    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public function getLimit($limit)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";
        return Db::getInstance()->queryLimit($sql, $limit);

    }

    public function save(Model $entity)
    {
        //TODO реализовать умный save
        if (is_null($entity->id)) {
            return $this->insert($entity);

        } else {
            return $this->update($entity);
        }
    }
}



