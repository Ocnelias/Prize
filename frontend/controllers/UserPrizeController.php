<?php
namespace frontend\controllers;

use common\models\User;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\base\Security;
use yii\db\ActiveRecord;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Prize;
use common\models\UserPrize;
use common\models\Settings;
use yii\behaviors\TimestampBehavior;

/**
 * Site controller
 */
class UserPrizeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['process', 'show-prize-success', 'show-prize-error'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Process getting prize.
     *
     * @return mixed
     */
    public function actionProcess()
    {
        $model = new UserPrize();

        if (Yii::$app->request->post()){
               $check_user_prize=UserPrize::findOne(Yii::$app->user->id);

               if (!$check_user_prize) {

                   $available_prizes = Prize::find()->where(['>', 'quantity', 0])->groupBy('prize_type')->orderBy(['rand()' => SORT_DESC])->limit(1)->one();

                   if ($available_prizes) {
                       $prize_id = $available_prizes->prize_type == Prize::TYPE_PRODUCT ? Prize::find()->where(['>', 'quantity', 0])->andWhere(['=', 'prize_type', Prize::TYPE_PRODUCT])->orderBy(['rand()' => SORT_DESC])->limit(1)->one()->id : $available_prizes->id;

                       $model->user_id = Yii::$app->user->id;
                       $model->prize_id = $prize_id;
                       $model->status = UserPrize::STATUS_RECEIVED;
                       $model->quantity = UserPrize::getQuantity($available_prizes->prize_type);
                       $model->created_at = time();
                       $model->updated_at = time();

                          if($model->save() ) {

                              $prizes_quantity = Prize::findOne($prize_id);
                              $prizes_quantity->quantity=$prizes_quantity->quantity-$model->quantity;
                              $prizes_quantity->save();

                              Yii::$app->session->setFlash('success', "Your have won the prize!");
                              return $this->redirect(['show-prize-success', 'id' => $model->id]);
                          }

                   }
                   $error_message='There no available prizes for now';
               }

            $error_message='You have already received your prize';

            Yii::$app->session->setFlash('error', $error_message);
            return $this->redirect(['show-prize-error']);

        }


        return $this->render('/site/index', [
            'model' => $model,
        ]);

    }

    public function actionShowPrizeSuccess($id = null)
    {
        if ($id) {
            $user_prize=UserPrize::findOne($id);
        } else {
            $user_prize=UserPrize::find()->where(['user_id'=>Yii::$app->user->id])->one();
        }

        if (!$user_prize or  $user_prize->user_id != Yii::$app->user->id) {
            Yii::$app->session->setFlash('error', "Your have no prizes yet");
            return $this->redirect(['/site/index']);
        }

        return $this->render('show-prize-success', [
            'model'=>$user_prize
        ]);

    }

    public function actionShowPrizeError()
    {

        return $this->render('show-prize-error', [

        ]);

    }
}
