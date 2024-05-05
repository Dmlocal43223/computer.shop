<?php

use yii\db\Migration;

/**
 * Class m240504_172644_city
 */
class m240504_172644_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('city', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique()->comment('Наименование'),
            'territory_id' => $this->integer()->notNull()->comment('Территория'),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);

        $this->createIndex(
            'idx-city-territory_id',
            'city',
            'territory_id'
        );

        $this->addForeignKey(
            'fk-city-territory_id',
            'city',
            'territory_id',
            'territory',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-city-territory_id',
            'city'
        );

        $this->dropIndex(
            'idx-city-territory_id',
            'city'
        );

        $this->dropTable('city');
    }
}
