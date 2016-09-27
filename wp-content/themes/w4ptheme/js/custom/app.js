(function () {
    jQuery(function($) {
        $(document).ready(function(){
            var $mobTrigger = $('.js-mobTrigger'),
                $mobWrapp = $('.js-mobWrap'),
                $mobClose = $('.js-mobClose'),
                $html = $('html');
            $mobTrigger.click(function(e){
                e.preventDefault();
                $mobWrapp.addClass('is-opened');
                $html.addClass('is-blocked');
            });
            $mobClose.click(function(){
                $mobWrapp.removeClass('is-opened');
                $html.removeClass('is-blocked');
            });
        });
    });
})();
