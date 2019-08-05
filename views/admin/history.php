<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07.08.2018
 * Time: 17:15
 */


use yii\helpers\HTML;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use vova07\imperavi\Widget;

//<!-- connect language file -->
$this->registerJsFile(Yii::getAlias('@web/js/external/ru.js'));

//$R

//<!-- call -->
//<script>
//$R('#content', { lang: 'fi' });
//</script>

$this->title = 'История';

$form = ActiveForm::begin([
    'id'                        => 'history-form',
    'enableClientValidation'    => true,
    'method'                    => 'post',
    'action'                    => ['history-update?id=' . $id],
    'options'                   => [
        'enctype'   => 'multipart/form-data'
    ]
]); ?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <br>
    <div class="alert alert-success alert-dismissable">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<h3 class="text-center">История</h3>

<?= $form->field($model, 'image')->widget(FileInput::class, [
    'options'       => [
        'accept'    => 'image/*',
        'multiple'  => false
    ],
    'pluginOptions' => [
        'initialPreview'        => $model->image_url,
        'uploadUrl'             => Url::to(['/images/history']),
        'initialPreviewAsData'  => true,
        'showPreview'           => true,
        'showRemove'            => false,
        'showCaption'           => false,
        'showUpload'            => false,
        'browseLabel'           => 'Выбрать историческое фото',
        'browseClass'           => 'btn btn-success btn-block'
    ]
]); ?>

<?= $form->field($model, 'description')->widget(Widget::class, [
    'id'            => 'content',
    'settings'      => [
        'lang'              => 'ru',
        'minHeight'         => 200,
        'plugins' => [
            'fontsize',
            'fullscreen'
        ]
    ]
]); ?>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>

<?php ActiveForm::end() ?>
