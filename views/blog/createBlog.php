<?php

use app\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\HTML;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\web\JqueryAsset;
use vova07\imperavi\Widget;
use kartik\file\FileInput;

$this->registerJsFile(Yii::getAlias('@web/js/external/jquery.liTranslit.js'), ['depends' => [JqueryAsset::className()]]);//
$this->registerJsFile(Yii::getAlias('@web/js/external/fontsize.min.js'));//, ['depends' => [JqueryAsset::className()]]

$translit = <<< JS
    $('#idTitle').liTranslit({
      elAlias: $('#idUrl')
    });
JS;

//$before_unload = <<< JS
//    window.onbeforeunload = function myConfirmation() {
//            return 'Внесённые изменения будут потеряны. Вы действительно хотите покинуть страницу?';
//    }
//JS;

$this->registerJs($translit);

$form = ActiveForm::begin([
    'id'                        => 'create-blog-form',
    'enableClientValidation'    => true,
    'method'                    => 'post',
    'action'                    => ['save-blog-in-db'],
    'options'                   => [
        'enctype'   => 'multipart/form-data'
    ]
]) ?>

<?php if (Yii::$app->session->hasFlash('warning')): ?>
    <br>
    <div class="alert alert-warning alert-dismissable">
        <?= Yii::$app->session->getFlash('warning') ?>
    </div>
<?php endif; ?>

<h3 class="text-center">Новый блог</h3>

<?= $form->field($model, 'title')->textInput(['id' => 'idTitle', 'placeholder' => 'Заглавие']); ?>

<?= $form->field($model, 'url')->textInput(['id' => 'idUrl', 'placeholder' => 'Url']); ?>

<?= $form->field($model, 'image')->widget(FileInput::class,[
    'options'       => [
        'accept'    => 'image/*',
        'multiple'  => false
    ],
    'pluginOptions' => [
        'initialPreview'        => [$model->poster_url],
        'uploadUrl'             => Url::to(['/blogs/' . $_SESSION['TMP_FOLDER']]),
        'initialPreviewAsData'  => true,
        'showPreview'           => true,
        'showRemove'            => false,
        'showCaption'           => false,
        'showUpload'            => false,
        'browseLabel'           => 'Выбрать титульное фото',
        'browseClass'           => 'btn btn-success btn-block'
    ]
]); ?>

<?= $form->field($model, 'preView')->textarea(['rows' => '2', 'placeholder' => 'Краткое описание']); ?>

<?= $form->field($model, 'content')->widget(Widget::className(), [
    'id' => 'content',
    'settings' => [
        'lang'              => 'ru',
        'minHeight'         => 200,
        'imageUpload'       => Url::to(['/blog/image-upload']),
        'imageDelete'       => Url::to(['/blog/file-delete']),
        'imageManagerJson'  => Url::to(['/blog/images-get']),
        'placeholder'       => 'Здесь будет красивый текст блога...  :)',
        'plugins' => [
            'fontsize',
            'fullscreen',
            'imagemanager'
        ]
    ]
]);
?>

<?= $form->field($model, 'id_category')->dropDownList(
  ArrayHelper::map(Category::find()->all(), 'id', 'name')); ?>

<?= Html::submitButton('Добавить блог', ['class' => 'btn btn-primary btn-block']) ?>

<?php ActiveForm::end() ?>
