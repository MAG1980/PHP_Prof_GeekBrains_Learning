<?php

namespace app\controllers;

use app\engine\App;

class ProductController extends Controller
{
    public function actionIndex()
    {
        echo $this->render('index');
    }

    protected function actionCatalog()
    {
//        $page = $_GET['page'] ?? 0;
        $page = App::call()->request->getParams()['page'] ?? 0;;
//        $catalog = Product::getAll();
        $catalog = App::call()->productRepository->getLimit(($page + 1) * App::call()->config['product_per_page']);
        echo $this->render('product/catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    protected function actionCard()
    {
        $request = App::call()->request->getParams()['id'];
        //   $id = $_GET['id'];
        $id = $request->getParams()['id'];
//        $product = (new ProductRepository())->getWhere(['id' => $id]);
        $product = App::call()->productRepository->getWhere(['id' => $id]);

        echo $this->render('product/card', [
            'product' => $product
        ]);
    }
}