<?php
namespace frontend\modules\project;

class Project extends \yii\base\Module
{
    public function init()
    {
        $this->controllerNamespace = 'frontend\modules\project\controllers';
        parent::init();
    }
}