<?php

namespace frontend\tests\components;

use common\models\Prize;
use common\models\Settings;
use common\models\UserPrize;
use Codeception\Test\Unit;

class MoneyTest extends Unit
{

    /**
     *
     * @throws \yii\base\InvalidConfigException
     * @throws \Exception
     */
    public function testConvertToBonus()
    {
        $money=UserPrize::find()->JoinWith('prize')
            ->andWhere(['prize_type'=>Prize::TYPE_MONEY])
            ->one();

        $convert_coefficient= Settings::find()->where(['key' =>'convert_money_coefficient'])->one()->value;


        $prize = \Yii::createObject(UserPrize::class);
        $this->assertEquals($prize->convertToBonus($money), $money * $convert_coefficient);
    }
}