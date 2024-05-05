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
            'name' => $this->string(255)->notNull()->unique()->comment('Наименование'),
            'district' => "ENUM('central', 'southern', 'northwestern', 'far_eastern', 'siberian', 'ural', 'volga', 'north_caucasian') NOT NULL",
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
