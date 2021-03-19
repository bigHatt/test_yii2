<?php

use app\models\Contractor;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title = 'Заказы';
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div id="orders-table">
        <?= GridView::widget([
            'id' => 'grid',
            'dataProvider' => $dataProvider,
            'rowOptions'=>function($model){
                if($model->Date_from < date("Y-m-d H:i:s")){
                    return ['class' => 'danger'];
                }
            },
            'columns' => [
                [
                    'attribute' => 'customer.Fullname',
                    'format' => 'html',
                    'content' => function ($model) {
                        return Html::a($model->customer->Fullname, Url::to(['order/view', 'id' => $model->ID]));
                    }
                ],
                'Work_list',
                'Date_from',
                'Date_to',
                'Price',
                [
                    'attribute' => 'contractor',
                    'label' => 'Исполнитель',
                    'format' => 'text',
                    'content' => function ($model) {
                        $contractor = Contractor::find()->where(['Order_id' => $model->ID])->orderBy(['Date' => SORT_DESC])->one();
                        return $contractor->contractor->Fullname ?? '';
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{add}',
                    'buttons' => [
                        'add' => function($url, $model, $key) {
                            return '<button href="#modal-window" type="button" class="modal-window btn btn-default" data-toggle="modal" modelId="'.$model->ID.'">Назначить</button>';
                        }
                    ]
                ]
            ],
        ]); ?>
    </div>
    <?php Modal::begin(['header' => '<h4 class="modal-title">Назначить</h4>', 'id' => 'modal-window', 'size'=>'modal-sm']); ?>
        <?= $this->render('modal', [
            'model' => new Contractor()
        ]) ?>
    <?php Modal::end(); ?>
</div>

<script>
$('.modal-window').on('click', function(e) {
    $('#contractor-order_id').attr('value', $(this).attr('modelId'))
})
$('#save-data').on('click', function(e) {
    e.preventDefault()
    $.ajax({
        url: $("#hz-form").attr('action'),
        type: "POST",
        dataType: "json",
        data: $("#hz-form").serialize(),
        success: function(response) {
            console.log(window.location.href) 
            if (response.success) {
                $('#orders-table').load(window.location.href + ' #orders-table');
            } else {
                alert(response.message)
            }   	
    	},
    	error: function(response) {
            alert('Ошибка при отправке запроса')
    	}
 	});
    $('#modal-window').modal('toggle')
});
</script>