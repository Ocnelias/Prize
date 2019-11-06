<?php

namespace common\models;

use app\models\Setting;
use Yii;

/**
 * This is the model class for table "user_prizes".
 *
 * @property int $id
 * @property int $user_id
 * @property int $prize_id
 * @property int $quantity
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Prize $prize
 * @property User $user
 */
class UserPrize extends \yii\db\ActiveRecord
{

    const STATUS_RECEIVED = 0;
    const STATUS_PROCESSING= 1;
    const STATUS_SENT= 2;
    const STATUS_REFUSED= 3;
    const STATUS_CHANGED= 4;

    const ACTION_BANK = 1;
    const ACTION_BONUS = 2;
    const ACTION_SEND = 3;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_prizes';
    }

    public static function readableTypes()
    {
        $list = [
            self::STATUS_RECEIVED => 'Received',
            self::STATUS_PROCESSING => 'Processing',
            self::STATUS_SENT => 'Sent',
            self::STATUS_REFUSED => 'Refused',
            self::STATUS_CHANGED => 'Changed to bonus',
        ];
        return $list;
    }

    public static function readableActions()
    {
        $list = [
            self::ACTION_BANK => 'Send money to bank account',
            self::ACTION_BONUS => 'Send your prize to bonus account',
            self::ACTION_SEND => 'Send your prize by post',

        ];
        return $list;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'prize_id', 'quantity', 'status', 'created_at', 'updated_at'], 'integer'],
            [['quantity', 'created_at', 'updated_at'], 'required'],
            [['prize_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prize::className(), 'targetAttribute' => ['prize_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'quantity' => 'Quantity',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrize()
    {
        return $this->hasOne(Prize::className(), ['id' => 'prize_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getQuantity($type)
    {

        switch ($type) {
            case Prize::TYPE_MONEY:
                $quantity=mt_rand(Settings::find()->where(['key' =>'money_range_from'])->one()->value, Settings::find()->where(['key' =>'money_range_to'])->one()->value);
                break;
            case Prize::TYPE_BONUS:
                $quantity=mt_rand(Settings::find()->where(['key' =>'bonus_range_from'])->one()->value, Settings::find()->where(['key' =>'bonus_range_to'])->one()->value);
                break;
            case Prize::TYPE_PRODUCT:
                $quantity=1;
                break;
            default:
                $quantity=1;
        }

        return $quantity;
    }

    public static function PrizesActions($type)
    {

        switch ($type) {
            case Prize::TYPE_MONEY:
                $action=self::readableActions()[self::ACTION_BANK];
                break;
            case Prize::TYPE_BONUS:
                $action=self::readableActions()[self::ACTION_BONUS];
                break;
            case Prize::TYPE_PRODUCT:
                $action=self::readableActions()[self::ACTION_SEND];
                break;
            default:
                $action=self::readableActions()[self::ACTION_BANK];
        }

        return $action;
    }

    public static function convertToBonus($money)
    {
        $convert_coefficient= Settings::find()->where(['key' =>'convert_money_coefficient'])->one()->value;

        return $money * $convert_coefficient;
    }

}
