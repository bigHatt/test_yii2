<?php

namespace app\models;

use Yii;

class User extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%User}}';
    }

    public function rules()
    {
        return [
            [['Fullname', 'Role_id'], 'required'],
            [['ID', 'Role_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Fullname' => 'ФИО',
            'Role_id' => 'Роль',
        ];
    }

    public function getRole()
    {
        return $this->hasOne(Role::class, ['ID' => 'Role_id']);
    }

    public static function findByRole($role)
    {
        $query = User::find()
            ->joinWith(['role role'])
            ->andWhere(['role.name' => $role]);
        return $query;
    }
}
