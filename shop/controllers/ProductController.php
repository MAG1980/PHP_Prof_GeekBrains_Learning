<?php

namespace app\controllers;

use app\models\{Product};

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
}