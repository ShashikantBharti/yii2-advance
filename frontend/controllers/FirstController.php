<?php

namespace frontend\controllers;

use frontend\models\RegistrationFormSearch;
use yii\web\Controller;
use yii;

class FirstController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new RegistrationFormSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
}