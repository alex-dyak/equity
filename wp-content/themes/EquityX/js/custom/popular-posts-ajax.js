(function () {
    jQuery(function($) {

      $(document).ready(function() {
        $('ul.popular-posts-list').mCustomScrollbar();
        $('div.popular-posts a.view-more').on('click', function(e) {
          e.preventDefault();
          var url = $(e.target).attr('href');
          var params = getUrlParams(url);
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
            },
            success: function (response) {
              // Load json data from server and output message.
              if (response.type != 'error') {
                $("ul.popular-posts-list .mCSB_container").append(response.content); //load new content inside .mCSB_container
                $("ul.popular-posts-list").mCustomScrollbar("update");
                $("div.popular-posts a.view-more").attr("href", "/?offset="+response.offset+"&limit="+response.limit);
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
