$(document).ready(function ($) {

    $(window).load(function () {
        $('.scroll-up').fadeOut();
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scroll-up').fadeIn(600);
        } else {
            $('.scroll-up').fadeOut(600);
        }
    });

    $('.scroll-up').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 800);
        // return false;
    });
    //scroll-up
    // sort

    $('.click-sidebar').click(function () {
        $('.sidebar-form').slideToggle(500,'linear');
    });
    // click-sidebar form

    $('.contact').click(function () {
        $('.show-contact-span').toggle();
    });
});