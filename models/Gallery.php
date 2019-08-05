<?php

namespace app\models;

use Yii;

class Gallery extends \yii\db\ActiveRecord
{
    public $image;

    public function rules()
    {
        return [
            [['id'], 'number', 'max' => 11],                        
            [['url_image'], 'string', 'max' => 200],            
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 300],
            [['id_category'], 'number', 'max' => 11],
            [['url', 'name', 'id_category', 'description'], 'safe'],
            [['url', 'name', 'id_category'], 'required'],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'url_image' => 'Адреса',
            'name' => 'Название',
            'description' => 'Описание',
            'id_category' => 'Категория',
            'image' => 'Изображение'
        ];
    }
}