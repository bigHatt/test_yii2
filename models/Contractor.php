<?php

namespace app\models;

use Yii;

class Contractor extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%Contractor}}';
    }

    public function rules()
    {
        return [
            [['Order_id', 'Contractor_id', 'Date'], 'required'],
            [['ID', 'Order_id', 'Contractor_id'], 'integer'],
            ['change_reason', 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Order_id' => 'Заказ',
            'Contractor_id' => 'Исполнитель',
            'Date' => 'Дата',
            'change_reason' => 'Причина смены'
        ];
    }

    public function getOrder()
    {
        return $this->hasOne(Order::class, ['ID' => 'Order_id']);
    }

    public function getContractor()
    {
        return $this->hasOne(User::class, ['ID' => 'Contractor_id']);
    }
}
