<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use app\models\Services;

$this->title = 'Услуги';

$form = ActiveForm::begin(['id' => 'login-form', 'options' => ['enctype' => 'multipart/form-data'],]) ?>
<?= $form->field($model, 'id')->hiddenInput(['value' => $model->id])->label(false); ?>

<?= $form->field($model, 'img_banner')->hiddenInput(['value' => $model->img_banner])->label(false); ?>

<?= $form->field($model, 'image')->widget(FileInput::class, [
    'options'       => ['accept' => 'image/*'],
    'pluginOptions' => [
        'initialPreview'        => [$model->img_banner],
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

<?= $form->field($model, 'title')->textarea(['rows' => '3'])->label('Заголовок') ?>

<?= $form->field($model, 'content')->textarea(['rows' => '10'])->label('Описание услуги') ?>

<?= Html::submitButton('Изменить', ['class' => 'btn btn-primary btn-block']) ?>

<?php ActiveForm::end() ?>
