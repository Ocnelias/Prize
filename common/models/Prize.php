<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "prizes".
 *
 * @property int $id
 * @property string $prize_name
 * @property int $prize_type
 * @property int $quantity
 *
 * @property UserPrize[] $userPrizes
 */
class Prize extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prizes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prize_name', 'prize_type'], 'required'],
            [['prize_type', 'quantity'], 'integer'],
            [['prize_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prize_name' => 'Prize Name',
            'prize_type' => 'Prize Type',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPrizes()
    {
        return $this->hasMany(UserPrize::className(), ['prize_id' => 'id']);
    }
}
