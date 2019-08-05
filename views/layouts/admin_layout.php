<?php
/* @var $this yii\web\View */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;

AppAsset::register($this);
$this->registerCssFile('/css/admin/sidebar.css', [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
]);
$url = $_SERVER['REQUEST_URI'];
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <nav id="w0" class="navbar-inverse navbar-fixed-top navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="/images/siteIcons/logo.svg" style="height: 100%" alt="" />
            </a>
            <div class="navbar-header">
                <button id="burger" type="button" class="navbar-toggle icon">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="/">
                    <img src="/images/siteIcons/logo.svg" height="100%" alt="qwert">
                </a> -->
            </div>
            <div id="w0-collapse" class="collapse navbar-collapse">
                <!-- <ul class="nav navbar-nav navbar-right">
                  <li ><form action="/site/logout" method="post"><input type="hidden" name="_csrf"><button class="logout" type="submit"><img class="icon-menu" src="/images/icons/logout.svg"></button></form></li>
                </ul> -->
            </div>
        </div>
    </nav>

    <div class="property-sidebar">

        <div id="sidebar">
            <div class="container-fluid"></div>

            <ul class="nav navbar-nav side-bar" id="myTopnav">

                <li class="side-bar <?= (strpos($url, '/admin/gallery') !== false) ? "active-menu" : ""; ?>"><a
                            href="/admin/gallery"><span>&nbsp;</span><img class="icon-menu" src="/images/icons/gallery.svg" alt="" >Галерея</a>
                </li>
                <li class="side-bar <?= (strpos($url, '/blog/index') !== false) ? "active-menu" : ""; ?>"><a
                            href="/blog/index"><span>&nbsp;</span> <img class="icon-menu" src="/images/icons/blog.svg" alt="" >Блог</a>
                </li> <!-- class="glyphicon glyphicon-flag" -->
                <li class="side-bar <?= (strpos($url, '/admin/work') !== false) ? "active-menu" : ""; ?>"><a
                            href="/admin/work"><span>&nbsp;</span> <img class="icon-menu" src="/images/icons/work.svg" alt="" >Как мы работаем</a>
                </li>
                <li class="side-bar <?= (strpos($url, '/admin/index') !== false) ? "active-menu" : ""; ?>"><a
                            href="/admin/index"><span>&nbsp;</span> <img class="icon-menu" src="/images/icons/services.svg" alt="" >Услуги</a>
                </li><!-- class="glyphicon glyphicon-list" -->
                <li class="side-bar <?= (strpos($url, '/admin/history') !== false) ? "active-menu" : ""; ?>"><a
                            href="/admin/history"><span>&nbsp;</span> <img class="icon-menu" src="/images/icons/history.svg" alt="" >История</a>
                </li>
                <li class="side-bar <?= (strpos($url, '/admin/team') !== false) ? "active-menu" : ""; ?>"><a
                            href="/team/index"><span>&nbsp;</span> <img class="icon-menu" src="/images/icons/team.svg" alt="" >Команда</a>
                </li><!-- class="glyphicon glyphicon-star" -->
                <li class="side-bar <?= (strpos($url, '/admin/contacts') !== false) ? "active-menu" : ""; ?>"><a
                            href="/admin/contacts"><span>&nbsp;</span> <img class="icon-menu" src="/images/icons/contacts.svg" alt="" >Контакы</a>
                </li>
                <li class="side-bar <?= (strpos($url, '/admin/social') !== false) ? "active-menu" : ""; ?>"><a
                            href="/admin/social"><span>&nbsp;</span> <img class="icon-menu" src="/images/icons/social.svg" alt="" >Социальные сети</a>
                </li>
                <li class="side-bar <?= (strpos($url, '/admin/partners') !== false) ? "active-menu" : ""; ?>"><a
                            href="/admin/partners"><span>&nbsp;</span> <img class="icon-menu" src="/images/icons/partners.svg" alt="" >Наши партнёры</a>
                </li>
                <li class="side-bar <?= (strpos($url, '/admin/settings') !== false) ? "active-menu" : ""; ?>"><a
                            href="/admin/settings"><span>&nbsp;</span> <img class="icon-menu" src="/images/icons/settings.svg" alt="" >Настройка сайта</a>
                </li>
                <?php if (Yii::$app->user->identity->username == 'admin'): ?>
                    <li class="side-bar <?= (strpos($url, '/admin/user') !== false) ? "active-menu" : ""; ?>"><a
                                href="/admin/user"><span>&nbsp;</span> <img class="icon-menu" src="/images/icons/users.svg" alt="" >Пользователи</a>
                    </li>
                <?php else: ?>
                    <li class="side-bar <?= (strpos($url, '/admin/user') !== false) ? "active-menu" : ""; ?>"><a
                                href="/admin/user-edit"><span>&nbsp;</span> <img class="icon-menu" src="/images/icons/users.svg" alt="" >Пользователь</a>
                    </li>
                <?php endif; ?>
                <li class="side-bar <?= (strpos($url, '/site/logout') !== false) ? "active-menu" : ""; ?> size">
                    <form action="/site/logout" method="post"><input type="hidden" name="_csrf">
                        <button class="logout" type="submit"><img class="icon-menu" src="/images/icons/logout.svg" alt="" >Выйти
                            (<?= Html::encode(Yii::$app->user->identity->username); ?>)
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>

    <div class="container-fluid content-page">
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
<script src='/js/admin/sidebar.js'></script>
</body>
</html>
<?php $this->endPage() ?>
