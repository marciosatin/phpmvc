(function($) {
    $(function() {
        $(window).on('load', function() {
            $(".preloader-wrapper").fadeOut();
            $(".content").fadeIn().css('opacity', '1');
        });
        $('.button-collapse').sideNav();
        $('.parallax').parallax();
        $('.slider').slider({full_width: true});
       
        var options = [
            {selector: '.slider', offset: 500, callback: 'F.x()'}
        ];
        Materialize.scrollFire(options);

    }); // end of document ready
})(jQuery); // end of jQuery name space
;window.F = {};
F.x = function() {
    $('.slider').removeClass('hide');
}


