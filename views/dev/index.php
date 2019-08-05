<?php

use yii\helpers\Html;

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?= Html::encode($this->params['modelSettings']->url_image) ?>"/>
    <title><?= Html::encode($this->params['modelSettings']->name) ?></title>
    <meta name="description" content="<?= Html::encode($this->params['modelSettings']->description) ?>"/>
    <meta name="keywords" content="<?= Html::encode($this->params['modelSettings']->keywords) ?>"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link href="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/css/lightgallery.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&subset=cyrillic,cyrillic-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&subset=cyrillic,cyrillic-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

</head>
<body>
<header>
    <!-- NAVBAR - START -->
    <nav class="navbar navbar-expand-lg navbar navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="http://design4sisters.com"><img src="/images/siteIcons/logo.svg" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item" id='services-nav'>
                        <a class="nav-link" href="#">Услуги</a>
                    </li>
                    <li class="nav-item" id='blog-nav'>
                        <a class="nav-link" href="#">Блог</a>
                    </li>
                    <li class="nav-item" id='about-us-nav'>
                        <a class="nav-link" href="#">О нас</a>
                    </li>
                    <li class="nav-item" id='contacts-nav'>
                        <a class="nav-link" href="#">Контакты</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- NAVBAR - END -->
</header>
<main>
    <!-- CAROUSEL - START -->
    <div id="carouselExampleIndicators" class="carousel slide" data-interval="false">
        <div class="indicators-wrap">
            <div class="container">
                <ol class="carousel-indicators">
                    <li onclick="showSection('.one')" data-target="#carouselExampleIndicators" data-slide-to="0"
                        class="icon active">
                        <img src="/images/siteIcons/icon1.svg" alt="">
                        <h4>Недвижимость</h4>
                    </li>
                    <li onclick="showSection('.two')" data-target="#carouselExampleIndicators" data-slide-to="1"
                        class="icon">
                        <img src="/images/siteIcons/icon2.svg" alt="">
                        <h4>Дизайн интерьера</h4>
                    </li>
                    <li onclick="showSection('.three')" data-target="#carouselExampleIndicators" data-slide-to="2"
                        class="icon">
                        <img src="/images/siteIcons/icon3.svg" alt="">
                        <h4>Арт галерея</h4>
                    </li>
                    <li onclick="showSection('.four')" data-target="#carouselExampleIndicators" data-slide-to="3"
                        class="icon">
                        <img src="/images/siteIcons/icon4.svg" alt="">
                        <h4>Авторская мебель</h4>
                    </li>
                </ol>
            </div>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="" src="<?= Html::encode($model[0]->img_banner) ?>" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="" src="<?= Html::encode($model[1]->img_banner) ?>" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="" src="<?= Html::encode($model[2]->img_banner) ?>" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="" src="<?= Html::encode($model[3]->img_banner) ?>" alt="Fourth slide">
            </div>
        </div>
    </div>
    <!-- CAROUSEL - END -->
    <!-- =============== 1. REALITY =============== -->
    <div class='part one'>
        <!-- GUARANTEE SECTION - START-->
        <section class="article guarantee">
            <div class="container">
                <div class="row content">
                    <div class="cont-bdr-top bdr"></div>
                    <div class="cont-bdr-right bdr"></div>
                    <h5><?= nl2br($model[0]->title) ?></h5>

                    <p class='with-frame'>
                        <span class='p-bdr-top bdr'></span>
                        <span class='p-bdr-left bdr'></span>

                        <?= nl2br($model[0]->content) ?>
                        <span class='p-bdr-bottom bdr'></span>
                    </p>
                    <div class="cont-bdr-bottom bdr"></div>
                </div>
            </div>
        </section>
        <!-- GUARANTEE SECTION - END-->
        <!-- CONTACT UP - START -->
        <section class='contact-us'>
            <a class='contact-link' href="#"><img src="/images/siteIcons/contact-us.svg" alt=""></a>
            <h3>связаться с нами</h3>
        </section>
        <!-- CONTACT UP - END -->
    </div>
    <!-- =============== 2. INTERIOR-DESIGN =============== -->
    <div class='part two'>
        <!-- CREATING SPACE - START -->
        <section class="article creating-space">
            <div class="container content">
                <div class="cont-bdr-top bdr"></div>
                <div class="cont-bdr-right bdr"></div>
                <h5>
                    <span class="h-bdr-top bdr"></span>
                    <span class="h-bdr-left bdr"></span>
                    <?= nl2br($model[1]->title) ?>
                    <span class="h-bdr-bottom bdr"></span>
                </h5>
                <ul class='creating-space-list'>
                    <li>
                        <div><?= nl2br($model[1]->content) ?></div>
                    </li>
                </ul>
                <div class="cont-bdr-bottom bdr"></div>
            </div>
        </section>
        <!-- CREATING SPACE - END -->
        <!-- GALLARY - START -->
        <section class="gallary">
            <div class="container">
                <h3 class="title"><span>Галерея</span></h3>
                <div class="row text-center">
                    <? $countDesign = count($modelGalleryDesign);
                    if ($countDesign == 0):?>
                        <h3>В этой категории еще нет изображений</h3>
                    <? else:?>
                        <ul id="lightgallery" class="list-unstyled row">
                            <? for ($i = 0; $i < $countDesign; $i++):?>
                                <? if ($i < 5):?>
                                    <li class="thumbnail-wrapper"
                                        data-src="<?= '/' . $modelGalleryDesign[$i]['url_image']; ?>">
                                        <a class="thumbnail" href=""
                                           style="background-image:url('<?= '/' . $modelGalleryDesign[$i]['url_image']; ?>')">
                                            <i class="material-icons">&#xE8FF;</i>
                                        </a>
                                    </li>
                                <? else:?>
                                    <li class="marg" data-src="<?= '/' . $modelGalleryDesign[$i]['url_image']; ?>">
                                    </li>
                                <? endif; ?>
                            <? endfor; ?>
                        </ul>
                    <? endif; ?>
                </div>
            </div>
        </section>
        <!-- GALLARY - END -->
        <!-- GOW WE WORK - START -->
        <section class="how-we-work">
            <div class="container">
                <h3 class="title"><span>Как мы работаем</span></h3>
                <?php for ($i = 0; $i < count($modelWork); $i++) : ?>
                    <?php if ($i % 2 == 0) : ?>
                        <div class="row">
                            <div class="content left">
                                <div class="text-block tb-<?= $i + 1 ?>">
                                    <h4><?= Html::encode($modelWork[$i]->header) ?></h4>
                                    <div class="left-line l-one"></div>
                                    <ul class='left'>
                                        <?php foreach ($modelWork[$i]->workDescriptions as $value) : ?>
                                            <li><?= Html::encode($value->description) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="icon-block">
                                    <img src="<?= Html::encode($modelWork[$i]->path) ?>" alt="">
                                </div>
                            </div>
                        </div>
                    <?php elseif ($i % 2 == 1) : ?>
                        <div class="row justify-content-end">
                            <div class="content right">
                                <div class="icon-block">
                                    <img src="<?= Html::encode($modelWork[$i]->path) ?>" alt="">
                                </div>
                                <div class="text-block tb-<?= $i + 1 ?>">
                                    <h4><?= Html::encode($modelWork[$i]->header) ?></h4>
                                    <div class="right-line r-one"></div>
                                    <ul class='right'>
                                        <?php foreach ($modelWork[$i]->workDescriptions as $value) : ?>
                                            <li><?= Html::encode($value->description) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </section>
        <!-- GOW WE WORK - END -->
    </div>
    <!-- =============== 3. ART - GALLARY =============== -->
    <div class='part three'>
        <!-- YOU CAN CHOOSE - START -->
        <section class="article you-can-choose">
            <div class="container">
                <div class="row content">
                    <div class="cont-bdr-top bdr"></div>
                    <div class="cont-bdr-right bdr"></div>
                    <h5><?= nl2br($model[2]->title) ?></h5>
                    <h5>
                        <span class="h-bdr-top bdr"></span>
                        <span class="h-bdr-left bdr"></span>
                        <?= nl2br($model[2]->content) ?>
                        <span class="h-bdr-bottom bdr"></span>
                    </h5>
                    <div class="cont-bdr-bottom bdr"></div>
                </div>
            </div>
        </section>
        <!-- YOU CAN CHOOSE - END -->
        <!-- ART GALLARY - START -->
        <section class="gallary">
            <div class="container">
                <h3 class="title"><span>Арт Галерея</span></h3>
                <div class="row text-center">
                    <? $countArt = count($modelGalleryArt);
                    if ($countArt == 0):?>
                        <h3>В этой категории еще нет изображений</h3>
                    <? else:?>
                        <ul id="lightgallery-2" class="list-unstyled row">
                            <? for ($i = 0; $i < $countArt; $i++):?>
                                <? if ($i < 5):?>
                                    <li class="thumbnail-wrapper" data-src="<?= '/' . $modelGalleryArt[$i]['url_image']; ?>">
                                        <a class="thumbnail" href=""
                                           style="background-image:url('<?= '/' . $modelGalleryArt[$i]['url_image']; ?>')">
                                            <i class="material-icons">&#xE8FF;</i>
                                        </a>
                                    </li>
                                <? else:?>
                                    <li class="marg" data-src="<?= '/' . $modelGalleryArt[$i]['url_image']; ?>">
                                    </li>
                                <? endif; ?>
                            <? endfor; ?>
                        </ul>
                    <? endif; ?>
                </div>
            </div>
        </section>
        <!-- ART GALLARY - END -->
    </div>
    <!-- =============== 4. AUTORS FURNITURE =============== -->
    <div class='part four'>
        <!-- FURNITURE CAPTION - START -->
        <section class="article furniture-caption">
            <div class="container">
                <div class="row content">
                    <div class="cont-bdr-top bdr"></div>
                    <div class="cont-bdr-right bdr"></div>
                    <h5>
                        <span class="h-bdr-top bdr"></span>
                        <span class="h-bdr-left bdr"></span>
                        <?= nl2br($model[3]->title) ?>
                        <span class="h-bdr-bottom bdr"></span>
                    </h5>
                    <p>
                        <?= nl2br($model[3]->content) ?>
                    </p>
                    <div class="cont-bdr-bottom bdr"></div>
                </div>
            </div>
        </section>
        <!-- FURNITURE CAPTION - END -->
        <!-- FURNITURE GALLARY - START -->
        <section class="gallary">
            <div class="container">
                <h3 class="title"><span>Авторская мебель</span></h3>
                <div class="row text-center">
                    <? $countFurniture = count($modelGalleryFurniture);
                    if ($countFurniture == 0):?>
                        <h4>В этой категории еще нет изображений</h4>
                    <? else:?>
                        <ul id="lightgallery-3" class="list-unstyled row">
                            <? for ($i = 0; $i < $countFurniture; $i++):?>
                                <? if ($i < 5):?>
                                    <li class="thumbnail-wrapper"
                                        data-src="<?= '/' . $modelGalleryFurniture[$i]['url_image']; ?>">
                                        <a class="thumbnail" href=""
                                           style="background-image:url('<?= '/' . $modelGalleryFurniture[$i]['url_image']; ?>')">
                                            <i class="material-icons">&#xE8FF;</i>
                                        </a>
                                    </li>
                                <? else:?>
                                    <li class="marg" data-src="<?= '/' . $modelGalleryFurniture[$i]['url_image']; ?>">
                                    </li>
                                <? endif; ?>
                            <? endfor; ?>
                        </ul>
                    <? endif; ?>
                </div>
            </div>
        </section>
        <!-- FURNITURE GALLARY - END -->
    </div>


    <!-- BLOG - START -->
    <section class='blog container'>
        <h3 class="title"><span>Блог</span></h3>
        <div id='blogContainer'>
            <div class="row blogRow" id='blog'>
                <?php for ($i = 0; $i < count($modelBlog) ; $i++): ?>
                    <div class='col-lg-4 block'>
                        <?php if (!empty($modelBlog[$i]->poster_url)): ?>
                            <img src='<?= Html::encode($modelBlog[$i]->poster_url) ?>' alt=''>
                        <?php endif; ?>
                        <article>
                            <h5><?= Html::encode($modelBlog[$i]->title) ?></h5>
                            <p><?= Html::encode($modelBlog[$i]->preView) ?></p>
                            <a href='#blogView' style='cursor:pointer' onclick='showBlog(<?= Html::encode($modelBlog[$i]->id) ?>)'>
                                <p class='read-more'>Читать дальше</p>
                            </a>
                        </article>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        <?php if (count($modelBlog) > 3) : ?>
            <div id="moreBlogs" class="block">
                <p class='block read-more moreBlogs' onclick="moreBlogs()">Больше блогов</p>
            </div>
        <?php endif; ?>

    </section>
    <!-- BLOG - END -->


    <!-- BAD IDEAS - START -->
    <section id="blogView" class="bad-ideas">
        <div class="container">
            <div class="row">
                <div id='blogContent' class="col-md-12">

                </div>
                <div class="bdr-right"></div>
                <div class="bdr-bottom"></div>
            </div>
        </div>
    </section>
    <!-- BAD IDEAS - END -->

    <!-- TeamNew - START -->
    <section class="team">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title"><span>Команда</span></h3>
                </div>
            </div>
            <div class="row">
            <?php for ($i = 0; $i < count($modelTeam); $i++) : ?>
                <div class="col-md-12 col-lg-6 mb-4 <?= $i % 2 ? 'right' : 'left';?>">
                    <div class="team-person-block">
                        <div class="img-wrap">
                            <div style="background-image:  url(<?= $modelTeam[$i]->image ?>)"></div>
                        </div>
                        <div class="person-info">
                            <div class="person-name"><span><?= $modelTeam[$i]->name ?></span></div>
                            <div class="person-profession"><?= $modelTeam[$i]->profession ?></div>
                            <div class="person-experience"><?= $modelTeam[$i]->experience ?></div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
            </div>
        </div>
    </section>
    <!-- TeamNew - END -->

    <!-- HISTORY - START -->
    <section class="history">
        <div class="container">
            <h3 class="title"><span>История</span></h3>
            <div class="row history-block">
                <div class="history-block">
                    <div class="desc">
                        <div class="bdr-bottom"></div>
                        <div class="bdr-left"></div>
                        <div class="bdr-top"></div>
                        <p><?= $modelHistory->description ?> </p>
                    </div>
                    <div class="image">
                        <img src="/images/history-img.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- HISTORY - END -->
    <!-- BACK-TO-UP BUTTON - START -->
    <div class="back-to-top">
        <i class="arrow-up"></i>
    </div>
    <!-- BACK-TO-UP BUTTON - END -->
