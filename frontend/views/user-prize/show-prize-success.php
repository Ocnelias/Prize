<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserPrize */

$this->params['breadcrumbs'][] = ['label' => 'User Prize', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="user-prize-view">

    <h1><?= Html::encode($this->title) ?></h1>

    You prize: <br>

    <h1>    <?=$model->quantity?>  <?=$model->prize->prize_name?> </h1>



</div>



