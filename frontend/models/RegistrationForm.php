<?php

namespace frontend\models;

use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;
use Yii;

/**
 * Class RegistrationForm
 * @package frontend\models
 * private $name;
 * private $mobile;
 * private $email;
 * private $dob;
 * private $image;
 * private $password;
 */

class RegistrationForm extends ActiveRecord
{
     private $name;
     private $mobile;
     private $email;
     private $dob;
     private $image;
     private $password;

    public static function tableName()
    {
        return 'registration';
    }

    public function rules()
    {
        return [
            [['name', 'mobile', 'email', 'dob', 'image','password'], 'required'],
            ['email', 'email'],
            ['name', 'match', 'pattern' => '/^[a-zA-Z ]{2,30}$/', 'message'=>'only characters allowed and length between(3 to 30)'],
            ['image', 'file', 'skipOnEmpty' => false,'extensions'=>['jpg', 'jpeg', 'png'], 'mimeTypes'=>'image/jpg, image/jpeg, image/png'],
            ['mobile', 'match', 'pattern'=>'/^[0-9]{10}$/', 'message'=>'Mobile Number must be 10 digit.'],
            ['password', 'match', 'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', 'message' => 'password must be at least one lower and upper case character and a digit and 8 character.']
        ];
    }

    public function attributeLabels()
    {
        return [
            'mobile' => 'Mobile Number',
            'email' => 'Email Id',
            'dob' => 'Date Of Birth',
        ];
    }

//    public function uploads()
//    {
//        if($this->validate()){
//            $this->image->saveAs('uploads/images/'.$this->image->baseName.'.'.$this->image->extension);
//            return true;
//        }
//        return false;
//    }
//
//    public static function getDb()
//    {
//        try {
//            return Yii::$app->get('db2');
//        } catch (InvalidConfigException $e) {
//            return $e->getMessage();
//        }
//    }


}