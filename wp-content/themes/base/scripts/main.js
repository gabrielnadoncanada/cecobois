(function ($) {
    $('.trigger-form').on('click', function (e) {
        e.preventDefault();
        toggleLoginForm(e);
    });
    $('body:not(.logged-in) #calculatrices-cebobois .calc_cecobois').on('click', function (e) {
        toggleLoginForm(e);
    });

    function toggleLoginForm(e) {
        e.preventDefault();
        $(window).scrollTop(0);
        $('header #loginform').slideToggle('fast');
        $('header .wp-block-social-links').toggleClass('formOpen');

        // Add event listener to body element to remove slideToggle on body click
        $('body').on('click', function (event) {
            if (!$(event.target).closest('#loginform').length && !$(event.target).closest('#calculatrices-cebobois').length
            && !$(event.target).closest('.trigger-form').length) {
                $('header #loginform').slideUp('fast');
                $('header .wp-block-social-links').removeClass('formOpen');
            }
        });
    }
}(jQuery));
