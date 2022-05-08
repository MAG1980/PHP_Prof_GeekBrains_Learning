<?php

namespace app\controllers;

use app\engine\App;
use app\interfaces\IRender;

//use app\models\repositories\CartRepository;
//use app\models\repositories\UserRepository;

abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    protected $render;

    public function __construct(IRender $render)
    {
        $this->render = $render;
    }

    public function runAction($action)
    {
        //Если экшен не передан, то выполняем дефолтный
        $this->action = $action ? :$this->defaultAction;
        $method = 'action'.ucfirst($this->action);

        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            die('404 нет такого экшена');
        }
    }

    /*    Этот метод может быть инкапсулирован в дочерние классы, потому что он формирует содержимое шаблона конкретно данного класса.
    В отличие от него метод renderTemplate() не привязан к какому-либо классу.*/
    protected function render($template, $params = [])
    {
//        $params ['is_auth'] = (new UserRepository())->isAuth();
        $params ['is_auth'] = App::call()->userRepository->isAuth();
//        $params ['user'] = (new UserRepository())->getLogin();
        $params ['user'] = App::call()->userRepository->getLogin();

        //Количество товаров в корзине, соответствующее данной сессии
//        $params ['count'] = (new CartRepository())->getCountWhere('session_id', session_id());
        $params ['count'] = App::call()->cartRepository->getCountWhere('session_id', session_id());

        return $this->renderTemplate('layouts/main', [
            'menu' => $this->renderTemplate('menu', $params),
            'content' => $this->renderTemplate($template, $params)
        ]);

    }

    private function renderTemplate($template, $params = [])
    {
        /*  При вызове метода в параметрах передавать $params = [] нельзя (это можно делать только при объявлении метода),
        т.к. это приведёт к тому, что значением параметра $params всегда будет пустой массив.
        В данном случае мы не указываем дефолтные значения,
        а передаём конкретные величины параметров.*/
        return $this->render->renderTemplate($template, $params);
    }
}