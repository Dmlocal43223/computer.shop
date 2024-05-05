<?php

use yii\db\Migration;

/**
 * Class m240504_180616_store
 */
class m240504_180616_store extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('store', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique()->comment('Наименование'),
            'type' => "ENUM('common', 'shop', 'service', 'decommission') NOT NULL",
            'is_deleted' => $this->boolean()->notNull()->defaultValue(false),
            'territory_id' => $this->integer()->notNull()->comment('Территория'),
            'city_id' => $this->integer()->notNull()->comment('Город'),
            'address' => $this->string(255)->notNull()->comment('Адрес'),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);

        $this->createIndex(
            'idx-store-territory_id',
            'store',
            'territory_id'
        );

        $this->addForeignKey(
            'fk-store-territory_id',
            'store',
            'territory_id',
            'territory',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->createIndex(
            'idx-store-city_id',
            'store',
            'city_id'
        );

        $this->addForeignKey(
            'fk-store-city_id',
            'store',
            'city_id',
            'city',
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
            'fk-store-territory_id',
            'store'
        );

        $this->dropIndex(
            'idx-store-territory_id',
            'store'
        );

        $this->dropForeignKey(
            'fk-store-city_id',
            'store'
        );

        $this->dropIndex(
            'idx-store-city_id',
            'store'
        );

        $this->dropTable('store');
    }
}
