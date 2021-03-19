<?php

namespace app\models;

use Yii;

class Order extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%Order}}';
    }

    public function rules()
    {
        return [
            [['Customer_id', 'Work_list', 'Date_from', 'Date_to', 'Price'], 'required'],
            [['ID', 'Customer_id'], 'integer'],
            ['Work_list', 'string'],
            [['Date_from', 'Date_to'], 'date', 'format' => 'yyyy-mm-d'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Customer_id' => 'Заказчик',
            'Work_list' => 'Работы',
            'Date_from' => 'С',
            'Date_to' => 'По',
            'Price' => 'Стоимость',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(User::class, ['ID' => 'Customer_id']);
    }

}
