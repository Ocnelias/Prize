<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%prizes}}`.
 */
class m191105_182839_create_prizes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%prizes}}', [
            'id' => $this->primaryKey(),
            'prize_name' => $this->string(255)->notNull(),
            'prize_type' => $this->integer()->notNull(),
            'quantity' => $this->integer(),
        ]);


        Yii::$app->db->createCommand()->batchInsert('{{%prizes}}', ['prize_name', 'prize_type', 'quantity'],
            [
                ['money', 1, 1000],
                ['bonus', 2, 1000000],
                ['product_1', 3, 1],
                ['product_2', 3, 10],
                ['product_3', 3, 20],
                ['product_4', 3, 30],
                ['product_5', 3, 50],
            ])->
        execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%prizes}}');
    }
}
