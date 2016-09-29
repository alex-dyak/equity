(function () {
    jQuery(function($) {
        $(document).ready(function() {
            var $mobTrigger = $('.js-mobTrigger'),
                $mobWrapp = $('.js-mobWrap');
            $mobTrigger.on('click', function(e) {
                e.preventDefault();
            });
            $mobWrapp.materialmenu({
                buttonClass: 'js-mobTrigger',
                mobileWidth: 1023
            });
            $('.js-videoBox').swipebox();
            headerPosition();

        });

        $(window).scroll(function() {
            headerPosition();
        });

        function headerPosition() {
            var $header = $('.js-header'),
                position = $(window).scrollTop();
            if( position > 0 ) {
                $header.addClass('is-not-top');
            } else {
                $header.removeClass('is-not-top')
            }
        }
    });
})();
