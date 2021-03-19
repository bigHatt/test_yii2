<?php

use app\models\Contractor;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;

$this->title = "Заказ №$model->ID";
?>
<div class="order-index">

<h1><?= Html::encode($this->title) ?></h1>

<?= DetailView::widget([
'model' => $model,
'attributes' => [
    'customer.Fullname',
    'Work_list',
    'Date_from',
    'Date_to',
    'Price'
]
]) ?>

<?= GridView::widget([
    'id' => 'grid',
    'dataProvider' => $dataProvider,
    'columns' => [
        'contractor.Fullname',
        'Date',
        'change_reason'
    ]
]); ?>
</div>