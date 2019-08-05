<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use app\models\Parnters;

$this->title = 'Партнёры';

$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => [
            'enctype' => 'multipart/form-data'
    ],
]); ?>

<h3 class="text-center"><?= $header ?></h3>

<?= $form->field($model, 'id')->hiddenInput(['value' => $model->id])->label(false); ?>
<?= $form->field($model, 'image')->hiddenInput(['value' => $model->image])->label(false); ?>
<?= $form->field($model, 'image_')->widget(FileInput::class, [
    'name'          => 'attachment[]',
    'options'       => ['accept' => 'image/*'],
    'pluginOptions' => [
        'initialPreview'        => [$model->image],
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

<?= $form->field($model, 'name')->textarea(['rows' => '1'])->label('Партнер') ?>

<?= $form->field($model, 'link')->textarea(['rows' => '1'])->label('Ссылка') ?>

<?php if ($model->id != null): ?>
    <?= Html::submitButton('Изменить данные партнёра', ['class' => 'btn btn-primary btn-block']) ?>
<?php else: ?>
    <?= Html::submitButton('Создать нового партнёра', ['class' => 'btn btn-primary btn-block']) ?>
<?php endif; ?>

<?php ActiveForm::end() ?>
