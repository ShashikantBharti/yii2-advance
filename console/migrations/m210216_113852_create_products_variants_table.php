<?php

use yii\db\Migration;
use console\components\Check;
/**
 * Handles the creation of table `{{%products_variants}}`.
 */
class m210216_113852_create_products_variants_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if(Check::isTableExists('products_variants')) {
            echo 'Table already exists!';
        } else {
            $this->createTable('{{%products_variants}}', [
                'id' => $this->bigInteger(),
                'product_id' => $this->bigInteger()->notNull(),
                'name' => $this->string()->notNull(),
                'price' => $this->money(),
                'inventory' => $this->integer(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->timeStamp(),
                'status' => $this->boolean(),
            ]);
        }



        $this->addPrimaryKey(
          'PK_prod_var',
          'products_variants',
          'id'
        );
        
        $this->addForeignKey(
            'FK_prod_var', 
            'products_variants', 
            'product_id', 
            'product', 
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropPrimaryKey('PK_prod_var', 'products_variants');
        $this->dropForeignKey('FK_prod_var', 'products_variants');
        $this->dropTable('{{%products_variants}}');
    }
}
