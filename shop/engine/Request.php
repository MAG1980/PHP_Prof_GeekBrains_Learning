<?php

namespace app\engine;

class Request
{
    protected $requestString;
    protected $controllerName;
    protected $actionName;
    protected $method;
    protected $params = [];


    public function __construct()
    {
        $this->parseRequest();
    }

    protected function parseRequest()
    {
        $this->requestString = $_SERVER['REQUEST_URI']; //Строка запроса
        $this->method = $_SERVER['REQUEST_METHOD'];

        $url = explode('/', $this->requestString);
        $this->controllerName = $url[1];
        $this->actionName = $url[2];

        $this->params = $_REQUEST;
    }

    /**
     * Возвращает имя контроллера
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    /**
     * Возвращает имя экшена
     * @return string
     */
    public function getActionName(): ?string
    {
        return $this->actionName;
    }

    /**
     * Возвращает название метода
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Возвращает ассоциативный массив с параметрами запроса
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    } //$_REQUEST


}