<?php

namespace common\components;


use phpDocumentor\Reflection\Types\Boolean;
use yii\base\Component;

/**
 * fake mathod send money to user bank account
 *
 * Class BankAPI
 * @package app\components
 */
class MoneySender extends Component
{
    private $apiKey;

    /**
     *
     *
     * @param int|float $money
     * @param int $bank_account
     * @throws \Exception
     */
    public function sendMoney($money, $bank_account) : bool
    {
        if (!$bank_account) {
            throw new \Exception(\Yii::t('app', 'Set your bank account'));
        }

        if (!$money || ($money < 0)) {
            throw new \Exception(\Yii::t('app', 'Incorrect format'));
        }

        return false;
    }
}