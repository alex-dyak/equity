(function () {
    jQuery(function($) {
        $(document).ready(function() {
            var $mobTrigger = $('.js-mobTrigger'),
                $mobWrapp = $('.js-mobWrap'),
                $mobClose = $('.js-mobClose');
            $mobWrapp.materialmenu({
                buttonClass: 'js-mobTrigger',
                mobileWidth: 1023
            });
            headerPosition();
        });
        $(window).scroll(function() {
            headerPosition();
        });
        function headerPosition() {
            var $header = $('.js-header'),
                position = $(window).scrollTop();
            if( position > 0 ) {
                $header.addClass('not-top');
            } else {
                $header.removeClass('not-top')
            }
        }
    });
})();
