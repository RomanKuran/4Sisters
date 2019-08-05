<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Контакты';

$form = ActiveForm::begin([
    'id' => 'Contacts-form',
    'action' => 'contacts-update'
]) ?>

<h3 class="text-center">Контакты</h3>

<?= $form->field($model, 'phone'); ?>

<?= $form->field($model, 'site_link'); ?>

<?= $form->field($model, 'address'); ?>

<div class="form-group">
    <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary btn-block']) ?>
</div>

<?php ActiveForm::end() ?>