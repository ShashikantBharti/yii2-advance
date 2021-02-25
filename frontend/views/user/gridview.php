<?php

use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use frontend\models\RegistrationForm;

$this->title = "Grid View";
$this->params['breadcrumbs'][] = $this->title;

?>
<h1><?= Html::encode($this->title); ?></h1>

<div class="grid-view">
    <?php

    $dataProvider = new ActiveDataProvider([
        'query' => RegistrationForm::find(),
        'pagination' => [
            'pageSize' => 2
        ],
    ]);

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class'=> 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'format' => 'integer'
            ],
            [
                'attribute' => 'name',
                'format' => 'text'
            ],
            [
                'attribute' => 'mobile',
                'format' => 'text'
            ],
            [
                'attribute' => 'email',
                'format' => 'email'
            ],
            [
                'attribute' => 'dob',
                'format' => ['date', 'php:d-M-Y']
            ],
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function($data) {
                    $url = Yii::getAlias('@images').'/'.$data->image;
                    return Html::img($url, ['alt' => 'Image', 'height'=>'50px']);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],

        ],
    ]);
    ?>
</div>


