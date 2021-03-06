<?php

namespace frontend\models;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class RegistrationFormSearch extends RegistrationForm
{

    public function rules()
    {
        return parent::rules(); // TODO: Change the autogenerated stub
    }

    public function search($params)
    {
        $query = RegistrationForm::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2
            ],
        ]);

        if(!($this->load($params))) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id'=>$this->id])
            ->andFilterWhere(['like','name', $this->name])
            ->andFilterWhere(['like','mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'dob', $this->dob]);

        return $dataProvider;

    }


}