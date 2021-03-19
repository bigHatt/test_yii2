<?php

namespace app\models;

use Yii;

class Role extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%Role}}';
    }

    public function rules()
    {
        return [
            [['Name', 'Title'], 'required'],
            [['ID', 'Name', 'Title'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Name' => 'Имя',
            'Title' => 'Название',
        ];
    }

}
