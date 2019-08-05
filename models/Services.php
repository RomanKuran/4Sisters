<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property string $img_banner
 * @property string $title
 * @property string $content
 */
class Services extends \yii\db\ActiveRecord
{

    public $image;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['img_banner', 'title', 'content'], 'required'],
            [['title', 'content'], 'string'],
            [['img_banner'], 'string', 'max' => 50],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions' => 'jpg, gif, png'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img_banner' => 'Картинка',
            'title' => 'Заголовок',
            'content' => 'Текст',
            'image' => 'Картинка'
        ];
    }
}
