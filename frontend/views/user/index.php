<?php

use yii\helpers\Html;

$this->title = "All Users";
$this->params['breadcrumbs'][] = $this->title;

$records = Yii::$app->cache->get('data');
?>

<div class="site-users">
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if( count($records) > 0) : ?>
                        <?php $sr = 1; ?>
                       <?php foreach ($records as $record) : ?>
                            <tr>
                                <td><?= $sr++; ?></td>
                                <td><?= $record->name; ?></td>
                                <td><?= $record->mobile; ?></td>
                                <td><?= $record->email; ?></td>
                                <td><?= $record->dob; ?></td>
                                <td>
                                    <img src="<?= '/uploads/images/'.$record->image; ?>" alt="" height="50px">
                                </td>
                                <td>
                                    <?= Html::a('View', ['view', 'id'=>$record->id],['class'=>'btn btn-sm btn-info']); ?>
                                    <?= Html::a('Edit', ['update', 'id'=>$record->id],['class'=>'btn btn-sm btn-primary']); ?>
                                    <?= Html::a('Delete', ['delete', 'id' => $record->id],['class'=>'btn btn-sm btn-danger']); ?>
                                </td>
                            </tr>
                       <?php endforeach;  ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6"><h4>No Record Found!</h4></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

