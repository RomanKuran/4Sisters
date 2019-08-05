<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Пользователи';

?>

<?php
$form = ActiveForm::begin() ?>

<h3 class="text-center">Новый пользователь</h3>

<?= $form->field($model, 'username') ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<?= $form->field($model, 'confirmPassword')->passwordInput() ?>

<?= Html::submitButton('Создать', ['class' => 'btn btn-primary btn-block']) ?>

<?php ActiveForm::end() ?>
