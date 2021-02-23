<?php

use yii\helpers\Html;
use yii\caching\Cache;

$this->title = 'Display';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">
    <div class="row">
        <div class="col-lg-8">

            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">

                    <h1 class="card-title"><?= $record->name; ?></h1>
                    <h4 class="card-body">
                        <div class="row">
                            <div class="col-lg-3">Mobile Number</div>
                            <div class="col-lg-6"> : <strong><?= $record->mobile; ?></strong></div>
                        </div>
                    </h4>
                    <h4 class="card-body">
                        <div class="row">
                            <div class="col-lg-3">Email Id</div>
                            <div class="col-lg-6"> : <strong><?= $record->email; ?></strong></div>
                        </div>
                    </h4>
                    <h4 class="card-body">
                        <div class="row">
                            <div class="col-lg-3">Date of Birth</div>
                            <div class="col-lg-6"> : <strong><?= $record->dob; ?></strong></div>
                        </div>
                    </h4>
                    <br>
                    <h4 class="card-body"> <?= Html::a('Back', 'index',['class'=>'btn btn-primary']); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <img src="<?= '/uploads/images/'.$record->image; ?>" alt="" width="70%">
        </div>
    </div>
</div>
