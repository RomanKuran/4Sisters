<?php

use yii\helpers\Html;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Галерея';

$form = ActiveForm::begin([
    'id' => 'Contacts-form',
    'options' => [
        'enctype'   => 'multipart/form-data'
    ],
    'action' => 'gallery-upload?id=' . $_GET['id']
])
?>

<?= $form->field($model, 'image')->widget(FileInput::class, [
    'options'       => [
        'accept' => 'image/*',
        'multiple'  => false
    ],
    'pluginOptions' => [
        // 'initialPreview'        => [$model->url_image],
        'uploadUrl'             => Url::to(['/images/']),
        'initialPreviewAsData'  => true,
        'showPreview'           => true,
        'showCaption'           => false,
        'showRemove'            => false,
        'showUpload'            => false,
        'browseClass'           => 'btn btn-success btn-block',
        'uploadClass'           => 'btn btn-info',
        'removeClass'           => 'btn btn-danger'
    ]
]); ?>

<?= $form->field($model, 'description'); ?>

<?= Html::submitButton('Загрузить', ['class' => 'btn btn-primary btn-block']) ?>
<?php ActiveForm::end() ?>