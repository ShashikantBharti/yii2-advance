    <?php

    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
    use yii\helpers\Url;

    $this->title = $title;
    $this->params['breadcrumbs'][] = $this->title;

    ?>

    <h1><?= Html::encode($this->title); ?></h1>

    <div class="demo-site">
        <?php $form = ActiveForm::begin(['id'=>'upload-csv', 'options'=>['enctype'=>'multipart/form-data']]); ?>
        <?= $form->field($model, 'file')->fileInput(); ?>
        <div class="form-group">
            <?= Html::submitButton('Upload CSV', ['class' => 'btn btn-primary', 'name' => 'upload-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>

        <?= Html::a('Export CSV', Url::to('export'),['class'=>'btn btn-primary']); ?>
        <?= Html::a('Download CSV', Url::to('download'),['class'=>'btn btn-primary']); ?>
        <?= Html::a('Delete CSV', Url::to('remove'),['class'=>'btn btn-danger']); ?>



    </div>
