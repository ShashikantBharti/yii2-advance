<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($this->title); ?></h1>

<div class="demo-site">
    <?php $form = ActiveForm::begin(['action'=>['user/register'],'id' => 'registration-form', 'options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Upload', ['class' => 'btn btn-primary', 'name' => 'registration-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
