$(document).ready(function ($) {

    $(window).scroll(function () {
        if ($(this).scrollTop() > 39 ) {
            
            $('.right-sidebar').addClass('right-side-bar-position');

            if ($(this).scrollTop() > 2950) {
                $('.right-sidebar').removeClass('right-side-bar-position');
                $('.right-sidebar').css({'margin-top':'2900px'});
            } else {
                $('.right-sidebar').css({'margin-top':'0px'});
            }
            
        } else {
            $('.right-sidebar').removeClass('right-side-bar-position');
        }

        if ($(this).scrollTop() > 620) {

            $('.sidebar').addClass('side-bar-position');

            if ($(this).scrollTop() > 1600) {
                $('.sidebar').removeClass('side-bar-position');
                $('.sidebar').css({'margin-top':'970px'});
            } else {
                $('.sidebar').css({'margin-top':'0px'});
            }
        } else {
            $('.sidebar').removeClass('side-bar-position');
        }
    });

    $("li[id*='s']").click(function() {
        let a = $(this).attr("id");
        if ($('.'+a).hasClass('fa-long-arrow-alt-down')) {
            $('.'+a).addClass('fa-long-arrow-alt-up');
            // $('.'+a).removeClass('fa-long-arrow-alt-down');
            $('.s1').removeClass('fa-long-arrow-alt-down');
            $('.s2').removeClass('fa-long-arrow-alt-down');
            $('.s3').removeClass('fa-long-arrow-alt-down');
            $('.s1').attr('value', '');
            $('.s2').attr('value', '');
            $('.s3').attr('value', '');
            $('.'+a).attr('value', 'tang-dan');
        } else if ($('.'+a).hasClass('fa-long-arrow-alt-up')) {
            $('.'+a).removeClass('fa-long-arrow-alt-up');
            $('.s1').removeClass('fa-long-arrow-alt-down');
            $('.s2').removeClass('fa-long-arrow-alt-down');
            $('.s3').removeClass('fa-long-arrow-alt-down');
            $('.s1').attr('value', '');
            $('.s2').attr('value', '');
            $('.s3').attr('value', '');
        } else { 
            $('.s1').removeClass('fa-long-arrow-alt-down');
            $('.s2').removeClass('fa-long-arrow-alt-down');
            $('.s3').removeClass('fa-long-arrow-alt-down');
            $('.s1').removeClass('fa-long-arrow-alt-up');
            $('.s2').removeClass('fa-long-arrow-alt-up');
            $('.s3').removeClass('fa-long-arrow-alt-up');
            $('.s1').attr('value', '');
            $('.s2').attr('value', '');
            $('.s3').attr('value', '');
            $('.'+a).addClass('fa-long-arrow-alt-down');
            $('.'+a).attr('value', 'giam-dan');
        }
    });

    $("a[href*='#']").click(function() {
        let target = $(this).attr("href");
        $('html,body').stop().animate({
          scrollTop: $(target).offset().top
        }, 500);
        event.preventDefault();
      });
    //   stop dung animate dang chay
    // event. k thay bi loi load

    //   $("a[href*='#']:not([href='#])").click(function() {
    //     let target = $(this).attr("href");
    //     $('html,body').stop().animate({
    //       scrollTop: $(target).offset().top
    //     }, 1000);
    //     event.preventDefault();
    //   });
})