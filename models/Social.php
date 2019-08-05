<?php

namespace app\models;

use Yii;

class Social extends \yii\db\ActiveRecord
{

    public function rules()
    {
        return [
            [['instagram'], 'string', 'max' => 200],
            [['facebook'], 'string', 'max' => 200],
            [['twitter'], 'string', 'max' => 200],
            [['viber'], 'string', 'max' => 200],
            [['instagram', 'facebook', 'twitter', 'viber'], 'safe'],
            [['instagram', 'facebook', 'twitter', 'viber'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'instagram' => 'Instagram',
            'facebook'  => 'Facebook',
            'twitter'   => 'Twitter',
            'viber'     => 'Viber',
        ];
    }
}