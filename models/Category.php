<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
  * This is the model class for table "category"
  *
  * @property int $id
  * @property string $name
  *
  */
class Category extends ActiveRecord
{

  public static function tableName() {
    return 'category';
  }

  public function rules()
  {
      return [
          [['id', 'name'], 'required'],
          'id'     => [['id'], 'integer'],
          'name'   => [['name'], 'string', 'max' => 20]
      ];
  }

  public function attributeLabels()
  {
    return [
      'id'    => 'ID',
      'name'  => 'Категория'
    ];
  }

}


 ?>
