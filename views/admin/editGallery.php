<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\grid\GridView;
use app\widgets\BootstrapLinkPager;

$this->title = 'Галерея';

$this->registerJsFile('/PropertyGallery/lightgallery.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/PropertyGallery/lightgallery-all.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/PropertyGallery/mousewhele.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/PropertyGallery/picturefill.js',['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJs(<<<JS
$(document).ready(function() {
  $('#lightgallery').lightGallery({
    pager: true
  });
});
JS
);
?>

    <link rel="stylesheet" href="../PropertyGallery/lightgallery.css">
    <link rel="stylesheet" href="../PropertyGallery/style.css">

    <h3 class="text-center">Галерея    </h3>
            <ul class="nav nav-pills category" id="myDIV">
                <li class="nav-item">
                    <a class="nav-link <?=($_GET['id'] == '2')?"active-menu-gallery":"";?>" href="/admin/gallery?id=2">ДИЗАЙН ИНТЕРЬЕРА</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=($_GET['id'] == '3')?"active-menu-gallery":"";?>" href="/admin/gallery?id=3">АРТ ГАЛЕРЕЯ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=($_GET['id'] == '4')?"active-menu-gallery":"";?>" href="/admin/gallery?id=4">АВТОРСКАЯ МЕБЕЛЬ</a>
                </li>
            </ul>

    <div class="cont">
        <div class="scroll-area">
            <div class="demo-gallery">
                <ul id="lightgallery">
                    <?php foreach($models as $image):?>
                        <li  id="/images/gallery/<?=$_GET["id"]?>/<?=$image->name?>" data-responsive="https://sachinchoolur.github.io/lightGallery/static/img/1-375.jpg 375, https://sachinchoolur.github.io/lightGallery/static/img/1-480.jpg 480, "/images/gallery/<?=$_GET["id"]?>/<?=$image->name?>" 800"
                        data-src="/images/gallery/<?=$_GET["id"]?>/<?=$image->name?>" data-sub-html="<h4><?=$image->name?></h4><p><?=$image->description?></p>"
                        data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
                            <a href="">
                                <img class="img-responsive" src="/images/gallery/<?=$_GET["id"]?>/<?=$image->name?>">
                                <div class="demo-gallery-poster">
                                    <img src="https://sachinchoolur.github.io/lightGallery/static/img/zoom.png">
                                </div>
                            </a>
                            </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>


    <?echo BootstrapLinkPager::widget([
        'pagination' => $pages,
    ]);?>

    <a class="nav-link" href="/admin/gallery-upload?id=<?=$_GET["id"]?>"><button class="btn btn-primary btn-block" style="margin-bottom: 20px;">Загрузить</button></a>

    <style>
        .cont{
            margin-top: 10px;
        }

        .category{
            display: flex;
            justify-content: center;
        }

        .myPagination{
            display: flex;
            justify-content: center;
        }

        .nav-link{
            background-color: #b7d2ff;
        }

        .active-menu-gallery{
            font-weight: bold;
        }
    </style>