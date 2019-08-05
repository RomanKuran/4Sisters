<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Услуги';

?>

<h3 class="text-center">Услуги</h3>

<div class="table-responsive">

    <?php try {
        echo GridView::widget([
            'dataProvider'  => $dataProvider,
            'layout'        => '{items}{summary}{pager}',
            'columns'       => [
                [
                    'attribute' => 'img_banner',
                    'format'    => ['image', [ 'class' => 'img-thumbnail' ]],
                    'contentOptions' => [ 'class' => 'img-thumbnail' ]
                ],
                    'title:text',
                    'content:text',
                [
                    'class'     => 'yii\grid\ActionColumn',
                    'template'  => '{view-update}',
                    'buttons'   => [
                        'view-update'     => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/admin/update?id=' . $model->id,
                                [
                                    'title' => Yii::t('app', 'Редактировать'),
                                    'class' => 'btn btn-success btn-action',
                                    'style' => 'margin: 5px'
                                ]
                            );
                        }
                    ]
                ]
            ]
        ]);
    } catch (Exception $e) { }

    ?>
</div>
