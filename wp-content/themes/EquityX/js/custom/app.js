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
            $('.js-loginPopup').magnificPopup({
                type:'inline',
                mainClass: 'loginWrap',
                midClick: true
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
                dots: true,
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
            mobileDefine();

            var $subMenu = $('.js-hoveredMenu').find('.menu>li>.sub-menu'),
                $links = $subMenu.closest('li').find('>a');

            if( $('body').hasClass('is-touch') ){
                $links.addClass('is-prevented');
                if( $('.js-hoveredMenu').length ){
                    $links.hover(function() {
                        $(this).closest('li').toggleClass('is-active');
                        //$links.toggleClass('is-prevented');
                    }, function() {
                        $links.addClass('is-prevented');
                    });
                }
            }

            $('body').on('click', '.is-prevented', function(e) {
                e.preventDefault();
                $(this).removeClass('is-prevented');
            })

            scrollToSelected();

        });

        $(window).scroll(function() {
            headerPosition();
        });

        $(window).resize(function() {
            equalHeight($('.js-equalItems'));
            slideEqualizer();
            mobileDefine();
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

        function mobileDefine() {
            // Define on the touch device
            function is_touch_device() {
                return (('ontouchstart' in window)
                || (navigator.MaxTouchPoints > 0)
                || (navigator.msMaxTouchPoints > 0));
            }
            if (is_touch_device()) {
                $('body').addClass('is-touch');
            }
            // end
        }

        function scrollToSelected() {
            if( $('[data-scroll-toselected]').length ) {
                var $selected = $('[data-scroll-toselected]'),
                    selectedPosition = $selected.offset().top,
                    destination = selectedPosition - $('.js-header').height() - 100;
                $('html, body').animate({
                    scrollTop: destination
                }, 1000);
                $selected.addClass('is-selected')
            }
        }

        // Custom Form - active label
        $('.js-equityx-form').find('.customForm-inputBox input, textarea').on('keyup blur focus', function (e) {

            var $this = $(this),
                label = $this.prev('label');

            if (e.type === 'keyup') {
                console.log('keyup');
                if ($this.val() === '') {
                    label.removeClass('is-active is-focus');
                } else {
                    label.addClass('is-active is-focus');
                }
            } else if (e.type === 'blur') {
                console.log('blur');
                if( $this.val() === '' ) {
                    label.removeClass('is-active is-focus');
                } else {
                    label.removeClass('is-focus');
                }
            } else if (e.type === 'focus') {
                console.log('focus');

                if( $this.val() === '' ) {
                    label.removeClass('is-active is-focus');
                    label.addClass('is-active is-focus');
                }
                else if( $this.val() !== '' ) {
                    label.addClass('is-focus');
                }
            }

        });

    });
})();
