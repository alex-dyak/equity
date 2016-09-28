(function () {
    jQuery(function($) {
        $(document).ready(function(){
            var $mobTrigger = $('.js-mobTrigger'),
                $mobWrapp = $('.js-mobWrap'),
                $mobClose = $('.js-mobClose');
            $mobWrapp.materialmenu({
                buttonClass: 'js-mobTrigger',
                mobileWidth: 1023
            });
        });
    });
})();
