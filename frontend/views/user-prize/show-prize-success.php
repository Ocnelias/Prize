<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UserPrize;

/* @var $this yii\web\View */
/* @var $model common\models\UserPrize */

$this->params['breadcrumbs'][] = ['label' => 'User Prize', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="user-prize-view">

    <h1><?= Html::encode($this->title) ?></h1>

    You prize: <br>

    <h1>    <?=$model->quantity?>  <?=$model->prize->prize_name?> </h1>

    Status:
    <br> <a class='btn btn-primary'> <?=UserPrize::readableTypes()[$model->status]?> </a> <br>  <br>


    Actions:
    <br> <a class='btn btn-primary'> <?=UserPrize::PrizesActions($model->prize->prize_type) ?> </a> <br>

    <a class='btn btn-default'> refuse a prize </a>

</div>



