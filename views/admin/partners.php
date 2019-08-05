<?php

use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Партнёры';

?>

<h3 class="text-center">Партнёры</h3>
<a href="/admin/partners-update">
    <button class="btn btn-primary btn-block" type="button" name="button">Добавить партнера</button>
    <br><br>
</a>

<div class="table-responsive">

    <?php try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'layout'    => '{items}{summary}{pager}',
            'columns' => [
                [
                    'attribute' => 'image',
                    'format'    => 'raw',
                    'value'     => function (app\models\Partners $model) {
                        if (!empty($model->image)) {
                            return Html::img($model->image, [
                                'class'     => 'img-thumbnail',
                                'alt'       => $model->name
                            ]);
                        } else {
                            return Html::img('/images/noPartners.svg', [
                                'class'     => 'img-thumbnail',
                                'alt'       => 'No partner title image'
                            ]);
                        }
                    },
                    'contentOptions' => [
                        'style' => ['width' => '60px', 'height' => '60px']
                    ]
                ],
                'name:text',
                [
                    'attribute' => 'link',
                    'format'    => [
                        'text', ['class' => 'text-center']
                    ],
                    'contentOptions' => ['class' => 'text-justify ']
                ],
                [
                    'class'     => 'yii\grid\ActionColumn',
                    'template'  => '{partners-update}{delete}',
                    'buttons'   => [
                        'partners-update' => function ($url, $model) {
                            $url = Url::to(['admin/partners-update', 'id' => $model->id]);
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span><br>', $url,
                                [
                                    'title' => 'Изменить',
                                    'class' => 'btn btn-success btn-action',
                                    'style' => 'margin: 5px'
                                ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                                ['partners-delete', 'id' => $model->id],
                                [
                                    'title' => 'Удалить',
                                    'class' => 'btn btn-danger btn-action',
                                    'data' => [
                                        'confirm' => 'Подтвердить?',
                                        'method' => 'post',
                                    ],
                                    'style' => 'margin: 5px'
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
