<?php

namespace app\engine;

use app\traits\TSingletone;


/**
 * Class App
 * @property Cookie $cookie
 * @property PhpRender $phpRender
 * @property Request $request
 * @property Session $session
 * @property TwigRender $twigRender
 * @property CartRepository $cartRepository
 * @property FeedbackRepository $feedbackRepository
 * @property ImageRepository $imageRepository
 * @property OrderRepository $orderRepository
 * @property ProductRepository $productRepository
 * @property UserRepository $userRepository
 * @property Db $db
 * @property array $config
 */
class App
{
    use TSingletone;

    public $config; //Чтобы была возможность использовать данные из config не только в Db.php
    private $components;
    private $controller;
    private $action;

    public function run($config)
    {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }

    protected function runController()
    {
        $this->controller = $this->request->getControllerName() ? :'product';
        $this->action = $this->request->getActionName();
//        var_dump($this->controller);
        $controllerClass = $this->config['controllers_namespaces'].ucfirst($this->controller)."Controller";
//        var_dump($controllerClass);
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass(new TwigRender());
            $controller->runAction($this->action);
        } else {
            echo "404";
        }
    }

    /**
     * Обёртка над static методом TSingletone getInstance() для сокращения записи
     * @return static
     */
    public static function call()
    {
        return static::getInstance();
    }

    public function __get($name)
    {
        return $this->components->get($name);
    }

    public function createComponent($name)
    {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);

                $reflection = new \ReflectionClass($class); //Класс ReflectionClass сообщает информацию о классе.
                return $reflection->newInstanceArgs($params); //Создаёт экземпляр класса с переданными параметрами
            } else {
                die("Нет класса компонента");
            }
        } else {
            die("Нет такого компонента");
        }
    }
}