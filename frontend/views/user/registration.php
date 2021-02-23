<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model frontend\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-contact">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>
            <hr>

            <?php $form = ActiveForm::begin(['action'=>['user/register'],'id' => 'registration-form', 'options'=>['enctype'=>'multipart/form-data']]); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'value'=>$model->name]) ?>
            <?= $form->field($model, 'mobile')->textInput(['value'=>$model->mobile]) ?>
            <?= $form->field($model, 'email')->textInput(['value'=>$model->email]) ?>

            <label for="dob">Date of Birth</label>
            <?php
                try {
//                    echo DatePicker::widget([
//                        'model' => $model,
//                        'attribute' => 'dob',
//                        'template' => '{input}{addon}',
//                        'clientOptions' => [
//                            'autoclose' => true,
//                            'format' => 'dd-mm-yyyy'
//                        ],
//                    ]);
                    echo  DatePicker::widget([
                        'name' => 'RegistrationForm[dob]',
                        'value' => $model->dob,
                        'id' => 'registrationform-dob',
                        'template' => '{input}{addon}',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-mm-yyyy'
                        ]
                    ]);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            ?>
            <br>
            <?= $form->field($model, 'image')->fileInput() ?>
            <?php if($model->name == '') : ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?php endif; ?>
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'registration-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<div class="row">
    <?php
        if(isset($data)) {

        }
    ?>

</div>