<?php

namespace app\controllers;

class IndexController extends Controller
{

    /**    Дефолтный экшен
     *  Вывод на страницу результата работы собственного метода render(), который вызывает собственный метод renderTemplate().
     * renderTemplate() возвращает результат работы метода, хранящегося в поле renderTemplate, значение которого
     * получено из конструктора родительского класса Controller, который вызывается в файле index.php и принимает
     * параметром класс, экземпляр которого будет храниться в поле renderTemplate.
     */
    protected function actionIndex()
    {
        echo $this->render('index');
    }

    private function render($template, $params = [])
    {
        return $this->renderTemplate('layouts/main', [
            'menu' => $this->renderTemplate('menu', $params),
            'content' => $this->renderTemplate($template, $params)
        ]);

    }

    private function renderTemplate($template, $params = [])
    {
        /*  В данном случае писать $params = [] нельзя, т.к. проиcходит не объявление, а вызов метода. Это приведёт к
        тому, что значением параметра $params всегда будет пустой массив.
      . Здесь мы не указываем дефолтные значения, а передаём конкретные*/
        
        return $this->render->renderTemplate($template, $params);;
    }
}