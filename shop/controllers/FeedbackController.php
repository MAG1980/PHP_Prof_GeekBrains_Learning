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
        echo $this->render('feedback/all_feedbacks', [
            'feedbacks' => $feedbacks
        ]);
    }

    function actionEdit()
    {
        $id = $_GET['id'];
        $feedbacks = Feedback::getAll();
        $editable_feedback = (array) Feedback::getOne($id);
        var_dump($editable_feedback);

        echo $this->render('feedback/all_feedbacks', [
            'editable_feedback' => $editable_feedback,
            'feedbacks' => $feedbacks
        ]);
    }

    function actionSave()
    {
        var_dump($_POST);
        $obj = new \stdClass();
        $id = $_GET['id'];
        $obj->id = $id ? (int) $id:null;
        $obj->name = $_POST['name'];
        $obj->text = $_POST['text'];
        $_POST = [];

        if ($obj->name === '' || $obj->text === '') {
            header('Location:/feedback/?status=error');
        } else {
            var_dump($obj);
            Feedback::save($obj);

//            executeSql("INSERT INTO feedback (name, text) VALUES ('{$name}', '{$feedback}')");
            header('Location:/?c=feedback&a=get_all');
            die();
        }


        $id = $_GET['id'];
        var_dump($this);
        Feedback::update($id);
        die('save');

        $name = secureRequestPrepare($_POST['name']);
        $text = secureRequestPrepare($_POST['text']);
        $id = secureRequestPrepare((int) $_GET['id']);
        $sql = "UPDATE feedback SET name = '{$name}', text = '{$text}' WHERE id = {$id}";
        executeSql($sql);
        header('Location: /feedback/?status=edit');

    }

    function actionDelete()
    {
        $id = $_GET['id'];
        var_dump('delete');
        Feedback::delete($id);
        header('Location:/?c=feedback&a=get_all');
        die();
//        $id = secureRequestPrepare((int) $_GET['id']);
//        $sql = "DELETE FROM feedback WHERE id = {$id}";
//        executeSql($sql);
//        header('Location:/feedback/?status=delete');
//        die();
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