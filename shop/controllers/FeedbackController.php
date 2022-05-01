<?php

namespace app\controllers;

use app\models\{Feedback};

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
        $feedback = new Feedback($id, $name, $text);

        if ($feedback->name === '' || $feedback->text === '') {
            header('Location:/feedback/?status=error');
        } else {
            $feedback->save();
            header('Location:/feedback/get_all');
            die();
        }
    }

    protected function actionDelete()
    {
        $id = $_GET['id'];
        $feedback = Feedback::getOne($id);
        $feedback->delete();
        header('Location:/feedback/get_all');
        die();
    }

//    function getFeedbackMessage()
//    {
//        $messages = [
//            'ok' => 'Сообщение добавлено',
//            'delete' => 'Сообщение удалено',
//            'edit' => 'Сообщение изменено',
//            'error' => 'Возникла ошибка!'
//        ];
//        return (isset($_GET['status'])) ? $messages [$_GET['status']]:'';
//    }
}