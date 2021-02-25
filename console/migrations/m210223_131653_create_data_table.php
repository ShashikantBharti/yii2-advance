<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%data}}`.
 */
class m210223_131653_create_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%data}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->primaryKey(),
            'name' => $this->string(),
            'address' => $this->string(),
        ]);

        $this->createIndex(
            'Idx_user_id',
            '{{%data}}',
            'user_id',
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('Idx_user_id', '{{%data}}');
        $this->dropTable('{{%data}}');
    }
}
