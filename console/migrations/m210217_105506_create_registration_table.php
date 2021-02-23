<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%registration}}`.
 */
class m210217_105506_create_registration_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%registration}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'mobile' => $this->string(15)->notNull(),
            'dob' => $this->string(20),
            'image' => $this->text(),
            'password' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%registration}}');
    }
}
