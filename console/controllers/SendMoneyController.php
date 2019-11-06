<?php

namespace console\controllers;

use common\models\UserPrize;
use common\models\Prize;
use yii\console\Controller;
use yii\helpers\Console;

class SendMoneyController extends Controller
{
     const DEFAULT_NUMBER = 10;

    /**
     * send prizes to users who did not receive prize yet
     *
     * @throws \Exception
     */
    public function actionSend(): void
    {
        $prizes = UserPrize::find()->alias('user_prize')->JoinWith(['prize','user'])
            ->where([
                'user_prize.status' => UserPrize::STATUS_RECEIVED,
                'prize_type' => Prize::TYPE_MONEY,
            ])
            ->limit(self::DEFAULT_NUMBER)
            ->all();

        if ($prizes) {
            $this->stdout(\Yii::t('app', 'Sending {prizes} prize(s)...' . PHP_EOL,
                ['prizes' => count($prizes)]), Console::FG_GREEN);
        } else {
            $this->stdout(\Yii::t('app', 'Nothing to send!' . PHP_EOL), Console::FG_YELLOW);
        }

       foreach ($prizes as $prize) {

           $prize->status = UserPrize::STATUS_SENT;
           $prize->save(false);

            $this->stdout(\Yii::t('app', 'Sending {money} money to user {user}...', [
                'money' =>$prize->quantity,
                'user' => $prize->user->email
            ]));


            $this->stdout(\Yii::t('app', ' [SENT]' . PHP_EOL), Console::FG_GREEN);
        }
    }
}