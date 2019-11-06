<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_prizes}}`.
 */
class m191105_182913_create_user_prizes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_prizes}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'prize_id' => $this->integer(),
            'quantity' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('FK_user_id', '{{%user_prizes}}', 'user_id');
        $this->addForeignKey('FK_user_id', '{{%user_prizes}}', 'user_id', '{{%user}}', 'id', 'SET NULL', 'CASCADE');


        $this->createIndex('FK_prize_id', '{{%user_prizes}}', 'prize_id');
        $this->addForeignKey('FK_prize_id', '{{%user_prizes}}', 'prize_id', '{{%prizes}}', 'id', 'SET NULL', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_prizes}}');
    }
}
