<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pet_category`.
 */
class m180606_130956_create_pet_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pet_category', [
            'pet_cat_id' => $this->primaryKey(),
            'category_name' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->Null(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pet_category');
    }
}
