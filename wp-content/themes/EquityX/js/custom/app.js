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
            equalHeight($('.js-equalItems'));
            $('.js-linkTooltip').click(function(e) {
                e.preventDefault();
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
