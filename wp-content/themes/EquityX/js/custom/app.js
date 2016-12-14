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
            var autoPlay = "?rel=0&autoplay=1",
                $videoFrame = $('.js-video-iFrame'),
                frameValue = $videoFrame.attr('src'),
                newValue = frameValue + autoPlay;
            $('.js-videoBox').click(function(e){
                e.preventDefault();
            });
            $('.js-videoBox').magnificPopup({
                type:'inline',
                midClick: true,
                callbacks: {
                    open: function() {
                        $videoFrame.attr('src', newValue);
                    },
                    close: function() {
                        $videoFrame.attr('src', frameValue);
                    }
                    // e.t.c.
                }
            });
            $('.js-LogoSlider').slick({
                infinite: true,
                autoplay: true,
                draggable: false,
                arrows: false,
                adaptiveHeight: true
            });
            $('.js-testimonialsSlider').slick({
                infinite: true,
                autoplay: true,
                draggable: false,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            draggable: false
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
            slideEqualizer();
            if ( $(window).width() > 1024 ){
                footerMenuMob();
            }
        });

        $(window).scroll(function() {
            headerPosition();
        });

        $(window).resize(function() {
            equalHeight($('.js-equalItems'));
            slideEqualizer();
            footerMenuMob();
            if ( $(window).width() > 2024 ){
                footerMenuMob();
            }
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

        function slideEqualizer() {
            if ( $(window).width() > 767 ){
                $('.js-testimonialsSlider').on('setPosition', function () {
                    $(this).find('.slick-slide').height('auto');
                    var slickTrack = $(this).find('.slick-track');
                    var slickTrackHeight = $(slickTrack).height();
                    $(this).find('.slick-slide').css('height', slickTrackHeight + 'px');
                });
            } else {
                $('.js-testimonialsSlider').find('.slick-slide').height('auto');
            }
        }

        function equalHeight($equalContainer) {
            var windowWidth = window.innerWidth,
                $columns = $('body').find('[data-equal]');
            $columns.height('auto');
            if ( windowWidth > 767 ) {
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

        function footerMenuMob() {
            var $menuContainer = $('.js-footerMenu'),
                $menuItem = $menuContainer.find('ul.menu'),
                $links = $menuItem.find('li > a');
            $links.each(function(){
                if( $(this).closest('li').find('.sub-menu').length ) {
                    $(this).addClass('js-prevented')
                }
            });
            $('body').on('click', '.js-prevented', function(e) {
                e.preventDefault();
                $(this).removeClass('js-prevented');
                $(this).closest('li').find('.sub-menu').addClass('is-visible')
            })
        }

    });
})();
