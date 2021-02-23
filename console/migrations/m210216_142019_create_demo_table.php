<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%demo}}`.
 */
class m210216_142019_create_demo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%demo}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'course' => $this->string(),
            'address' => $this->text()
        ]);

        $this->renameTable( 
            'demo', 
            'students'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%students}}');
    }
}
