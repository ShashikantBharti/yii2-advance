<?php


namespace frontend\models;

use yii\base\Model;

class UploadCSV extends model
{
    private $file;

    public function rules()
    {
        return [
            [['csvFile'], 'file', 'skipOnEmpty'=>false, 'extension'=>'csv'],
        ];
    }

    public function upload()
    {
        if($this->validate()) {
            $rd = rand(0, 9999999);
            $this->file->saveAs('uploads/file/'.$rd.$this->file->baseName.'.'.$this->file->extension);
            return true;
        } else {
            return false;
        }
    }
}