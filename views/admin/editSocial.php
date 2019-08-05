<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Социальные сети';

$form = ActiveForm::begin([
    'id' => 'Contacts-form',
    'action' => 'social-update'
]) ?>

<h3 class="text-center">Социальные сети</h3>

<?= $form->field($model, 'instagram')->textInput(['placeholder' => '@myInstagramPage']); ?>

<?= $form->field($model, 'facebook')->textInput(['placeholder' => 'Страница в Facebook']); ?>

<?= $form->field($model, 'twitter')->textInput(['placeholder' => 'Страница в Twitter']); ?>

<?= $form->field($model, 'viber')->textInput(['placeholder' => 'Номер в Viber']); ?>

<div class="form-group">
    <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary btn-block']) ?>
</div>

<?php ActiveForm::end() ?>
