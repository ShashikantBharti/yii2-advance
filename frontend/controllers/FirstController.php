<?php

namespace frontend\controllers;

use frontend\models\RegistrationFormSearch;
use yii\web\Controller;
use yii;
use yii\base\Event;

class FirstController extends Controller
{

    // Event Name
    const EVENT_SHOW_MESSAGE = 'ShowMessage';

    public function actionIndex(): string
    {
        $searchModel = new RegistrationFormSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    // Global Event.

    public function actionDemo()
    {
        $data = 'This is event message.';
        $this->on(self::EVENT_SHOW_MESSAGE, 'showMessage', $data);
        $this->trigger(self::EVENT_SHOW_MESSAGE);
        $this->off(self::EVENT_SHOW_MESSAGE);
    }

    // Anonymous Event.

    public function actionDemo2()
    {
        $data = 'This is demo - 2 message, ';
        $this->on(self::EVENT_SHOW_MESSAGE,
            function(Event $event){
                echo ucwords($event->data.'anonymous function.');
            }
            , $data);
        $this->trigger(self::EVENT_SHOW_MESSAGE);
        $this->off(self::EVENT_SHOW_MESSAGE);
    }

    // Controller Event.

    public function actionDemo3()
    {
        $data = 'This is demo - 3 message.';
        $this->on(self::EVENT_SHOW_MESSAGE, [$this, 'showMessage'], $data);
        $this->trigger(self::EVENT_SHOW_MESSAGE);
        $this->off(self::EVENT_SHOW_MESSAGE);
    }

    function showMessage(Event $event){
        echo ucwords($event->data);
        echo 'This is controller event.';
    }

    // Controller Event.

    public function actionDemo4()
    {
        $data = 'This is demo - 4 message.';
        $this->on(self::EVENT_SHOW_MESSAGE, [FirstController::className(), 'showMessage'], $data);
        $this->trigger(self::EVENT_SHOW_MESSAGE);
        $this->off(self::EVENT_SHOW_MESSAGE);
    }

    // Anonymous Event.

    public function actionDemo5()
    {
        $data = 'This is demo - 5 message, ';
        Event::on(self::className(),self::EVENT_SHOW_MESSAGE,
            function(Event $event){
                echo ucwords($event->data.'Class Name function.');
            }
            , $data);
        Event::trigger(self::className(),self::EVENT_SHOW_MESSAGE);
        Event::off(self::className(),self::EVENT_SHOW_MESSAGE);
    }

    // Global

    public function actionDemo6()
    {
        $data = 'This is event message.';
        Yii::$app->on(self::EVENT_SHOW_MESSAGE, 'showMessage', $data);
        Yii::$app->trigger(self::EVENT_SHOW_MESSAGE);
        Yii::$app->off(self::EVENT_SHOW_MESSAGE);
    }

}