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

//    public function actionRegistration()
//    {
//        $model = new RegistrationForm();
//        $formData = Yii::$app->request->post();
//
//        if($formData){
//            $rd = rand(0, 9999999);
//            $image = UploadedFile::getInstance($model, 'image');
//            $prefix = rand(0, 999999);
//            $imageName = $prefix . '_' . $image->name;
//            $data = $formData["RegistrationForm"];
//            $data["image"] = $imageName;
//
//            echo '<pre>';
//            print_r($data);
//            echo '</pre>';
//            $data = json_encode($data);
//
//            $url = 'http://localhost:8080/user/register';
//
//            $ch = curl_init($url);
//            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_HTTPHEADER,['Content-Type: application/json']);
//            $result = curl_exec($ch);
//            curl_close($ch);
//            $json_result = json_decode($result, true);
//            echo $json_result;
//
//        }
//
//        return $this->render('registration', ['model'=>$model, 'title'=>'Registration']);
//    }

    public function actionRegistration()
    {
        $model = new RegistrationForm();
        $formData = Yii::$app->request->post();

        /********** Using Raw Query *************/

            if($formData) {
                $rd = rand(0, 999999);
                $image = UploadedFile::getInstance($model, 'image');
                $prefix = rand(0, 999999);
                $imageName = $prefix . '_' . $image->name;
                $data = $formData["RegistrationForm"];
                $data["image"] = $imageName;

                $query = new Query('db');
                $insert = $query->insert('registration', $data);
                if ($insert) {
                    $query = new Query('db2');
                    $insert = $query->insert('registration', $data);
                    if ($insert) {
                        $image->saveAs('uploads/images/' . $imageName);
                        Yii::$app->session->setFlash('success', 'Registration <strong>Success!</strong>');
                        return $this->redirect(['/user/index']);
                    } else {
                        Yii::$app->session->setFlash('error', 'Registration in Second DB <strong>Failed!</strong>');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Registration <strong>Failed!</strong>');
                }
            }

        /********** Using Model ************
         * @param $id
         * @return string|\yii\web\Response
         */

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
        return $this->render('registration', ['model' => $model, 'title'=>'Registration']);
    }

    public function actionUpdate($id)
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

    public function actionView($id): string
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
//        $data = Yii::$app->db->createCommand("SELECT * FROM `registration`")->queryAll();
        $data = Yii::$app->db2->createCommand("SELECT * FROM `registration`")->queryAll();
        echo '<pre>';
        print_r($data);
        die;
        return $this->render('test');
    }

    public function actionDemo2()
    {
        // init model
        $model = new UploadCSV();

        // run if data is posted.
        if($model->load(Yii::$app->request->post())) {
            // init file instance
            $file = UploadedFile::getInstance($model, 'file');
            // upload csv file
            $file->saveAs('uploads/files/' . $file->name);
            // assign file name into model
            $model->file = $file->name;
            // Open uploaded file in read mode.
            $handle = fopen('uploads/files/' . $model->file, 'r');
            // set flag
            $query = 2;
            // remove headers from csv
            $headers = fgetcsv($handle, 10000, ",");
            // Loop until data receive from csv file.
            while (($fileop = fgetcsv($handle, 10000, ',')) !== false) {
                // assign data into variables.
                $user_id = $fileop[0];
                $name = $fileop[1];
                $address = $fileop[2];
                // sql query to get data as user_id.
                $sql = "SELECT * FROM `data` WHERE `user_id`='$user_id'";
                // execute query and get record.
                $record = Yii::$app->db->createCommand($sql)->queryOne();
                if(!$record) {
                    // if record not found then insert.
                    $sql = "INSERT INTO `data`(`user_id`,`name`, `address`) VALUES ('$user_id','$name','$address')";
                    $query = Yii::$app->db->createCommand($sql)->execute();
                } else {
                    // if record found and fields not matched then update values.
                    if($record['name'] !== $name or $record['address'] !== $address) {
                        $sql = "UPDATE `data` SET `name`='$name',`address`='$address' WHERE `user_id`='$user_id'";
                        $query = Yii::$app->db->createCommand($sql)->execute();
                    }
                }
            }
            // Set flash message.
            if (!$query) {
                Yii::$app->session->setFlash('error', 'File Uploading & Data Saving Failed!');
            } elseif($query == 2) {
                Yii::$app->session->setFlash('warning', 'Data Up To Date!!');
            } else {
                Yii::$app->session->setFlash('success', 'File Uploaded & Data Saved successfully!');
            }
            return $this->redirect('demo2');
        }
        return $this->render('demo2', ['model' => $model, 'title' => 'Upload CSV']);
    }

    public function actionExport()
    {
        $sql = "SELECT * FROM `data`";
        $records = Yii::$app->db->createCommand($sql)->queryAll();

        $data = [];
        foreach ($records as $record) {
            $data[] = [$record['user_id'], $record['name'],$record['address']];
        }
        $fp = fopen(Yii::getAlias('@root') . '/data.csv', 'w+');
        fputcsv($fp, ['user_id', 'name', 'address']);
        foreach ($data as $d) {
            fputcsv($fp, $d);
        }
        fclose($fp);
        Yii::$app->session->setFlash('success', 'Data exported as CSV!');
        return $this->redirect('demo2');
    }

    public function actionDownload()
    {
        $fileName = 'data.csv';
        $filePath = Yii::getAlias('@root') . '/'. $fileName;
        if(file_exists($filePath)) {
            header("Cache-Control: public");
            header('Content-Description: File Transfer');
            header("Content-Type: text/csv");
            header("Content-Disposition: attachment; filename=$fileName");
            header("Content-Transfer-Encoding: binary");
            readfile($filePath, true);
            exit;
        } else {
            Yii::$app->session->setFlash('error', 'File does not Exists! Sorry &#128539;');
        }
        return $this->redirect('demo2');
    }

    public function actionRemove()
    {
        $fileName = 'data.csv';
        $filePath = 'uploads/files/'.$fileName;
        if(!file_exists($filePath)){
            Yii::$app->session->setFlash('error', 'File not exists!');
            return $this->redirect('demo2');
        }
        $handle = fopen($filePath, 'r');
        $headers = fgetcsv($handle, 10000, ',');
        $query = false;
        while(($fp = fgetcsv($handle, 10000, ',')) !== false) {
           $user_id = $fp[0];
           $sql = "DELETE FROM `data` WHERE `user_id`='$user_id'";
           $query = Yii::$app->db->createCommand($sql)->execute();
        }
        unlink($filePath);
        if($query){
            Yii::$app->session->setFlash('success', 'Data and File deleted successfully!');
        } else {
            Yii::$app->session->setFlash('error', 'Something went wrong!');
        }
        return $this->redirect('demo2');
    }


    public function actionGridview()
    {
        return $this->render('gridview');
    }

}