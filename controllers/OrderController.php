<?php

namespace app\controllers;

use app\models\Contractor;
use Yii;
use yii\web\Controller;
use app\models\Order;
use yii\data\ActiveDataProvider;


class OrderController extends Controller
{
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
     * @return string
     */
    public function actionIndex()
    {
        $orders = Order::find()->with('customer');
        $dataProvider = new ActiveDataProvider([
            'query' => $orders,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionSet()
    {
        $model = new Contractor();
        $model->load(Yii::$app->request->post());
        $prevContr = Contractor::find()->where(['Order_id' => $model->Order_id])->orderBy(['Date' => SORT_DESC])->one();
        if ($prevContr) {
            $prevContr->change_reason = empty($model->change_reason) ? null : $model->change_reason;
            $prevContr->save();
        }
        $model->Date = date("Y-m-d H:i:s");
        $model->change_reason = null;
        if ($model->save()) {
            return json_encode(['success'=> true, 'message' => 'Назначено']);
        } else {
            return json_encode(['success'=> false, 'message' => 'Ошибка при назначении']);
        }
    }

    public function actionView($id)
    {
        $model = Order::findOne($id);
        if ($model) {
            $contrs = Contractor::find()->with('contractor')->where(['Order_id' => $model->ID]);
            $dataProvider = new ActiveDataProvider([
                'query' => $contrs,
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);
            return $this->render('view', [
                'model' => $model,
                'dataProvider' => $dataProvider
            ]);
        }
    }

    public function actionCreate()
    {
        $model = new Order();
        $model->load(Yii::$app->request->post());
        //\yii\helpers\VarDumper::dump($model, 5, true); exit;
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
