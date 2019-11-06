<?php

use common\models\Prize;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\models\UserPrize;

/* @var $this yii\web\View */
/* @var $model common\models\UserPrize */

$this->params['breadcrumbs'][] = ['label' => 'User Prize', 'url' => ['index']];
\yii\web\YiiAsset::register($this);


$typeAction = Url::toRoute(['user-prize/send-prize', 'actionType' => $model->prize->prize_type]);
$refuseUrl= Url::toRoute(['user-prize/refuse-prize']);
$convertMoneyUrl = Url::toRoute(['user-prize/convert-user-money']);

?>
<div class="user-prize-view">

    <h1><?= Html::encode($this->title) ?></h1>

    You prize: <br>

    <h1>    <?=$model->quantity?>  <?=$model->prize->prize_name?> </h1>

    Status:
    <br> <?=UserPrize::readableTypes()[$model->status]?>

    <?php if ($model->prize->prize_type==Prize::TYPE_MONEY) { ?>

        <br> <a href="<?=$convertMoneyUrl?>" class=''> Convert to bonus </a> <br>

    <?php } ?>
    <br>  <br>


    <?php if ($model->status==UserPrize::STATUS_RECEIVED) { ?>

     <p> Actions: </p>
        <a href="<?=$typeAction?>" class='btn btn-primary'> <?=UserPrize::PrizesActions($model->prize->prize_type) ?> </a> <br>

    <a class='btn btn-default'> refuse a prize </a>

    <?php } ?>

</div>



