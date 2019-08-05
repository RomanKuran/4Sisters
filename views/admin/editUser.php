<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Пользователи';

?>

<?php $form = ActiveForm::begin([
    'id'                        => 'edit-blog-form',
    'enableClientValidation'    => true,
    'method'                    => 'post',
    'action'                    => [ 'user-update?id=' . $id ]
]); ?>

<h3 class="text-center">Редактирование пользователя</h3>

<?= $form->field($model, 'username')->textInput(['disabled' => true]) ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<?= $form->field($model, 'confirmPassword')->passwordInput() ?>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>

<?php ActiveForm::end() ?>
