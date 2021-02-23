<?php 

namespace frontend\controllers;

use frontend\models\RegistrationForm;
use frontend\models\UploadCSV;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;
use frontend\components\Query;

class UserController extends Controller
{
    public function actionIndex()
    {
        $data = RegistrationForm::find()->all();
        if(!Yii::$app->cache->exists('data')) {
            $id = 'data';
            $time = 20;
            Yii::$app->cache->set($id, $data, $time);
        }
        return $this->render('index');
    }

    public function actionRegister()
    {
        $data = file_get_contents('php://input');
        echo '<pre>';
        print_r($data);
    }

    public function actionRegistration()
    {
        $model = new RegistrationForm();
        $formData = Yii::$app->request->post();

        if($formData){
            $rd = rand(0, 9999999);
            $image = UploadedFile::getInstance($model, 'image');
            $prefix = rand(0, 999999);
            $imageName = $prefix . '_' . $image->name;
            $data = $formData["RegistrationForm"];
            $data["image"] = $imageName;

            echo '<pre>';
            print_r($data);
            echo '</pre>';
            $data = json_encode($data);

            $url = 'http://localhost:8080/user/register';

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER,['Content-Type: application/json']);
            $result = curl_exec($ch);
            curl_close($ch);
            $json_result = json_decode($result, true);
            echo $json_result;
        }

        return $this->render('registration', ['model'=>$model, 'title'=>'Registration']);
    }

//    public function actionRegistration()
//    {
//        $model = new RegistrationForm();
//        $formData = Yii::$app->request->post();

        /********** Using Raw Query *************/

//            if($formData) {
//                $rd = rand(0, 999999);
//                $image = UploadedFile::getInstance($model, 'image');
//                $prefix = rand(0, 999999);
//                $imageName = $prefix . '_' . $image->name;
//                $data = $formData["RegistrationForm"];
//                $data["image"] = $imageName;
//
//                $query = new Query('db');
//                $insert = $query->insert('registration', $data);
//                if ($insert) {
//                    $query = new Query('db2');
//                    $insert = $query->insert('registration', $data);
//                    if ($insert) {
//                        $image->saveAs('uploads/images/' . $imageName);
//                        Yii::$app->session->setFlash('success', 'Registration <strong>Success!</strong>');
//                        return $this->redirect(['/user/index']);
//                    } else {
//                        Yii::$app->session->setFlash('error', 'Registration in Second DB <strong>Failed!</strong>');
//                    }
//                } else {
//                    Yii::$app->session->setFlash('error', 'Registration <strong>Failed!</strong>');
//                }
//            }

            /********** Using Model *************/

//        if ($model->load($formData)) {
//            $image = UploadedFile::getInstance($model, 'image');
//            $prefix = rand(0, 999999);
//            $imageName = $prefix.'_'.$image->name;
//            $image->saveAs('uploads/images/'.$imageName);
//            $model->image = $imageName;
//            if ($model->save(false)) {
//                Yii::$app->session->setFlash('success', 'Registration <strong>Success!</strong>');
//                return $this->redirect(['/user/index']);
//            } else {
//                Yii::$app->session->setFlash('error', 'Registration <strong>Failed!</strong>');
//            }
//        }
//
//        return $this->render('registration', ['model' => $model, 'title'=>'Registration']);
//    }

    public function actionEdit($id)
    {
        $model = RegistrationForm::findOne($id);
        $formData = Yii::$app->request->post();
        $rd = rand(0,999999);

        if ($model->load($formData)) {
            $image = UploadedFile::getInstance($model, 'image');
            $prefix = rand(0, 999999);
            $imageName = $prefix.'_'.$image->name;
            $image->saveAs('uploads/images/'.$imageName);
            $model->image = $imageName;
            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Registration <strong>Success!</strong>');
                return $this->redirect(['/user/index']);
            } else {
                Yii::$app->session->setFlash('error', 'Registration <strong>Failed!</strong>');
            }
        }
        return $this->render('registration', ['model'=>$model, 'title'=>'Update']);
    }

    public function actionView($id)
    {
        $record = RegistrationForm::findOne($id);
        return $this->render('view', ['record'=>$record]);
    }

    public function actionDelete($id)
    {
        $record = RegistrationForm::findOne($id);
        $imagePath = 'uploads/images/'.$record->image;
        if($record->delete()) {
            unlink($imagePath);
            Yii::$app->session->setFlash('success', 'Record successfully <strong>Deleted!</strong>');
        } else {
            Yii::$app->session->setFlash('error', 'Record <strong>Deletion Failed!</strong>');
        }
        return $this->redirect(['/user/index']);
    }

    public function actionDemo()
    {

        $model = new RegistrationForm;

        if(Yii::$app->cache->exists('demo')) {
            Yii::$app->cache->delete('data');
        }

        return $this->render('demo', ['model'=>$model]);

    }

    public function actionTest()
    {
        $data = Yii::$app->db->createCommand("SELECT * FROM `registration`")->queryAll();
        $data = Yii::$app->db2->createCommand("SELECT * FROM `registration`")->queryAll();
        echo '<pre>';
        var_dump($data);
        die;
        return $this->render('test');
    }

    public function actionDemo2()
    {
        $model = new UploadCSV();

        if (Yii::$app->request->isPost) {
            $model->csvFile = UploadedFile::getInstance($model, 'csvFile');
            if ($model->upload()) {
                // file is uploaded successfully
                Yii::$app->session->setFlash('success', 'CSV File Uploaded successfully!');
            } else {
                Yii::$app->session->setFlash('error', 'File Uploading failed!');
            }
        }
        return $this->render('demo2', ['model' => $model, 'title'=>'Upload CSV']);
    }
}