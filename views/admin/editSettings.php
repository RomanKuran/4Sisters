<?php

use yii\helpers\Html;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Настройка сайта';

$form = ActiveForm::begin([
    'id'        => 'Contacts-form',
    'action'    => 'settings-update'
]) ?>

<h3 class="text-center">Настройка сайта</h3>

<?= $form->field($model, 'description'); ?>

<?= $form->field($model, 'keywords'); ?>

<?= $form->field($model, 'name'); ?>

<?= $form->field($model, 'image')->widget(FileInput::class, [
    'options'       => [
        'accept' => 'image/*',
        'multiple'  => false
    ],
    'pluginOptions' => [
        'initialPreview'        => [$model->url_image],
        'uploadUrl'             => Url::to(['/images']),
        'initialPreviewAsData'  => true,
        'showPreview'           => true,
        'showCaption'           => false,
        'showRemove'            => false,
        'showUpload'            => false,
        'browseClass'           => 'btn btn-success btn-block',
        'uploadClass'           => 'btn btn-info',
        'removeClass'           => 'btn btn-danger'
    ],
]); ?>

<?= Html::submitButton('Обновить', ['class' => 'btn btn-primary btn-block']) ?>

<?php ActiveForm::end() ?>