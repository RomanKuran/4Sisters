$id_category = 1;
$offset = 3;

// SHOW AND HIDE CONTENT ON CLICK
function showSection(el) {
    $('.part').each(function () {
        $(this).not(el).fadeOut(200);
    });
    $(el).fadeIn(200);

// REMOVE FRAMES
    $('.article').removeClass('fire');
    $('.bad-ideas').removeClass('fire');
    $('.history').removeClass('fire');
    $('.text-block').removeClass('fire');
    $('.bdr').addClass('removeTrans');

    $('#blogView').hide();
    $offset = 3;

    switch (el) {
        case '.one':
            $id_category = 1;
            break;
        case '.two':
            $id_category = 2;
            break;
        case '.three':
            $id_category = 3;
            break;
        case '.four':
            $id_category = 4;
            break;
    }

    $.ajax({
        url: '/dev/blog-category',
        type: "GET",
        data: {id: $id_category},
        dataType: "json",
        success: function (response) {
            $("#blogContainer").html('<div></div>');
            $("#blogContainer").html(response.blogRow);
            if ($("div").is("#moreBlogs")) {
                $("#moreBlogs").replaceWith(response.moreBlogs);
            }
            else {
                $("#blogContainer").after(response.moreBlogs);
            }
        }
    });

}

function showBlog(id) {
    $.ajax({
        url: '/dev/blog-open',
        type: "GET",
        data: {id: id},
        success: function (data) {
            $("#blogContent").html(data);
            $('#blogView').show();
        }
    });

    $('#blogView').show();

    $('html, body').animate({
        scrollTop: $('#blogView').offset().top},
        500,
        'swing');
    return false;
}

function moreBlogs() {
    $.ajax({
        url: '/dev/more-blogs',
        type: "GET",
        data: {id: $id_category, offset: $offset},
        dataType: "json",
        success: function (response) {
            // var response = JSON.parse(data);
            $("#blogContainer").append(response.blogRow);
            $("#blogContainer .blogRow:last-child").hide().show(1000);
            if (response.moreBlogs == '') {
                $("#moreBlogs").remove();
            }
            $offset += 3;
        }
    });
}

$(document).ready(function(event){

    $('#blogView').hide();

// MODIFYING GALLARYS
    lightGallery(document.getElementById('lightgallery'), {
        galleryId: 1,
        mode: 'lg-slide',
        width: '85%',
        zoom: false,
        fullScreen: true,
        autoplay: false,
        preload: 3,
        download: false
    });

    lightGallery(document.getElementById('lightgallery-2'), {
        galleryId: 2,
        mode: 'lg-slide',
        width: '85%',
        zoom: false,
        fullScreen: true,
        autoplay: false,
        preload: 3,
        download: false
    });

    lightGallery(document.getElementById('lightgallery-3'), {
        galleryId: 3,
        mode: 'lg-slide',
        width: '85%',
        zoom: false,
        fullScreen: true,
        autoplay: false,
        preload: 3,
        download: false
    });

// CHANGE IMAGE ATTR ON RESIZING WIDTH WINDOW
    // if($(window).width() < 576) {
    //   $( "#respons-1" ).attr('src', 'images/gallary/gallary1.jpg');
    //   $( "#respons-2" ).attr('src', 'images/gallary/gallary2.jpg');
    //   $( "#respons-3" ).attr('src', 'images/gallary/gallary3.jpg');
    // }

    // $(window).resize(function(){
    //   if($(window).width() < 576) {
    //     $( "#respons-1" ).attr('src', 'images/gallary/gallary1.jpg');
    //     $( "#respons-2" ).attr('src', 'images/gallary/gallary2.jpg');
    //     $( "#respons-3" ).attr('src', 'images/gallary/gallary3.jpg');
    //   } else{
    //     $( "#respons-1" ).attr('src', 'images/gallary/gallary1_sq.jpg');
    //     $( "#respons-2" ).attr('src', 'images/gallary/gallary2_sq.jpg');
    //     $( "#respons-3" ).attr('src', 'images/gallary/gallary3_sq.jpg');
    //   }
    // });

// CAROUSEL
    $('.carousel').carousel({
        interval: false
    })

// When the user scrolls down, show the button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 925) {
            $('.back-to-top').fadeIn(200);
        } else {
            $('.back-to-top').fadeOut(200);
        }
    })

// When the user clicks on the scroll-up button, scroll to the top of the document
    $('.back-to-top').click(function () {
        $("html, body").stop().animate({scrollTop: 0}, 500, 'swing');
        return false;
    })

// When the user clicks on the contact-us button
    $('.contact-link').click(function () {
        $('body, html').animate({scrollTop: $('body').height()}, 500, 'swing');
        return false;
    })
// When the user clicks on the navigations buttons
    $('#services-nav').click(function () {
        $('html, body').animate({scrollTop: $('#carouselExampleIndicators').offset().top + $('#carouselExampleIndicators').height()}, 500, 'swing');
        return false;
    });

    $('#blog-nav').click(function () {
        $('html, body').animate({scrollTop: $('.blog').offset().top}, 500, 'swing');
        return false;
    });

    $('#about-us-nav').click(function () {
        $('html, body').animate({scrollTop: $('.team').offset().top}, 500, 'swing');
        return false;
    });

    $('#contacts-nav').click(function () {
        $('body, html').animate({scrollTop: $('body').height() - document.documentElement.clientHeight}, 700, 'swing');
    })

// FRAMES ANIMATION LOGIK
    $(window).scroll(function () {
        $('.bdr').removeClass('removeTrans');

        let bottomWindow = $(this).scrollTop() + $(this).height();
        let bottomArticle = $('.article').not(':hidden').offset().top + $('.article').not(':hidden').height();

        if (bottomWindow >= bottomArticle) {
            $('.article').addClass('fire').addClass('removeTrans');
        }
        if (bottomWindow >= ($('.bad-ideas').offset().top + $('.bad-ideas').height())) {
            $('.bad-ideas').addClass('fire');
        }
        if (bottomWindow >= ($('.history').offset().top + $('.history').height())) {
            $('.history').addClass('fire');
        }
        // TEXT BLOCKS
        if ($('.tb-1').offset().top > 0 && bottomWindow >= ($('.tb-1').not(':hidden').offset().top + $('.tb-1').not(':hidden').height() + 100)) {
            $('.tb-1').addClass('fire');
        }
        if ($('.tb-2').offset().top > 0 && bottomWindow >= ($('.tb-2').not(':hidden').offset().top + $('.tb-2').not(':hidden').height() + 100)) {
            $('.tb-2').addClass('fire');
        }
        if ($('.tb-3').offset().top > 0 && bottomWindow >= ($('.tb-3').not(':hidden').offset().top + $('.tb-3').not(':hidden').height() + 100)) {
            $('.tb-3').addClass('fire');
        }
        if ($('.tb-4').offset().top > 0 && bottomWindow >= ($('.tb-4').not(':hidden').offset().top + $('.tb-4').not(':hidden').height() + 100)) {
            $('.tb-4').addClass('fire');
        }
        if ($('.tb-5').offset().top > 0 && bottomWindow >= ($('.tb-5').not(':hidden').offset().top + $('.tb-5').not(':hidden').height() + 100)) {
            $('.tb-5').addClass('fire');
        }
        if ($('.tb-6').offset().top > 0 && bottomWindow >= ($('.tb-6').not(':hidden').offset().top + $('.tb-6').not(':hidden').height() + 100)) {
            $('.tb-6').addClass('fire');
        }

    });

})
