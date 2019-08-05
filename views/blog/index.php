<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Блог';

?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <br>
    <div class="alert alert-success alert-dismissable">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<h3 class="text-center">Блоги</h3>

<a href="/blog/create-blog" class="btn btn-primary btn-block">Написать блог</a><br><br>

<div class="table-responsive">

    <?php try {
        echo GridView::widget([
            'id'            => 'all_blogs',
            'dataProvider'  => $dataProvider,
            'layout'        => '{items}{summary}{pager}',
            'columns'       => [
                [
                    'attribute'         => 'poster_url',
                    'format'            => 'raw',
                    'contentOptions'    => [ 'class' => 'img-thumbnail' ],
                    'value'             => function (app\models\Blog $model) {
                        if (!empty($model->poster_url)) {
                            return Html::img($model->poster_url, [
                                'class'     => 'img-thumbnail',
                                'alt'       => '',
                                'width'     => '140',
                                'height'    => '120',
                            ]);
                        } else {
                            return Html::img('/images/noPhoto.svg', [
                                'alt'       => 'No title image',
                                'class'     => 'img-thumbnail noBlogTitleImage'
                            ]);
                        }
                    }
                ],
                [
                    'attribute' => 'title',
                    'format'    => 'text'
                ],
                [
                    'attribute' => 'preView',
                    'format'    => 'text'
                ],
                [
                    'attribute' => 'id_category',
                    'format'    => 'html',
                    'value'     => function ($model) {
                        return $model->getCategory()->name;
                    }
                ],
                [
                    'attribute' => 'id_user',
                    'format'    => 'html',
                    'value'     => function ($mod) {
                        return $mod->getUser()->username;
                    }
                ],
                [
                    'attribute' => 'date',
                    'format'    => ['date', 'php:d.m.Y H:i:s']
                ],
                [
                    'class'     => 'yii\grid\ActionColumn',
                    'template'  => '{blog-edit}{blog-delete}',
                    'buttons'   => [
                        'blog-edit'     => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/blog/edit-blog?id=' . $model->id,
                                [
                                    'title' => Yii::t('app', 'Редактировать запись'),
                                    'class' => 'btn btn-success btn-action',
                                    'style' => 'margin: 5px'
                                ]
                            );
                        },
                        'blog-delete'   => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/blog/delete-blog?id=' . $model->id,
                                [
                                    'title' => Yii::t('app', 'Удалить запись'),
                                    'class' => 'btn btn-danger btn-action',
                                    'style' => 'margin-left: 5px',
                                    'data'  => [
                                        'confirm'   => Yii::t('app', 'Вы действительно хотите удалить этот блог?'),
                                        'method'    => 'post'
                                    ]
                                ]
                            );
                        }
                    ],
                    'contentOptions' => [
                        'style' => 'width: 120px'
                    ]
                ]
            ]
        ]);
    } catch (Exception $e) { } ?>

</div>
