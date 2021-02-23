<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%registration}}`.
 */
class m210217_130151_add_email_column_to_registration_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%registration}}', 'email', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%registration}}', 'email');
    }
}
