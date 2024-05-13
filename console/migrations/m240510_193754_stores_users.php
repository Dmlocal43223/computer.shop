<?php

use yii\db\Migration;

/**
 * Class m240510_193754_stores_users
 */
class m240510_193754_stores_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('stores_users', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('Пользователь'),
            'store_id' => $this->integer()->notNull()->comment('Склад'),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);

        $this->createIndex(
            'idx-stores_users-user_id',
            'stores_users',
            'user_id'
        );

        $this->addForeignKey(
            'fk-stores_users-user_id',
            'stores_users',
            'user_id',
            'user',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->createIndex(
            'idx-stores_users-store_id',
            'stores_users',
            'store_id'
        );

        $this->addForeignKey(
            'fk-stores_users-store_id',
            'stores_users',
            'store_id',
            'store',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->createIndex(
            'idx-unique-user-store',
            'stores_users',
            ['user_id', 'store_id'],
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-stores_users-user_id',
            'stores_users'
        );

        $this->dropIndex(
            'idx-stores_users-user_id',
            'stores_users'
        );

        $this->dropForeignKey(
            'fk-stores_users-store_id',
            'stores_users'
        );

        $this->dropIndex(
            'idx-stores_users-store_id',
            'stores_users'
        );

        $this->dropIndex(
            'idx-unique-user-store',
            'stores_users'
        );

        $this->dropTable('stores_users');
    }
}
