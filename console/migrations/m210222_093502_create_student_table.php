<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%student}}`.
 */
class m210222_093502_create_student_table extends Migration
{

    public function init(){
        $this->db = 'db';
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%student}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'course' => $this->string(20)->notNull(),
            'duration' => $this->integer(5)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%student}}');
    }
}
