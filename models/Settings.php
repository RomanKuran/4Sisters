<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;


/**
 * This is the model class for table "settings"
 *
 * @property int $id
 * @property string $description
 * @property string $keywords
 * @property string $url_image
 * @property string $name_image
 * @property string $name
 *
 **/

class Settings extends ActiveRecord
{
    public $image;

    public static function tableName() {
        return 'settings';
    }

    public function rules()
    {
        return [
            [['description', 'keywords', 'name'], 'required'],
            [['description'], 'string', 'max' => 500],
            [['description', 'keywords', 'url', 'name'], 'safe'],
            [['keywords'], 'string', 'max' => 500],
            [['name'], 'string', 'max' => 100],
            [['url_image'], 'string', 'max' => 200],
            [['name_image'], 'string', 'max' => 100],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions' => 'png, jpg'] //  'skipOnEmpty' => false,
        ];
    }

    public function attributeLabels()
    {
        return [
            'description'   => 'Описание',
            'keywords'      => 'Ключевые слова',
            'url'           => 'Url',
            'name'          => 'Название сайта',
            'image'         => 'Изображение',
        ];
    }

}