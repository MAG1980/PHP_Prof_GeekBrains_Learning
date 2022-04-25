<?php

namespace app\controllers;

use app\models\Feedback;

class FeedbackController extends Controller
{
    protected function actionGet_all()
    {
        $feedbacks = Feedback::getAll();
        echo $this->render('feedback/all_feedbacks', [
            'feedbacks' => $feedbacks
        ]);
    }

    protected function actionEdit()
    {
        $id = $_GET['id'];
        $feedbacks = Feedback::getAll();
        $editable_feedback = (array) Feedback::getOne($id);

        echo $this->render('feedback/all_feedbacks', [
            'editable_feedback' => $editable_feedback,
            'feedbacks' => $feedbacks
        ]);
    }

    protected function actionSave()
    {
        $id = $_GET['id'];
        $id = $id ? (int) $id:null;
        $name = $_POST['name'];
        $text = $_POST['text'];
        $_POST = [];
        $obj = new Feedback($id, $name, $text);
        var_dump($obj);

        if ($obj->name === '' || $obj->text === '') {
            header('Location:/feedback/?status=error');
        } else {
            Feedback::save();
            header('Location:/?c=feedback&a=get_all');
            die();
        }
    }

    protected function actionDelete()
    {
        $id = $_GET['id'];
        Feedback::delete($id);
        header('Location:/?c=feedback&a=get_all');
        die();
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