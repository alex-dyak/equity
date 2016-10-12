(function () {
    jQuery(function($) {

      $(document).ready(function() {
        var $popularWidget = $('.js-popularPosts'),
            $scrollArea = $('.js-popularScrollArea'),
            $scrollMore = $popularWidget.find('.js-popularMore');
        $scrollArea.mCustomScrollbar();
        $scrollMore.on('click', function(e) {
          e.preventDefault();
          var scrollAreaHeight = $scrollArea.height(),
          url = $(this).attr('href');
          var params = getUrlParams(url);
          $scrollMore.addClass('is-active');
          jQuery.ajax({
            type: 'POST',
            url: ajax_data.ajaxurl,
            data: {
              action: "popular-posts",
              offset: params.offset,
              limit: params.limit
            },
            dataType: 'json',
            beforeSend: function () {
              // Set a preloader here.
              $popularWidget.addClass('is-active');
              $scrollArea.height(scrollAreaHeight);
            },
            success: function (response) {
              // Load json data from server and output message.
              if (response.type != 'error') {
                $("ul.popular-posts-list .mCSB_container").append(response.content); //load new content inside .mCSB_container
                $scrollArea.mCustomScrollbar("update");
                $scrollMore.attr("href", "/?offset="+response.offset+"&limit="+response.limit).removeClass('is-active');
              } else {
                $scrollMore.addClass('is-active is-noPosts');
              }
            }
          });
        });
      });

      function getUrlParams(url) {
        var params = {};
        url.substring(1).replace(/[?&]+([^=&]+)=([^&]*)/gi,
          function (str, key, value) {
            params[key] = value;
          });
        return params;
      }

    });

})();
