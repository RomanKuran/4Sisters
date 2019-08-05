<?php

namespace app\models;


use \yii\db\ActiveRecord;

/**
 * This is the model class for table "work_description".
 *
 * @property int $id
 * @property int $work_id
 * @property string $description
 *
 * @property Work $work
 */
class WorkDescr extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_description';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['work_id'], 'integer'],
            [['description'], 'string', 'max' => 200],
            [['work_id'], 'exist', 'skipOnError' => true, 'targetClass' => Work::class, 'targetAttribute' => ['work_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'work_id'       => 'Work ID',
            'description'   => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWork()
    {
        return $this->hasOne(Work::class, ['id' => 'work_id']);
    }
}
