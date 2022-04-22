<?php

namespace app\controllers;

use app\models\Product;

class ProductController
{
    private $action;
    private $defaultAction = 'index';

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

    //Дефолтный экшен
    private function actionIndex()
    {
        echo $this->render('index');
    }

    private function actionCatalog()
    {
        $page = $_GET['page'] ?? 0;

//        $catalog = Product::getAll();
        $catalog = Product::getLimit(($page + 1) * 2);
        echo $this->render('product/catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    private function actionCard()
    {
        $id = $_GET['id'];
        $product = Product::getOne($id);

        echo $this->render('product/card', [
            'product' => $product
        ]);
    }

    public function render($template, $params = [])
    {
        return $this->renderTemplate('layouts/main', [
            'menu' => $this->renderTemplate('menu', $params),
            'content' => $this->renderTemplate($template, $params)
        ]);

    }

    /**
     * @param $template  - название шаблона страницы
     * @param $params  - ассоциативный массив с данными, которые нужно передать в шаблон. Имена ключей соответствуют
     * именам переменных, доступных в шаблоне
     * @return false|string
     */
    public function renderTemplate($template, $params = [])
    {
        //Сохраняем вывод скрипта в буфере
        ob_start();

        /*Импортируем данные из ассоциативного массива в переменные,
        имена которых соответствуют ключам элементов массива*/
        extract($params);

        //Собираем путь до файла с шаблоном страницы и подключаем его
        include VIEWS_DIR.$template.'.php';

        /*  Заканчиваем буферизацию вывода, возвращаем накопленное содержимое буфера вывода и очищаем буфер */
        return ob_get_clean();
    }
}