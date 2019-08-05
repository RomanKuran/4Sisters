<?php

namespace app\models;

use Yii;

class Contacts extends \yii\db\ActiveRecord
{

    public function rules()
    {
        return [
            [['phone'], 'string', 'max' => 17],
            [['site_link'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 200],
            [['phone', 'site_link', 'address'], 'safe'],
            [['phone', 'site_link', 'address'], 'required'],
            [['phone'], 'number']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'IД',
            'phone' => 'Телефон',
            'site_link' => 'Ссылка',
            'address' => 'Адрес'
        ];
    }
}