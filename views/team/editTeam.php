<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;

$this->title = 'Команда';

$form = ActiveForm::begin([
    'id'                        => 'edit-team-form',
    'enableClientValidation'    => true,
    'method'                    => 'post',
    'action'                    => [ 'update?id=' . $id ],
    'options'                   => [
        'enctype' => 'multipart/form-data'
    ]
]); ?>

<h3 class="text-center">Редактирование данных</h3>

<?= $form->field($model, 'photo')->widget(FileInput::class, [
    'options' => [
        'accept' => 'image/*',
        'multiple' => false
    ],
    'pluginOptions' => [
        'initialPreview' => [$model->image],
        'uploadUrl' => Url::to(['/images']),
        'initialPreviewAsData' => true,
        'showPreview' => true,
        'showCaption' => false,
        'showRemove' => false,
        'showUpload' => false,
        'browseLabel' => 'Выбрать титульное фото',
        'browseClass' => 'btn btn-success btn-block'
    ],
]); ?>

<?= $form->field($model, 'name')->textarea(['rows' => '1'])->label('Имя') ?>

<?= $form->field($model, 'profession')->textarea(['rows' => '1'])->label('Профессия') ?>

<?= $form->field($model, 'experience')->textarea(['rows'=>'3'])->label('Опыт') ?>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>

<?php ActiveForm::end() ?>
