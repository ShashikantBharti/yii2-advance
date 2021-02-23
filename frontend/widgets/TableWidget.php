<?php

namespace frontend\widgets;

use frontend\assets\AppAsset;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;


class TableWidget extends Widget
{

    public $className;
    public $model;

    public function run()
    {

//        $view = $this->getView();
//        AppAsset::register($view);
//        $view->registerCssFile(Yii::$app->request->baseUrl.'/css/custom.css',['position' =>3]);

        $columns = $this->model::getTableSchema()->getColumnNames();
        $records = $this->model::find()->all();
        $html = '<table class="'.$this->className.'"><thead><tr>';

        foreach ($columns as $column) {
            if($column !== 'password') {
                $html .= "<th>$column</th>";
            }
        }

        $html .= "<th>Actions</th>";
        $html .= "</tr></thead><tbody>";

        $images = Yii::getAlias('@images');

        $sr = 1;
        foreach ($records as $record) {
            foreach ($columns as $column) {
                $html .= "<tr>";
                $html .= "<td>$sr</td>";
                $html .= "<td>$record->name</td>";
                $html .= "<td>$record->mobile</td>";
                $html .= "<td>$record->dob</td>";
//                $html .= "<td><img src='/uploads/images/$record->image' alt='' height='50px'></td>";
                $html .= "<td><img src='$images/$record->image' alt='' height='50px'></td>";
                $html .= "<td>$record->email</td>";
                $html .= "<td>";
                $html .= Html::a('View', ['view', 'id'=>$record->id],['class'=>'btn btn-sm btn-info']);
                $html .= '&nbsp;'.Html::a('Edit', ['edit', 'id'=>$record->id],['class'=>'btn btn-sm btn-primary']).'&nbsp;';
                $html .= Html::a('Delete', ['delete', 'id' => $record->id],['class'=>'btn btn-sm btn-danger']);
                $html .= "</td>";
                $html .= "</tr>";
                break;
            }
            $sr = $sr+1;
        }

        $html .= "</tbody></table>";

        return $html;
    }
}