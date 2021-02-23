<?php

use frontend\widgets\TableWidget;
use yii\helpers\Html;

$this->title = "Demo";
$this->params['breadcrumbs'][] = $this->title;

//  $this->registerCssFile(Yii::$app->request->baseUrl.'assets/css/custom.css', ['position'=>'\yii\web\View::POS_END']);
//  $this->registerJsFile(Yii::$app->request->baseUrl.'/assets/css/custom.js');

//  $this->registerCss('body {color: red;}');
//  $this->registerJs('alert("Hello World");');


?>

<div class="site-users">
    <div class="container">
          <?= TableWidget::widget(['className'=>'table','model'=>$model]); ?>
    </div>
    <div class="container">
        <?= \frontend\widgets\HelloWidget::widget([]); ?>
        <?= \frontend\widgets\SimpleWidget::widget([]); ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">

               <?= \frontend\widgets\FormWidget::widget(['heading'=>'Login Here', 'action'=>'loginForm', 'labels'=>['Email or Phone', 'User Password']]); ?>

            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
    <?php

//        echo Yii::getAlias('@app');
//        echo Yii::getAlias('@vendor');
//        echo Yii::getAlias('@runtime');
//        echo Yii::getAlias('@web');
//        echo Yii::getAlias('@webroot');
//        echo Yii::getAlias('@common');
//        echo Yii::getAlias('@frontend');
//        echo Yii::getAlias('@backend');
//        echo Yii::getAlias('@console');
//        echo Yii::getAlias('@yii');
//        echo Yii::getAlias('@images');

    echo Html::a('Refresh', 'demo', ['class' => 'btn btn-primary']);
    echo '<hr>';
    echo '<pre>';
    if($data = Yii::$app->cache->get('data')){
        var_dump($data);
    } else {
        echo '<h4>Cache Cleared</h4>';
    }

    $data = Yii::$app->cache->delete('data');

    ?>
    <br><br>
</div>
