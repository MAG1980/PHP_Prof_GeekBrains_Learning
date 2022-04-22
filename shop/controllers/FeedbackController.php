<?php

namespace app\controllers;

use app\models\Feedback;

class FeedbackController
{
    private $action;
    private $defaultAction = 'index';

    public function runAction($action)
    {
        //Если экшен не передан, то выполняем дефолтный
        $this->action = $action ? :$this->defaultAction;
        $method = 'action'.ucfirst($this->action);
        var_dump($method);
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

    function actionGet_all()
    {
        $feedbacks = Feedback::getAll();
        var_dump($feedbacks);
        // $catalog = Product::getLimit(($page + 1) * 2);
        echo $this->render('feedback/all_feedbacks', [
            'feedbacks' => $feedbacks
        ]);
    }

    function addFeedBack()
    {
        $name = secureRequestPrepare($_POST['name']);
        $feedback = secureRequestPrepare($_POST['text']);
        $_Post = [];

        if ($name === '' || $feedback === '') {
            header('Location:/feedback/?status=error');
        } else {
            executeSql("INSERT INTO feedback (name, text) VALUES ('{$name}', '{$feedback}')");
            header('Location:/feedback/?status=ok');
        }
    }

    function deleteFeedBack()
    {
        $id = secureRequestPrepare((int) $_GET['id']);
        $sql = "DELETE FROM feedback WHERE id = {$id}";
        executeSql($sql);
        header('Location:/feedback/?status=delete');
        die();
    }

    function getEditableFeedback($action)
    {
        if ($action == "edit") {
            $id = secureRequestPrepare((int) $_GET['id']);
            $sql = "SELECT * FROM feedback WHERE id = {$id}";
            return $editable_feedback = getOneResult($sql);
        } else {
            return null;
        }
    }

    function saveEditableFeedback()
    {
        $name = secureRequestPrepare($_POST['name']);
        $text = secureRequestPrepare($_POST['text']);
        $id = secureRequestPrepare((int) $_GET['id']);
        $sql = "UPDATE feedback SET name = '{$name}', text = '{$text}' WHERE id = {$id}";
        executeSql($sql);
        header('Location: /feedback/?status=edit');
    }

    function doFeedbackAction($action)
    {
        if ($action == "add") {
            addFeedBack();

        }
        if ($action == "delete") {
            deleteFeedBack();
        }

        if ($action == "save") {
            saveEditableFeedback();
            die();
        }
    }

    function getFeedbackMessage()
    {
        $messages = [
            'ok' => 'Сообщение добавлено',
            'delete' => 'Сообщение удалено',
            'edit' => 'Сообщение изменено',
            'error' => 'Возникла ошибка!'
        ];
        return (isset($_GET['status'])) ? $messages [$_GET['status']]:'';
    }

    public function render($template, $params = [])
    {
        return $this->renderTemplate('layouts/main', [
            'menu' => $this->renderTemplate('menu', $params),
            'content' => $this->renderTemplate($template, $params)
        ]);

    }

    public function renderTemplate($template, $params = [])
    {
        ob_start();
        extract($params);
        include VIEWS_DIR.$template.'.php';
        return ob_get_clean();
    }
}