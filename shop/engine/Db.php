<?php

namespace app\engine;

use app\traits\TSingletone;
use PDO;

class Db
{
    private array $config = [
        'driver' => 'mysql',
        'host' => 'localhost:3307',
        'login' => 'root',
        'password' => '',
        'database' => 'shop',
        'charset' => 'utf8'
    ];

    private $connection = null;

    use TSingletone;

    private function getConnection(): PDO
    {
        try {
            if (is_null($this->connection)) {
                // вместо new PDO(“mysql:host=$this->config[ ‘host’ ]; dbname=$dbname”, $user, $pass);
                $this->connection = new PDO($this->prepareDsnString(),
                    $this->config['login'],
                    $this->config['password']);

                // запросы к БД будут возвращать данные в виде ассоциативного массива.
                $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }
        } catch (PDOExeception $error) {
            echo "Подключение не удалось: ".$error->getMessage();
        }

        return $this->connection;
    }

    public function lastInsertId()
    {
        return (int) $this->getConnection()->lastInsertId();
    }

//подготавливает параметры подключения
    private function prepareDsnString(): string
    {
        return sprintf("%s:host=%s; dbname=%s; charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    public function query(string $sql, array $params)
    {
        $STH = $this->getConnection()->prepare($sql);

        //передаём в качестве аргумента массив параметров запроса
//        var_dump($params);
        $STH->execute($params);

        //объект с инкапсулированными даными, полученными из БД
        return $STH;
    }

    public function queryWithLimit(string $sql, string $value, int $limit)
    {
        $STH = $this->getConnection()->prepare($sql);

        $STH->bindValue(":value", $value, \PDO::PARAM_STR);
        $STH->bindValue(":limit", $limit, \PDO::PARAM_INT);
        $STH->execute();
        return $STH->fetchAll();
    }


    public function queryOneObject($sql, $params = [], $class)
    {
        //Сохранение данных, полученных из БД в объект
        $STH = $this->query($sql, $params);

        //Устанавливает режим выборки по умолчанию для объекта запроса в виде экземпляра $class
        //Если не задать PDO::FETCH_PROPS_LATE, то сначала в объект сохраняются данные, а потом вызывается
        // конструктор класса, что приводит к обнулению данных
        $STH->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $class);

        //Извлечение данных из объекта
        return $STH->fetch();
    }

    public function queryLimit($sql, $limit)
    {
        $STH = $this->getConnection()->prepare($sql);
        $STH->bindValue(1, $limit, \PDO::PARAM_INT);
        $STH->execute();
        return $STH->fetchAll();
    }

    public function queryOne($sql, $params = [])
    {
        //возвращаем данные, извлечённые из объекта, возвращённого методом query( $sql, $params )
        return $this->query($sql, $params)->fetch();
    }

    public function queryAll($sql, $params = [])
    {
//возвращаем все данные, извлечённые из объекта, возвращённого методом query( $sql, $params )
        return $this->query($sql, $params)->fetchAll();
    }

    /**
     * Используется для запросов к БД, которые не возвращают данные
     * @param  string  $sql
     * SQL-запрос
     * @param  array  $params
     * ассоциативный массив с параметрами запроса
     * @return Db $this
     * экэемпляр класса Db
     */
    public function execute($sql, array $params = []): object
    {
        $this->query($sql, $params);
        return $this;
    }
}