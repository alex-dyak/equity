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
            headerPosition();
            equalHeight($('.js-equalItems'));
            $('.js-linkTooltip').click(function(e) {
                e.preventDefault();
            });
            $('.js-linkTooltip').hover(function() {
                $(this).toggleClass('is-active');
            });
            var $searchHolder = $('.js-searchHolder'),
                $searchTrigger = $('.js-searchTrigger'),
                $searchClose = $('.js-closeSearchForm');
            $searchTrigger.click(function(e){
                e.preventDefault();
                $searchHolder.addClass('is-opened');
            });
            $searchClose.click(function(){
                $searchHolder.removeClass('is-opened');
            });
            $('.js-gotoLinks').each( function () {
                var $link = $(this).find('a'),
                destination = $link.attr('href');
                if( $link.length ){
                    $link.on('click', function (e) {
                        e.preventDefault();
                        $('html, body').animate({
                            scrollTop: $(destination).offset().top - $('.js-header').outerHeight() - 30
                        }, 1000);
                    });
                }
            });
            $('.js-videoBox').magnificPopup({
                type: 'iframe',
                patterns: {
                    youtube: {
                        index: 'youtube.com/',

                        id: 'v=',
                        src: '//www.youtube.com/embed/%id%?autoplay=1'
                    },
                    vimeo: {
                        index: 'vimeo.com/',
                        id: '/',
                        src: '//player.vimeo.com/video/%id%?autoplay=1'
                    },
                    gmaps: {
                        index: '//maps.google.',
                        src: '%id%&output=embed'
                    }
                },
                srcAction: 'iframe_src',
            });
        });

        $(window).scroll(function() {
            headerPosition();
        });

        $(window).resize(function() {
            equalHeight($('.js-equalItems'));
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

        function equalHeight($equalContainer) {
            var windowWidth = window.innerWidth,
                $columns = $('body').find('[data-equal]');
            $columns.height('auto');
            if ( windowWidth > 1025 ) {
                $equalContainer.each(function () {
                    var $this = $(this),
                        columns = $this.find('[data-equal]'),
                        tallestcolumn = 0;
                    columns.height('auto');
                    columns.each(function () {
                        var currentHeight = $(this).height();
                        if (currentHeight > tallestcolumn) {
                            tallestcolumn = currentHeight;
                        }
                    });
                    columns.height(tallestcolumn);
                });
            }
        }

    });
})();