<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
?>

<div class="reference-search">

    <?php $form = ActiveForm::begin([
        'action' => Url::to(['order/create']),
    ]); ?>

    <?= $form->field($model, 'Customer_id')->dropDownList(ArrayHelper::map(User::findByRole('customer')->all(), 'ID', 'Fullname')) ?>
    
    <?= $form->field($model, 'Work_list')->textarea(['rows' => 2, 'cols' => 5]); ?>

    <?= $form->field($model, 'Date_from')->widget(DatePicker::class, ['clientOptions' => ['format' => 'yyyy-mm-d'],]) ?>

    <?= $form->field($model, 'Date_to')->widget(DatePicker::class, ['clientOptions' => ['format' => 'yyyy-mm-d'],]) ?>

    <?= $form->field($model, 'Price')->textInput(['type' => 'number']); ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

