<?php

use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Как мы работаем';

?>

<h3 class="text-center">Как мы работаем</h3>

<br>
<a href="/admin/work-update">
    <button class="btn btn-primary btn-block" type="button" name="button">Добавить новый раздел</button>
</a>
<br><br>

<div class="table-responsive">

    <?php try {
        echo GridView::widget([
            'dataProvider'  => $dataProvider,
            'layout'        => '{items}{summary}{pager}',
            'columns'       => [
                [
                    'attribute' => 'path',
                    'format'    => 'image',
                    'contentOptions' => [
                        'width' => '60px',
                        'height' => '60px'
                    ]
                ],
                [
                    'attribute' => 'header',
                    'format' => "raw",
                    'contentOptions' => [
                        'style' => 'text-align: center; font-size: 22px; vertical-align: middle;'
                    ],
                    'headerOptions' => [
                        'style' => 'text-align: center; vertical-align: middle;'
                    ]
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{work-update}{delete}',
                    'buttons' => [
                        'work-update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span><br>', '/admin/work-update?id=' . $model->id,
                                [
                                    'title' => Yii::t('app', 'Редактировать раздел'),
                                    'class' => 'btn btn-success btn-action',
                                    'style' => 'margin: 5px'
                                ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/admin/work-delete?id=' . $model->id,
                                [
                                    'title' => Yii::t('app', 'Удалить раздел'),
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
                        'style' => 'width: 120px; vertical-align: middle;'
                    ]
                ]
            ]
        ]);
    } catch (Exception $e) { }
    ?>

</div>
