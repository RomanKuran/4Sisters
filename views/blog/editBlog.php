<?php

use app\models\Category;
use yii\helpers\HTML;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use kartik\file\FileInput;

//$this->registerJsFile(Yii::getAlias('@web/js/external/fontsize.min.js'), [
//    'depends' => [
//        JqueryAsset::className()
//    ]
//]);

//$before_unload = <<< JS
//    window.onbeforeunload = function myConfirmation() {
//            return 'Внесённые изменения будут потеряны. Вы действительно хотите покинуть страницу?';
//    }
//JS;

//$this->registerJs($before_unload);

$form = ActiveForm::begin([
    'id'                        => 'edit-blog-form',
    'enableClientValidation'    => true,
    'method'                    => 'post',
    'action'                    => [ 'update-blog?id=' . $id ],
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

<h3 class="text-center">Редактирование блога</h3>

<?= $form->field($model, 'title')->textInput(['id' => 'idTitle', 'placeholder' => 'Заглавие']); ?>

<?= $form->field($model, 'url')->textInput(['id' => 'idUrl', 'placeholder' => 'Url', 'disabled' => true]); ?>

<?= $form->field($model, 'image')->widget(FileInput::class, [
    'options'       => [
        'accept'    => 'image/*',
        'multiple'  => false
    ],
    'pluginOptions' => [
        'initialPreview'        => $model->poster_url,
        'uploadUrl'             => Url::to(['/blogs/' . $_SESSION['BLOG_ID']]),
        'initialPreviewAsData'  => true,
        'showPreview'           => true,
        'showRemove'            => false,
        'showCaption'           => false,
        'showUpload'            => false,
        'browseLabel'           => 'Выбрать титульное фото',
        'browseClass'           => 'btn btn-success btn-block'
    ]
]); ?>

<?= $form->field($model, 'preView')->textarea(['rows' => '2', 'placeholder' => 'Краткое описание']) ?>

<?= $form->field($model, 'content')->widget(Widget::class, [
    'settings' => [
        'lang'              => 'ru',
        'minHeight'         => 200,
        'imageUpload'       => Url::to(['/blog/image-upload']),
        'imageDelete'       => Url::to(['/blog/file-delete']),
        'imageManagerJson'  => Url::to(['/blog/images-get']),
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

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>

<?php ActiveForm::end() ?>
