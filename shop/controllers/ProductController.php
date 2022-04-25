<?php

namespace app\controllers;

use app\models\Product;

class ProductController extends Controller
{
    protected function actionCatalog()
    {
        $page = $_GET['page'] ?? 0;

//        $catalog = Product::getAll();
        $catalog = Product::getLimit(($page + 1) * 2);
        echo $this->render('product/catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    protected function actionCard()
    {
        $id = $_GET['id'];
        $product = Product::getOne($id);

        echo $this->render('product/card', [
            'product' => $product
        ]);
    }

    /*    Этот метод инкапсулирован в класс, потому что он формирует содержимое шаблона конкретно данного класса.
        В отличие от него метод renderTemplate() не привязан к какому-либо классу.*/
    private function render($template, $params = [])
    {
        return $this->renderTemplate('layouts/main', [
            'menu' => $this->renderTemplate('menu', $params),
            'content' => $this->renderTemplate($template, $params)
        ]);

    }

    private function renderTemplate($template, $params = [])
    {
        return $this->render->renderTemplate($template, $params);
    }
}