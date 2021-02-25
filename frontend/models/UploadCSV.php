<?php

namespace frontend\models;


use yii\db\ActiveRecord;


class UploadCSV extends ActiveRecord
{

    public $file;

    public static function tableName(): string
    {
        return 'file';
    }

    public function rules(): array
    {
        return [
            ['file', 'file', 'skipOnEmpty' => false,'extensions'=>['csv']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'file'=>'Select CSV File',
        ];
    }

}