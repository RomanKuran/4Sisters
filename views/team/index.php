<?php

use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Команда';

?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <br>
    <div class="alert alert-success alert-dismissable">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<h3 class="text-center">Команда</h3>

<a href="/team/create" class="btn btn-primary btn-block">Добавить человека в команду</a><br><br>

<div class="table-responsive">

    <?php try {
        echo GridView::widget([
            'dataProvider'  => $dataProvider,
            'layout'        => '{items}{summary}{pager}',
            'columns'       => [
                [
                    'attribute' => 'image',
                    'format'    => [
                        'image', [
                            'class' => 'img-thumbnail',
                            'width' => '140',
                            'height' => '120'
                        ],
                    ],
                    'contentOptions' => ['class' => 'img-thumbnail']
                ],
                [
                    'attribute' => 'name',
                    'format' => [
                        'text', ['class' => 'text-center']
                    ],
                    'contentOptions' => ['class' => 'text-justify ']
                ],
                'profession:text',
                'experience:text',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{team-update}{team-delete}',
                    'buttons' => [
                        'team-update' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/team/edit?id=' . $model->id,
                                [
                                    'title' => Yii::t('app', 'Редактировать запись'),
                                    'class' => 'btn btn-success btn-action',
                                    'style' => 'margin: 5px'
                                ]);
                        },
                        'team-delete' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/team/delete?id=' . $model->id,
                                [
                                    'title' => 'Удалить запись',
                                    'class' => 'btn btn-danger btn-action',
                                    'style' => 'margin-left: 5px',
                                    'data'  => [
                                        'confirm'   => Yii::t('app', 'Вы действительно хотите удалить этого человека из Вашей команды?'),
                                        'method'    => 'post'
                                    ]
                                ]);
                        }
                    ],
                    'contentOptions' => [
                        'style' => 'width: 120px'
                    ]
                ]
            ]
        ]);
    } catch (Exception $e) { }
    ?>

</div>
