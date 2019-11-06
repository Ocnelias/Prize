<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserPrize */
/* @var $form ActiveForm */

$this->title = 'Get your prize';
?>
<div class="site-index">

    <div class="jumbotron">

        <p class="lead">Press the button to get your random prize</p>
        <div class="prize">

            <?php $form = ActiveForm::begin(['action' => ['user-prize/process'], 'options' => ['method' => 'POST']]); ?>

            <div class="form-group">
                <?= Html::submitButton('Get your prize', ['class' => 'btn btn-lg btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>


    </div>


</div>
