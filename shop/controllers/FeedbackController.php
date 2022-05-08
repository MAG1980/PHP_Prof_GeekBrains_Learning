<?php

namespace app\controllers;

use app\engine\App;
use app\models\entities\Feedback;

class FeedbackController extends Controller
{
    protected function actionGet_all()
    {
//        $feedbacks = (new FeedbackRepository())->getAll();
        $feedbacks = App::call()->feedbackRepository->getAll();
        echo $this->render('feedback/all_feedbacks', [
            'feedbacks' => $feedbacks
        ]);
    }

    protected function actionEdit()
    {
//        $id = (new Request())->getParams()['id'];
        $id = App::call()->request->getParams()['id'];
//        $feedbacks = (new FeedbackRepository())->getAll();
        $feedbacks = App::call()->feedbackRepository->getAll();
//        $editable_feedback = (new FeedbackRepository())->getWhere(['id' => $id]);
        $editable_feedback = App::call()->feedbackRepository->getWhere(['id' => $id]);

        echo $this->render('feedback/all_feedbacks', [
            'editable_feedback' => $editable_feedback,
            'feedbacks' => $feedbacks
        ]);
    }

    protected function actionSave()
    {
//        $request = new Request();
        $request = App::call()->request;

        $id = $request->getParams()['id'];
        $name = $request->getParams()['name'];
        $text = $request->getParams()['text'];
        $id = $id ? (int) $id:null;

        if (!is_null($id)) {
//            $feedback = (new FeedbackRepository())->getWhere(['id' => $id]);
            $feedback = App::call()->feedbackRepository->getWhere(['id' => $id]);
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
            App::call()->feedbackRepository->save($feedback);
            header('Location:/feedback/get_all');
            die();
        }
    }

    protected function actionDelete()
    {
        $id = App::call()->request->getParams()['id'];
        $feedback = App::call()->feedbackRepository->getWhere(['id' => $id]);
        App::call()->feedbackRepository->delete($feedback);
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