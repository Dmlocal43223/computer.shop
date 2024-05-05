<?php

use yii\db\Migration;

/**
 * Class m240504_112214_manufacturer
 */
class m240504_112214_manufacturer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('manufacturer', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique()->comment('Наименование'),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('manufacturer');
    }
}
