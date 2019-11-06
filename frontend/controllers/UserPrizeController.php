<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\base\Security;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Prize;
use common\models\UserPrize;

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
                        'actions' => ['process'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionProcess()
    {
        $model = new UserPrize();

        if (Yii::$app->request->post()){

              $available_prizes=Prize::find()->where(['>', 'quantity' , 0])->groupBy('prize_type')->orderBy(['rand()' => SORT_DESC])->limit(1)->one();


              if ($available_prizes) {
                  $prize_id= $available_prizes->prize_type==Prize::TYPE_PRODUCT ? Prize::find()->where(['>', 'quantity' , 0])->andWhere(['=', 'prize_type' , Prize::TYPE_PRODUCT])->orderBy(['rand()' => SORT_DESC])->limit(1)->one()->id : $available_prizes->id;
                  echo $available_prizes->prize_type;
                  echo $prize_id;
              }

              $model->user_id=Yii::$app->user->id;
              $model->prize_id=$prize_id;


            return $this->redirect(['show_prize', 'id' => $model->id]);
        }


        return $this->render('/site/index', [
            'model' => $model,
        ]);

    }
}
