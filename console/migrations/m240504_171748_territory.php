<?php

use yii\db\Migration;

/**
 * Class m240504_171748_territory
 */
class m240504_171748_territory extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('territory', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->comment('Наименование'),
            'district' => "ENUM('common', 'shop', 'service') NOT NULL",
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('territory');
    }
}
