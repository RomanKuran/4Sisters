<?php

namespace app\models;
use app\models\WorkDescr;

use Yii;

/**
 * This is the model class for table "work".
 *
 * @property int $id
 * @property string $header
 * @property string $path
 *
 * @property WorkDescription[] $workDescriptions
 */
class Work extends \yii\db\ActiveRecord
{

    public $image;

    public static function tableName() {
        return 'work';
    }

    public function rules() {
        return [
            [['header'], 'required'],
            [['header', 'path'], 'string', 'max' => 50],
            [['path'], 'default', 'value'=>'/siteIcons/how-we-work-1.svg'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png, svg '],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'header' => 'Заголовок',
            'path' => 'Картинка',
            'image' => 'Картинка'
        ];
    }

    public function getWorkDescriptions() {
        return $this->hasMany(WorkDescr::class, ['work_id' => 'id']);
    }

}