</main>
<footer>
    <div class="container">
        <h3 id="qqq">Наши партнеры</h3>
        <div class='row'>
            <?php for ($i = 0; $i < count($partners); $i++) : ?>
                <div class="col-sm-6">
                        <a target="_blank" href="<?= $partners[$i]->link ?>" class='partners <?= $i % 2 ? 'right' : 'left';?>'>
                            <div style="background-image: url(<?= $partners[$i]->image ?>);"></div>
                            <span><?= $partners[$i]->name ?></span>
                        </a>
                </div>
            <?php endfor; ?>
        </div>
        <div class="row">
            <div class="contacts">
                <div class="block left">
                    <a href="http://design4sisters.com/"><img src="/images/siteIcons/logo.svg" alt=""></a>
                </div>
                <div class="block middle">
                    <a target="_blank" href="https://www.instagram.com/<?= $modelSocial->instagram ?>"><i class="fab fa-instagram"></i></a>
                    <a target="_blank" href="<?= $modelSocial->facebook ?>"><i class="fab fa-facebook-f"></i></a>
                    <a target="_blank" href="<?= $modelSocial->twitter ?>"><i class="fab fa-twitter"></i></a>
                    <a href="tel:<?= $modelSocial->viber ?>"><i class="fab fa-viber"></i></a>
                </div>
                <div class="block right">
                    <div class="wrap">
                        <a href="tel:<?= $modelContacts->phone ?>"><p><i class="phone"></i><?= $modelContacts->phone ?></p></a>
                        <a target='_blank' href="<?= $modelContacts->site_link ?>"><p><i class="globe"></i><?= $modelContacts->site_link ?></p></a>
                        <a target='_blank' href="https://www.google.com.ua/maps/place/<?= $modelContacts->address ?>"><p><i class="location"></i><?= $modelContacts->address ?></p></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
<script src='/js/app.js'></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"
        integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-pager.js/master/dist/lg-pager.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-fullscreen.js/master/dist/lg-fullscreen.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-hash.js/master/dist/lg-hash.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-share.js/master/dist/lg-share.js"></script>
<script>
    $(document).ready(function () {
        $("#qqq").click(function () {
            $.ajax({
                url: "/dev/showcategory", success: function (result) {
                    document.getElementById("#qqq").innerHTML = result.info;
                }
            });
        });
    });

    $(document).mouseup(function (e){
        var x = $(".navbar-toggler");
        if (!x.is(e.target) && x.has(e.target).length === 0 && $("#navbarSupportedContent").hasClass("show")) {
            x.click();
        }
    });
</script>
</body>
</html>