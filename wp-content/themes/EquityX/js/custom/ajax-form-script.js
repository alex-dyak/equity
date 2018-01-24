jQuery(document).ready(function ($) {
  $('#contactbutton').click(function () {
    var first_name = $('#first_name').val();
    var email = $('#email').val();
    if (!first_name || !email) {
      $('#contact-msg').html('At least one of the form fields is empty.');
      return false;
    } else {
        $.ajax({
          type: 'POST',
          url: ajax_object.ajax_url,
          data: $('#equityx_form').serialize(),
          dataType: 'json',
          success: function (response) {
            if (response.status == 'success') {
              $('#equityx_form')[0].reset();
            }
            $('#contact-msg').html(response.errmessage);
          }
        });
      }
    }
  );
});
