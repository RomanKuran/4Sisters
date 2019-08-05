<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 06.07.2018
 * Time: 19:40
 */

use yii\helpers\Html;

?>

<div class='row blogRow' id='blog'>
    <?php for ($i = 0; $i < 3; $i++):?>
        <div class='col-lg-4 block'>
            <?php if (!empty($model[$i]->poster_url)): ?>
                <img src='<?= Html::encode($model[$i]->poster_url) ?>' alt=''>
            <?php endif; ?>
            <article>
                <h5><?= Html::encode($model[$i]->title) ?></h5>
                <p><?= Html::encode($model[$i]->preView) ?></p>
                <a href='#blogView' style='cursor:pointer' onclick='showBlog(<?= Html::encode($model[$i]->id) ?>)'>
                    <p class='read-more'>Читать дальше</p>
                </a>
            </article>
        </div>
    <?php endfor; ?>
</div>
