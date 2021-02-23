<?php

namespace console\components;

use yii\base\Component;
use Yii;
use yii\base\NotSupportedException;

class Check extends Component
{
    public static function isTableExists($table)
    {
        $schema = Yii::$app->getDb()->schema->getTableSchema($table);
        if ($schema !== null) {
           return true;
        }
        return false;
    }

    public static function isColumnExists($name, $table)
    {
        $columns = Yii::$app->getDb()->schema->getTableSchema($table)->getColumnNames();
        foreach($columns as $column) {
            if($table === $name) {
                return true;
            }
        }
        return false;
    }

    public static function isUniqueIndexExists($table)
    {
        try {
            $indexes = Yii::$app->getDb()->schema->findUniqueIndexes(Yii::$app->getDb()->getTableSchema($table));
            if($indexes !== null) {
                return true;
            }
        } catch (NotSupportedException $e) {
            echo $e;
        }
        return false;
    }

}

