<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property double $convert_money_coefficient
 * @property int $money_range_from
 * @property int $money_range_to
 * @property int $bonus_range_from
 * @property int $bonus_range_to
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['convert_money_coefficient'], 'number'],
            [['money_range_from', 'money_range_to', 'bonus_range_from', 'bonus_range_to'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'convert_money_coefficient' => 'Convert Money Coefficient',
            'money_range_from' => 'Money Range From',
            'money_range_to' => 'Money Range To',
            'bonus_range_from' => 'Bonus Range From',
            'bonus_range_to' => 'Bonus Range To',
        ];
    }
}
