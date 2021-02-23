<?php

use yii\db\Migration;
use console\components\Check;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m210216_110133_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        if(Check::isTableExists('product')) {
            echo 'Table already exists!';
        } else {
            $this->createTable('{{%product}}', [
                'id' => $this->bigInteger(),
                'name' => $this->string()->notNull(),
                'product-handle' => $this->string()->unique(),
                'images' => $this->text(),
                'price' => $this->money(),
                'inventory' => $this->integer(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->timeStamp(),
                'status' => $this->boolean()
            ]);
        }

        $this->addPrimaryKey(
            'PK_prod',
            'product',
            'id'
        );

        if(Check::isColumnExists('email', 'product')){
            echo 'Column already exists!';
        } else {
            $this->addColumn(
                'product',
                'email',
                $this->string(25)
            );
        }

        if(Check::isUniqueIndexExists('product')){
            echo 'Unique Index already exists!';
        }else {
            $this->createIndex(
                'Idx_prod',
                'product',
                'name',
                'true'
            );
        }


        $this->renameColumn(
            'product', 
            'email', 
            'email_id'
        );

        $this->alterColumn(
            'product', 
            'name', 
            $this->string(200)->notNull()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('Idx_prod', 'product');
        $this->dropColumn('product', 'email_id');
        $this->dropPrimaryKey('PK_prod', 'product');
        $this->dropTable('{{%product}}');
    }
}
