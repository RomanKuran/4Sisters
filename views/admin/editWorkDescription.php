<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07.08.2018
 * Time: 11:02
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id'                        => 'edit-work-description-form',
    'enableClientValidation'    => true,
    'method'                    => 'post',
    'action'                    => ['work-description-save-in-db?id=' . $id]
]); ?>

<br><br>
<div class="row"style=" padding-right: 15px; " >
    <?= $form->field($model, 'description', [
        'options' => [
            'class' => 'col-xs-10'
        ]
    ])->textInput(['placeholder' => 'Описание']); ?>

    <?= Html::submitButton('Сохранить', [
        'class'=> 'btn btn-primary col-xs-2',
        'style' => [
            'margin-top' => '23px'
        ]
    ]); ?>
</div>
<?php ActiveForm::end(); ?>

