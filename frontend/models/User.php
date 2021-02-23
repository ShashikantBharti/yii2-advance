<?php


namespace frontend\models;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{


    public static function getDb()
    {
        try {
            return Yii::$app->get('db2');
        } catch (InvalidConfigException $e) {
            return $e->getMessage();
        }
    }

}