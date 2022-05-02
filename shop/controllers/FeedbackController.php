<?php

namespace app\controllers;

use app\engine\Request;
use app\models\entities\Feedback;
use app\models\repositories\FeedbackRepository;

class FeedbackController extends Controller
{
    protected function actionGet_all()
    {
        $feedbacks = (new FeedbackRepository())->getAll();
        echo $this->render('feedback/all_feedbacks', [
            'feedbacks' => $feedbacks
        ]);
    }

    protected function actionEdit()
    {
        $id = (new Request())->getParams()['id'];
        $feedbacks = (new FeedbackRepository())->getAll();
        $editable_feedback = (new FeedbackRepository())->getWhere('id', $id);

        echo $this->render('feedback/all_feedbacks', [
            'editable_feedback' => $editable_feedback,
            'feedbacks' => $feedbacks
        ]);
    }

    protected function actionSave()
    {
        $request = new Request();
        var_dump($request);

        $id = $request->getParams()['id'];
        $name = $request->getParams()['name'];
        $text = $request->getParams()['text'];
        $id = $id ? (int) $id:null;

        if (!is_null($id)) {
            $feedback = (new FeedbackRepository())->getWhere('id', $id);
            $feedback->__set('name', $name);
            $feedback->__set('text', $text);
        } else {
            $feedback = new Feedback($name, $text);
        }

        $_POST = [];

// TODO Создать страницы с сообщениями об ошибках
        if ($feedback->name === '' || $feedback->text === '') {
            header('Location:/feedback/?status=error');
        } else {
            (new FeedbackRepository())->save($feedback);
            header('Location:/feedback/get_all');
            die();
        }
    }

    protected function actionDelete()
    {
        $id = (new Request())->getParams()['id'];
        $feedback = (new FeedbackRepository())->getWhere('id', $id);
        (new FeedbackRepository())->delete($feedback);
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