<?php

use app\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'id' => 'hz-form',
    'action' => Url::to(['order/set'])]);
?>
<div class="form-group">
    <?= $form->field($model, 'Order_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Contractor_id')->dropDownList(ArrayHelper::map(User::findByRole('contractor')->all(), 'ID', 'Fullname')) ?>
    <?= $form->field($model, 'change_reason')->textarea(['rows' => 2, 'cols' => 5]); ?>
    <button type="submit" id="save-data" class="btn btn-success"><?='Применить'?></button>
    <?= Html::a('Отмена', ['create'], ['href' => '#', 'class' => 'btn btn-denger', 'data-toggle'=>"modal", 'data-target'=>"#modal-window"]) ?>
</div>
<?php
    ActiveForm::end();
?>
