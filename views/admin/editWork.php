<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

$this->registerCssFile("/css/admin/work.css");
$this->title = 'Как мы работаем';

$form = ActiveForm::begin([
    'id' => 'edit-working-form',
    'method' => 'post',
    'action' => 'save-work-in-db?id=' . $workModel->id
]) ?>

<h3 class="text-center"><?= $workModel->header; ?></h3>

<br><br>

<div class="row" style=" padding-right: 15px; " >
    <img src="<?= $workModel->path; ?>" alt="" width="60px" height="60px" class="col-xs-1">

    <?= $form->field($workModel, 'header', [
        'options' => [
            'class' => 'col-xs-9'
        ]
    ])->textInput(['placeholder' => 'Заглавие']); //->label(false) ?>

    <?= Html::submitButton('Сохранить', [
        'class'=> 'btn btn-primary col-xs-2',
        'style' => [
                'margin-top' => '23px'
            ]
    ]); ?>
</div>
<?php ActiveForm::end(); ?>

<br><br>

<div class="table-responsive">

    <?php try {
        echo GridView::widget([
            'dataProvider' => $descriptionsProvider,
            'layout'    => '{items}{summary}{pager}',
            'columns' => [
                [
                    'attribute' => 'description',
                    'format' => [
                        'text', ['class' => 'text-center']
                    ],
                    'contentOptions' => [
                        'class' => 'text-justify ',
                        'id' => 'description'
                    ]
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}{delete}',
                    'buttons' => [
                        'update' => function ($url, $workModel, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span><br>', '/admin/work-description-update?id=' . $workModel->work_id,
                                [
                                    'title' => Yii::t('app', 'Редактировать запись'),
                                    'class' => 'btn btn-success btn-action',
                                    'style' => 'margin: 5px'
                                ]
                            );
                        },
                        'delete' => function ($url, $workModel, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>','/admin/work-description-delete?id=' . $workModel->work_id,
                                [
                                    'title' => 'Удалить запись',
                                    'class' => 'btn btn-danger btn-action',
                                    'style' => 'margin-left: 5px',
                                    'data'  => [
                                        'confirm'   => Yii::t('app', 'Вы действительно хотите удалить этот раздел?'),
                                        'method'    => 'post'
                                    ]
                                ]);
                        }
                    ],
                    'contentOptions' => [
                        'style' => 'width: 200px; vertical-align: middle;'
                    ]
                ]
            ]
        ]);
    } catch (Exception $e) {
    }
    ?>

</div>
<br><br>

<?php $descrForm = ActiveForm::begin([
            'action' => 'add-description?work_id=' . $workModel->id
]); ?>

<h4>Добавить новый елемент описания</h4>

<div class="row" style="padding-right: 15px; ">

    <?= $form->field($wdModel, 'description', [
        'options' => [
            'class' => 'col-xs-10'
        ]
    ])->textInput(['placeholder' => 'Описание']); //->label(false) ?>

    <?= Html::submitButton('Добавить', [
        'class'=> 'btn btn-primary col-xs-2',
        'style' => [
            'margin-top' => '23px'
        ]
    ]) ?>
</div>
<?php ActiveForm::end() ?>
