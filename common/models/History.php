<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property int $id
 * @property int $user_id
 * @property int $prize_id
 * @property string $action
 * @property int $created_at
 * @property int $updated_at
 */
class Histrory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'prize_id', 'created_at', 'updated_at'], 'integer'],
            [['action', 'created_at', 'updated_at'], 'required'],
            [['action'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'prize_id' => 'Prize ID',
            'action' => 'Action',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
