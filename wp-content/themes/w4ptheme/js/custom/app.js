(function () {
  jQuery(function($) {
    $(document).ready(function(){
      $('.js-videoBox').swipebox();
      $('.js-wow').on('click', function() {
        setTimeout(function(){
          var lol = $('.js-videoItem').contents().find("video").eq(0).attr('src')
          //.contents().find("video").get(0)
          console.log(lol);
        }, 1000)
      });
    });
  });
})();
