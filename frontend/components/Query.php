<?php

namespace frontend\components;

use Yii;

class Query
{

    public $db;

    public function __construct($db =  null)
    {
        $this->db = $db;
    }

    public function insert($table = null, $values = null, $condition = null): bool
    {
        $sql = "INSERT INTO `$table`";

        $key = [];
        $value = [];

        if($values != null) {
            foreach ($values as $k=>$v){
                $key[] = $k;
                $value[] = $v;
            }
            $key = "`".implode("`,`", $key)."`";
            $value = "'".implode("','", $value)."'";

            $sql .= "($key) VALUES($value)";
        }

        if($condition != null) {
            $sql .= "WHERE ";
            $count = count($condition);
            $c = 1;
            foreach ($condition as $k=>$v) {
                if($c == $count){
                    $sql .= "$k=$v";
                } else {
                    $sql .= "$k=$v,";
                }
            }
        }
        $db = $this->db;
        return Yii::$app->$db->createCommand($sql)->execute();
    }

}